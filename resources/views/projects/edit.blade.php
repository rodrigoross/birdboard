<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="font-bold text-sm text-gray-500 uppercase">{{ __('Edite seu projeto') }}</h1>
        </h2>
    </x-slot>
    <div class="mx-auto px-6 py-3 bg-white rounded shadow shadow-sm">
        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="container mt-5">
            @method('PATCH')
            @include('projects.partials.form', [
            'buttonText' => __('Atualizar projeto')
            ])
        </form>
    </div>
</x-app-layout>
