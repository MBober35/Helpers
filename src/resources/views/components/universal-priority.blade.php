<universal-priority url="{{ route("ajax.priority.update", ["table" => $table, "field" => $field]) }}"
                    :elements="{{ json_encode($elements) }}">
</universal-priority>