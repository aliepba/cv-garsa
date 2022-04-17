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
          <div class="card-body">
            <form action="{{route('penggajian.update', $item->id)}}" method="POST" >
                @method('PUT')
                @csrf
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="no_pegawai">Nama Pegawai</label>
                    <input type="text" class="form-control" id="no_pegawai" name="no_pegawai" value="{{$item->no_pegawai}}" readonly>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{$item->tgl_mulai}}" readonly>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{$item->tgl_selesai}}" readonly>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_hari">Hari</label>
                        <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari"
                        min="{{$absen}}"
                        max="{{$absen}}"
                        placeholder="{{$absen}}"
                        value="{{$absen}}">  
                        <span class="badge badge-secondary">Total Absen : {{$absen}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_hari">Upah</label>
                        <input type="number" class="form-control" id="upah_hari" name="upah_hari" value="110000" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_absen">Total Absen</label>
                        <input type="number" class="form-control" id="total_absen" name="total_absen" 
                        value="{{$item->total_absen}}" 
                        onkeyup="sum();">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_korosok">Korosok</label>
                        <input type="number" class="form-control" id="jumlah_korosok" 
                        name="jumlah_korosok" 
                        min="{{$jumlah->korosok}}" 
                        max="{{$jumlah->korosok}}"
                        placeholder="{{$jumlah->korosok}}"
                        value="{{$jumlah->korosok}}">  
                        <span class="badge badge-secondary">Total Korosok : {{$jumlah->korosok}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_korosok">Upah</label>
                        <input type="number" class="form-control" id="upah_korosok" name="upah_korosok" value="500" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_korosok">Total Korosok</label>
                        <input type="number" class="form-control" id="total_korosok" name="total_korosok"
                         value="{{$item->total_korosok}}" 
                         onkeyup="sum();"> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pk20">PK20</label>
                        <input type="number" class="form-control" id="jumlah_pk20" name="jumlah_pk20" 
                        min="{{$jumlah->pk20}}" 
                        max="{{$jumlah->pk20}}"
                        value="{{$jumlah->pk20}}">  
                        <span class="badge badge-secondary">Total PK20 : {{$jumlah->pk20}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_pk20">Upah</label>
                        <input type="number" class="form-control" id="upah_pk20" name="upah_pk20" value="500" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_pk40">Total PK20</label>
                        <input type="number" class="form-control" id="total_pk20" name="total_pk20" 
                        value="{{$item->total_pk20}}" onkeyup="sum();">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pk40">PK40</label>
                        <input type="number" class="form-control" id="jumlah_pk40" name="jumlah_pk40" 
                        min="{{$jumlah->pk40}}"
                        max="{{$jumlah->pk40}}"
                        value="{{$jumlah->pk40}}">  
                        <span class="badge badge-secondary">Total PK40 : {{$jumlah->pk40}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_pk40">Upah</label>
                        <input type="number" class="form-control" id="upah_pk40" name="upah_pk40" value="1000" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_pk40">Total PK40</label>
                        <input type="number" class="form-control" id="total_pk40" name="total_pk40" 
                        value="{{$item->total_pk40}}" onkeyup="sum();">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pkk20">PKK20</label>
                        <input type="number" class="form-control" id="jumlah_pkk20" name="jumlah_pkk20"
                         min="{{$jumlah->pkk20}}"
                         max="{{$jumlah->pkk20}}"
                         value="{{$jumlah->pkk20}}">  
                         <span class="badge badge-secondary">Total PKK20 : {{$jumlah->pkk20}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_pkk20">Upah</label>
                        <input type="number" class="form-control" id="upah_pkk20" name="upah_pkk20" value="450" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_pkk20">Total PKK20</label>
                        <input type="number" class="form-control" id="total_pkk20" name="total_pkk20" 
                        value="{{$item->total_pkk20}}" 
                        onkeyup="sum();">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pkk40">PKK40</label>
                        <input type="number" class="form-control" id="jumlah_pkk40" name="jumlah_pkk40" 
                        min="{{$jumlah->pkk40}}"
                        max="{{$jumlah->pkk40}}"
                        value="{{$jumlah->pkk40}}"
                        >  
                        <span class="badge badge-secondary">Total PKK40 : {{$jumlah->pkk40}}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="upah_pkk40">Upah</label>
                        <input type="number" class="form-control" id="upah_pkk40" name="upah_pkk40" value="450" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_pkk40">Total PKK40</label>
                        <input type="number" class="form-control" id="total_pkk40" name="total_pkk40"
                         value="{{$item->total_pkk40}}" 
                         onkeyup="sum();">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Total Gaji</label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" id="total_gaji" name="total_gaji" value="{{$item->total_gaji}}">
                        </div>
                        <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            

          </div>
          <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </div>
    <!--/.col (left) -->

  </div>
</div>
@endsection

@push('addon-script')

<script>
    $(document).ready(function(){
      $("#jumlah_hari ,#upah_hari").keyup(function(){
        var hari  = parseInt($("#jumlah_hari").val());
        var upah_hari  = parseInt($("#upah_hari").val());
        var total_hari = hari * upah_hari;
        $("#total_absen").val(total_hari);
      });
    });


     $(document).ready(function(){
      $("#jumlah_korosok ,#upah_korosok").keyup(function(){
        var angka1  = parseInt($("#jumlah_korosok").val());
        var angka2  = parseInt($("#upah_korosok").val());
        var hasil = angka1 * angka2;
        $("#total_korosok").val(hasil);
      });
    });

    $(document).ready(function(){
      $("#jumlah_pk20 ,#upah_pk20").keyup(function(){
        var jumlahpk20  = parseInt($("#jumlah_pk20").val());
        var upahpk20  = parseInt($("#upah_pk20").val());
        var totalpk20 = jumlahpk20 * upahpk20;
        $("#total_pk20").val(totalpk20);
      });
    });

    $(document).ready(function(){
      $("#jumlah_pk40 ,#upah_pk40").keyup(function(){
        var jumlahpk40  = parseInt($("#jumlah_pk40").val());
        var upahpk40  = parseInt($("#upah_pk40").val());
        var totalpk40 = jumlahpk40 * upahpk40;
        $("#total_pk40").val(totalpk40);
      });
    });

    $(document).ready(function(){
      $("#jumlah_pkk20 ,#upah_pkk20").keyup(function(){
        var jumlahpkk20  = parseInt($("#jumlah_pkk20").val());
        var upahpkk20  = parseInt($("#upah_pkk20").val());
        var totalpkk20 = jumlahpkk20 * upahpkk20;
        $("#total_pkk20").val(totalpkk20);
      });
    });

    $(document).ready(function(){
      $("#jumlah_pkk40 ,#upah_pkk40").keyup(function(){
        var jumlahpkk40  = parseInt($("#jumlah_pkk40").val());
        var upahpkk40  = parseInt($("#upah_pkk40").val());
        var totalpkk40 = jumlahpkk40 * upahpkk40;
        $("#total_pkk40").val(totalpkk40);
      });
    });

    function sum() {
      var totalAbsen = document.getElementById('total_absen').value;
      var totalKorosok = document.getElementById('total_korosok').value;
      var totalPk20 = document.getElementById('total_pk20').value;
      var totalPk40 = document.getElementById('total_pk40').value;
      var totalPkk20 = document.getElementById('total_pkk20').value;
      var totalPkk40 = document.getElementById('total_pkk40').value;
      var result = parseInt(totalAbsen) + parseInt(totalKorosok) + parseInt(totalPk40) + parseInt(totalPkk20) + parseInt(totalPkk40);
      if (!isNaN(result)) {
         document.getElementById('total_gaji').value = result;
      }
}
    
  </script>
@endpush