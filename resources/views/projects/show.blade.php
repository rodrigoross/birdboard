<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-middle">
            <p class="font-bold text-sm text-gray-500 uppercase self-center">
                <a class="hover:text-sky-500" href="{{ route('projects.index') }}">{{ __('Meus Projetos') }}</a> /
                {{ $project->title }}
            </p>

            <x-button class="shadow shadow-sm">
                <a href="{{ route('projects.edit', $project->id) }}">{{ __('Editar projeto') }}</a>
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
                        {{-- route('tasks.update', ['project' => $project->id, 'task' => $task->id]) --}}
                        <x-card class="mb-3">
                            <form action="{{ $task->path() }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="flex justify-between items-center w-full">

                                    <input type="text" name="body" id="{{ "task-{$task->id}" }}"
                                        class="w-full p-0 border-transparent focus:border-transparent focus:ring-0 {{ $task->completed ? 'text-gray-500' : '' }}"
                                        value="{{ $task->body }}">

                                    <input type="checkbox" name="completed" id="{{ "completed-{$task->id}" }}"
                                        onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
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

                    <form method="POST" action="{{ route('projects.update', $project->id) }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <textarea class="border-none rounded-lg shadow shadow-sm p-5 w-full"
                                style="min-height: 200px;" name="notes" id="notes"
                                placeholder="Alguma coisa para tomar nota?">{{ $project->notes }}</textarea>

                            @error('notes')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <x-button>
                            {{ __('Salvar') }}
                        </x-button>
                    </form>
                </div>
            </div>
            <div class="lg:w-1/4 grow-1">
                <x-card-item>
                    <x-slot name="title">
                        {{ $project->title }}
                    </x-slot>

                    <x-slot name="description">
                        <div>
                            {{ Str::limit($project->description, 250) }}
                        </div>
                    </x-slot>
                </x-card-item>

                @include('projects.activities.card')
            </div>
        </div>
    </section>
</x-app-layout>
