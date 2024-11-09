<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageTripResource extends JsonResource
{
    public function toArray($request)
    {
        $url = $this->getUrl();

        // Replace localhost with 127.0.0.1:8000
        $url = str_replace('localhost', '127.0.0.1:8000', $url);
        return [            
            'id' => $this->id, // Media ID if needed
            'url' => $url, // Get the URL of the media
            'name' => $this->file_name, // You can include the file name or any other relevan
        ];
    }
}
