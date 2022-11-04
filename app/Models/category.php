<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'gambar'
    ];

    public function products()
    {
        return $this->hasMany(product::class);
    }
}
