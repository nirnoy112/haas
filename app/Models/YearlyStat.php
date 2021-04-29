<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyStat extends Model
{
    use HasFactory;

    protected $table = 'yearly_stats';
    protected $guarded = [];

}
