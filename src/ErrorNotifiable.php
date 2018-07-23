<?php

namespace Pyaesone17\Lapse;

use Pyaesone17\Lapse\Notifications\RemindExceptionNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\AnonymousNotifiable;
use Pyaesone17\Lapse\Models\Lapse;
use Notification;
use Throwable;
use Exception;

trait ErrorNotifiable
{
    /**
     * Send notification via laravel notification channels
     *
     * @param  Exception $e
     * @return boolean
     */
    public function sendNotification($exception, $formatters = [])
    {
        if ($this->shouldntReport($exception)) {
            return;
        }
                    
        try {
            $this->storeLapse($exception);
            $notification = $this->getNotification();
            $notification->notify(new RemindExceptionNotification($exception, $formatters));
        } catch (Throwable $t) {
            dd($t);
        }
    }

    protected function getNotification()
    {
        return $this->getDefaultNotification();
    }

    protected function getDefaultNotification()
    {
        $anonymousNotification = new AnonymousNotifiable();
        $channels = config('lapse.channels');

        foreach ($channels as $key => $channel) {
            $anonymousNotification->route($key, $channel);
        }
   
        return $anonymousNotification;
    }

    protected function storeLapse($exception)
    {
        Lapse::create([
            'class' => get_class($exception),
            'title' => $exception->getMessage(),
            'content' => $exception->__toString(),
            'url' => url()->current(),
            'payload' => json_encode(request()->all()),
            'method' => request()->method(),
            'user_id' => auth()->check() ? auth()->user()->id : null
        ]);
    }
}
