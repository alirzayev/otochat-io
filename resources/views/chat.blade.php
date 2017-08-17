@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chatroom for Conversation {{ $conversation_id }}
                        <span class="badge pull-right">@{{ usersInRoom.length }}</span>
                    </div>
                    <chat-log :conv_id="{{ $conversation_id }}" :messages="messages"></chat-log>
                    <chat-composer :conv_id="{{ $conversation_id }}"></chat-composer>
                </div>
            </div>
        </div>
    </div>
@endsection