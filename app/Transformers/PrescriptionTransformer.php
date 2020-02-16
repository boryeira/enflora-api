<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Users\Prescription;

class PrescriptionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Prescription $prescription)
    {
        return [
            'id' => (int)$prescription->id,
            'userId' => (int)$prescription->user_id,
            'start' => isset($prescription->start) ? (string)$prescription->start->format('d-m-Y') : null, 
            'end' => isset($prescription->end) ? (string)$prescription->end->format('d-m-Y') : null, 
            'monthly' => (int)$prescription->monthly,
            'file' => (string)$prescription->file,
            'status' => (array)$prescription->status
        ];
    }
}
