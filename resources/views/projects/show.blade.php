<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="p-3 bg-white rounded shadow-shadom-sm h-96">
            {{ $project->description }}
        </div>

        <x-button class="my-3">
            <a href="{{ route('projects.index') }}">{{ __('Voltar') }}</a>
        </x-button>
    </div>
</x-app-layout>
