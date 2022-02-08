<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Birdboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-between align-middle mb-5">
        <h1 class="font-bold text-sm text-gray-500 uppercase self-center">Meus projetos</h1>

        <x-button class="">
            <a href="{{ route('projects.create') }}">Novo projeto</a>
        </x-button>
    </div>
    <ul class="list-inside">
        @forelse  ($projects as $project)
            <li
                class="my-1 p-2 bg-white rounded shadow shadow-sm hover:bg-gray-50 hover:text-indigo-700 hover:shadow-md">
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </li>
        @empty
            <li>{{ __('Nenhun projeto criado!') }}</li>
        @endforelse
    </ul>
</x-app-layout>
