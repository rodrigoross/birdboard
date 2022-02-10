<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="font-bold text-sm text-gray-500 uppercase">{{ __('Edite seu projeto') }}</h1>
        </h2>
    </x-slot>

    <div class="mx-auto px-6 py-3 bg-white rounded shadow shadow-sm">
        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="container mt-5">
            @csrf
            @method('PATCH')
            <div class="container">
                <label for="title" class="block text-sm font-medium text-gray-700">Titulo</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                        name="title" placeholder="Titulo" value="{{ $project->title }}">
                </div>
            </div>
            <div class="container my-3">
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <textarea
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                        name="description" placeholder="Loren ipsum...">{{ $project->description }}
                    </textarea>
                </div>
            </div>
            <div class="text-right">
                <x-button>
                    <a href="{{ $project->path() }}">{{ __('Voltar') }}</a>
                </x-button>
                <x-button type="submit">
                    {{ __('Atualizar projeto') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
