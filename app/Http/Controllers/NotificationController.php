<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function index()
    {
        return view(
            auth()->user()->admin
                ? 'notification.admin_notification'
                : 'notification.notification'
        );
    }

    public function read()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return 'true';
    }

    public function destroy()
    {
        auth()->user()->notifications()->delete();

        return redirect()->route('notification.index');
    }

}
