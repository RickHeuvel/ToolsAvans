<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ViewPage;
use Session;
use App\PageView;

class IncrementPageViewCounter
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
    public function handle(ViewPage $event)
    {
        $name = $event->name;

        $session = (Session::get('views') == null) ? [] : Session::get('views');
        if (array_key_exists($name, $session)) {
            if (strtotime($session[$name]) < strtotime("-5 minutes")) {
                $this->createView($name);
                $session[$name] = now();
            }
        } else {
            $this->createView($name);
            $session[$name] = now();
        }

        Session::put('views', $session);
    }

    private function createView($name) {
        PageView::create([
            'name' => $name,
        ]);
    }
}
