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
            <li class="breadcrumb-item"><a href="{{route('jabatan.index')}}">Pegawai</a></li>
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
          <h3 class="card-title">Data Karyawan</h3>
          <a href="{{route('pegawai.create')}}" class="btn btn-sm btn-primary ml-3"><i class="fas fa-plus"></i></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>No Pegawai</th>
              <th>Nama</th>
              <th>Kelamin</th>
              <th>Posisi</th>
              <th>Kontak</th>
              <th>Alamat</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;
                @endphp
              @foreach ($data as $item)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$item->no_pegawai}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->kelamin}}</td>
                  <td>{{$item->nama_jabatan}}</td>
                  <td>{{$item->kontak}}</td>
                  <td>{{$item->alamat}}</td>
                  <td>
                    <a href="{{route('pegawai.edit', $item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                    <form action="{{route('pegawai.destroy', $item->id)}}" method="post" class="d-inline">
                      @csrf
                      @method('delete')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>No Pegawai</th>
              <th>Nama</th>
              <th>Kelamin</th>
              <th>Posisi</th>
              <th>Kontak</th>
              <th>Alamat</th>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush
