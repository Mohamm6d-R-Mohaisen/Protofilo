<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Admin\CategorayResource;

class Category extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',

    ];
    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($r) use ($search){
                    $r->where('title', 'LIKE', $search);

            });
        }
        return $query;
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
