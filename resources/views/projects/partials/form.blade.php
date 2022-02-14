@csrf

<div class="container">
    <label for="title" class="block text-sm font-medium text-gray-700">Titulo</label>
    <div class="mt-1 flex rounded-md shadow-sm">
        <input type="text"
            class="{{ count($errors->title) ? 'border border-2 border-red-400' : 'focus:ring-indigo-500 focus:border-indigo-500' }} block w-full rounded sm:text-sm focus:border-0 border-gray-300"
            name="title" placeholder="Titulo" value="{{ $project->title }}" required>
    </div>
    @error('title')
        <span class="text-red-400 text-sm">Nome do projeto é necessário.</span>
    @enderror
</div>
<div class="container my-3">
    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
    <div class="mt-1 flex rounded-md shadow-sm">
        <textarea
            class="{{ count($errors->description)? 'border border-2 border-red-400': 'focus:ring-indigo-500 focus:border-indigo-500' }} flex-1 block w-full rounded sm:text-sm border-gray-300"
            name="description" placeholder="Algo sobre o projeto..." required>{{ $project->description }}</textarea>
    </div>
    @error('description')
        <span class="text-red-400 text-sm">Descrição do projeto é necessária.</span>
    @enderror
</div>
<div class="text-left flex flex-row items-center gap-1">
    <x-button type="submit">
        {{ $buttonText }}
    </x-button>
    <a class="text-sm font-bold self-center uppercase p-2 rounded-lg text-gray-500 hover:bg-gray-100"
        href="{{ $project->path() }}">{{ __('Cancelar') }}</a>
</div>
