<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\ModelFilters\TemplateFilter;

class Template extends Model
{
    use HasFactory;
    use TemplateFilter, Filterable;

    private static $whiteListFilter = ['*'];
    protected $table = 'templates';
    protected $primaryKey = 'template_id';
    protected $fillable = [
        'name',
        'desc',
        'pic',
        'instructions',
        'signatures',
        'user_id'
    ];

    // protected $casts = [
    //     'signatures' => 'array'
    // ];

    public  static function searchaa($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
