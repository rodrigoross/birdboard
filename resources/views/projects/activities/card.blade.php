<x-card class="mt-3">
    <div>
        <ul class="text-sm">
            @foreach ($project->activities as $activity)
                <li class="{{ $loop->last ? '' : 'mb-1' }}">
                    @include("projects.activities.{$activity->description}")
                    <span
                        class="text-right text-gray-300">{{ $activity->created_at->diffForHumans(null, true) }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</x-card>
