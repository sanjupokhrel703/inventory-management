<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'primary_number', 'user_id', 'secondary_number', 'address', 'cows', 'buffaloes'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
