@extends('layouts.app')
@section('content')

<br>
<div class="wrapper">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Kirim Data Tugas
                	
 @if(Auth::user()->role == 'Siswa')               	
 <a href="{{ route('tugas.view') }}" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
 @else
 <a href="{{ route('tugas.index') }}" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
 @endif
<br>                                                            
<div class="panel-body">
	<div class="container">
		<div class="col-md-8">
				<form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="{{ route('tugas_siswa.update',$tugas_siswa->id) }}">
				<input name="_method" type="hidden" value="PATCH">
					@csrf
						<div class="form-group">
							<label>File</label>
							<input id="file" name="file" accept="*/file" class="validate" type="file" multiple>
							@if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('file') }}</strong>
                            </span>
                    		@endif
							<label class="text-danger">Maks 2MB</label><br>
							
						</div>
						<div class="form-group">
							<label>Batas Tanggal</label>
							<input type="text" class="form-control" value="{{$tugas->batas}}" readonly>
							@if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('file') }}</strong>
                            </span>
                    		@endif
						</div>

						<input type="hidden" name="ket" value="Sudah Dikerjakan">
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