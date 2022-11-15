<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Contact;
use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): Renderable{

        return view('contact');
    }

    final public function send(): RedirectResponse
    {
        return rescue(
            callback: function ()
            {
                $contact = Contact::fromRequest();
                $admin = User::make([
                    'name' => 'Admin',
                    'email' => 'admin@test.com',
                ]);
                \Mail::to($admin)->send(new ContactMail($contact));
                return redirect()->back()->with('success', 'El correo ha sido enviado correctamente');
            },
            rescue: function ($e)
            {
                return redirect()->back()->with('error', $e->getMessage());
            },
            report: true,
        );
    }
}
