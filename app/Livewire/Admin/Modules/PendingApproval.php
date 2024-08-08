<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;

class PendingApproval extends Component
{
    public $data = [
        'title' => 'Pending Approval',
        'actionButton' => [
            'Lihat History' => [
                'attribute' => null,
                'icon' => null,
                'color' => 'yellow',
                'link' => '/approval_history'
            ]
        ]
    ];
    function mount() {
        $this->dispatch('GlobalData',$this->data);
    }
    public function render()
    {
        return view('livewire.admin.modules.pending-approval');
    }
}
