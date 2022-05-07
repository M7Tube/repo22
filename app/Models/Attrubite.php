<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attrubite extends Model
{
    use HasFactory;
    protected $table = 'attrubites';
    protected $primaryKey = 'attrubite_id';
    protected $fillable = [
        'name', 'template_id', 'status', 'category_id'
    ];

    protected $casts = [
        'status' => 'array'
    ];

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'template_id');
    }

    public function category()
    {
        return $this->belongsTo(ReportCategory::class, 'category_id', 'category_id');
    }

    public  static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }
}
