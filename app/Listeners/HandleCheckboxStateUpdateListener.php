<?php

namespace App\Listeners;

use App\Actions\Checkbox\CheckboxRedisBitmapUpdate;
use Illuminate\Support\Facades\Log;
use Laravel\Reverb\Events\MessageReceived;

class HandleCheckboxStateUpdateListener
{
    public function __construct()
    {
    }

    public function handle(MessageReceived $event): void
    {
        $payload = json_decode($event->message);
        /**
         * channel: `client-state` define on vue side
         */
        if ($payload->event != 'client-state') {
            return;
        }

        $data = $payload->data;

        Log::info(json_encode($data));

        (new CheckboxRedisBitmapUpdate())->handle($data->id, $data->checked);
    }
}
