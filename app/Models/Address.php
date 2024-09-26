<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'first_name',
        'phone_number',
        'email_address',
        'street_address',
        'city',
        'state',
        'country',
        'zip_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
