@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master Data Upah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('upah.index')}}">Upah</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Penggajian</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('penggajian.create')}}" method="GET">
          @csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="no_pegawai">Nama Pegawai</label>
                    <select class="form-control" id="No_pegawai" name="no_pegawai" required>
                      <option value="--">Pilih Pegawai</option>
                      @foreach ($pegawai as $item)
                         <option value="{{$item->no_pegawai}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                      <label for="no_pegawai">Jenis Pekerjaan</label>
                      <select class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan" required>
                        <option value="--">Pilih Jenis Gaji</option>
                          <option value="harian">Harian</option>
                          <option value="borongan">Borongan</option>
                      </select>
                    </div>
                  </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                  </div>
                </div>

            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->

      {{-- table gaji --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Record Penggajian</h3>
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
              <th>Tanggal</th>
              <th>Total Gaji</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
              @foreach ($gaji as $item)
              <tr>
                  <td>{{$no++}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->no_pegawai}}</td>
                  <td>{{$item->tgl_mulai}}</td>
                  <td>{{$item->tgl_selesai}}</td>
                  <td>Rp. {{format_uang($item->total_gaji)}}</td>
                  <td>
                    @if ($item->approve == NULL)
                        <span class="badge badge-warning">Belum Accept</span>
                    @else
                        <span class="badge badge-success">Accept</span>
                    @endif
                  </td>
                  <td>
                    @if ($item->approve == NULL)
                        <a href="{{route('penggajian.edit', $item->id)}}" class="btn btn-sm btn-primary">
                          <i class="fa fa-pen" aria-hidden="true"></i>
                        </a>
                        <a href="{{route('approve.gaji', $item->id)}}?approve=submit" class="btn btn-sm btn-success">
                          <i class="fa fa-check" aria-hidden="true"></i>
                        </a>
                        <form action="{{route('penggajian.destroy', $item->id)}}" method="post" class="d-inline">
                          @csrf
                          @method('delete')
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                      @else
                      <a href="{{route('slip.gaji', $item->id)}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-file-invoice"></i>
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

    </div>
    <!--/.col (left) -->

  </div>
</div>
@endsection
