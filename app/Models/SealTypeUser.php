<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealTypeUser extends Model
{
    use HasFactory;

    protected $table = 'sealtypeusers';
    protected $connection = 'sqlanywhere';

    protected $fillable = [
        'sealid',
        'userid',
        // 'created_at',
        // 'updated_at',
    ];

    public function sealType()
    {
        return $this->belongsTo(SealType::class, 'sealid', 'sealid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id'); // Assuming the primary key for users is 'id'
    }
}
