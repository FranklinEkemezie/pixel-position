@props(['job'])
<x-job-card-panel>
    <div class="grid grid-cols-3 sm:grid-cols-6 lg:grid-cols-8 space-x-2 space-y-2 lg:space-x-4">
        <!-- Image -->
        <div>
            <x-employer-logo logo="{{ $job->employer->logo }}" class="w-96" />
        </div>

        <!-- Details -->
        <div class="col-span-2 sm:col-span-3 lg:col-span-4">
            <div class="flex flex-col justify-center h-full">
                <p class="text-white/60 text-sm">
                    <a href="/companies/{{ $job->employer->name }}">{{ $job->employer->name }}</a>
                </p>
                <div class="mt-4 lg:mt-4 space-y-2">
                    <p class="text-xl font-bold group-hover:text-brand-blue">
                        <a href="{{ $job->url }}">{{ $job->title }}</a>
                    </p>
                    <p class="text-white/75 text-sm">{{ $job->salary }}</p>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="col-span-3 sm:col-span-2 lg:col-span-3 py-2">
            <div class="flex items-center lg:justify-end flex-wrap space-x-1 space-y-1 mt-2">
                @foreach($job['tags'] as $tag)
                    <x-tag :tag="$tag" size="xs" />
                @endforeach
            </div>
        </div>
    </div>
</x-job-card-panel>
