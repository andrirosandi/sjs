<?php

namespace App\Livewire\Admin\Widgets;

use App\Libs\Hello;
use App\Models\Menu;
use App\Libs\livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Console\DumpCommand;

class MainMenu extends Component
{
    public $menu,$menuraw,$active;
    public function mount(){
        $user = session('user');
        // dump($user->groupid);
        $menu = Menu::join('Menupermission', 'Menu.id', '=', 'Menupermission.menu_id')
        ->where('Menupermission.usergroup_id', $user->groupid)
        // ->where('Menupermission.allowed', 1)
        ->where('Menupermission.allowed', '!=',0)
        ->orderBy('sequence')
        ->get('menu.*');
        // dump(json_encode($menu));
        $this->menuraw = $menu;
        $this->prepare();

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
                if (is_array($this->active))
                if ( in_array($m->id,$this->active)) {
                    $m->active = 1;
                    
                }
                else{
                    $m->active = 0;
                }
                $return[$k] = $m;
                
                if ($m->type == 0) {
                    $return[$k]->child = $this->generate($menu,$m->id);
                }
            }
            
        }
        return $return;
    }
    public function prepare() {
        $raw = $this->menuraw;
        $menu = [];
        $active = null;

        
        foreach ($raw as $key => $value) {
            $menu[$value->id] = $value;
            if ($value->id == Route::currentRouteName()) {
                $active[] = $value->id;
            }
        }
        
        for ($i=0; $i < count($menu); $i++) { 
            if (isset($menu[$active[$i]??0])) 
            $active[$i+1] = $menu[$active[$i]]->parent;
    }
    $this->active = $active;
    
    }
    
    public function render()
    {
        return view('livewire.admin.widgets.main-menu');
    }
}
