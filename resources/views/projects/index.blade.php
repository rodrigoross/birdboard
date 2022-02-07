<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title></title>
</head>

<body>
    <h1>Birdboard</h1>
    <ul>
        @forelse  ($projects as $project)
            <li>
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </li>
        @empty
            <li>Nenhun projeto criado!</li>
        @endforelse
    </ul>
</body>

</html>
