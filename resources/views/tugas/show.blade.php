@extends('layouts.app')
@section('content')

<br>
<div class="wrapper">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Show Data Tugas 
 @if(Auth::user()->role == 'Siswa')               	
 <a href="{{ route('tugas.view') }}" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
 @else
 <a href="{{ route('tugas.index') }}" class="btn btn-danger pull-right"><i class="fa fa-sign-out">Kembali</i></a></div>
 @endif
<br>                                                            
<div class="panel-body">
	<div class="container">
		<div class="col-md-8">
				<form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data">
				<input name="_method" type="hidden" value="PATCH">
			
					@csrf

					
					<div class="form-group">
							<label>Guru</label>
							<input class="form-control" type="text" value="{{$tugas->Guru->nama}}" readonly>
					</div>

								<!-- File -->
						<div class="form-group">
							<label>File</label>
							<br>
							<span class="fa fa-file" style='font-size:50px'>&nbsp </span>
							<a class="btn btn-info" href="/download/{{$tugas->file}}"><span class="fa fa-download"> Download File</span></a>

						</div>

						<div class="form-group">
							<label>KKM</label>
							<input name="KKM" class="form-control" placeholder="KKM" type="text" value="{{ $tugas->KKM }}" readonly>
							
						</div>

						<br>
						<div class="form-group">
							<div class="dataTable_wrapper">
								<table class="table-bordered table-hover" id="datatables">
									<thead>
										<tr>
										<th>Siswa</th>	
										<th>Nilai</th>
										<th>Keterangan</th>
										<th>Action</th>
										</tr>
									</thead>

									<tbody>
										@foreach($tugas1 as $data)
										<tr>
											<td>{{$data->siswa}}</td>	
											<td>{{$data->nilai}}</td>
											<td>
                        @if( $data->ket == NULL )
                            <a href="#" class="btn btn-warning">Sedang Di Proses</a>
                        @elseif( $data->ket == 'Tuntas')
                            <a href="#" class="btn btn-success">{{ $data->ket }}</a>
                        @elseif( $data->ket == 'Belum Tuntas')
                            <a href="#" class="btn btn-danger">{{ $data->ket }}</a>
                        @elseif( $data->ket == 'Belum Dikerjakan')
                            <a href="#" class="btn btn-danger">{{ $data->ket }}</a>
                        @elseif( $data->ket == 'Sudah Dikerjakan')
                            <a href="#" class="btn btn-success">{{ $data->ket }}</a>     
                        @endif
                        </td>
                        <td>
                        @if(Auth::user()->role == 'Admin')

                        <a class="btn btn-primary" href="{{ route('tugas_siswa.kirim',$data->id) }}">Kirim</a> 
                        @if($data->file != null)
                        ||
                        <a class="btn btn-info" href="{{ route('tugas_siswa.nilai',$data->id) }}">Beri Nilai</a>
                        @elseif($data->file == null)

                        @endif

                        @elseif(Auth::user()->role == 'Guru')

                        <a class="btn btn-primary" href="{{ route('tugas_siswa.kirim',$data->id) }}">Kirim</a> ||
                        <a class="btn btn-info" href="{{ route('tugas_siswa.nilai',$data->id) }}">Beri Nilai</a>
                        @if($data->file == null)

                        @elseif($data->file != null)
                        ||
                        <a class="btn btn-info" href="{{ route('tugas_siswa.unduh',$data->id) }}">Download File</a>@endif

                        @elseif(Auth::user()->role == 'Siswa')
                        	@if($data->file == null)
                        	<a class="btn btn-primary" href="{{ route('tugas_siswa.kirim',$data->id) }}">Kirim</a>
                        	@else

                        	@endif
                        	@endif
                        </td>
										</tr>
										
										@endforeach
										</tbody>
								</table>
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