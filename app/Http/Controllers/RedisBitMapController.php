<?php

namespace App\Http\Controllers;

use App\Actions\Checkbox\CheckboxRedisBitmapGet;

class RedisBitMapController extends Controller
{
    public function bitmap()
    {
        (new CheckboxRedisBitmapGet())->handle();
    }
}
