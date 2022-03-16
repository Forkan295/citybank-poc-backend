<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_code',
        'type',
        'founded',
        'founder',
        'headquarter',
        'website',
    ];


    public function scopeActive($q)
    {
        $q->where('status', 1);
    }


}
