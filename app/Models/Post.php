<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = ['user_id', 'title', 'body', 'date'];

    // public function getTitleAttribute($value)
    // {
    //     return strtoupper($value);
    // }

    // public function getTitleAndBodyAttribute()
    // {
    //     return $this->title . ' - ' . $this->body;
    // }

    // public function getDateAttribute()
    // {
    //     return date('d-m-Y');
    // }
}
