<?php

namespace App\Listeners;

use App\Events\ViewTool;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\ToolView;
use Session;

class IncrementViewCounter
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
     * @param  ViewTool  $event
     * @return void
     */
    public function handle(ViewTool $event)
    {
        $tool = $event->tool;

        $session = (Session::get('views') == null) ? [] : Session::get('views');
        if (array_key_exists($tool->slug, $session)) {
            if (strtotime($session[$tool->slug]) < strtotime("-5 minutes")) {
                $this->createView($tool);
                $session[$tool->slug] = date('Y-m-d H:i:s');
            }
        } else {
            $this->createView($tool);
            $session[$tool->slug] = date('Y-m-d H:i:s');
        }

        Session::put('views', $session);
    }

    private function createView($tool) {
        $view = new ToolView();
        $view->tool_slug = $tool->slug;
        $view->created_at = date('Y-m-d H:i:s');
        $view->save();
    }
}