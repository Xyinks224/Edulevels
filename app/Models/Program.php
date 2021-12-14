<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at']; // Menghidden field tertentu ( Melalui Model)

    // protected $fillable = ['name', 'edulevel_id']; //Melindungi yang bisa/tidak diisi
    protected $guarded =[]; //Melindungi yang tidak bisa diisi

    public function edulevel()
    {
        return $this->belongsTo('App\Models\Edulevel');
    }
}
