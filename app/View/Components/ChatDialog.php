<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatDialog extends Component
{
    /**
     * Create a new component instance.
     */

    public $getMessagesUrl;
    public $sendMessageUrl;

    public function __construct(string $getMessagesUrl, string $sendMessageUrl)
    {
        $this->getMessagesUrl = $getMessagesUrl;
        $this->sendMessageUrl = $sendMessageUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-dialog');
    }
}
