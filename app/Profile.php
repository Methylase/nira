<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
       'postalCode',
       'description',
       'facebook',
       'twitter',
       'instagram',
       'linkedin'

   ];   
  public $table='profiles';
  protected $primaryKey='id';
   
    function user() {
     return $this->belongsTo('App\User');

    }
}
