<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'mail', 'explanation'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
