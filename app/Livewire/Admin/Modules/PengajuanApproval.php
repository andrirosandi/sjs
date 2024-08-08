<?php

namespace App\Livewire\Admin\Modules;

use App\Libs\livewire;
use Livewire\Component;
use Livewire\Attributes\Url;


class PengajuanApproval extends Component
{
    #[Url]
    public $page,$q,$orderby,$ordermethod,$response;

    public $contentData;
    public $data;
    public $pov,$show;

    function iniPageInfo() {

        if (($this->pov??null) === 'requestor') {
            $data =[
                'title' => "Pengajuan Approval",
                'actionButton' => [
                    'Buat Pengajuan Approval' => [
                        'attribute' => null,
                        'icon' => null,
                        'color' => 'green',
                        'link' => '/pengajuan_approval_form'
                    ]
                ]
            ];
        }
        elseif (($this->pov??null) === 'approver' && $this->show === 'pending') {
            $data = [
                'title' => "Pending Approval",
                'actionButton' => [
                    'Lihat History' => [
                        'attribute' => null,
                        'icon' => null,
                        'color' => 'yellow',
                        'link' => '/approver/pengajuan_approval/history'
                    ]
                ]
            ];
        }
        elseif (($this->pov??null) === 'approver' && $this->show === 'history') {
            $data = [
                'title' => "History Approval",
                'actionButton' => [
                    'Lihat Pending' => [
                        'attribute' => null,
                        'icon' => null,
                        'color' => 'green',
                        'link' => '/approver/pengajuan_approval/pending'
                    ]
                ]
            ];
        }
        
        $this->data =@$data;
    }
    function mount($pov,$show='pending' /* pending | history */) {
        // echo $pov;die;
        $this->pov = $pov;
        $this->show = $show;
        $this->iniPageInfo();
        $this->dispatch('GlobalData',$this->data);
        // $this->initPengajuanapprovallist();
    }

    public function initPengajuanapprovallist()  {


        if ($this->pov === 'requestor') {
            $url = 'api/request/requestor';
        }
        if ($this->pov === 'approver') {
            $url = 'api/request/approver';
            if(($this->show ?? null) == 'pending') $input['response'] = '0';
            if(($this->show ?? null) == 'history') $input['response'] = '1,2';
        }
        
        if($this->page ?? null !== null) $input['page'] = $this->page;
        if($this->q ?? null !== null) $input['q'] = $this->q;
        if($this->orderby ?? null !== null) $input['orderby'] = $this->orderby;
        if($this->ordermethod ?? null !== null) $input['ordermethod'] = $this->ordermethod;
        $this->contentData = (livewire::getHTTP($url,$input??[]))??[];
        
    }

    function setpage($page){
        $this->page = $page;
    }

    public function orderUpdate($orderby,$ordermethod) {
        $this->orderby = $orderby;
        $this->ordermethod = $ordermethod;
        
        $this->initPengajuanapprovallist();
        
    }

    
    public function render()
    {
        
        $this->initPengajuanapprovallist();
        return view('livewire.admin.modules.pengajuan-approval');
    }
}
