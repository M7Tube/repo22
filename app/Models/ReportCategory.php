<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
    use HasFactory;
    protected $table = 'report_categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name', 'template_id'
    ];

    public  static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'template_id');
    }
    public function att()
    {
        return $this->hasMany(Attrubite::class, 'category_id', 'category_id');
    }
    public function selector()
    {
        return $this->hasMany(Selector::class, 'category_id', 'category_id');
    }
    public function textbox()
    {
        return $this->hasMany(TextBox::class, 'category_id', 'category_id');
    }
}
