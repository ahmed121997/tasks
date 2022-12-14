<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dec',
        'status',
        'user_id',
        'dead_line',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function done(){
        return $this->status;
    }
}
