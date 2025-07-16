<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_agent extends Model
{
    protected $fillable = [
        'name',
        'email',
        'comment',
        'user_id',
        'property_id',
    ];   
    protected $table='contact_agents';
    protected $primaryKey='id';
}
