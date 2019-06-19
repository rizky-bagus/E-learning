<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alert;
class Kategori extends Model
{
	protected $table = "kategori";
    protected $fillable = ['nama_kategori','slug'];
    public $timestamps = true;

    public static function boot(){
    	parent::boot();
    	self::deleting(function($kategori){
    		if ($kategori->Artikel->count() > 0){
    		$html = 'Kategori tidak bisa dihapus karena masih digunakan';
    		Alert::error($html)->autoclose(2500);
    		return false;
    		}
    	});
    }

    public function Artikel() {
		return $this->hasMany('App\Artikel', 'id_kategori');
	}
}
