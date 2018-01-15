@component('mail::message')
# Bienvenido al modulo de administracion BU

![alt text](http://www.overthetop.mx/img/logorecortadooverthetop.png "BU")

En este modulo podras crear y controlar las tarjetas para tu empresa, crear mas usuarios administrativos, realizar los pagos y en general saber los contactos que ha tenido cada tarjeta.

<dl>
    <dt>Tu usuario: {{ $user['name'] }}</dt>
    <dt>Ha sido creado satisfactoriamente.</dt>

    <dt>El login lo haras con el correo: {{ $user['email'] }}</dt>
    <dt>Puedes ingresar con el password: {{ $user['password'] }} </dt>
</dl>

Tu siguiente paso es llenar los datos generales de tu empresa y crear las tarjetas que necesitas para tu empresa.<br>

Gracias por tu preferencia.<br>
{{ config('app.name') }}
@endcomponent
