@extends('layouts.app')
@section('content')
<br>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Data Reviews</div>
<br>                                                            
    &nbsp<a href="{{ route('review.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"> Tambah</i></a>
        <a href="/export/review" class="btn btn-success"><i class="fa fa-file-excel-o"> Export Excel</i></a>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table-bordered table-hover table-responsive" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Foto</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        @php $no =1; @endphp
                        @foreach($reviews as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->name }}</td>
                                <td><img src="{{asset('Image/Review/'.$data->foto) }}" width="60px" height="60px"></td>
                                @if($data->ket == 'Unpublish')
                                <form method="post" action="{{ route('review.publish',$data->id) }}">
                                    {{ csrf_field() }}
                                    <td><button type="submit" class="btn btn-danger">Unpublish</button></td>
                                    </form>
                                @elseif($data->ket == 'Publish')
                                <form method="post" action="{{ route('review.unpublish',$data->id) }}">
                                    {{ csrf_field() }}
                                      <td><button type="submit" class="btn btn-success">Publish</button></td>
                                    </form>
                                @endif    
                                <td>
        <form method="post" action="{{ route('review.destroy',$data->id) }}"> 
        <a href="{{ route('review.show',$data->id) }}" class="btn btn-info">Show</a>
        ||                           
        <a href="{{ route('review.edit',$data->id) }}" class="btn btn-warning">Edit</a>
        ||
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">
        <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-danger">Delete</button>
        </form>                            

                                </td>

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