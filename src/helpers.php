<?php

if (! function_exists("active_state")) {
    /**
     * @return \MBober35\Helpers\Helpers\ActiveRouteManager
     */
    function active_state() {
        return app("active-route");
    }
}