<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alert;


class Guru extends Model
{
    //
    protected $table ="guru";
    protected $fillable = ['nipd','nama','foto','mapel','alamat'];

    public $timestamps = true;

    public function user() {
		return $this->hasMany('App\User', 'id_guru');
	}

	public function Kelas() {
		return $this->hasMany('App\Kelas', 'wali_kelas');
	}

	public function Tugas() {
		return $this->hasMany('App\Tugas', 'pengirim');
	}

	public static function boot(){
    	parent::boot();
    	self::deleting(function($guru){
    		if ($guru->Kelas->count() > 0){
    		$html = 'Guru tidak bisa dihapus karena masih digunakan';
    		Alert::error($html)->autoclose(2500);
    		return false;
    		}elseif($guru->Tugas->count() > 0){
            $html = 'Guru tidak bisa dihapus karena masih digunakan';
            Alert::error($html)->autoclose(2500);
            return false;
            }elseif($guru->user->count() > 0){
            $html = 'Guru tidak bisa dihapus karena masih digunakan';
            Alert::error($html)->autoclose(2500);
            return false;
            }
    	});
    }


}

