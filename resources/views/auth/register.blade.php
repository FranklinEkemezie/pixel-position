<x-layout>
    <x-slot:heading>Register</x-slot:heading>

    <div class="max-w-3xl mx-auto md:mt-12">

        <form action="/register" method="post" enctype="multipart/form-data">
            @csrf

            <div class="text-center">
                <h2 class="font-bold text-4xl">Register</h2>
            </div>

            <!-- Form fields -->
            <div class="space-y-8 mx-auto">

                <x-forms.form-field name="name" label="Name" />
                <x-forms.form-field name="email" type="email" label="Email" />
                <x-forms.form-field name="password" type="password" label="Password" />
                <x-forms.form-field name="password_confirmation" type="password" label="Confirm Password" />

                <x-divider />

                <x-forms.form-field name="employer_name" label="Employer Name" />
                <x-forms.form-field name="employer_logo" type="file" label="Employer Logo" />

                <x-forms.form-button>Create Account</x-forms.form-button>

            </div>
        </form>
    </div>
</x-layout>
