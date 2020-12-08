<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    // protected $table = 'posts';//custom table name
    // protected $primaryKey = 'id';//custom id
    protected $date = ['deleted_at'];
    protected $fillable = [
        'title', 'body', 'is_admin'
    ];
}
