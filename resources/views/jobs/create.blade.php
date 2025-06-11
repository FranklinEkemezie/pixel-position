<x-layout>
    <x-slot:heading>Create Job</x-slot:heading>

    <div class="max-w-3xl mx-auto p-12">

        <form action="/jobs" method="post">
            @csrf

            <div class="text-center">
                <h2 class="font-bold text-4xl">New Job</h2>
            </div>

            <!-- Form fields -->
            <div class="space-y-8 mx-auto">

                <x-forms.form-field name="title" label="Title" placeholder="Web developer" />
                <x-forms.form-field name="salary" label="Salary" placeholder="50,000 USD" />
                <x-forms.form-field name="location" label="Location" placeholder="Abuja" />
                <x-forms.form-field name="schedule" type="select"
                    :options="['Part Time', 'Full Time']" label="Schedule"
                />
                <x-forms.form-field name="url" type="url" label="URL" placeholder="Your Job Posting URL" />
                <x-forms.form-field name="featured" type="checkbox"
                    label="Featured (Cost: $120)" checkbox-label="Please check this to make this job featured"
                />

                <x-divider class="my-12" />

                <x-forms.form-field
                    name="tags" label="Tags (comma separated)"
                    placeholder="laracasts, video, education"
                />

                <div class="my-8">
                    <x-forms.form-button>Create Job</x-forms.form-button>
                </div>

            </div>
        </form>
    </div>
</x-layout>
