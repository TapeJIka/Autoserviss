<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory,Filterable;

    protected $fillable = [
        'name',
        'price',
        'category_id',
    ];


    public function category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
}
