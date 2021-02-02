<?php

namespace MBober35\Helpers\Traits;

use Illuminate\Support\Str;

trait ShouldSlug {

    protected static function bootShouldSlug()
    {
        static::creating(function ($model) {
            // Записать slug.
            $model->generateSlug();
        });

        static::updating(function ($model) {
            // Записать slug.
            $model->generateSlug(true);
        });
    }

    /**
     * По какому столбцу искать.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->routeKey ?? "slug";
    }

    /**
     * На основе чего генерировать.
     *
     * @return string
     */
    public function getSlugKey()
    {
        return $this->slugKey ?? "title";
    }

    /**
     * Сгенерировать новый адрес.
     *
     * @param false $updating
     */
    public function generateSlug($updating = false)
    {
        $key = $this->getRouteKeyName();

        if ($updating && ($this->original[$key] == $this->{$key})) return;

        $current = trim($this->{$key});
        $slug = empty($current) ? $this->{$this->getSlugKey()} : $current;
        $slug = Str::slug($slug);
        $buf = $slug;
        $i = 1;
        $id = $updating ? $this->id : 0;
        while (
            self::query()
                ->select("id")
                ->where($key, $buf)
                ->where("id", "!=", $id)
                ->count()
        ) {
            $buf = $slug . "-" . $i++;
        }
        $this->{$key} = $buf;
    }
}
