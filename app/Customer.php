<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'identification_type', 'identification_number', 'email'];

    const ID_TYPE_CPF = 1;
    const ID_TYPE_RG = 2;

    public function getIdentificationAttribute()
    {
        return __('customer.identifications.' . $this->identification_type, [
            'number' => $this->identification_number
        ]);
    }
}
