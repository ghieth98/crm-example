<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'clientName' => $this->company_name,
            'clientEmail' => $this->client_email,
            'clientPhone' => $this->client_phone,
            'companyName' => $this->company_name,
            'companyAddress' => $this->company_address,
            'companyCity' => $this->company_city,
            'companyZip' => $this->company_zip,
            'companyVat' => $this->company_vat,
        ];
    }
}
