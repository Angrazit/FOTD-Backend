<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\style;

class product extends Model
{
    protected $fillable = ['catagory', 'link_gambar', 'link_toko' ,'deskripsi'];
    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }
    use HasFactory;
}
