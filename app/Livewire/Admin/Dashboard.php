<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class Dashboard extends Component
{
    public $data = [
        'title' => 'Dashboard'
    ];
    function mount() {
        // dump(@$_COOKIE);
        $this->dispatch('GlobalData',$this->data);
       

    }
    public function render()
    {
        return view('livewire.admin.dashboard')
        // ->layout('layouts.login')
        ;
    }
}
