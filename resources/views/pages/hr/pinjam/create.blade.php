@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pinjaman</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('pinjaman.index')}}">Pinjaman</a></li>
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
          <h3 class="card-title">Form Pinjaman</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start --> 
        <form action="{{route('pinjaman.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_pegawai">Nama Pegawai</label>
                        <select class="form-control" id="no_pegawai" name="no_pegawai" required>
                          <option value="--">Pilih Pegawai</option>
                          @foreach ($pegawai as $item)
                             <option value="{{$item->no_pegawai}}">{{$item->nama}}</option>
                          @endforeach
                        </select>  
                      </div>
                      <div class="form-group">
                        <label for="tgl_peminjaman">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman" placeholder="Tanggal Pinjam" required>
                        @error('tgl_peminjaman')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jumlah">Jumlah Peminjaman</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Peminjaman" min="0" required>
                        @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
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

    </div>
    <!--/.col (left) -->

  </div>
</div>
@endsection