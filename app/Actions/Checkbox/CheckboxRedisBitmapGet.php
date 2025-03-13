<?php

namespace App\Actions\Checkbox;

use Illuminate\Support\Facades\Redis;

class CheckboxRedisBitmapGet
{

    public function handle(): string
    {
        $bitmap = '';
        $states = str_split(Redis::GET('state'));
        foreach ($states as $state) {
            $bitmap .= str_pad(decbin(ord($state)), 8, '0', STR_PAD_LEFT);
        }

        return $bitmap;
    }
}
