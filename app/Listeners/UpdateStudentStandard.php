<?php

namespace App\Listeners;

use App\Events\PromoteStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStudentStandard
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PromoteStudent $event)
    {
       // promote student if the current student standard is between 1 and 9

        $event->student->standard_id < 9 ? $event->student->standard_id++ : $event->student->standard_id;
        $event->student->save();
    }
}
