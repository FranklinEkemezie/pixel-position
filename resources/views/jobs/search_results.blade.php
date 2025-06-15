@props([
    'query' => null
])
<x-layout>
    <x-slot:heading>Job Search Results</x-slot:heading>

    <div class="max-w-6xl mx-auto space-y-4">
        <div class="text-center my-8">
            <h2 class="font-bold text-4xl my-4">Job Search Results</h2>
            @if($query !== null)
                <p>Found {{ $jobs->count() }} result(s) for: <em>{{ $query }}</em></p>
            @else
                <p>Found {{ $jobs->count() }} results(s)</p>
            @endif

        </div>

        <div class="space-y-4">
            @foreach($jobs as $job)
                <x-job-card-alt :job="$job" />
            @endforeach

            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
