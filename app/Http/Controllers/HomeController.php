<?php

namespace App\Http\Controllers;

use App\Actions\Checkbox\CheckboxRedisBitmapCount;
use App\Actions\Checkbox\CheckboxRedisBitmapGet;

class HomeController extends Controller
{
    public function __invoke()
    {
        $props = [
            'state' => (new CheckboxRedisBitmapGet())->handle(),
            'count' => (new CheckboxRedisBitmapCount())->handle(),
        ];

        return view('welcome', compact('props'));
    }
}
