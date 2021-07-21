<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LocaleChangeController extends Controller
{
    public function __invoke(Request $request)
    {
        Validator::make(['locale' => $request->locale], [
            'locale' => [
                'required',
                Rule::in(getDefinedLocales()),
            ],
        ]);

        $user = Auth::user();
        $user->locale = $request->locale;
        $user->save();

        return redirect(replaceUrlLocale(url()->previous(), 'lv')
                        ?? url()->previous());
    }
}
