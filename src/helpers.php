<?php

if (! function_exists("active_state")) {
    /**
     * @return \MBober35\Helpers\Helpers\ActiveRouteManager
     */
    function active_state() {
        return app("active-route");
    }
}

if (! function_exists("date_helper")) {
    /**
     * @return \MBober35\Helpers\Helpers\DateHelperManager
     */
    function date_helper() {
        return app("date-helper");
    }
}