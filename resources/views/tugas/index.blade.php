@extends('layouts.app')
@section('content')
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Data Tugas</div>
<br>                                                           
    &nbsp
    @if(Auth::user()-> role == 'Siswa')

    @elseif(Auth::user()-> role == 'Guru')
    <a href="{{ route('tugas.tambah') }}" class="btn btn-primary"><i class="fa fa-plus"> Tambah Tugas</i></a>

    @elseif(Auth::user()-> role == 'Admin')
    <a href="{{ route('tugas.create') }}" class="btn btn-primary"><i class="fa fa-plus"> Tambah Tugas</i></a>

    @endif
    <a href="/export/tugas" class="btn btn-success"><i class="fa fa-file-excel-o"> Export Excel</i></a>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table-bordered table-hover table-responsive" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pengirim</th>
                                                <th>File</th>
                                                <th>KKM</th>
                                                <th>Batas Kirim</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>

                        <?php $nomor = 1; ?>
                        @php $no = 1; @endphp
                        @foreach($data as $tugas)

                      <tr>
                        <td>{{ $no++ }}</td>

                        <td>{{ $tugas->Guru->nama }}</td>
                        <td><center><span class="fa fa-file" style='font-size:40px'></span>
                            </center>
                        </td>
                        <td>{{ $tugas->KKM }}</td>
                        <td>{{ $tugas->batas }}</td>
                        <td>
                            @if(Auth::user()->role == 'Siswa')
                            <a class="btn btn-info" href="{{ route('tugas.show',$tugas->id) }}">Show</a>
                            

                            @elseif(Auth::user()->role == 'Admin')
                            <form method="post" action="{{ route('tugas.destroy',$tugas->id) }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">

                                
                            <a class="btn btn-info" href="{{ route('tugas.show',$tugas->id) }}">Show</a>
                            ||
                            <a class="btn btn-warning" href="{{ route('tugas.edit',$tugas->id) }}">Edit</a> ||
                                <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            @elseif(Auth::user()->role == 'Guru')
                             <form method="post" action="{{ route('tugas.destroy',$tugas->id) }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">

                            <a class="btn btn-info" href="{{ route('tugas.show',$tugas->id) }}">Show</a>
                            ||

                            <a class="btn btn-warning" href="{{ route('tugas.ubah',$tugas->id) }}">Edit</a> ||
                                <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endif
                                
                        </td>
                      </tr>
                      @endforeach   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>  
        </div>
    </div>
</div>
@endsection