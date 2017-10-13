<?php

namespace Pyaesone17\Lapse;

use Pyaesone17\Lapse\Notifications\RemindExceptionNotification;
use Illuminate\Notifications\Notifiable;
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
    public function sendNotification($exception, $closure)
    {
        if ($this->shouldntReport($exception) || app()->runningInConsole()) {
            return;
        }
        
        if( app()->environment()!='local' ){
            
            try {
                $user = $closure();

                if (! $user instanceof Notifiable) {
                    throw new Exception(get_class($user).' must be notifiable object');
                }

                $notifiable = Notification::route('slack', config('lapse.slack_channel'))->route('database',$user->notifications());
                $notifiable->notify(new RemindExceptionNotification($exception));
                
            } catch (Throwable $t) {
                dd($t);
            }
        }
    }
}
