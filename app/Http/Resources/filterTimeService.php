<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class filterTimeService extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $explode=explode(',',$this[0]->photos);
        
        $stars=0;
        foreach($this[0]->evaluation as $evaluation){
            $stars=$stars+$evaluation->evaluation;
        }
        $count=$this[0]->evaluation->count();

        if($count>0){
        $rate=$stars/$count;
        }else{
        $rate=0;
        }
        return [
            'title'=>$this[0]->title,
            'photo'=>$explode[0],
            'price'=>$this[0]->price,
            'evaluation'=>$rate,
            'photouser'=>$this[0]->user->photo,
            'username'=>$this[0]->user->name,
            'userid'=>$this[0]->user_id,
        ];
    }
}
