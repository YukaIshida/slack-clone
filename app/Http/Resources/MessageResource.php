<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
                'type' => 'message',
                'message_id' => $this->id,
                'attributes'=> [
                    'channel_id' => $this->channel_id,
                    'user' => $this->user,
                    'content' => $this->content,
                ]
            ]
        ];
    }
}
