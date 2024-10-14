@extends(backpack_view('blank'))
@vite('resources/js/app.js')

@php

    use Illuminate\Support\Facades\Auth;


@endphp
@section('content')
    <div id="app">
        <!-- Use the VideoChat component here -->
        <video-chat
            :allusers="{{ json_encode($users) }}"
            :authuserid="{{ backpack_user()->id }}"
            pusher-key="{{ env('PUSHER_APP_KEY') }}"
            pusher-cluster="{{ env('PUSHER_APP_CLUSTER') }}"
        ></video-chat>
    </div>

{{--<div id="app">
       <video-chat-new :user="{{ $user }}" :others="{{ $others }}" pusher-key="{{ env('PUSHER_APP_KEY') }}" pusher-cluster="{{ env('PUSHER_APP_CLUSTER') }}"></video-chat-new>
</div>
--}}

@endsection
