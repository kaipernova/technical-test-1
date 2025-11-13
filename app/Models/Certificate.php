<?php

namespace App\Models;

use App\HasNotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasNotes, HasFactory;

    protected $fillable = [
        'stream_name',
        'property_id',
        'issue_date',
        'next_due_date',
    ];
}
