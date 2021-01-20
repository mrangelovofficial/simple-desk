<?php

namespace App\Models;

use Carbon\Carbon;
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
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function getCreatedAtAttribute($date) {
        $date = Carbon::parse($date);
        $today = Carbon::today();
        if($date->isSameDay($today)){
            return $date->format('g:i A');
        }else{
            return $date->format('j M');
        }
    }

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

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
