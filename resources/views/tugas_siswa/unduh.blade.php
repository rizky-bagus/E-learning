@extends('layouts.app')
@section('content')

<br>
<div class="wrapper">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Unduh Data Tugas
                	
 <a href="{{ route('tugas.index') }}" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
<br>                                                            
<div class="panel-body">
	<div class="container">
		<div class="col-md-8">
				<form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST">
				<input name="_method" type="hidden" value="PATCH">
					@csrf
						
					<div class="form-group">
							<div class="form-group">
							<label>File</label>
							<br>
							<span class="fa fa-file" style='font-size:50px'>&nbsp </span>
							<a class="btn btn-info" href="/download/tugas_siswa/{{$tugas_siswa->file}}"><span class="fa fa-download"> Download File</span></a>

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