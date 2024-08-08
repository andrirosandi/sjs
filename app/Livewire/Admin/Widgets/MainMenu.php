<?php

namespace App\Livewire\Admin\Widgets;

use App\Libs\Hello;
use App\Models\Menu;
use App\Libs\livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class MainMenu extends Component
{
    public $menu;
    public function mount(){
        $user = session('user');
        // dump($user->groupid);
        $menu = Menu::join('Menupermission', 'Menu.id', '=', 'Menupermission.menu_id')
        ->where('Menupermission.usergroup_id', $user->groupid)
        ->where('Menupermission.allowed', 1)
        ->where('Menupermission.allowed', '!=',0)
        ->orderBy('sequence')
        ->get('menu.*');
        // dump(json_encode($menu));
        $this->menu = json_decode(json_encode($this->generate($menu,0),
            // 'raw' => $menu
        ),true);
        


    }

   
    public function generate($menu,$parent)
    {
        // code...

        $return = null;

        foreach ($menu as $k => $m) {
            if ($m->parent == $parent) {
                $return[$k] = $m;
                if ($m->type == 0) {
                    $return[$k]->child = $this->render($menu,$m->id);
                }
            }
            
        }
        return $return;
    }
    
    public function render()
    {
        return view('livewire.admin.widgets.main-menu');
    }
}
