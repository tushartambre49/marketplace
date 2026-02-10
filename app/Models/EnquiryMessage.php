<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnquiryMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_id',
        'sender_id',
        'message',
    ];


        public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}

