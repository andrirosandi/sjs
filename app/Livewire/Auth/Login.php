<?php

namespace App\Livewire\Auth;

use DateTime;
use Livewire\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AuthController;


class Login extends  Component  // hj
{
	public $userid;
    public $password;
    public $remember;
    public $message;
    public $cookies;
    public $redirect_url = '/';

    protected $rules = [
        'userid' => 'required',
        'password' => 'required',
        // 'remember' => 'boolean',

    ];

    function mount() {
        $this->redirect_url = '/';
        if (isset($_GET['redirect'])) {
            $this->redirect_url = base64_decode($_GET['redirect']);
        }
    }

    public function submit()
    {
        $this->validate();

        $response = (new AuthController())->login($this->userid,$this->password);
        
        if($response != null) return redirect($this->redirect_url); // Akan langsung redirect ke '/' 
        else $this->message = 'Login Failed ! Userid or Password is wrong .';
    }
    function expired($minutes) {
        $currentDate = new DateTime();
        $expirationDate = $currentDate->modify("+".$minutes." minutes");
        
        return $expirationDate;
    }
    
    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.login');
    }
}
