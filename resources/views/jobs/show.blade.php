<x-layout>
    <x-slot:heading>Job - {{ $job->title }}</x-slot:heading>

    <div>
        <x-job-card-panel>
            <div class="p-2 md:p-4 space-y-8">
                <div>
                    <div class="flex items-center justify-start flex-row-reverse space-x-4 mt-2">
                        <x-employer-logo logo="{{ $job->employer->logo }}" class="w-10 md:w-20" />
                        <div class="space-x-4 text-center me-4">
                            <p class="text-lg lg:text-2xl font-bold">{{ $job->employer->name }}</p>
                            <p class="text-gray-50">{{ $job->employer->user->name }}</p>
                        </div>
                    </div>
                </div>

                <x-divider />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-full">
                        <h4 class="text-gray-50/80">Title</h4>
                        <p class="text-xl font-bold">{{ $job->title }}</p>
                    </div>
                    <div>
                        <h4 class="text-gray-50/80">Salary</h4>
                        <p class="text-xl font-bold">{{ $job->salary }}</p>
                    </div>
                    <div>
                        <h4 class="text-gray-50/80">Location</h4>
                        <p class="text-xl font-bold">{{ $job->location }}</p>
                    </div>
                    <div>
                        <h4 class="text-gray-50/80">Schedule</h4>
                        <p class="text-xl font-bold">{{ $job->schedule }}</p>
                    </div>
                    <div>
                        <h4 class="text-gray-50/80">Posted On</h4>
                        <p class="text-xl font-bold">{{ $job->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
                <div class="space-y-2">
                    @foreach($job->tags as $tag)
                        <x-tag :tag="$tag" />
                    @endforeach
                </div>
            </div>
        </x-job-card-panel>

        <x-divider class="mt-16 mb-4" />

        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 my-4 py-4">
            <div>
                <x-custom-button href="{{ $job->url }}">View Job Posting</x-custom-button>
            </div>
            <div class="flex items-center justify-end space-x-4">
                @can('edit', $job)
                    <x-custom-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-custom-button>
                    <form action="/jobs/{{ $job->id }}" method="post">
                        @csrf
                        @method('DELETE')

                        <x-custom-button class="bg-red-600 hover:bg-red-600/80">Delete Job</x-custom-button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</x-layout>
