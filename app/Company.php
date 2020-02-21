<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'cnpj';

    protected $fillable = ['name', 'cnpj'];

    public $incrementing = false;

    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = preg_replace('/\D/', '', $value);
    }

    public function getCnpjFormattedAttribute()
    {
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $this->attributes['cnpj']);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'company_contact', 'company_cnpj', 'contact_cpf');
    }
}
