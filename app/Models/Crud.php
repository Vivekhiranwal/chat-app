<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    use HasFactory;
    // protected $table = "cruds";
    // protected $fillable = ['name', 'email', 'gender', 'language', 'city'];

    public function setNameAttribute($value)
    {
        if (strpos($value, 'Mr') !== false) {
            return $this->attributes['name'] = $value;
        } else {
            return $this->attributes['name'] = 'Mr .' . $value;
        }
    }
    public function setCityAttribute($value)
    {
        return $this->attributes['city'] = $value . ', India';
    }
    // public function setStateAttribute($value)
    // {
    //     return $this->attributes['state'] = $value.', State';
    // }

    
    // public function setStateAttribute($value)
    // {
    //     if (strpos($value, 'State')) {
    //         return $this->attributes['state'] = $value;
    //     } else {
    //         return $this->attributes['state'] = $value.'State';
    //     }
        
    // }
}
