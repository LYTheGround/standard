@component('mail::message')

    Le Produit : <b>{{ $product->name }}</b> a bien été ajouté mis à jour


    @component('mail::button', ['url' => $url])
        Voir le Produit
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
