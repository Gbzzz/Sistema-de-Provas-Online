<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'correto',
    ];

    public function question()
    {
        return $this->belongsTo(questions::class);
    }
}
