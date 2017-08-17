<?php

namespace App\Http\Controllers;

use App\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    //
    public function index()
    {
        return view('conversation');
    }

    public function createConversation(Request $request)
    {

        // get user conversation
        // auth user can be both receiver and owner
        // two user have just one conversation
        $conversation = Conversation::whereIn('user_id', [Auth::id(), $request->get('id')])
            ->whereIn('receiver_id', [$request->get('id'), Auth::id()])
            ->first(); // Get conv. data

        //  check user conversation
        if ($conversation) {
            // if exists return conversation
            return response()->json(['error' => false, 'conversation' => $conversation]);
        } else {
            // if not exists then create new conversation
            $conversation = new Conversation();
            $conversation->user_id = Auth::id();
            $conversation->receiver_id = $request->get('id');
            $conversation->save();
        }

        return response()->json(['error' => false, 'conversation' => $conversation]);
    }
}
