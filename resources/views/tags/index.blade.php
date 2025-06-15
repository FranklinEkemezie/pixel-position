<x-layout>
    <x-slot:heading>Employers</x-slot:heading>

    <div class="max-w-4xl mx-auto space-y-4">
        <div class="text-center my-8">
            <h2 class="font-bold text-4xl my-4">Available Tags</h2>
        </div>

        <div class="space-y-4">
            @foreach($tags as $tag)
                <x-job-card-panel>
                    <div class="grid grid-cols-8 gap-x-4">
                        <div class="col-span-7 space-y-4">
                            <div>
                                <h3 class="text-2xl font-bold">{{ $tag->name }}</h3>
                            </div>
                            <div>
                                <ul>
                                    @foreach($tag->jobs as $job)
                                        <li>{{ $job->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="text-end">
                                <x-custom-button
                                    href="/tags/{{ $tag->name }}"
                                    class="text-sm rounded-full px-8">
                                    Explore Jobs ({{ $tag->jobs->count() }})
                                </x-custom-button>
                            </div>
                        </div>
                    </div>
                </x-job-card-panel>
            @endforeach

            {{ $tags->links() }}
        </div>
    </div>

</x-layout>
