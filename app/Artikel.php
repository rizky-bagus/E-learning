<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    //
    protected $table ="artikel";
    protected $fillable = ['title','foto','content','ket','id_kategori'];

    public $timestamps = true;

    public function Kategori() {
		return $this->belongsTo('App\Kategori', 'id_kategori');
	}

	public function getRouteKeyName(){
    	return 'slug';
    } 

    
}
