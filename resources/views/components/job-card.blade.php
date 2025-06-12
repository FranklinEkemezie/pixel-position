@props(['job'])
<x-job-card-panel>
    <div class="flex flex-col h-full justify-between space-y-8 py-2">
        <p class="text-sm text-white">{{ $job->employer->name }}</p>
        <div class="text-center space-y-4">
            <p class="text-lg font-bold group-hover:text-brand-blue">
                <a href="{{ $job->url }}">{{ $job->title }}</a>
            </p>
            <p class="text-white/60 hover:text-white/80">{{ $job->salary }}</p>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-3 flex items-end flex-wrap space-x-1.5">
                @foreach($job->limitTags as $tag)
                    <x-tag :tag="$tag" size="2xs" />
                @endforeach
            </div>
            <div>
                <x-employer-logo logo="{{ $job->employer->logo }}" class="w-20" />
            </div>
        </div>
        <div class="self-end">
            <a href="/jobs/{{ $job->id  }}" class="px-8 py-2 font-bold rounded-2xl text-sm bg-white/10 hover:bg-white/30">View Job</a>
        </div>
    </div>
</x-job-card-panel>

