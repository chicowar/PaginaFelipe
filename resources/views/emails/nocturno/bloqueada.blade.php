


@component('mail::message')
# Tu tarjeta de presentacion ha sido bloqueada

![alt text](http://www.overthetop.mx/img/logorecortadooverthetop.png "BU")

{{ $user['username'] }}, tu tarjeta ha sido bloqueada debido a que expiro.<br>
Es necesario se realice el pago en oxxo y lo reportes al correo: xxx@xx.com para poder seguir utilizandola.<br>

<dl>
    <dt>El numero de cuenta es: xxx.xx</dt>
    <dt>Tu numero de tarjeta es: {{ $user['id'] }}</dt>
</dl>

El periodo de prueba expira el: {{ $user['vencimiento'] }}

Gracias por tu preferencia.<br>
{{ config('app.name') }}
@endcomponent
