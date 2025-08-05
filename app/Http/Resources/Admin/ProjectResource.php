<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $catogary_name=$this->category->name;
        $operations = view('admin.projects.sub.operations', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'name'=>$this->name,
            'url'=>$this->url,
            'catogary_name'=>$catogary_name,
            'operations' => $operations,
        ];
    }
}
