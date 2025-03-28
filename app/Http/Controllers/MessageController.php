<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path('storage/chatapp-1d2e5-firebase-adminsdk-fbsvc-621de1c2b7.json'));
        $this->database = $factory->createDatabase();
    }

    public function chat()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('crud.chat', compact('users'));
    }

    public function sendMessage(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'receiver_id' => 'required|integer',
                'message' => 'required|string',
            ]);

            // Save to MySQL database
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
                'is_read' => 0,
            ]);

            Log::info('Message saved to database:', $message->toArray());

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error saving message:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    public function fetchMessages()
    {
        $messages = $this->database->getReference('messages')->getValue();
        return response()->json($messages);
    }

    public function markMessageRead(Request $request)
    {
        try {
            $senderId = $request->sender_id;
            $receiverId = Auth::id();

            // Update unread messages to read
            Message::where('sender_id', $senderId)
                ->where('receiver_id', $receiverId)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);

            return response()->json(['success' => true, 'message' => 'Messages marked as read']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
