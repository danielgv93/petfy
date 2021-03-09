<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación

1. Crear host virtual con la direccion http://petfy.es. Si no es asi, es probable que alguna imagen no se muestre correctamente
1. Instalar composer desde [aquí](https://getcomposer.org/download/)
2. Ejecutar `composer install`.
3. Clonar el archivo .env.example y cambiarlo de nombre por .env. Cambiar la linea 5 `APP_URL=http://petfy.es` y la linea
13 por el nombre de la base de datos que se haya preparado.
    
5. Ejecutar `php artisan key:generate`.
6. Ejecutar `composer require laravel/jetstream`.
7. Instalar nodejs de [aqui](https://nodejs.org/es/download/) y ejecutar los siguientes comandos:
```
npm install
npm run dev
php artisan migrate
```

8. Ejecutar `php artisan db:seed`.
9. Ejecutar `php artisan storage:link` para poder acceder desde el cliente a las imagenes.
10. Usuario de prueba:
1. Email: dani@gmail.com
2. Password: 123

## APIS

- Maps
- Telegram
- Twitter

### Maps

El refugio de cada mascota tendrá almacenado en base de datos la geolocalización, la cual se
plasmará posteriormente en la vista correspondiente. Para ello la API de google maps necesita
un fichero xml con la información del refugio. Esto se genera en el siguiente controlador:
```php
class MapaController extends Controller
{
    public function generarXML(int $id) {
        $refugio = User::query()->findOrFail($id);
        $dom = new DOMDocument("1.0");
        $nodo = $dom->createElement("markers");
        $nodoPadre = $dom->appendChild($nodo);

        $nodo = $dom->createElement("marker");
        $nodoMarker = $nodoPadre->appendChild($nodo);
        $nodoMarker->setAttribute("id", $refugio->id);
        $nodoMarker->setAttribute("name", $refugio->name);
        $nodoMarker->setAttribute("lat", $refugio->latitud);
        $nodoMarker->setAttribute("lng", $refugio->longitud);
        $xml = $dom->saveXML();
        return response($xml, 200)->header("Content-type", "text/xml");
    }
}
```
Esta fichero lo toma el script en la vista del refugio y muestra el punto en el mapa.

### Telegram

Para manejar la API de Telegram se ha utilizado la siguiente libreria en laravel
`irazasyed/telegram-bot-sdk`.

La API-KEY de este servicio se encuentra en ``config/telegram.php``

Se establece una conexión con la API en dos momentos concretos:

- Introducir nueva mascota a la base de datos (función store de MascotasController).
- Adoptar una mascota (función adoptar de MascotasController).

La funcionalidad es la misma en ambas acciones y es la siguiente.
```php
private function postPhotoTelegram($texto, $mascota)
    {
        Telegram::sendPhoto([
            'chat_id' => '-1001301205495',
            'photo' => InputFile::create(public_path("storage/$mascota->imagen"), $mascota->imagen),
            'caption' => $texto
        ]);
    }
```
Esta función privada se llama desde la funcion del controlador pertinente y se ejecuta. Los 
parámetros necesarios son: `chat_id` que es el identificador del chat en el que el bot va a
enviar el mensaje, `photo` que es la imagen subida al servidor de Telegram y `caption` que es
el texto que acompaña a la imagen.

### Twitter

Para manejar la API de Telegram se ha utilizado la siguiente libreria en laravel
` thujohn/twitter `.

Las variables de las API-KEY que necesita Twitter esta en ``config/ttwitter``, 
que a su vez recurre a las variables de entorno siguientes:
```
TWITTER_CONSUMER_KEY=rUvluz0ey7sXZqJT74kSWFSwY
TWITTER_CONSUMER_SECRET=nH0mOGoz81JPfSl0GoCkMlsbEfLYUAXzwxulwzQkh0ML67tn38
TWITTER_ACCESS_TOKEN=1367884989354893314-5lZ2Ye0D0R7en2wN8xHBJhzeiqGXi3
TWITTER_ACCESS_TOKEN_SECRET=vjPoE2MqLTlNNRtsqiv1J0NWVevahfy23spHtPcZ2HjLM
```

Al igual que en telegram, la conexion con la API de twitter se establece a las mismas acciones.
```php
private function postTwitter($texto, $mascota)
    {
        $photo = Twitter::uploadMedia(["media" => File::get(public_path("storage/$mascota->imagen"))]);
        Twitter::postTweet([
            "status" => $texto,
            "media_ids" => $photo->media_id_string
        ]);
    }
```
Como en este caso la API-KEY va asociada a nuestra cuenta de Twitter, no hara falta establecer
en donde se va a publicar la información. Esta funcion privada es similar a la de Telegram,
ya que primero necesita subir la foto al servidor de Twitter y después envía una peticion
con los datos para que se publique el tweet.
