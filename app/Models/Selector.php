<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selector extends Model
{
    use HasFactory;
    protected $table = 'selectors';
    protected $primaryKey = 'selector_id';
    protected $fillable = [
        'name', 'values', 'is_required', 'template_id', 'category_id'
    ];

    protected $casts = [
        'is_required' => 'integer'
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
