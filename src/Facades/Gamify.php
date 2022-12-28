<?php

namespace Sajidbashir24h\Gamify\Facades;

use Sajidbashir24h\Gamify\Badge;
use Sajidbashir24h\Gamify\Events\BadgeAchieved;

class Gamify
{

    /**
     * @param $subject
     *
     * @return bool
     */
    public function syncBadges($subject)
    {
        $badgeIds = Badge::all()->filter
            ->isAchieved($subject)
            ->map->id;

        $sync_res = $subject->badges()->sync($badgeIds);

        // send event for new badges
        if (count($sync_res['attached']) > 0) {
            Badge::query()->whereIn('id', $sync_res['attached'])->get()->each(function ($badge) use ($subject) {
                BadgeAchieved::dispatch($subject, $badge);
            });
        }


        return true;
    }

    /**
     * @param $badge
     * @param $subject
     *
     * @return bool
     */
    public function syncBadge($badge, $subject)
    {
        if ($badge->isAchieved($subject)) {
            $subject->badges()->syncWithoutDetaching($badge->id);
            BadgeAchieved::dispatch($subject, $badge);

            return true;
        }

        return false;
    }
}

