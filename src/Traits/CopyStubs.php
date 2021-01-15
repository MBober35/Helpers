<?php

namespace MBober35\Helpers\Traits;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

trait CopyStubs {

    /**
     * Копировать заглушки.
     *
     * @param $from
     * @param $to
     * @param false $noReplace
     */
    protected function copyStubs($from, $to, $noReplace = false)
    {
        (new Filesystem)->ensureDirectoryExists(app_path($to));

        collect((new Filesystem)->allFiles($from))
            ->each(function (SplFileInfo $file) use ($to, $noReplace) {
                $fileName = Str::replaceLast(".stub", ".php", $file->getFilename());

                $exist = (new Filesystem)->exists(app_path("{$to}/{$fileName}"));
                if ($exist && ! $noReplace) {
                    $exist = ! $this->confirm("File [{$fileName}] exists, replace it?");
                }

                if (! $exist) {
                    (new Filesystem)->copy(
                        $file->getPathname(),
                        app_path("{$to}/{$fileName}")
                    );

                    $this->info("File [{$fileName}] successfully created");
                }
            });
    }

}
