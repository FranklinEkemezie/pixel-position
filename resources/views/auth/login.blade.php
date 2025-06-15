<x-layout>
    <x-slot:heading>Login</x-slot:heading>

    <div class="max-w-3xl mx-auto md:p-12">

        <form action="/login" method="post">
            @csrf

            <div class="text-center">
                <h2 class="font-bold text-4xl">Login</h2>
            </div>

            <!-- Form fields -->
            <div class="space-y-8 mx-auto">

                <x-forms.form-field name="email" type="email" label="Email" />
                <x-forms.form-field name="password" type="password" label="Password" />

                <x-forms.form-button>Login</x-forms.form-button>
            </div>
        </form>
    </div>
</x-layout>
