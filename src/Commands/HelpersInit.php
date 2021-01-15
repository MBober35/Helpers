<?php

namespace MBober35\Helpers\Commands;

use Illuminate\Console\Command;
use MBober35\Helpers\Traits\CopyVue;

class HelpersInit extends Command
{
    use CopyVue;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'helpers:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init helpers files';

    protected $vueIncludes = [
        "admin" => [
            "confirm-form" => "ConfirmForm",
        ],
    ];

    protected $vueFolder = "Helpers";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->makeVueIncludes("admin");
    }
}
