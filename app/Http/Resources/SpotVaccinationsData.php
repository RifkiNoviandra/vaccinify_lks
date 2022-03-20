<?php

namespace App\Http\Resources;

use App\Models\vaccination;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SpotVaccinationsData extends JsonResource
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
            'date' => $request->date ?? Carbon::today()->toDateString(),
            'spot' =>[
                'id' => $this->id,
                'name' => $this->name,
                'address' => $this->address,
                'serve' => $this->serve,
                'capacity' => $this->capacity,
            ],
            'vaccination_counts' => $this->vaccination->count(),
        ];
    }
}
