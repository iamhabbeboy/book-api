<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isbn',
        'authors',
        'country',
        'publisher',
        'release_date',
        'number_of_pages',
    ];

    public function setAuthorsAttribute($value)
    {
        $this->attributes['authors'] = implode(", ", $value);
    }

    public function getAuthorsAttribute()//: array
    {
        return explode(',', $this->attributes['authors']);
    }
}
