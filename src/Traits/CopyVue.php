<?php

namespace MBober35\Helpers\Traits;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

trait CopyVue {

    protected function makeVueIncludes($key)
    {
        if (empty($this->vueIncludes[$key])) return;

        $filePath = $this->checkVueInludeFile($key);

        foreach ($this->vueIncludes[$key] as $name => $include) {
            if (! $this->confirm("Add {$name} => {$include}.vue component to {$filePath}?")) continue;
            $data = [
                "Vue.component(",
                "'$name', ",
                "require('../components/{$this->vueFolder}/{$include}.vue').default",
                ");\n\n",
            ];
            file_put_contents(
                $filePath,
                implode("", $data),
                FILE_APPEND
            );
            $this->info("{$name} added to {$filePath}");
        }
    }

    protected function checkVueInludeFile($key)
    {
        $filePath = resource_path("js/{$key}/vue-includes.js");

        if (! file_exists($filePath)) {
            file_put_contents(
                $filePath,
                ""
            );
            $this->info("Added file {$filePath}");
        }

        return $filePath;
    }

}
