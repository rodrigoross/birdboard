<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Birdboard') }}
        </h2>
    </x-slot>

    <h1 class="font-bold text-sm text-gray-500 uppercase">Criar projeto</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="container mt-5">
        @csrf
        <div class="container">
            <label for="title" class="block text-sm font-medium text-gray-700">Titulo</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <input type="text"
                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                    name="title" placeholder="Titulo">
            </div>
        </div>
        <div class="container my-3">
            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <textarea
                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300"
                    name="description" placeholder="Loren ipsum..."></textarea>
            </div>
        </div>
        <div class="text-right">
            <x-button>
                {{ __('Salvar projeto') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
