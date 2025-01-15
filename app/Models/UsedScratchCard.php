<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedScratchCard extends Model
{
    use HasFactory;

    protected $table = 'used_scratch_cards';

    protected $fillable = ['pin', 'user_id', 'used_at'];

    protected $dates = ['used_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
