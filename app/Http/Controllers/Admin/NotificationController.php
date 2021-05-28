<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\AnnounceAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $emailList = $request->email_list;
        foreach ($emailList as $i => $email) {
            Notification::route('slack', env('SLACK_WEBHOOK_URL'))
                ->notify((new AnnounceAll($email))->delay($i*5));
        }
    }
}
