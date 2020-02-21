<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'cpf';

    protected $fillable = ['name', 'surname', 'cpf', 'phone'];

    public $incrementing = false;

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
    }

    public function getCpfFormattedAttribute()
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->attributes['cpf']);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_contact', 'contact_cpf', 'company_cnpj');
    }
}
