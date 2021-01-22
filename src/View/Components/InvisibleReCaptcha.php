<?php

namespace MBober35\Helpers\View\Components;

use Illuminate\View\Component;

class InvisibleReCaptcha extends Component
{
    /**
     * Function after check.
     *
     * @var string
     */
    public $callback;

    /**
     * Google site key.
     *
     * @var string
     */
    public $siteKey;

    /**
     * Form id.
     *
     * @var string
     */
    public $formId;

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
    public function __construct(string $callback, string $formId = '', $noScript = false)
    {
        $this->callback = $callback;
        $this->siteKey = config("re-captcha.siteKey");
        $this->formId = ! empty($formId) ? $formId : false;
        $this->noScript = $noScript;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('helpers::components.invisible-re-captcha');
    }
}
