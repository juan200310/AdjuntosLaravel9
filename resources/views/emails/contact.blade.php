<div>
    <h1>Nuevo mensaje desde el formulario de contacto</h1>
    <h2>Mensaje de: {{ $contact->name }}</h2>
    <p><strong>Correo:</strong> {{ $contact->email }}</p>
    <p><strong>Motivo:</strong> {{ $contact->subject }}</p>
    <p><strong>Mensaje:</strong> {{ $contact->message }}</p>
</div>
