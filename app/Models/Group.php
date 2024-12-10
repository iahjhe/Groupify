<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // Define the relationship to messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Define the relationship to users (pivot table)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
       // Define the relationship to the user (group creator)
       public function user()
       {
           return $this->belongsTo(User::class); // A group belongs to a user (the creator)
       }
   
   
       // Define the relationship to users (pivot table for group members)

}

