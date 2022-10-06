<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hitlink extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function short()
    {
        return $this->belongsTo(Link::class,'link_id');
    }
}
