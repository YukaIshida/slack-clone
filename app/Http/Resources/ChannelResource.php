<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'channel',
                'channel_id' => $this->id,
                'attributes'=> [
                    'channel_name' => $this->channel_name,
                ]
            ]
        ];
    }
}
