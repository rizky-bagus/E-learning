<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas_Siswa extends Model
{
    //
    protected $table ="tugas_siswa";
    protected $fillable = ['id_tugas', 'siswa','nilai','ket'];
    public $timestamps = true;
}
