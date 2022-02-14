@if (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'notes')
    {{ __("{$activity->ownerName()} atualizou as notas do projeto") }}

@elseif (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'title')
    {{ __("{$activity->ownerName()} atualizou o titulo do projeto") }}

@elseif (count($activity->changes['after']) === 1 && key($activity->changes['after']) === 'description')
    {{ __("{$activity->ownerName()} atualizou a descrição do projeto") }}
@else
    {{ __("{$activity->ownerName()} atualizou o projeto") }}
@endif
