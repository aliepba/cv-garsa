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
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Upah</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('upah.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
            </div>
            <div class="form-group">
                <label for="upah">Nominal Upah</label>
                <input type="text" class="form-control" id="upah" name="upah" placeholder="Nominal Upah">
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

    <!-- right column -->
    <div class="col-md-6">
      <!-- Form Element sizes -->
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Upah</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">No</th>
                <th>Nama Barang</th>
                <th>Upah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no =1 ;
              @endphp
              @foreach ($data as $item => $items)
                  <tr>
                    <td>{{$item + $data->firstItem()}}</td>
                    <td>{{$items->nama_barang}}</td>
                    <td>{{$items->upah}}
                    <td>
                      <a href="{{route('upah.edit', $items->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                      <form action="{{route('upah.destroy', $items->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                      <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            {{ $data->links() }}
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!--/.col (right) -->
  </div>
</div>
@endsection