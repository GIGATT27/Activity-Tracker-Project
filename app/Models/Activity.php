<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // protected $table = 'activity';

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function updates()
{
    return $this->hasMany(ActivityUpdate::class);
}

    protected $fillable = [
        'name',
        'description',
        'status',
        'remarks',
        'user_id',
    ];

    use HasFactory;
}
