@component('mail::message')

Senhor(a) {{$email}},
Estamos ansiosos para nos comunicarmos mais com você. Para mais informações visite nosso blog.
@component('mail::button', ['url' => 'https://tip-laravel.herokuapp.com/'])
Tip
@endcomponent
Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent