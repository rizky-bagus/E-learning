@extends('layouts.app')
@section('content')
<br>
<div class="wrapper">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Edit Profile
                	
 <a href="/home" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
<br>                                                            
<div class="panel-body">
	<div class="container">
		<div class="col-md-8">
				<form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="{{ route('profile.update',Auth::user()->id) }}">
				<input name="_method" type="hidden" value="PATCH">
			
					@csrf

					@if(Auth::user()->role == 'Siswa')
						<input type="hidden" name="id_siswa" value="{{ Auth::user()->id_siswa }}">

					@elseif(Auth::user()->role == 'Guru')
						<input type="hidden" name="id_guru" value="{{ Auth::user()->id_guru }}">

					@endif							
					<input type="hidden" name="role" value="{{ Auth::user()->role }}">

						<div class="form-group">
							<label>E-mail</label>
							<input name="email" class="form-control" placeholder="E-mail" type="text" value="{{ Auth::user()->email }}" required>
							@if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                    		@endif
						</div>

						<div class="form-group">
							<label>Password Baru</label>
							<input name="baru" class="form-control" placeholder="Password" type="password"required>
							@if ($errors->has('baru'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('baru') }}</strong>
                            </span>
                    		@endif
						</div>

						<div class="form-group">
							<label>Konfirmasi Password</label>
							<input name="konfirmasi" class="form-control" placeholder="Password" type="password"required>
							@if ($errors->has('konfirmasi'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('konfirmasi') }}</strong>
                            </span>
                    		@endif
						</div>


						
						<div class="form-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

@endsection