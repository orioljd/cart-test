# Uso de Laravel como framework

He usado Laravel como framework, dado que en la actualidad es el que más domino.

- [Web oficial de laravel](https://laravel.com/).

He recurrido en algunas ocasiones a metodos de 
[Collections](https://laravel.com/docs/7.x/collections) que me permiten trabajar
con arrays de una forma más sencilla. He usado 
[filter](https://laravel.com/docs/7.x/collections#method-filter) para buscar
en las colecciones y [sum](https://laravel.com/docs/7.x/collections#method-sum) para
hacer la suma de los items del carrito.

## Instalación 
Para el correcto funcionamiento, después de haber hecho `clone` del proyecto,
desde el directorio del proyecto deberemos ejecutar:

<code>
composer install
</code>

### Linux permissions problems
Es posible que hayan problemas de permisos de acceso a los directorios 
logs y cache por eso recomiendo seguir las instrucciones en el caso de que pase:

- https://stackoverflow.com/a/37266353/7047274

# Currency Class
Para obtener las monedas respecto al euro he utilizado el servicio que habeis sugerido:
- https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html

Dado lo que dicen en el propio servicio:

> The reference rates are usually updated around 16:00 CET on every working day, 
except on TARGET closing days. They are based on a regular daily concertation 
procedure between central banks across Europe, which normally takes place at 14:15 CET.

Lo ideal es que esto se haga cada 24 horas preferiblemente justo después de las
16:00h CET, y se actualicen las diferentes monedas en base de datos. Ahora mismo
lo obtengo en el momento de la petición del total en otra moneda, pero evidentemente
no sería así en producción.

# Unit testing

El código del carrito está en el directorio /app/Libs/ y el código de testear en
/tests/Unit/

Desde la raiz del proyecto /cart/ se puede testear el código usando el comando 
``artisan`` :

<code>
php artisan test
</code>

Aunque si se prefiere el método standard sería:

<code>
./vendor/bin/phpunit
</code>
