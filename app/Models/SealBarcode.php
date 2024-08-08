<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealBarcode extends Model
{
    use HasFactory;

    protected $table = 'sealbarcodes';
    protected $primaryKey = 'barcode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $connection = 'sqlanywhere';
    protected $fillable = [
        'barcode',
        'sealid',
        'blocked',
        // 'created_at',
        // 'updated_at',
        'sealed_by',
        'sealed_at',
        'sealed_picture',
        'sealed_location',
        'unsealed_by',
        'unsealed_at',
        'unsealed_picture',
        'unsealed_location'

    ];

    protected $casts = [
        'blocked' => 'boolean',
    ];

    public function sealHistories()
    {
        return $this->hasMany(SealHistory::class, 'barcode', 'barcode');
    }

    public function sealType()
    {
        return $this->belongsTo(SealType::class, 'sealid', 'sealid');
    }
}
