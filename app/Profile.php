<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    public $timestamps=false;
    protected $fillable = [
       'user_id',
       'profile_image',        
       'firstname',
       'middlename',
       'lastname',            
       'email',
       'gender',            
       'phone_number',
       'dob',
       'marital_status',
       'hobbies',
       'address_1',
       'address_2',
       'city',
       'state',
       'localG',
       'country',
       'postalCode'

   ];   
  protected $table='profiles';
  protected $primaryKey='id';
}
