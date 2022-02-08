<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Birdboard') }}
        </h2>
    </x-slot>

    <form action="{{ route('projects.store') }}" method="POST" class="container mt-5">
        <h1 class="font-bold text-sm text-gray-500 px-8 uppercase">Criar projeto</h1>
        @csrf
        <div class="container my-3 px-8">
            <label for="title" class="block text-sm font-medium text-gray-700">Titulo</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input type="text"
                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                    name="title" placeholder="Titulo">
            </div>
        </div>
        <div class="container my-3 px-8">
            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <textarea
                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                    name="description" placeholder="Loren ipsum..."></textarea>
            </div>
        </div>
        <div class="px-4 py-3 text-right sm:px-6">
            <x-button>
                {{ __('Salvar projeto') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
