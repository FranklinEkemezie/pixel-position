<x-layout>
    <x-slot:heading>{{ $heading ?? 'Home Page' }}</x-slot:heading>

    <div class="max-w-5xl mx-auto">

        <!-- Dashboard Profile -->
        @if(request()->is('dashboard'))
            <div class="my-8 p-2">
                <div class="flex items-center space-x-4">
                    <x-employer-logo
                        class="w-20 rounded-full"
                        logo="{{ auth()->user()->employer->logo }}"
                        alt="{{ auth()->user()->employer->name }}"
                    />
                    <div>
                        <p class="text-gray-50/60">
                            Hello,
                            <span class="text-gray-50/80 font-semibold">{{ auth()->user()->name }}</span>
                        </p>
                        <h3 class="font-bold text-xl">{{ auth()->user()->employer->name }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hero Area -->
        <section class="text-center my-4 py-8 space-y-8">
            <h2 class="capitalize text-4xl font-bold w-10/12 mx-auto mt-8">
                Let's find your next <span class="text-brand-blue">job</span>
            </h2>
            <div>
                <form action="/jobs/search">
                    <input
                        type="text"
                        name="q"
                        placeholder="Web Developer..."
                        class="inline-block w-full max-w-2xl border border-gray-100/10 rounded-lg
                    p-4 bg-white/10 outline-none focus:border-transparent focus:ring-2
                    focus:ring-brand-blue"
                        autocomplete="off"
                    />
                </form>
            </div>
        </section>

        <!-- Featured Jobs -->
        <section class="my-4 py-8 space-y-8">
            <x-section-heading>Featured Jobs</x-section-heading>

            <!-- Featured Jobs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredJobs as $job)
                    <x-job-card :job="$job" />
                @endforeach
            </div>
        </section>

        <!-- Tags -->
        <section class="my-4 py-8 space-y-8">
            <x-section-heading>Tags</x-section-heading>
            <div class="space-x-2 space-y-2">
                @foreach($tags as $tag)
                    <x-tag :tag="$tag" />
                @endforeach
            </div>

            <div class="text-end">
                <x-custom-button href="/tags">See all</x-custom-button>
            </div>
        </section>

        <!-- Recent Jobs -->
        <section class="my-4 py-8 space-y-8">
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                @foreach($recentJobs as $job)
                    <x-job-card-alt :job="$job" />
                @endforeach
            </div>

            <div>
                {{ $recentJobs->links() }}
            </div>
        </section>

    </div>
</x-layout>
