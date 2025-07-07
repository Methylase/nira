<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{   
    protected $fillable = [
        'image',
        'name',
        'email',
        'subject',
        'feedback'
    ];   
    protected $table='testimonials';
    protected $primaryKey='id';
}
