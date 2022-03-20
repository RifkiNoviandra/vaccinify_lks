<?php

namespace App\Http\Resources;

use App\Models\vaccine;
use Illuminate\Http\Resources\Json\JsonResource;

class SpotResorcesData extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $vaccine = vaccine::all();
        $vaccineId = $this->vaccine->pluck('id')->all();
        $avaibleVaccine = [];

        foreach ($vaccine as $allvaccine){
            $avaibleVaccine[$allvaccine->name] =in_array($allvaccine->id , $vaccineId);
        }
        return['id' => $this->id , 'name' => $this->name , 'address' => $this->address , 'serve' => $this->serve , 'capacity' => $this->capacity , "available_vaccines" => $avaibleVaccine];
    }
}
