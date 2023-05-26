<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'enunciado',
        'answer',
        'tipoQuestao',
    ];

     public function answers()
     {
         return $this->hasMany(Answer::class, 'question_id');
     }
     public function test(): BelongsToMany
     {
         return $this->belongsToMany(Test::class);
     }
}
