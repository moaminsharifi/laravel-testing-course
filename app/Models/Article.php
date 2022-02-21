<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * @return void
     */
    public function scopeTrending($query, $take = 3){
        return $query->orderBy('reads','desc')->take($take)->get();
    }
}
