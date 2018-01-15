@component('mail::message')
# Tu tarjeta de presentacion esta lista

![alt text](http://www.overthetop.mx/img/logorecortadooverthetop.png "BU")

{{ $user['first_name'] }}, tu empresa ha creado una tarjeta de presentacion para ti.<br>
Descarga la aplicacion BU para poder acceder a ella y disfrutar de la aplicacion.<br>

<dl>
    <dt>El usuario es: {{ $user['first_name'] }}</dt>
    <dt>Haz login en la app de BU con el correo: {{ $user['email'] }}</dt>
    <dt>El password asignado es: 1234567 </dt>
</dl>

El periodo de prueba expira el: {{ $user['vencimiento'] }}

Gracias por tu preferencia.<br>
{{ config('app.name') }}
@endcomponent
