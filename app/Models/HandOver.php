<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandOver extends Model
{
    use HasFactory;
    protected $table = 'hand_overs';
    protected $primaryKey = 'hand_over_id';
    protected $fillable = [
        'note',
        'name',
        'signture1',
        'signture1Name',
        'signture2',
        'signture2Name',
        'Doc_No',
    ];
}
