<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch(Request $request)
{
    // Get the selected locale from the request
    $selectedLocale = $request->input('locale');

    // Set the application locale
    app()->setLocale($selectedLocale);
    session()->put('locale', $selectedLocale);

    // Display the selected locale using dd()
    // dd($selectedLocale);

    // Redirect back or to a specific page
    return redirect()->back();
}

}
