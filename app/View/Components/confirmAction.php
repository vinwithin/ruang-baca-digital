<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmAction extends Component
{
    /**
     * Create a new component instance.
     */
    public $modalId;
    public $title;
    public $actionUrl;
    public $confirmText;
    public function __construct($modalId, $title, $actionUrl, $confirmText)
    {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->actionUrl = $actionUrl;
        $this->confirmText = $confirmText;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-action');
    }
}
