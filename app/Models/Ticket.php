<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image',
        'createdat',
        'solvedat',
        'solutiondesc',
        'status',
    ];
    
    protected $dates = ['createdat', 'solvedat', 'deleted_at'];

    // Relationship to the user who created the ticket
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function resolvedBy()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}
