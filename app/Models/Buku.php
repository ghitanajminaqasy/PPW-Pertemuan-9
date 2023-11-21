<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Gallery;

class Buku extends Model
{
    use HasFactory;
    
    protected $table = 'buku';

    protected $casts = [
        'tgl_terbit' => 'datetime'
    ];

    protected $dates = ['tgl_terbit'];


    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'tgl_terbit',
        'filepath',
        'filename',
    ];
    public function galleries(): HasMany 
    {
        return $this->hasMany(Gallery::class);
    }

    public function photos(){
        return $this->hasMany('App\Buku', 'id_buku', 'id');
    }
}
