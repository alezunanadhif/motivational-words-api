<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'comments_content' => $this->comments_content,
            'commentator' => $this->commentator['username'],
            'created_at' => date_format(new DateTime($this->created_at), 'd-m-Y'),
        ];
    }
}
