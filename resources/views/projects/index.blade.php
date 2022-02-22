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

                @can('manage', $project)
                    <x-slot name="footer">
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="text-right">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm" type="submit">{{ __('Excluir') }}</button>
                        </form>
                    </x-slot>
                @endcan
            </x-card-item>
        @empty
            <div>{{ __('Você não tem nenhum projeto ainda!') }}</div>
        @endforelse
    </div>

    <modal name="hello-w" class="rounded-lg" height="auto">
        <div class="p-10">
            <h1 class="text-2xl mb-8 text-center">Vamos Fazer Algo Novo</h1>

            <div class="flex gap-4">
                <div class="flex-1">
                    <div class="mb-4">
                        <label for="title" class="block text-sm text-gray-700">{{ __('Titulo') }}</label>
                        <input type="text"
                            class="p-2 block w-full rounded text-sm sm:text-xs focus:border-0 border border-gray-300"
                            name="title" placeholder="Titulo" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm text-gray-700">{{ __('Descrição') }}</label>
                        <textarea class="p-2 w-full rounded text-sm sm:text-xs focus:border-0 border border-gray-300"
                            name="description" placeholder="Titulo" rows=7 required></textarea>
                    </div>

                </div>
                <div class="flex-1">
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700">{{ __('Precisa de algumas tarefas') }}</label>
                        <input type="text"
                            class="p-2 block w-full rounded text-sm sm:text-xs focus:border-0 border border-gray-300"
                            placeholder="Adicionar uma tarefa">
                    </div>

                    <button class="inline-flex items-center text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            class="mr-2">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                                <path fill="#000"
                                    d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z">
                                </path>
                            </g>
                        </svg>
                        <span>{{ __('Adiciona nova tarefa') }}</span>
                    </button>
                </div>
            </div>

            <footer class="flex justify-end gap-2">
                <x-outline-button type="button">{{ __('Cancelar') }}</x-outline-button>
                <x-button type="button">{{ __('Criar projeto') }}</x-button>
            </footer>
        </div>
    </modal>

    <a href="" @click.prevent="$modal.show('hello-w')">Abrir</a>
</x-app-layout>
