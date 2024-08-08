<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika tidak menggunakan konvensi Laravel
    protected $connection = 'sqlanywhere';

    protected $table = 'usergroups';

    // Tentukan primary key
    protected $primaryKey = 'id';

    // Primary key bukan auto-incrementing
    public $incrementing = false;

    // Tipe primary key adalah string
    protected $keyType = 'string';

    // Tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;

    // Kolom-kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'id',
        'description',
        'blocked'
    ];
}
