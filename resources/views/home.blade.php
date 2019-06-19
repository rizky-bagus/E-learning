@extends('layouts.app')

@section('content')
@if(Auth::user()->role =='Guru')
<br>
<br>
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $info['status'] }}</div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <form action="{{ route('home.store') }}" method="post">
                            @csrf
                            <tr>
                                <td>
                                    <select name="note" class="form-control" required>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Sakit/Izin">Sakit/Izin</option>
                                        <option value="Tidak Masuk">Tidak Masuk</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-flat btn-success" name="btnIn" {{ $info['btnIn'] }}>ABSEN MASUK</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                     <div class="panel-heading">Riwayat Absen</div>
<br>  
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table-bordered table-hover" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php $nomor = 1; ?>
                        @php $no = 1; @endphp
                        @forelse($data_absen as $absen)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$absen->date}}</td>
                                    <td>{{$absen->time_in}}</td>
                                    <td>{{$absen->time_out}}</td>
                                    @if($absen->note === 'Masuk')
                                    <td><a class="btn btn-success">{{$absen->note}}</a></td>
                                    @elseif($absen->note === 'Sakit/Izin')
                                    <td><a class="btn btn-warning">{{$absen->note}}</a></td>
                                    @elseif($absen->note === 'Tidak Masuk')
                                    <td><a class="btn btn-danger">{{$absen->note}}</a></td>
                                    @endif

                                    @if($absen->time_out == null)
                                  <td>
                <form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="{{ route('home.update',$absen->id) }}">
                <input name="_method" type="hidden" value="PATCH">
                    @csrf
                            <button type="submit" class="btn btn-flat btn-danger" name="btnOut" {{ $info['btnOut'] }}>ABSEN KELUAR</button>

                                </td>

                                @else

                                @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                                </tr>
                            @endforelse   
                    </tbody>
                  </table>
                  {!! $data_absen->links() !!}
                </div>
              </div>
            </div>  
        </div>
    </div>


    

    
   



@elseif(Auth::user()->role =='Admin')
<br>        
 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
 <div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-edit color-blue"></em>
                            <div class="large"><?php echo $artikel;  ?></div>
                            <div><b>Data Artikel</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-orange"></em>
                            <div class="large"><?php echo $siswa;  ?></div>
                            <div><b>Data Siswa</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
                            <div class="large"><?php echo $guru;  ?></div>
                            <div><b>Data Guru</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-red"></em>
                            <div class="large"><?php echo $user;  ?></div>
                            <div><b>Data Users</b></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-book color-blue"></em>
                            <div class="large"><?php echo $tugas;  ?></div>
                            <div><b>Data Tugas</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-building color-orange"></em>
                            <div class="large"><?php echo $kelas;  ?></div>
                            <div><b>Data Kelas</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-book color-teal"></em>
                            <div class="large"><?php echo $kelas;  ?></div>
                            <div><b>Data Kategori</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-comments color-red"></em>
                            <div class="large"><?php echo $reviews;  ?></div>
                            <div><b>Data Reviews</b></div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </div>
    </div>

@elseif(Auth::user()->role =='Siswa')

<br>
<br>
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $info['status'] }}</div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <form action="{{ route('home.store') }}" method="post">
                            @csrf
                            <tr>
                                <td>
                                    <select name="note" class="form-control" required>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Sakit/Izin">Sakit/Izin</option>
                                        <option value="Tidak Masuk">Tidak Masuk</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-flat btn-success" name="btnIn" {{ $info['btnIn'] }}>ABSEN MASUK</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                     <div class="panel-heading">Riwayat Absen</div>
<br>  
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table-bordered table-hover" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php $nomor = 1; ?>
                        @php $no = 1; @endphp
                        @forelse($data_absen as $absen)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$absen->date}}</td>
                                    <td>{{$absen->time_in}}</td>
                                    <td>{{$absen->time_out}}</td>
                                    @if($absen->note === 'Masuk')
                                    <td><a class="btn btn-success">{{$absen->note}}</a></td>
                                    @elseif($absen->note === 'Sakit/Izin')
                                    <td><a class="btn btn-warning">{{$absen->note}}</a></td>
                                    @elseif($absen->note === 'Tidak Masuk')
                                    <td><a class="btn btn-danger">{{$absen->note}}</a></td>
                                    @endif

                                    @if($absen->time_out == null)
                                  <td>
                <form id="input" class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="{{ route('home.update',$absen->id) }}">
                <input name="_method" type="hidden" value="PATCH">
                    @csrf
                            <button type="submit" class="btn btn-flat btn-danger" name="btnOut" {{ $info['btnOut'] }}>ABSEN KELUAR</button>

                                </td>

                                @else

                                @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                                </tr>
                            @endforelse   
                    </tbody>
                  </table>
                  {!! $data_absen->links() !!}
                </div>
              </div>
            </div>  
        </div>
    </div>


    

    
   







@endif



@endsection

