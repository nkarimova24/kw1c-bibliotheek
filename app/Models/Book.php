<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'genre_id',
        'year_published',
        'description',
        'status',
        'loan_period',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}