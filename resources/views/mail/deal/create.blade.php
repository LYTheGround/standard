@component('mail::message')

    Un nouveau Deal : <b>{{ $deal->name }}</b> a bien été ajouté dans votre Répertoire.

@component('mail::button', ['url' => $url])
Voir le Produit
@endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
