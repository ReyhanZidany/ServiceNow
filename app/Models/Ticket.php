<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'createdat',
        'solvedat',
        'solutiondesc',
        'status',
    ];
    
    protected $dates = ['createdat', 'solvedat', 'deleted_at'];

}

