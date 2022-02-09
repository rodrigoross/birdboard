<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-middle">
            <p class="font-bold text-sm text-gray-500 uppercase self-center">
                <a class="hover:text-sky-500" href="{{ route('projects.index') }}">{{ __('Meus Projetos') }}</a> /
                {{ $project->title }}
            </p>

            <x-button class="shadow shadow-sm">
                <a href="{{ route('projects.create') }}">{{ __('Novo projeto') }}</a>
            </x-button>
        </div>
    </x-slot>

    <section>
        <div class="lg:flex gap-3 mb-6">
            <div class="lg:w-3/4 mb-6">
                <div class="mb-3">
                    <h2 class="text-lg text-gray-400 font-normal uppercase">{{ __('Tarefas') }}</h2>
                    {{-- Tarefas --}}
                    @foreach ($project->tasks as $task)
                        <x-card class="mb-3">
                            {{ $task->body }}
                        </x-card>
                    @endforeach
                    <x-card class="mb-3">
                        <form action="{{ route('tasks.store', $project->id) }}" method="POST" class="p-0">
                            @csrf
                            <input type="text" name="body" id="task"
                                class="w-full p-0 border-transparent focus:border-transparent focus:ring-0"
                                placeholder="{{ __('Adicionar uma nova tarefa...') }}">
                        </form>
                    </x-card>
                </div>

                <div class="mb-3">
                    <h2 class="text-lg text-gray-400 font-normal uppercase">{{ __('Notas') }}</h2>
                    {{-- Notas --}}

                    <textarea class="border-none rounded-lg shadow shadow-sm p-5 w-full" style="min-height: 200px;"
                        name="notes" id="notes" cols="30" rows="1">Lorem ipsum</textarea>


                </div>
            </div>
            <div class="lg:w-1/4 grow-1">
                <x-card-item>
                    <x-slot name="title">
                        {{ $project->title }}
                    </x-slot>

                    <x-slot name="description">
                        <div>
                            {{ $project->description }}
                        </div>
                    </x-slot>
                </x-card-item>
            </div>
        </div>
    </section>
</x-app-layout>
