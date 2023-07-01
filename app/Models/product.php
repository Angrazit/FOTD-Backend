<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['catagory', 'link_gambar', 'link_toko' ,'deskripsi'];
    use HasFactory;
}
