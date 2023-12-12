<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id_sender', 'user_id_receiver'];

    public function sender(){
        return $this->belongsTo(User::class, 'user_id_sender');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'user_id_receiver');
    }

    public static function sendChats($request){
        $user = Auth::user();

        // Create a new chat message
        $newChat = Chat::create([
            'message' => $request->input('message'),
            'user_id_sender' => $user->id,
            'user_id_receiver' => $request->input('receiver_id'),
            'is_read' => false,
        ]);

        // Retrieve the updated list of messages with sender and receiver information
        $chats = Chat::with('sender', 'receiver')
            ->where(function ($query) use ($user, $request) {
                $query->where('user_id_sender', $user->id)
                    ->where('user_id_receiver', $request->input('receiver_id'));
            })
            ->orWhere(function ($query) use ($user, $request) {
                $query->where('user_id_sender', $request->input('receiver_id'))
                    ->where('user_id_receiver', $user->id);
            })
            ->get();

        return $chats;
    }

    public static function getChats($user_id){
        $authUser = Auth::user();

        // Mark received messages as read
        Chat::where('user_id_sender', $user_id)
            ->where('user_id_receiver', $authUser->id)
            ->update(['is_read' => true]);

        // Retrieve the chat messages with sender and receiver information
        $chats = Chat::with('sender', 'receiver')
            ->where(function ($query) use ($authUser, $user_id) {
                $query->where('user_id_sender', $authUser->id)
                    ->where('user_id_receiver', $user_id);
            })
            ->orWhere(function ($query) use ($authUser, $user_id) {
                $query->where('user_id_sender', $user_id)
                    ->where('user_id_receiver', $authUser->id);
            })
            ->get();

        return $chats;
    }
}
