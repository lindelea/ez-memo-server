<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class MemoResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'Memo',
            'attributes' => [
                'title' => $this->title,
                'contents' => $this->contents,
                'user_id' => $this->user_id,
                'folder_id' => $this->folder_id,
                'is_public' => (bool)$this->is_public,
                'is_archive' => (bool)$this->is_archive,
                'created_at_humans' => $this->created_at->diffForHumans(),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'key' => $this->encryptUUID(),
            ],
            'links' => [
                'url' => 'http://ez-memo.test/api/v1/memos?key='.$this->encryptUUID(),
            ],
        ];
    }

    /**
     * ID暗号
     * @return string
     */
    private function encryptUUID()
    {
        return Crypt::encryptString($this->id);
    }
}
