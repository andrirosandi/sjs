<?php

namespace App\Livewire\Auth;

use App\Libs\livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class Logout extends Component
{
    public $logout;

    public function act() : void {
        session()->forget('user');
        session()->invalidate();
        session()->regenerateToken();
        redirect('/auth/login');
    }
    public function mount() : void {
        $this->act();
        
    }
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
