@component('mail::message')

Un nouveau Produit : <b>{{ $product->name }}</b> a bien été ajouté dans votre magasin


@component('mail::button', ['url' => $url])
    Voir le Produit
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
