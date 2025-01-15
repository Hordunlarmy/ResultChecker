<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScratchCard extends Model
{
    use HasFactory;

    protected $table = 'scratch_cards';

    protected $fillable = ['pin', 'is_used'];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }
}
