<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, Searchable;
    protected $table = "messages";
    protected $fillable = [
            'id',
            'userid',
            'useremail',
            'username',
            'messagerid',
            'messageremail',
            'messagername',
            'subject',
            'category',
            'message',
            'ip',
            'sentdate'
    ];



}
