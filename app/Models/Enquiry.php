<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquiry extends Model
{
    use HasFactory;

   protected $fillable = [
        'listing_id',
        'customer_id',
        'provider_id',
        'message',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function messages()
    {
        return $this->hasMany(EnquiryMessage::class);
    }
   

}
