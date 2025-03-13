<?php

namespace App\Actions\Checkbox;

use Illuminate\Support\Facades\Redis;

class CheckboxRedisBitmapUpdate
{
    public function handle(int $index, bool $checked)
    {
        /**
         * redis-cli
         * ```
         * # set bit
         * 127.0.0.1:6379> setbit state 2 1
         * 127.0.0.1:6379> setbit state 3 0
         * 127.0.0.1:6379> setbit state 10 1
         *
         * get-bit
         * 127.0.0.1:6379> getbit state 2
         * 127.0.0.1:6379> getbit state
         * ```
         */

        Redis::SETBIT('state', $index, (int) $checked);
    }
}
