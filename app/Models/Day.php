<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table="days";
    protected $fillable = [
        'nom',
        'date',
        'statut'
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class,'day_id','id');
    }
}
