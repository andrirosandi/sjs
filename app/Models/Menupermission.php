<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menupermission extends Model
{
    use HasFactory;
    protected $connection = 'sqlanywhere';
    protected $table = 'menupermission';
    protected $fillable = [
        'usergroup_id',
        'menu_id',
        'allowed',
    ];
}
