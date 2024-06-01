<?php

namespace App\Http\Controllers;

use App\Events\ForumDiscussionSent;
use App\Events\PrivateMessageSent;
use App\Models\Forum;
use App\Models\Message;
use App\Models\Psychologist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    // Mom Controller for Consultation
    public function showPsychologists()
    {
        $psychologists = DB::table('psychologists')->where('status', 'active')->get();
        return view('Mom.index', compact('psychologists'));
    }

    public function showDialogMessage($id) 
    {
        $userId = session()->has('users_data') ? session()->get('users_data')['id_users'] : null;

        $psychologists = DB::table('psychologists')->where('status', 'active')->get();
        $result = [];

        foreach($psychologists as $psychologist) {
            $lastMessage = DB::table('messages')->where(function ($query) use ($userId, $psychologist) {
                $query->where('from', $userId)->where('to', $psychologist->users_id);
            })->orWhere(function ($query) use ($userId, $psychologist) {
                $query->where('from', $psychologist->users_id)->where('to', $userId);
            })->orderBy('created_at', 'desc')->first();

            $objectData = (object)[
                'id' => $psychologist->users_id,
                'name' => $psychologist->name,
                'photo' => $psychologist->photo,
                'last_message_timestamp' => $lastMessage ? $lastMessage->created_at : null,
                'last_message_content' => $lastMessage ? $lastMessage->content : null,
            ];

            $result[] = $objectData;
        }

        $psychologistName = DB::table('psychologists')->where('users_id', $id)->first();
        
        return view('Mom.dialog', compact('result', 'psychologistName'));
    }

    public function getMessages($recipientId) 
    {
        $userId = session()->has('users_data') ? session()->get('users_data')['id_users'] : null;

        $chatId = $userId < $recipientId ? $userId . '-' . $recipientId : $recipientId . '-' . $userId;
        $messages = DB::table('messages')->where('chat_id', $chatId)->get();
        return response()->json($messages);
    }

    public function sendMessages(Request $request) {
        $userId = session()->has('users_data') ? session()->get('users_data')['id_users'] : null;
        $recipientId = $request->to;

        $chatId = $userId < $recipientId ? $userId . '-' . $recipientId : $recipientId . '-' . $userId;
        $messages = new Message();
        $messages->from = $userId;
        $messages->to = $recipientId;
        $messages->content = $request->content;
        $messages->chat_id = $chatId;
        $messages->save();

        event(new PrivateMessageSent($messages));

        return response()->json(['status' => 'Message Sent!', 'message' => $messages]);
    }

    // Psychologist Controller for Consultation
    public function messagesWithMom()
    {
        $userId = session()->has('users_data') ? session()->get('users_data')['id_users'] : null;

        $messages = DB::table('messages')
                    ->where('from', $userId)
                    ->orWhere('to', $userId)
                    ->get();
            
        $relatedUserIds = $messages->map(function ($message) use ($userId) {
            return $message->from == $userId ? $message->to : $message->from;
        })->unique();

        $result = [];

        $relatedMoms = DB::table('moms')->whereIn('users_id', $relatedUserIds)->get();

        foreach($relatedMoms as $relatedMom) {
            $lastMessage = DB::table('messages')->where(function ($query) use ($userId, $relatedMom) {
                $query->where('from', $userId)->where('to', $relatedMom->users_id);
            })->orWhere(function ($query) use ($userId, $relatedMom) {
                $query->where('from', $relatedMom->users_id)->where('to', $userId);
            })->orderBy('created_at', 'desc')->first();

            $objectData = (object)[
                'id' => $relatedMom->users_id,
                'name' => $relatedMom->name,
                'photo' => $relatedMom->photo,
                'last_message_timestamp' => $lastMessage ? $lastMessage->created_at : null,
                'last_message_content' => $lastMessage ? $lastMessage->content : null,
                'type' => 'mom',
            ];

            $result[] = $objectData;
        }

        $relatedFamilies = DB::table('families')->whereIn('users_id', $relatedUserIds)->get();

        foreach($relatedFamilies as $relatedFamily) {
            $lastMessage = DB::table('messages')->where(function ($query) use ($userId, $relatedFamily) {
                $query->where('from', $userId)->where('to', $relatedFamily->users_id);
            })->orWhere(function ($query) use ($userId, $relatedFamily) {
                $query->where('from', $relatedFamily->users_id)->where('to', $userId);
            })->orderBy('created_at', 'desc')->first();

            $objectData = (object)[
                'id' => $relatedFamily->users_id,
                'name' => $relatedFamily->name,
                'photo' => $relatedFamily->photo,
                'last_message_timestamp' => $lastMessage ? $lastMessage->created_at : null,
                'last_message_content' => $lastMessage ? $lastMessage->content : null,
                'type' => 'family',
            ];

            $result[] = $objectData;
        }
        
        return view('Psychologist.index', compact('result'));
    }

    public function showDialogMessageWithMom($id)
    {
        return view('Psychologist.dialog');
    }

    // Show Discussion Forum
    public function showDiscussionForum()
    {
        return view('Family.index');
    }

    // Get Messages From Discussion Forum
    public function getMessagesDiscussionForum() 
    {
        $messages = DB::table('forums')->get();
        return response()->json($messages);
    }

    // Send Messages to Forum
    public function sendMessageDiscussion(Request $request) {
        $userId = session()->has('users_data') ? session()->get('users_data')['id_users'] : null;

        $message = new Forum();
        $message->from = $userId;
        $message->content = $request->content;
        $message->name = $request->name;
        $message->save();

        event(new ForumDiscussionSent($message));

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }
}
