<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Events\MessageEvent;
use Illuminate\Support\Facades\Auth;

class Chatcomponent extends Component
{
    public $message = '';
    public $messages = [];
    public $user;
    public $sender_id;
    public $receiver_id;

    public function mount($user_id)
    {
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = Message::where(function($query){
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function($query){
            $query->where('sender_id', $this->receiver_id)
            ->where('receiver_id', $this->sender_id);
        })
        ->with('sender:id,name', 'receiver:id,name')
        ->get();
        foreach($messages as $message){
            $this->appendMessage($message);
        }
        // dd($this->messages);

        $user = User::whereId($user_id)->first();
        
        
        // $messageAll = Message::all();
        // foreach($messageAll as $message){
        //     $this->messages[] = [
        //         'username' => $message->user->name,
        //        'message' => $message->message,
        //     ];
        // }
        
    }

    public function appendMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
            'message' => $message->message,

        ];
    }

    public function sendMessage()
    {

        $newMessage = new Message();
        $newMessage->sender_id = $this->sender_id;
        $newMessage->receiver_id = $this->receiver_id;
        $newMessage->message = $this->message;
        $newMessage->save();

        $this->appendMessage($newMessage);
        broadcast(new MessageEvent($newMessage))->toOthers();

        $this->message = '';
        
       
    }

    #[On('echo-private:our-channel.{sender_id},MessageEvent')]
    public function listenForMessage($event)
    {
       $newMessage = Message::whereId($event['message']['id'])
       ->with('sender:id,name', 'receiver:id,name')
       ->first();
       if ($newMessage) {
        $this->appendMessage($newMessage);
    }
       
    }
    public function render()
    {
        return view('livewire.chatcomponent');
    }
}
