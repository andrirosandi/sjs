<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;
use App\Models\SealBarcode;
use App\Models\SealTypeUser;
use Livewire\Attributes\On; 
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Seal extends Component
{   
    use WithFileUploads;
    #[Url] 
    public $data = [
        'title' => 'Seal',
    ];

    public $step = 1;
    public $code = null;
    public $status = 0;
    public $message = '';
    public $uploadfieldName;
    public $tempUrl;
    public $clientOriginalname;
    public $newattachment;
    public $needcapture;
    public $needlocation;
    public $geolocation;
    public $barcodedata;

    function mount() {
        $this->dispatch('GlobalData', $this->data);
    }

    #[On('coded')]
    public function setCode($code) {
        // ... (rest of the setCode method remains unchanged)
        
        $this->code = $code;

        $barcodedata = SealBarcode::join('sealtypes','sealbarcodes.sealid','sealtypes.sealid')
            ->where('sealbarcodes.barcode',$code)->first();
        $user = session('user');
        $this->message = null;
        if (!$barcodedata) {
            $this->step = 3;
            $this->status = 0;
            $this->message = 'Barcode/QR Code tidak ditemukan !';

        }
        elseif ($barcodedata->blocked == 1) {
            $this->step = 3;
            $this->status = 0;
            $this->message = 'Barcode/QR Code ini tidak dapat digunakan !';
        }
        else  {
            $sealtypeuser = SealTypeUser::where('sealid',$barcodedata->sealid)
                ->where('userid',$user->userid)
                ->first();
            if (!$sealtypeuser){
                $this->step = 3;
                $this->status = 0;
                $this->message = 'Anda tidak punya Akses ke Segel ini';
            }
            else{
                $this->needcapture = $barcodedata->needcapture;
                $this->needlocation = $barcodedata->needlocation;
                
                if ($barcodedata->status == 0) {
                    $this->step = 2;
                }
                else if ($barcodedata->status == 1) {
                    $this->step = 2;
                }
                else{
                    $this->step = 3;
                    $this->message = 'Segel ini sudah pernah dipakai !';
                }
                
                // $this->step = 2;
                $this->barcodedata = $barcodedata;


            }
        }
    }

    #[On('setloc')]
    public function setGeolocation($geolocation) {
        $this->geolocation = $geolocation;
    }

    public function save($status) {
        $originalFileName = $this->code . '.1.' . $this->newattachment->getClientOriginalName();
        $this->newattachment->storeAs(path: 'public/pictures', name: $originalFileName);

        // Create thumbnail
        $this->createThumbnail($originalFileName);

        $sealbarcode = SealBarcode::find($this->code);
        $user = session('user');

        if ($status == 1) {
            $sealbarcode->sealed_at = now();
            $sealbarcode->status = $status;
            $sealbarcode->sealed_by = $user->userid;
            $sealbarcode->sealed_location = $this->geolocation;
            $sealbarcode->sealed_picture = $originalFileName;
        }
        if ($status == 2) {
            $sealbarcode->unsealed_at = now();
            $sealbarcode->status = $status;
            $sealbarcode->unsealed_by = $user->userid;
            $sealbarcode->unsealed_location = $this->geolocation;
            $sealbarcode->unsealed_picture = $originalFileName;
        }
        $sealbarcode->save();

        $this->step = 3;
        $this->status = 1;
        $this->message = 'Berhasil ' . (($status == 1) ? "memasang Segel." : "membuka Segel.") ;
    }

    private function createThumbnail($filename)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read(Storage::path('public/pictures/' . $filename));

        $image->scaleDown(width: 200, height: 200);

        if (!Storage::exists('public/pictures/thumbnail')) {
            Storage::makeDirectory('public/pictures/thumbnail');
        }

        $thumbnailPath = 'public/pictures/thumbnail/' . $filename;
        $image->save(Storage::path($thumbnailPath));
    }

    public function render()
    {
        return view('livewire.admin.modules.seal');
    }
}