<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getNameAttribute($value){
        return ucfirst($value);
    }
    public function setNameAttribute($value){
        $this->attributes['name'] = "Mr.".$value;
    }
    public function setAddressAttribute($value){
        $this->attributes['address'] = $value ." Ban";
    }
    public function getCompany(){
        return $this->hasOne("App\Models\Company");
        //for many relationship hasMany
    }
}
