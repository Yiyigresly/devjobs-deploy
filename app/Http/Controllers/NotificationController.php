<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // solo va a tener un metodo, asi que se usa invokee
    public function __invoke(Request $request)
    {
       
       // laravel sabe si el usuario ha recibido o no Notificaciones. No puede ver otras notificaciones mas que las suyas mismas
       $notifications = auth()->user()->unreadNotifications;

       //limpiar notificaciones
       auth()->user()->unreadNotifications->markAsRead();

       return view('notifications.index', compact('notifications'));
    }
}
