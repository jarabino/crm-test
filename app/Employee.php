<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    protected $fillable = [
        "id",
        "first_name",
        "last_name",
        "company_id",
        "mobile_no",
        "email",
    ];

    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

