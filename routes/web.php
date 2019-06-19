<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', 'FrontendController');
Route::resource('frontend', 'FrontendController');
Route::get('home', 'HomeController@index');
Route::get('/all-artikel', 'AllController@artikel')->name('all.artikel');
Route::get('/all-review', 'AllController@review')->name('all.review');
Route::get('/artikel/single/{artikel}','FrontendController@single')->name('single');

Auth::routes();
	Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
	Route::get('/create', 'UsersController@createguru')->name('users.createguru');
	Route::resource('users', 'UsersController');
	Route::resource('artikel', 'ArtikelController');
	Route::resource('review', 'ReviewController');
	Route::resource('kelas', 'KelasController');
	Route::resource('kategori', 'KategoriController');
	Route::resource('guru', 'GuruController');
	Route::resource('siswa', 'SiswaController');
	
	
	
	Route::post('artikel/publish/{id}','ArtikelController@publish')->name('artikel.publish');
	Route::post('artikel/unpublish/{id}','ArtikelController@unpublish')->name('artikel.unpublish');
	Route::post('tugas/aksi_nilai/{id}','Tugas_SiswaController@aksi_nilai')->name('tugas_siswa.aksi_nilai');
	Route::post('review/publish/{id}','ReviewController@publish')->name('review.publish');
	Route::post('review/unpublish/{id}','ReviewController@unpublish')->name('review.unpublish');
	Route::post('users/aktif/{id}','UsersController@aktif')->name('users.aktif');
	Route::post('users/nonaktif/{id}','UsersController@nonaktif')->name('users.nonaktif');
	});

	Route::group(['prefix'=>'guru', 'middleware'=>['auth']], function () {
		Route::get('siswa', 'SiswaController@view')->name('siswa.view');
		Route::get('tugas', 'TugasController@View_Guru')->name('tugas.view_tugas');
		Route::get('tugas/create', 'TugasController@tambah')->name('tugas.tambah');
		Route::get('tugas/{id}/edit', 'TugasController@ubah')->name('tugas.ubah');
	});

	Route::group(['prefix'=>'siswa', 'middleware'=>['auth']], function () {
		Route::get('tugas', 'TugasController@lihat_siswa')->name('tugas.view');
		Route::resource('kirim', 'KirimController');
		Route::get('tugas/kirim/{id}', 'TugasController@kirim')->name('tugas.kirim');
		Route::get('download/tugas_siswa/{file}', 'Tugas_SiswaController@download');

	});

Route::resource('tugas', 'TugasController');	
Route::resource('home', 'HomeController');
Route::resource('profile', 'ProfileController');
Route::get('profile/{password}/ubah/', 'ProfileController@ubah')->name('profile.ubah');
Route::get('download/{file}', 'TugasController@download');
Route::get('export/tugas', 'TugasController@export');
Route::get('export/artikel','ArtikelController@export');
Route::get('export/users','UsersController@export');
Route::get('export/siswa','SiswaController@export');
Route::get('export/guru','GuruController@export');
Route::get('export/review','ReviewController@export');
Route::get('tugas/{id}/unduh', 'Tugas_SiswaController@unduh')->name('tugas_siswa.unduh');
Route::get('download/tugas_siswa/{file}', 'Tugas_SiswaController@download');
Route::resource('tugas_siswa','Tugas_SiswaController');
Route::get('tugas/{id}/kirim', 'Tugas_SiswaController@kirim')->name('tugas_siswa.kirim');
Route::get('tugas/{id}/nilai', 'Tugas_SiswaController@nilai')->name('tugas_siswa.nilai');
