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

    <div class="grid grid-cols-3 gap-3">
        @forelse ($projects as $project)
            <div class="bg-white rounded shadow shadow-sm p-5" style="height: 200px">
                <h3 class="font-normal text-xl py-4">
                    {{ $project->title }}
                </h3>

                <div class="text-gray-500">
                    {{ Str::limit($project->description, 180, '...') }}
                </div>
            </div>
        @empty
            <div>{{ __('Você não tem nenhum projeto ainda!') }}</div>
        @endforelse
    </div>

    {{-- <ul class="list-inside">
        @forelse  ($projects as $project)
            <li
                class="my-1 p-2 bg-white rounded shadow shadow-sm hover:bg-gray-50 hover:text-indigo-700 hover:shadow-md">
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </li>
        @empty
            <li>{{ __('Nenhun projeto criado!') }}</li>
        @endforelse
    </ul> --}}
</x-app-layout>
