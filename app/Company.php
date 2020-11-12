<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Company extends Model
{
    use Notifiable;
    protected $fillable = [
        "id",
        "name",
        "email",
        "logo",
        "website",
    ];

    public function employee() 
    {
        return $this->hasMany(Employee::class);
    }
}
