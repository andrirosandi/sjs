<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;
use App\Models\SealType;
use App\Models\SealBarcode;
use Livewire\Attributes\Url;
use App\Libraries\SqlAnywhere;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Sealreport extends Component
{
    #[Url]
    public $page = 1,$perPage = 20,

    $code,

    $sealid,
    
    $sealed_at_from,
    $sealed_at_to,
    $unsealed_at_from,
    $unsealed_at_to,

    $sealed_by,
    $unsealed_by,

    $blocked,

    $status,
    $showUnusedBarcode = 0,
    
    $orderby='sealed_at',$ordermethod='desc',
    
    $showFilterForm = 0
    ;
    public $data = [
        'title' => 'Seal Activity',
        // 'actionButton' => [
        //     'Scan Seal' => [
        //         'attribute' => null,
        //         'icon' => null,
        //         'color' => 'green',
        //         'link' => '/seal'
        //     ]
        // ]
        ];
    

    public $message;
    public $errors,$errorsInput;
    public $sealtypes;
    public $sealhistory;
    public $meta;
    // public ;

    protected function validateInputs()
    {
        $this->errors = null;
        $this->errorsInput = null;
        $input = [
            'page' => $this->page,
            'code' => $this->code,
            'sealid' => $this->sealid,
            'sealed_at_from' => $this->sealed_at_from,
            'sealed_at_to' => $this->sealed_at_to,
            'unsealed_at_from' => $this->unsealed_at_from,
            'unsealed_at_to' => $this->unsealed_at_to,
            'sealed_by' => $this->sealed_by,
            'unsealed_by' => $this->unsealed_by,
            'blocked' => $this->blocked,
            'status' => $this->status,
            'orderby' => $this->orderby,
            'ordermethod' => $this->ordermethod,
        ];

        $rules = [
            'page' => 'nullable|integer',
            'code' => 'nullable|string|max:255',
            'sealid' => 'nullable|string|max:255',
            'sealed_at_from' => 'nullable|date',
            'sealed_at_to' => 'nullable|date|after_or_equal:sealed_at_from',
            'unsealed_at_from' => 'nullable|date',
            'unsealed_at_to' => 'nullable|date|after_or_equal:unsealed_at_from',
            'sealed_by' => 'nullable|string|max:255',
            'unsealed_by' => 'nullable|string|max:255',
            'blocked' => 'nullable|boolean',
            'status' => 'nullable|string|max:255',
            'orderby' => 'nullable|string|in:column_name_1,column_name_2,...', // Ganti dengan nama kolom yang valid
            'ordermethod' => 'nullable|in:asc,desc',
        ];

        

        try {
    		$val = Validator::make($input, $rules);
            return $val->validate();
    		
    	} catch (ValidationException $e) {
    		
            $this->message = "Update Failed";
            $this->errors = $e->validator->errors()->all();
            $this->errorsInput = $e->validator->errors()->messages();
            return false;
    	}
    }

    function mount() {
        
        $this->dispatch('GlobalData',$this->data);

        $this->load();
        // dump($object->get());
    }
    function load(){
        $this->validateInputs();
        $this->sealtypes = SealType::get();

        $object = SealBarcode::join('SealTypes','sealbarcodes.sealid','sealtypes.sealid');
        if ($this->code != null) $object = $object->where('sealbarcodes.barcode','like','%'.$this->code.'%');
        if ($this->sealed_by != null) $object = $object->where('sealbarcodes.sealed_by','like','%'.$this->sealed_by.'%');
        if ($this->unsealed_by != null) $object = $object->where('sealbarcodes.unsealed_by','like','%'.$this->unsealed_by.'%');
        if ($this->sealid != null) $object = $object->where('sealtypes.sealid','like','%'.$this->sealid.'%');
        if ($this->status != null) $object = $object->where('sealbarcodes.status','=',$this->status);
        if ($this->blocked != null) $object = $object->where('sealbarcodes.blocked','=',$this->blocked);
        if ($this->showUnusedBarcode == 0) $object = $object->where('sealbarcodes.status','>',0);
        
        // Filter berdasarkan sealed_at range
        if ($this->sealed_at_from != null) {
            $sealed_at_to = $this->sealed_at_to ?? now(); // Gunakan tanggal hari ini jika sealed_at_to tidak ada
            $object = $object->whereBetween('sealed_at', [$this->sealed_at_from, $sealed_at_to]);
        }
        
        // Filter berdasarkan unsealed_at range
        if ($this->unsealed_at_from != null) {
            $unsealed_at_to = $this->unsealed_at_to ?? now(); // Gunakan tanggal hari ini jika unsealed_at_to tidak ada
            $object = $object->whereBetween('unsealed_at', [$this->unsealed_at_from, $unsealed_at_to]);
        }
        
        // Tambahkan kondisi order by jika diperlukan
        if ($this->orderby != null) {
            $ordermethod = $this->ordermethod ?? 'asc'; // Gunakan 'asc' jika ordermethod kosong
            $object = $object->orderBy($this->orderby, $ordermethod);
        }
        
        // $this->data = $object->paginate($this->perPage, ['*'], 'page', $this->page);
        
        $sqlanywhere = new SqlAnywhere($object);
        $object = $sqlanywhere->select(
            ['sealbarcodes.barcode',
            'sealbarcodes.blocked',
            'sealbarcodes.created_at',
            'sealbarcodes.sealed_by',
            'sealbarcodes.sealed_at',
            'sealbarcodes.sealed_picture',
            'sealbarcodes.sealed_location',
            'sealbarcodes.unsealed_by',
            'sealbarcodes.unsealed_at',
            'sealbarcodes.unsealed_picture',
            'sealbarcodes.unsealed_location',
            'sealbarcodes.status',
            'sealtypes.sealid',
            'sealtypes.sealname',]
            

        )->page($this->page,$this->perPage)->prepare($meta);
        $this->sealhistory = $object->get();
        $this->meta = $meta;
    }

    function setShowFilterForm($i) {
        $this->showFilterForm = $i;
        $this->load();
    }
    public function setPage($page) {
        $this->page = $page;
        $this->load();
    }
    

    public function render()
    {
        
        return view('livewire.admin.modules.sealreport');
    }
}
