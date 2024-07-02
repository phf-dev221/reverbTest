<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Events\MessageEvent;
use Illuminate\Support\Facades\Auth;

class Chatcomponent extends Component
{
    public $message;
    public $messages = [];

    public function mount()
    {
        $messageAll = Message::all();
        foreach($messageAll as $message){
            $this->messages[] = [
                'username' => $message->user->name,
               'message' => $message->message,
            ];
        }
    }

    public function submitMessage()
    {
        MessageEvent::dispatch(Auth::user()->id, $this->message);
        $this->message = "";
    }

    #[On('echo:our-channel,MessageEvent')]
    public function listenForMessage($data)
    {
        $this->messages[] = [
            'username' => $data['username'],
            'message' => $data['message']
        ];
    }
    public function render()
    {
        return view('livewire.chatcomponent');
    }
}
