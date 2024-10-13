@extends(backpack_view('blank'))
@vite('resources/js/app.js')

@php

    use Illuminate\Support\Facades\Auth;


@endphp
@section('content')
<div id="app">
 <video-chat :allusers="{{ $users }}" :authUserId="{{ backpack_user()->id }}" turn_url="{{ env('TURN_SERVER_URL') }}"
                    turn_username="{{ env('TURN_SERVER_USERNAME') }}" turn_credential="{{ env('TURN_SERVER_CREDENTIAL') }}" />
</div>

{{--<div id="app">
       <video-chat-new :user="{{ $user }}" :others="{{ $others }}" pusher-key="{{ env('PUSHER_APP_KEY') }}" pusher-cluster="{{ env('PUSHER_APP_CLUSTER') }}"></video-chat-new>
</div>
--}}

@endsection
