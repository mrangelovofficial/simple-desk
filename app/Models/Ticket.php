<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'subject',
        'content'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
