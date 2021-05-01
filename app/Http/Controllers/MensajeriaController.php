<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Support\Facades\File;

class MensajeriaController extends Controller
{
    public function getMe()
    {
        $response = Telegram::getMe();
        return $response;
    }
    /**
     * Postea en Telegram un mensaje con un texto
     * @param $texto
     */
    public static function postTelegram($texto)
    {
        Telegram::sendMessage([
            'chat_id' => "-1001301205495",
            "text" => $texto,
        ]);
    }

    /**
     * Postea en Twitter un tweet con una imagen
     * @param $texto
     * @param $mascota
     */
    public static function postTwitter($texto, $mascota)
    {
        $photo = Twitter::uploadMedia(["media" => File::get(public_path("storage/$mascota"))]);
        Twitter::postTweet([
            "status" => $texto,
            "media_ids" => $photo->media_id_string
        ]);
    }

    /**
     * Postea en Telegram un mensaje con un texto y una imagen
     * @param $texto
     * @param $mascota
     */
    public static function postPhotoTelegram($texto, $mascota)
    {
        Telegram::sendPhoto([
            'chat_id' => '-1001301205495',
            'photo' => InputFile::create(public_path("storage/$mascota"), $mascota),
            'caption' => $texto
        ]);
    }
}
