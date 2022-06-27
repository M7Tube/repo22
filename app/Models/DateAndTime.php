<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateAndTime extends Model
{
    use HasFactory;
    protected $table = 'date_and_times';
    protected $primaryKey = 'date_and_time_id';
    protected $fillable = [
        'title', 'date', 'is_required', 'template_id', 'category_id'
    ];
}
