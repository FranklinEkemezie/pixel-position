<x-layout>
    <x-slot:heading>Create Job</x-slot:heading>

    <div class="max-w-3xl mx-auto p-12">

        <form action="/jobs/{{ $job->id }}" method="post">
            @csrf
            @method('PATCH')

            <div class="text-center">
                <h2 class="font-bold text-4xl">Edit Job</h2>
            </div>

            <!-- Form fields -->
            <div class="space-y-8 mx-auto">

                <x-forms.form-field name="title" label="Title" placeholder="Web developer"
                                    value="{{ old('title') ?? $job->title }}" />
                <x-forms.form-field name="salary" label="Salary" placeholder="50,000 USD"
                                    value="{{ old('salary') ?? $job->salary }}" />
                <x-forms.form-field name="location" label="Location" placeholder="Abuja"
                                    value="{{ old('location') ?? $job->location }}" />
                <x-forms.form-field name="schedule" type="select" label="Schedule"
                                    :options="['Part Time', 'Full Time']"
                                    value="{{ old('schedule') ?? $job->schedule }}" />
                <x-forms.form-field name="url" type="url" label="URL" placeholder="Your Job Posting URL"
                                    value="{{ old('url') ?? $job->url }}" />
                <x-forms.form-field name="featured" type="checkbox" label="Featured (Cost: $120)"
                                    checkbox-label="Please check this to make this job featured"
                                    checked="{{ old('featured') ?? $job->featured }}" />

                <x-divider class="my-12" />

                <x-forms.form-field
                    name="tags" label="Tags (comma separated)" placeholder="laracasts, video, education"
                    value="{{ old('tags') ?? $job->tags->pluck('name')->join(',') }}"
                />

                <div class="my-8">
                    <x-forms.form-button>Edit Job</x-forms.form-button>
                </div>

            </div>
        </form>
    </div>
</x-layout>
