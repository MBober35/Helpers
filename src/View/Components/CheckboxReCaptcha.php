<?php

namespace MBober35\Helpers\View\Components;

use Illuminate\View\Component;

class CheckboxReCaptcha extends Component
{
    /**
     * Google site key.
     *
     * @var string
     */
    public $siteKey;

    /**
     * Disable google script
     *
     * @var bool
     */
    public $noScript;

    /**
     * Create a new component instance.
     *
     * InvisibleReCaptcha constructor.
     * @param string $callback
     */
    public function __construct($noScript = false)
    {
        $this->noScript = $noScript;
        $this->siteKey = config("re-captcha.siteKey");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('helpers::components.checkbox-re-captcha');
    }
}
