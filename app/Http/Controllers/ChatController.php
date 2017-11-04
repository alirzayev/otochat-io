<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //

    /**
     * Display messages between two users.
     *
     * @param $conversation_id
     * @return \Illuminate\Http\Response
     */
    public function index($conversation_id)
    {
        return view('chat', compact('conversation_id'));
    }

    /**
     * @param $conversation_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fetchMessages($conversation_id)
    {
        $messages = Message::where('conversation_id', $conversation_id)->with('user')->get();
        return $messages;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        // Store the new message
        $message = new Message();
        $message->user_id = $user->id;
        $message->conversation_id = request()->get('conversation_id');
        $message->message = request()->get('message');
        $message->save();

        // Announce that a new message has been posted
        event(new MessagePosted($message, $user));

        return response()->json([
            'Error' => false,
            'message' => 'New message has created!'
        ], 200);
    }
}
