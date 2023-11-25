<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question,
            'category' => $this->category,
            'choices' => [
                'a' => $this->answer_1,
                'b' => $this->answer_2,
                'c' => $this->answer_3,
                'd' => $this->answer_4,
            ], 
        ];
    }
}
