<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $connection = 'sqlanywhere';
    protected $primaryKey = 'id';
    protected $table = 'menu';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'parent',
        'type',
        'sequence',
        'wire',
        'link',
    ];
}
