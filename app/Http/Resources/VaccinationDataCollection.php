<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VaccinationDataCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $first = null;
        $second = null;

        if (@$this[0]) {
            $first = $this[0];
            $first['status'] = ($first->vaccine_id && $first->doctor_id && $first->officer_id) ? 'done' : 'Null';
        }
        if (@$this[1]) {
            $second = $this[1];
            $second['status'] = ($second->vaccine_id && $second->doctor_id && $second->officer_id) ? 'done' : 'Null';
        }

        return [
            "first" => $first,
            "second" => $second,
        ];
    }
}
