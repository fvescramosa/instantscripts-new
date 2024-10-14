<?php

namespace App\Http\Controllers;

use App\Events\StartVideoChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class VideoChatController extends Controller
{
    public function callUser(Request $request)
    {
        $data = [
            'type' => 'incomingCall',
            'from' => $request->from,
            'signalData' => $request->signal_data,
        ];

        broadcast(new StartVideoChat($data))->toOthers();

        return response()->json(['status' => 'call initiated']);
    }

    public function acceptCall(Request $request)
    {
        $data = [
            'type' => 'callAccepted',
            'signal' => $request->signal,
            'to' => $request->to,
        ];

        broadcast(new StartVideoChat($data))->toOthers();

        return response()->json(['status' => 'call accepted']);
    }



    public function index(Request $request) {
        $user = backpack_user();

        $others = User::where('id', '!=', backpack_user()->id)->pluck('name', 'id');
        return view('video-chat-new')->with([
            'user' => collect(backpack_user()->only(['id', 'name'])),
            'others' => $others
        ]);
    }

    public function auth(Request $request) {
        $user = backpack_user();
        $socket_id = $request->socket_id;
        $channel_name = $request->channel_name;
        $pusher = new Pusher(
            '0e565a374c2bf7d0df35',
           'f18bd4b30d3877bb3d1b',
            '1878477',
            [
                'cluster' => 'ap1',
                'encrypted' => true
            ]
        );
        return response(
            $pusher->presence_auth($channel_name, $socket_id, $user->id)
        );
    }

}
