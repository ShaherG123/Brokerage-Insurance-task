<?php

namespace App\Http\Resources;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\CourseContent;
use Auth;

class ActionResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'state' => $this->state,
        ];
    }
}
