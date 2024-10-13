@extends(backpack_view('blank'))
@vite('resources/js/app.js')

@php

    use Illuminate\Support\Facades\Auth;


@endphp
@section('content')

<div id="app">
       <video-chat-mix :user="{{ $user }}" :others="{{ $others }}" pusher-key="{{ env('PUSHER_APP_KEY') }}" pusher-cluster="{{ env('PUSHER_APP_CLUSTER') }}"></video-chat-mix>
</div>


@endsection
