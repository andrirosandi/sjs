<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealType extends Model
{
    use HasFactory;

    protected $table = 'sealtypes';
    protected $primaryKey = 'sealid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $connection = 'sqlanywhere';
    protected $fillable = [
        'sealid',
        'sealname',
        'needcapture',
        'needlocation',
        'blocked',
        'barcodesuffixlength',
        'barcodetype',
        // 'created_at',
        // 'updated_at',
    ];

    protected $casts = [
        'needcapture' => 'integer',
        'needlocation' => 'integer',
        'blocked' => 'integer',
    ];

    public function sealBarcodes()
    {
        return $this->hasMany(SealBarcode::class, 'sealid', 'sealid');
    }
}
