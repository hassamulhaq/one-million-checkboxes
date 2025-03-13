<?php

namespace App\Actions\Checkbox;

use Illuminate\Support\Facades\Redis;

class CheckboxRedisBitmapGet
{

    public function handle()
    {
        dd(Redis::GET('state'));
    }
}
