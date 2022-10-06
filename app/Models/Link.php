<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function hit()
    {
        return $this->hasMany(Hitlink::class);
    }
}
