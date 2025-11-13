<?php

namespace App\Models;

use App\HasNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasNotes, HasFactory;

    protected $fillable = [
        'organisation',
        'property_type',
        'parent_property_id',
        'uprn',
        'address',
        'town',
        'postcode',
        'live',
    ];

    public function certificates() {
        return $this->hasMany(Certificate::class, 'property_id', 'id');
    }
}
