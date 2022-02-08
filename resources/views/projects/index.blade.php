<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-middle">
            <h1 class="font-bold text-sm text-gray-500 uppercase self-center">{{ __('Meus projetos') }}</h1>

            <x-button class="shadow shadow-sm">
                <a href="{{ route('projects.create') }}">{{ __('Novo projeto') }}</a>
            </x-button>
        </div>
    </x-slot>


    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-3">
        @forelse ($projects as $project)
            <div class="bg-white rounded-lg shadow shadow-sm p-5" style="height: 200px">
                <h3
                    class="-ml-5 font-normal text-xl py-4 pl-5 mb-3 border-solid border-l-4 border-l-sky-500 hover:text-sky-500 transition ease-in-out">
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                </h3>

                <div class="text-gray-500 md:truncate">
                    {{ Str::limit($project->description, 180, '...') }}
                </div>
            </div>
        @empty
            <div>{{ __('Você não tem nenhum projeto ainda!') }}</div>
        @endforelse
    </div>
</x-app-layout>
