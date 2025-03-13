<?php

namespace App\Actions\Checkbox;

use Illuminate\Support\Facades\Redis;

class CheckboxRedisBitmapCount
{

    public function handle()
    {
        return Redis::BITCOUNT('state');
    }
}
