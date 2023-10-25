<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'domain',
        'description',
        'aliases',
        'mailboxes',
        'max_quota',
        'quota',
        'transport',
        'backup_mx',
        'is_active',
    ];
    use HasFactory;
}
