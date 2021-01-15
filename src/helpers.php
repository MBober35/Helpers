<?php

if (! function_exists("is_active")) {
    /**
     * @return \MBober35\Helpers\Facades\ActiveRouteManager
     */
    function is_active() {
        return app("active-route");
    }
}