@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Jabatan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('absen.index')}}">Absen</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Absen Pegawai</h3>
          <button type="button" class="btn btn-primary btn-sm ml-3" data-toggle="modal" data-target="#modal-primary">
            <i class="fas fa-plus"></i>
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No Pegawai</th>
              <th>Tanggal</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              <tr>
                  <td>#</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->no_pegawai}}</td>
                  <td>{{$item->tanggal_hadir}}</td>
                  <td>{{$item->masuk}}</td>
                  <td>{{$item->keluar}}</td>
                    @if ($item->masuk >= '08:00:00')
                    <td>
                    <span class="badge badge-pill badge-success">Tepat Waktu</span>
                    </td>
                    @else
                    <td>
                        <span class="badge badge-pill badge-warning">Telat</span>
                        </td>
                    @endif
                  <td>
                    <a href="javascript:void(0)" onclick="masukanSchedule({{$item->id}})" class="btn btn-info btn-sm rounded"><i class="fas fa-plus"></i></a>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-detail">
                      <i class="fas fa-eye"></i>
                    </button>

                    {{-- <a href="{{route('pegawai.edit', $item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                    <form action="{{route('pegawai.destroy', $item->id)}}" method="post" class="d-inline">
                      @csrf
                      @method('delete')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form> --}}
                  </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Pegawai</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Action</th>
            </tr>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>

<div class="modal fade" id="modal-schedule">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Rincian Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{route('schedule.store')}}" method="POST" id="formSchedule">
              @csrf
              <div class="form-group">
                <label>No Pegawai</label>
                <input type="text" id="no_pegawai" name="no_pegawai" class="form-control" readonly/>
                <input type="date" id="tanggal_hadir" name="tanggal_hadir" class="form-control" hidden />
                <input type="text" id="id_absen" name="id_absen" class="form-control" hidden/>
              </div>
              <div class="form-group">
              <label>Nama Barang</label>
              <select class="form-control" name="upah_id">
                  <option value="0">Pilih Nama Barang</option>
                  @foreach ($upah as $upah)
                  <option value="{{$upah->id}}">{{$upah->nama_barang}}</option>
                  @endforeach
              </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" />
              </div>
          
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
@endsection

@push('addon-script')
<div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Absensi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('absen.store')}}" method="POST">
                @csrf
                <div class="form-group">
                <label>Nama Pegawai</label>
                <select class="form-control" name="no_pegawai">
                    <option value="0">Pilih Pegawai</option>
                    @foreach ($pegawai as $pgw)
                    <option value="{{$pgw->no_pegawai}}">{{$pgw->nama}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_hadir"/>
                </div>
                <div class="form-group">
                    <label>Jam Masuk</label>
                    <input type="time" class="form-control" name="masuk"/>
                </div>
                <div class="form-group">
                    <label>Jam Keluar</label>
                    <input type="time" class="form-control" name="keluar"/>
                </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


    
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  function masukanSchedule(id){
            $.get('/absen/'+id, function(data){
                $("#no_pegawai").val(data.no_pegawai);
                $('#id_absen').val(data.id);
                $('#tanggal_hadir').val(data.tanggal_hadir);
                $("#modal-schedule").modal("toggle");
            })
        }


</script>
@endpush