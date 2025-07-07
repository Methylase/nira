<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{    protected $fillable = [
    'user_id',
    'property_id',
    'carousel'
];   
protected $table='carousels';
protected $primaryKey='id';
}
