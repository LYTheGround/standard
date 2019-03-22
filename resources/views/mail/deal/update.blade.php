@component('mail::message')
    Le Deal : <b>{{ $deal->infoBox->name }}</b> a bien été ajouté mis à jour.

@component('mail::button', ['url' => route('deal.show',$url)])
        Voir le {{ $deal->infoBox->name }}
@endcomponent
    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
