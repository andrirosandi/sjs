<?php

namespace App\Livewire\Admin\Widgets;

use Livewire\Attributes\On;
use Livewire\Component;

class ContentTitle extends Component
{
    public $data;

    #[On('GlobalData')]
    function ProccessingData($data) {
        $this->data = $data;
    }
    
    public function render()
    {
        return view('livewire.admin.widgets.content-title');
    }
}
