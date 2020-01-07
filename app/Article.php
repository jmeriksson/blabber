<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Table Name
    protected $table = 'articles';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
