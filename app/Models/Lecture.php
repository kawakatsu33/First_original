<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'body',
        'times',
        'user_id',
        'subject_id',
        'pdf_path',
        'pdf_paths',
        'level']
        ;
    protected static function boot()
        {
            parent::boot();
        
            static::deleting(function($lecture) {
                $lecture->understanding()->delete();
            });
        }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function weeks()
    {
        return $this->belongsToMany(Week::class, 'lecture_week');
    }
    
    public function understanding()
    {
        return $this->hasOne(Understanding::class);
    }
}
