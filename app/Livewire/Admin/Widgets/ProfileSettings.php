<?php

namespace App\Livewire\Admin\Widgets;

use App\Libs\livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;
use App\Libs\Hello;
use App\Models\UserGroup;

class ProfileSettings extends Component
{
    public $user,$usergroup,$logout;

    public function mount(){
        // $response = Http::asMultipart()->get(, []);


        // $response = livewire::getHTTP('api/profile');
        // $response = (new \App\Libs\Hello)->call('AuthController@profile');
        $this->user = session('user');

        // Log::debug($this->user);

        // if (@($response)['data'] == null) return redirect('/auth/login');
        // $response = Http::asMultipart()->get(, []);
        
        // $response_group = livewire::getHTTP('api/usergroup');
        $this->usergroup =  json_decode(json_encode((UserGroup::where('id',$this->user->groupid)->get())[0]),true);
        // dump([ $this->usergroup,$this->user->groupid]);
        // $this->usergroup = @($response_group)['data'];
        // Log::debug($this->usergroup);
        // die;
    }

    public function logoutRun() {
        // $response = livewire::getHTTP('api/logout');
        // $response = (new \App\Libs\Hello)->call('AuthController@logout');
        // $this->logout = @$response;
        // Log::debug($this->logout);

        // Cookie::forget('apptoken');
        // $this->dispatch('deletecookies',cookiesToDelete: [['name' => 'apptoken']]);
        session()->forget('user');
        return redirect('/auth/login');

    }
    public function render()
    {
        return view('livewire.admin.widgets.profile-settings');
    }
}
