<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Listing extends Model
{
    use HasFactory;

  protected $fillable = [
    'provider_id',
    'category_id',
    'title',
    'description',
    'city',
    'suburb',
    'price',
    'price_type',
    'status',
];


        public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

        public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getStatusAttribute($value)
    {
        return strtolower(trim($value));
    }

}
