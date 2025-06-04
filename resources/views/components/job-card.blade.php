@props([
    'job'   => [
        'title'     => 'Psychology Teacher',
        'employer'  => 'Glover, Dietrich and Yost',
        'url'       => 'http://www.douglas.com/sed-quia-eaque-earum-minima',
        'salary'    => '$50,000 USD',
        'tags'      => ['health', 'education', 'psychology'],
        'img'       => 'resources/images/jobs/city-skyscraper.png'
    ]
])
<x-job-card-panel>
    <p class="text-sm text-white">{{ $job['employer'] }}</p>
    <div class="text-center space-y-4">
        <p class="text-lg font-bold group-hover:text-brand-blue">
            <a href="{{ $job['url'] }}">{{ $job['title'] }}</a>
        </p>
        <p class="text-white/60 hover:text-white/80">{{ $job['salary'] }}</p>
    </div>
    <div class="flex items-center justify-between">
        <div class="flex flex-wrap items-center space-x-1 space-y-1">
            @foreach($job['tags'] as $tag)
                <x-tag size="xs">{{ $tag }}</x-tag>
            @endforeach
        </div>
        <div>
            <x-employer-img src="{{ $job['img'] }}" :size="20" />
        </div>
    </div>
</x-job-card-panel>

