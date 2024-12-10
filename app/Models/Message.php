<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // In the Message model (app/Models/Message.php)

public function user()
{
    return $this->belongsTo(User::class);
}

}
