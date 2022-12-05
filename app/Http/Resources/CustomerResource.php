<?php

namespace App\Http\Resources;

class CustomerResource extends MainResource
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
            'address' => $this->address,
            'description' => $this->description,
            'created_by_id' => $this->created_by,
            'created_by' => new UserResource($this->Created_by),
            'employee_id' => $this->employee_id,
            'employee' => new UserResource($this->Employee),
            'action_id' => $this->action_id,
            'action' => new ActionResource($this->Action),
            'state' => $this->state,
        ];
    }
}
