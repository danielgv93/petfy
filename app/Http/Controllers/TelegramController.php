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
        Telegram::sendMessage([
            'chat_id' => "-1001301205495",
            "text" => $request->texto,
        ]);
    }

    public function adoptar(Mascota $mascota)
    {

    }
}
