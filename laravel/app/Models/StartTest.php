<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StartTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_id',
        'time_start_test',
        'time_remaining_test',
    ];

}
