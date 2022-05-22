<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ModelFilters\InspectionFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class InProgressInspection extends Model
{
    use HasFactory;
    use Filterable;
    use InspectionFilter;
    //
    private static $whiteListFilter = ['*'];

    protected $table = 'in_progress_inspections';
    protected $primaryKey = 'IPI_id';
    protected $fillable = [
        'name', 'desc', 'location', 'date', 'value','is_complated'
    ];
}
