<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'time_test',
        'dsc_test',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public function startTests()
    {
        return $this->hasMany(StartTest::class);
    }

    public function endTests()
    {
        return $this->hasMany(EndTest::class);
    }

}
