<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    //

    public function show()
    {
        return view('auth.register');
    }

    public function create(Request $request)
    {
        $userAttrs = $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'confirmed', Password::min(6)],
        ]);

        $employerValidationRules = [
            'employer_name' => ['required', 'min:5']
        ];

        if (! empty($request->get('employer_logo')))
            $employerValidationRules['employer_logo'] = ['file'];

        $employerAttrs = $request->validate($employerValidationRules);

        // Create user
        $user = User::create($userAttrs);

        // Upload file
        /** @var  UploadedFile|null $employerLogo */
        $employerLogo = $employerAttrs['employer_logo'] ?? null;

        if ($employerLogo && ! ($filePath = $employerLogo->store())) {
            abort(500, 'Could not upload file. Please try again');
        }

        $user->employer()->create([
            'name'  => $employerAttrs['employer_name'],
            'logo'  => $filePath ?? null
        ]);

        Auth::attempt($request->only('email', 'password'));

        return redirect()->intended('/dashboard');
    }
}
