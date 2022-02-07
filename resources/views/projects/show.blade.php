<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $project->title }}</title>
</head>

<body>
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>
</body>

</html>
