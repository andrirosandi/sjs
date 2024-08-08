<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;

class ApprovalHistory extends Component
{
    public $data = [
        'title' => 'Approval History'
    ];
    function mount() {
        $this->dispatch('GlobalData',$this->data);
    }
    public function render()
    {
        return view('livewire.admin.modules.approval-history');
    }
}
