<?php

namespace App\Models;

use App\Http\Resources\Admin\ServiceResource;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public $resource=ServiceResource::class;

    protected $fillable=[
        'name',
        'rate',
        'description',
    ];
    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($r) use ($search){
                $r->Where('title', 'LIKE', $search);
            });
        }
        return $query;
    }
}
