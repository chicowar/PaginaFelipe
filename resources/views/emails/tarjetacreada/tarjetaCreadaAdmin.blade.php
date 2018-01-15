@component('mail::message')
# Nueva tarjeta creada

![alt text](http://www.overthetop.mx/img/logorecortadooverthetop.png "BU")

Haz creado una nueva tarjeta para la empresa.

<dl>
    <dt>El usuario es: {{ $user['first_name'] }}</dt>
    <dt>Y ha sido creado satisfactoriamente.</dt>

    <dt>El login lo hara en la app de BU con el correo: {{ $user['email'] }}</dt>
    <dt>El password asignado es: 1234567 </dt>
</dl>

El siguiente paso es que el usuario descargue la app de BU, e ingrese para disfrutar de la aplicacion.<br>
El periodo de prueba expira el: {{ $user['vencimiento'] }}

Gracias por tu preferencia.<br>
{{ config('app.name') }}
@endcomponent
