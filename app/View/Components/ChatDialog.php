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
    public $broadcastOn;
    public $broadcastAs;

    public function __construct(string $getMessagesUrl, string $sendMessageUrl, string $broadcastOn, string $broadcastAs)
    {
        $this->getMessagesUrl = $getMessagesUrl;
        $this->sendMessageUrl = $sendMessageUrl;
        $this->broadcastOn = $broadcastOn;
        $this->broadcastAs = $broadcastAs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-dialog');
    }
}
