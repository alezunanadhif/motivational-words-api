<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordsDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'about' => $this->about,
            'words' => $this->words,
            'writer' => $this->whenLoaded('writer', function () {
                return $this->writer['username'];
            }),
            'created_at' => date_format(new DateTime($this->created_at), 'd-m-Y'),
        ];
    }
}
