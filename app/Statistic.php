<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistics';
    protected $casts = [
        'team1Tried' => 'array',
        'team2Tried' => 'array'
    ];
}
