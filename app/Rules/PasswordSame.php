<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\InvokableRule;

class PasswordSame implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $pwHashVal = User::where('id', Auth::user()->id)->first()->password;

        if (!Hash::check($value, $pwHashVal)){
            $fail('Your :attribute is incorrect.');
        }
    }
}
