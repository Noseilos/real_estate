<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ScheduleCreated;
use App\Models\Schedule;
use Mail;
use Storage;

class ScheduleNotification
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  object  $event
     * @return void
     */
    public function handle(ScheduleCreated $event)
    {

        $schedule_id = Schedule::find($event->id)->toArray();
        $email = $event->email;
        
        $file = Storage::path('images/landscape-bg.jpg');
        Mail::send(
            'mail.schedule_notification',
            $schedule_id,
            function ($message) use ($schedule_id, $email, $file) {
                $message->from('support@tahananrealestate.com', 'Admin');
                $message->to($email);
                $message->subject("Your schedule is confirm!");
                $message->attach($file);
            }
        );
    }
}
