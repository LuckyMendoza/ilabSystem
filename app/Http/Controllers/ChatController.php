<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChatController extends Controller{

    public function index(){
        $users = User::where('is_verified', '1')->get();
        $authUserId = auth()->id();
        $chats = [];

        // Retrieve all chat messages involving the authenticated user
        $chat = Chat::where('user_id_sender', $authUserId)
            ->orWhere('user_id_receiver', $authUserId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('components.message', compact('users', 'chat', 'chats'));
    }

    public function store(Request $request){
        $chats = Chat::sendChats($request);

        return response()->json($chats);
    }

    public function getUserChat($user_id){
        $chats = Chat::getChats($user_id);

        return response()->json($chats);
    }


}
