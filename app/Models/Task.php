<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table="tasks";
    protected $fillable = [
        'description',
        'fin',
        'statut',
        'day_id'
    ];
 /*   protected $casts=[
        'fin'=>'date:hh:mm',
    ];*/
    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
