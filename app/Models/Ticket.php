<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'subject',
        'content',
        'user_id',
        'status_id',
        'priority_id',
        'category_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
