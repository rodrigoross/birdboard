{{-- Convidar usuario --}}
<x-card-item class="mt-3">
    <x-slot name="title">
        {{ __('Convidar usuário') }}
    </x-slot>

    <x-slot name="description">
        <form action="{{ $project->path() . '/invite' }}" method="POST" class="text-right">
            @csrf
            <div class="flex flex-col text-left mb-2">
                <x-input id="email" class="block mt-1 w-full border-gray-300 py-2 px-3" type="email" name="email"
                    placeholder="{{ __('Endereço de e-mail') }}" />
                @error('email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <x-button class="text-sm" type="submit">{{ __('Convidar') }}</x-button>
        </form>
    </x-slot>

    <x-slot name="footer">
        {{--  --}}
    </x-slot>
</x-card-item>
