@component('mail::message')
# Confirmacion de usuario administrador creado

@component('mail::panel')
![alt text](http://www.overthetop.mx/img/logorecortadooverthetop.png "BU")
@endcomponent
<dl>
    <dt>El usuario: {{ $user->name }}</dt>
    <dt>Ha sido creado satisfactoriamente.</dt>

    <dt>El login lo haras con el correo: {{ $user->email }}</dt>
    <dt>Puedes ingresar con el password: {{ $user->password }} </dt>
</dl>
Gracias por tu preferencia.<br>
{{ config('app.name') }}
@endcomponent
