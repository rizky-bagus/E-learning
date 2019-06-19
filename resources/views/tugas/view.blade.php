@extends('layouts.app')
@section('content')
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Data Tugas</div>
<br>                                                           
    &nbsp <a href="/export/tugas" class="btn btn-success"><i class="fa fa-file-excel-o"> Export Excel</i></a>
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
                        @foreach($tugas as $tugas1)

                      <tr>
                        <td>{{ $no++ }}</td>

                        <td>{{ $tugas1->Guru->nama }}</td>
                        <td><center><span class="fa fa-file" style='font-size:40px'></span>
                            </center>
                        </td>
                        <td>{{ $tugas1->KKM }}</td>
                        <td>{{ $tugas1->batas }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('tugas.show',$tugas1->id) }}">Show</a>
                            

                            
                                
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