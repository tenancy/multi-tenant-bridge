<?php

namespace Tenancy\Bridge\Hyn\Proxies;

use Illuminate\Contracts\Events\Dispatcher;
use Hyn\Tenancy\Events as Hyn;
use Tenancy\Identification\Events\Identified;
use Tenancy\Identification\Events\Switched;

class EventMapper
{
    protected $map = [
        Identified::class => Hyn\Websites\Identified::class,
        Switched::class => Hyn\Websites\Switched::class,
    ];

    public function subscribe(Dispatcher $events)
    {
        $events = array_keys($this->map);

        $events->listen($events, [$this, 'proxy']);
    }

    public function proxy($event)
    {
        $to = $this->map[get_class($event)];

        if (property_exists($event, 'website')) {
            $website = $event->website;
        } elseif (property_exists($event, 'hostname')) {
            $hostname = $event->hostname;
        }

        app('events')->dispatch(
            new $to($website ?? $hostname ?? null)
        );
    }
}
