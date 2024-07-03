<div class="h-screen flex flex-col">
    <a href="/dashboard" class="mt-2 ml-2 text-center">&larr; Chat</a>
   
    <div class="flex-1 overflow-y-scroll mt-6 bg-gray-200 mx-">
        @foreach ($messages as $message)
            <div class="px-4 py-2">
                @if ($message['sender'] != auth()->user()->name)
                    <div class="flex items-center mb-2">
                        <img class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/50/50" alt="User Avatar">
                        <div class="font-medium">{{$message['sender']}}</div>
                    </div>
                    <div class="bg-white rounded-lg p-2 shadow  shadow mb-2 max-w-sm break-words inline-block">
                        {{$message['message']}}
                    </div>
                @else
                    <div class="clearfix w-4/4">
                        <div class="text-right flex items-center justify-end mb-2 ">
                            <p class="bg-blue-500 mx-4 my-2 p-2 text-white rounded-lg inline-block">
                                {{$message['message']}}
                            </p>
                            <div><img class="w-8 h-8 rounded-full" src="https://picsum.photos/50/50?image=10" alt="User Avatar"></div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <form wire:submit="sendMessage()">
        <div class="bg-gray-100 px-4 py-2">
            <div class="flex items-center">
                <input class="w-full border rounded-full py-2 px-4 mr-2" wire:model="message" type="text"
                    placeholder="Type your message...">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-full"
                    type="submit">Send</button>
            </div>
        </div>
    </form>
</div>