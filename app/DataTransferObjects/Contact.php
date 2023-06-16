<?php

namespace App\DataTransferObjects;

use Illuminate\Http\UploadedFile;

/* Adding final class comments */
final class Contact{

    private function __construct(
        public readonly string $subject,
        public readonly string $name,
        public readonly string $email,
        public readonly string $message,
        public readonly UploadedFile $file,
    ){}

    /* Adding comments to fromArray function */
    public static function fromArray(array $data): self
    {
        return new self(
            subject: data_get($data, 'subject'),
            name: data_get($data, 'name'),
            email: data_get($data, 'email'),
            message: data_get($data, 'message'),
            file: data_get($data, 'file'),
        );
    }

    public static function fromRequest(): self
    {
        $data = request()->validate([
            'subject' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'file' => 'required|file',
        ]);

        return self::fromArray($data);
    }
}