<div>
    {{-- In work, do what you enjoy. --}}
    @foreach ($messages as $itemMessage )
    {{$itemMessage['username']}} : {{$itemMessage['message']}}<br>
    @endforeach
    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" wire:key="{{now()}}" />
        <button type="submit">Envoyer</button>     
    </form>
</div>
