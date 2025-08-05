<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Admin\ProjectResource;
use App\Models\Image;

class Project extends Model
{

    public $resource=ProjectResource::class;
    protected $fillable = [
        'category_id',
        'name',
        'url',
        'overview',
        'features',
    ];
    protected $casts = [
        'features' => 'array',

    ];
    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($r) use ($search){
                $r->where('name', 'LIKE', $search);

            });
        }
        return $query;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
