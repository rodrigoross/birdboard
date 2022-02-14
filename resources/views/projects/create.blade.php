<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-sm text-gray-500 uppercase">{{ __('Criar projeto') }}</h1>
    </x-slot>

    <div class="mx-auto px-6 py-3 bg-white rounded shadow shadow-sm">
        <form action="{{ route('projects.store') }}" method="POST" class="container mt-5">
            @include('projects.partials.form',[
            'project' => new App\Models\Project,
            'buttonText' => __('Criar projeto')
            ])
        </form>
    </div>
    {{-- <form action="{{ route('projects.store') }}" method="POST" class="container mt-5">
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
    </form> --}}
</x-app-layout>
