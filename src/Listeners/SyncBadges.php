<?php

namespace Sajidbashir24h\Gamify\Listeners;

use Sajidbashir24h\Gamify\Events\PointsChanged;

class SyncBadges
{
    /**
     * Handle the event.
     *
     * @param  PointsChanged  $event
     * @return void
     */
    public function handle(PointsChanged $event)
    {
        $event->subject->syncBadges();
    }
}
