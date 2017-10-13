<?php

namespace Pyaesone17\Lapse;

use Pyaesone17\Lapse\Notifications\RemindExceptionNotification;
use Notification;
use Throwable;

trait ErrorNotifiable
{
    /**
     * Send notification via laravel notification channels
     * 
     * @param  Exception $e
     * @return boolean
     */
    public function sendNotification($exception, $closure)
    {
        if ($this->shouldntReport($exception) || app()->runningInConsole()) {
            return;
        }
        
        if( app()->environment()!='local' ){
            
            try {
                $user = $closure();
                $notifiable = Notification::route('slack', config('lapse.slack_channel'))->route('database',$user);
                $notifiable->notify(new RemindExceptionNotification($exception));
            } catch (Throwable $t) {
                dd($t);
            }
        }
    }
}
