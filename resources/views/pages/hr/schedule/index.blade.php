@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Schedule</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('schedule.index')}}">Schedule</a></li>
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
          <h3 class="card-title">Record Schedule</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No Pegawai</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
              @foreach ($data as $item)
            </tr>
                  <td>{{$no++}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->no_pegawai}}</td>
                  <td>{{$item->nama_barang}}</td>
                  <td>{{$item->jumlah}}</td>
                  <td>{{$item->tanggal_hadir}}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Pegawai</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush