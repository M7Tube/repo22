<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;
    protected $table='signatures';
    protected $primaryKey='signature_id';
    protected $fillable=[
        'name',
        'signature'
    ];

    public  static function search($search)
    {
        return empty($search)?static::query()
        :static::query()->where('name','like','%'.$search.'%');
    }
}
