<?php

namespace MBober35\Helpers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use MBober35\Helpers\Exceptions\PreventActionException;

class PriorityController extends Controller
{
    public function update(Request $request, string $table, string $field)
    {
        if (! Schema::hasTable($table)) {
            throw new PreventActionException("Таблица не найдена", 404);
        }
        if (! Schema::hasColumn($table, $field) || ! Schema::hasColumn($table, "id")) {
            throw new PreventActionException("Поле не найдено", 404);
        }
        Validator::make($request->only("items"), [
            "items" => ["required", "array"]
        ], [], [
            "items" => "Элементы",
        ])->validate();
        $items = $request->get("items");
        $ids = [];
        foreach ($items as $priority => $id) {
            $ids[] = $id;
            DB::table($table)
                ->where("id", $id)
                ->update([
                    "$field" => $priority
                ]);
        }
        // TODO: make event
        return response()
            ->json([
                "success" => true,
                "message" => "Успешно"
            ]);
    }
}
