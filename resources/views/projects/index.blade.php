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
            <x-card-item>
                <x-slot name="title">
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                </x-slot>

                <x-slot name="description">
                    {{ Str::limit($project->description, 250, '...') }}
                </x-slot>

                <x-slot name="footer">
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="text-right">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm" type="submit">{{ __('Excluir') }}</button>
                    </form>
                </x-slot>
            </x-card-item>
        @empty
            <div>{{ __('Você não tem nenhum projeto ainda!') }}</div>
        @endforelse
    </div>
</x-app-layout>
