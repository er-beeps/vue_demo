<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $table = 'developer'; 
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [];
}
