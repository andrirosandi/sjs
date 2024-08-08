<?php

namespace App\Livewire\Admin\Widgets;

use Livewire\Component;
use Livewire\Attributes\On;

class ActionButton extends Component
{
    public $data;

    #[On('GlobalData')]
    function ProccessingData($data) {
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.admin.widgets.action-button');
    }
}
