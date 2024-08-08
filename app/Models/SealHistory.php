<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealHistory extends Model
{
    use HasFactory;

    protected $table = 'sealhistories';
    protected $connection = 'sqlanywhere';
    protected $fillable = [
        'barcode',
        'status',
        'changedby',
        // 'created_at',
        // 'updated_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function sealBarcode()
    {
        return $this->belongsTo(SealBarcode::class, 'barcode', 'barcode');
    }
}
