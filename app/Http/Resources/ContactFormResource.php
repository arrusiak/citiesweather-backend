<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ContactFormResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'email' => "mixed", 'comments' => "mixed", 'subject' => "mixed", 'created_at' => "string", 'updated_at' => "string"])]
    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'email' => $this->email,
            'comments' => $this->comments,
            'subject' => $this->subject,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
