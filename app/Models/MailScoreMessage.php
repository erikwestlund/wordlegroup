<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailScoreMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['message' => 'json'];

}
