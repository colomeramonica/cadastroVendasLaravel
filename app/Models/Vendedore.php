<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedore extends Model
{
    protected $fillable = [
        'nome',
        'email',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/vendedores/'.$this->getKey());
    }
}
