<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function getMe()
    {
        $response = Telegram::getMe();
        return $response;
    }

    public function mascotaNueva(Request $request)
    {
        $texto = "$request->nombre está listo para que lo adoptes!";
        Telegram::sendMessage([
            'chat_id' => env("TELEGRAM_CHANNEL_ID"),
            "text" => $texto,
        ]);
    }

    public function adoptar(Mascota $mascota)
    {

    }
}
