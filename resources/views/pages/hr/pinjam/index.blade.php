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
            <li class="breadcrumb-item"><a href="{{route('jabatan.index')}}">Pinjam</a></li>
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
          <h3 class="card-title">Data Pinjaman</h3>
          <a href="{{route('pinjaman.create')}}" class="btn btn-sm btn-primary ml-3"><i class="fas fa-plus"></i></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No Pegawai</th>
              <th>Tanggal Pinjaman</th>
              <th>Jumlah</th>
              <th>Wajib Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
            </tr>
                  <td>#</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->no_pegawai}}</td>
                  <td>{{$item->tgl_peminjaman}}</td>
                  <td>Rp. {{format_uang($item->jumlah)}}</td>
                  <td>Rp. {{format_uang($item->bayar)}}</td>
                  <td><span class="badge badge-primary">{{$item->status}}</span></td>
                  <td>
                    @if($item->status == 'PENDING')
                      <a href="{{route('approve.pinjam', $item->id)}}?status=ACCEPT" class="btn btn-sm btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                      </a>
                      <a href="{{route('pinjaman.edit', $item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                      <form action="{{route('pinjaman.destroy', $item->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                      </form>    
                    @elseif($item->status == 'ACCEPT')
                    <a href="javascript:void(0)" onclick="masukanPembayaran({{$item->id}})" class="btn btn-info btn-sm rounded">
                      Pembayaran
                    </a>
                      <a href="{{route('pembayaran.show', $item->id)}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                      <a href="{{route('approve.pinjam', $item->id)}}?status=LUNAS" class="btn btn-sm btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                      </a>
                    @else
                      <a href="{{route('pembayaran.show', $item->id)}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                    @endif
                  
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Pegawai</th>
                <th>Tanggal Pinjaman</th>
                <th>Jumlah</th>
                <th>Wajib Bayar</th>
                <th>Status</th>
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
@endsection

@push('addon-script')

<div class="modal fade" id="modal-bayar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Rincian Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{route('pembayaran.store')}}" method="POST" id="formSchedule">
              @csrf
              <div class="form-group">
              <label>Tanggal Pembayaran</label>
              <input type="text" id="peminjaman_id" name="peminjaman_id" class="form-control" hidden/>
              <input type="date" id="tgl_pembayaran" name="tgl_pembayaran" class="form-control" required/>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah_pembayaran" id="jumlah_pembayaran" required/>
              </div>
          
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  function masukanPembayaran(id){
            $.get('/pinjaman/'+id, function(data){
                $('#peminjaman_id').val(data.id);
                $("#modal-bayar").modal("toggle");
            })
        }
      
</script>
@endpush