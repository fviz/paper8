<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'color', 'description'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

}
