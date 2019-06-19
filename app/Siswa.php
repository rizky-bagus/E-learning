<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alert;


class Siswa extends Model
{
    //
    protected $table ="siswa";
    protected $fillable = ['nis','nama','foto','kelas','alamat'];

    public $timestamps = true;

    public function user() {
		return $this->hasMany('App\User', 'id_siswa');
	}

	public function Kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function Tugas()
    {
        return $this->belongsToMany('App\Tugas', 'tugas_siswa', 'id_tugas','siswa');
    }

    public static function boot(){
        parent::boot();
        self::deleting(function($siswa){
            if($siswa->Tugas->count() > 0){
            $html = 'Siswa tidak bisa dihapus karena masih digunakan';
            Alert::error($html)->autoclose(2500);
            return false;
            }elseif($siswa->user->count() > 0){
            $html = 'Siswa tidak bisa dihapus karena masih digunakan';
            Alert::error($html)->autoclose(2500);
            return false;
            }
        });
    }
}
