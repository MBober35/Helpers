<?php

use Illuminate\Support\Facades\Route;
use MBober35\Helpers\Http\Controllers\PriorityController;

Route::group([
    "prefix" => "ajax/vue/priority",
    "middleware" => ["web", "management"],
    "as" => "ajax.priority."
], function () {
    Route::group([
        "prefix" => "/{table}/{field}",
    ], function () {
        Route::put("/", [PriorityController::class, "update"])->name("update");
    });
});
