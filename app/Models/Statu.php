<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;
    protected $table='status';
    protected $primaryKey='status_id';
    protected $fillable=[
        'name',
        // 'attrubite_id'
    ];

    // public function status()
    // {
    //     return $this->belongsTo(Attrubite::class,'attrubite_id','attrubite_id');
    // }
}
