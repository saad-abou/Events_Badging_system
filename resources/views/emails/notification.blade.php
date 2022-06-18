@component('mail::message')

<p>
    Mr/Mme {{ $msg['nom'] }} {{ $msg['prenom'] }} a ajouté une preuve de paiement
</p>

<p>
    email : {{ $msg['email'] }}
</p>



{{-- @component('mail::button', ['url' => 'http://127.0.0.1:8000/report', 'color' => 'success'])

@endcomponent --}}

@endcomponent
