@if (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'notes')
    {{ __('Você atualizou as notas do projeto') }}

@elseif (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'title')
    {{ __('Você atualizou o titulo do projeto') }}

@elseif (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'description')
    {{ __('Você atualizou a descrição do projeto') }}
@else
    {{ __('Você atualizou o projeto') }}
@endif
