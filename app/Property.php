<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
       'user_id',
       'image',              
       'address',
       'amount',
       'state',
       'localG',
       'postalCode',
       'area',
       'bed',
       'baths',
       'garage',
       'amenities',
       'type',
       'map',
       'video',
       'description',
       'status'

   ];   
  protected $table='properties';
   
}
