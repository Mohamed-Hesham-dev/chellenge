<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserArtecalesResource extends JsonResource
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
            
           
            'name' => $this->name,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'articals'=>ArticalResource::collection($this->articals),  

        ];
    }
}
