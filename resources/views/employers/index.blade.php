<x-layout>
    <x-slot:heading>Employers</x-slot:heading>

    <div class="max-w-4xl mx-auto space-y-4">
        <div class="text-center my-8">
            <h2 class="font-bold text-4xl my-4">Meet Our Employers</h2>
        </div>

        <div class="space-y-4">
            @foreach($employers as $employer)
                <x-job-card-panel>
                    <div class="grid grid-cols-8 gap-x-4">
                        <div>
                            <x-employer-logo :logo="$employer->logo" alt="{{ $employer->name }}" class="w-40" />
                        </div>
                        <div class="col-span-7 space-y-4">
                            <div>
                                <h3 class="text-2xl font-bold">{{ $employer->name }}</h3>
                                <p>Since <span class="text-gray-50/80"> {{ $employer->created_at->toFormattedDateString() }}</span></p>
                            </div>
                            <div class="text-end">
                                <x-custom-button
                                    href="/employers/{{ $employer->name }}"
                                    class="text-sm rounded-full px-8">
                                    Explore Jobs ({{ $employer->jobs->count() }})
                                </x-custom-button>
                            </div>
                        </div>
                    </div>
                </x-job-card-panel>
            @endforeach

            {{ $employers->links() }}
        </div>
    </div>

</x-layout>
