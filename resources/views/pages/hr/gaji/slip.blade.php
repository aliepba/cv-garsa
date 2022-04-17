<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tanda Registrasi</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
	{{-- <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}" rel="stylesheet')}}" > --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body background="white">
    <br/>
    <br/>
    <br/>
    <p class="h3 text-center">CV Garsa Sejahtera</p>  <br/>
    <p align="center"  style="margin-left:25px; font-family:arial; font-size:18px; font-weight:bold;">SLIP GAJI : </p><hr>
    <p align="center" class="h6">Periode {{$item->tgl_mulai}} - {{$item->tgl_selesai}}</p>
    <table border="0" align="center">
        <tr>
            <td width="220px" height="40px">No Pegawai</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">{{$item->no_pegawai}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">Nama Pegawai</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">{{$item->nama}}</td>
        </tr>
    </table>
    <br/>
    <table border="1" class="center">
        <tr>
            <td width="220px" height="40px">Absen</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_absen)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">Korosok</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_korosok)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">PK20</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_pk20)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">PK40</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_pk40)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">PKK20</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_pkk20)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">PKK40</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_pkk40)}}</td>
        </tr>
        <tr>
            <td width="220px" height="40px">Total</td>
            <td width="20px" class="text-center">:</td>
            <td width="400px">Rp. {{format_uang($item->total_gaji)}}</td>
        </tr>
    </table>
    <br/>
    <br/>
    <div class="row" style="margin-top:25px">
        <div class="col-md-10" style="margin-left: 25px; margin-top:30px">
            {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->format('svg')
                                            ->color(3, 4, 94)
                                            ->style('round', 0.9)
                                            ->eyeColor(0, 235, 155, 0, 0, 0, 0)->errorCorrection('H')
                                            ->generate(Request::url())) !!}"> --}}
        </div>
        <div class="col-md-2" style="margin-left: 350px">
            <p style="margin-right: 25px;" align="left">
                Karawang, {{$item->approve}} <br/>
                                    <br/><br/><br/><br/>
                Direktur
            </p>
        </div>
    </div>
</body>
</html>