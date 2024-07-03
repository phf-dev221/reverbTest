<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">Discussions</h1>
                    @foreach ($users as $user)
                    <p class="text-lg font-medium mb-4">
                        <a href="/chat/{{$user->id}}" class="text-blue-500 hover:text-blue-700 transition duration-300">
                            {{$user->name}}
                        </a>
                    </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
