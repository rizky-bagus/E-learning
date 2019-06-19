@extends('layouts.app')
@section('content')
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                     <div class="panel-heading">Data Siswa</div>
<br>  
        &nbsp &nbsp<a href="/export/siswa" class="btn btn-success"><i class="fa fa-file-excel-o"> Export Excel</i></a>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table-bordered table-hover" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Foto</th>
                                                <th>Kelas</th>
                                                <th>Alamat</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                        @php $no =1; @endphp
                        @foreach($siswa as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nis }}</td>
                                <td>{{ $data->nama }}</td>
                                <td><img src="{{asset('Image/Siswa/'.$data->foto) }}" width="60px" height="60px"></td>
                                <td>{{ $data->Kelas->nama }}</td>
                                <td>{{ $data->alamat }}</td>    
                            </tr>
                            @endforeach
                        </tbody>
                                       </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                @endsection