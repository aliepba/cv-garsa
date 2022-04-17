@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Pembayaran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('jabatan.index')}}">Pembayaran</a></li>
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
          <h3 class="card-title">Detail Pembayaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah">Nama Pegawai</label>
                        <input class="form-control" value="{{$data->nama}}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah">Jumlah Pinjaman</label>
                        <input class="form-control" value="Rp. {{format_uang($data->jumlah)}}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah">Sisa Bayar</label>
                        <input class="form-control" value="Rp. {{format_uang($data->bayar)}}" readonly>
                    </div>
                </div>
            </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pembayaran</th>
              <th>Jumlah Pembayaran</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
              @foreach ($item as $items)
                </tr>
                    <td>{{$no++}}</td>
                    <td>{{$items->tgl_pembayaran}}</td>
                    <td>Rp. {{format_uang($items->jumlah_pembayaran)}}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah Pembayaran</th>
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
<script>
  $(function () {
    $("#example1").DataTable({
        "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

</script>
@endpush