<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Vocabulary extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "word" => $this->word,
            "description" => $this->description,
            "spelling" => $this->spelling,
            "audio"=>$this->audio,
            "category"=>$this->category,
            "vocab_example"=>$this->vocab_example,
            "user_id"=>$this->user_id,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
        ];
    }
}
