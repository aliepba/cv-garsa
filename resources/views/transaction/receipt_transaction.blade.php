<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			font-family: Arial, sans-serif;
		}

		.center{
			text-align: center;
		}

		.right{
			text-align: right;
		}

		.left{
			text-align: left;
		}

		p{
			font-size: 10px;
		}

		.top-min{
			margin-top: -15px;
		}
		.top-max{
			margin-top: 50px;
		}

		.uppercase{
			text-transform: uppercase;
		}

		.bold{
			font-weight: bold;
		}

		.d-block{
			display: block;
		}

		hr{
			border: 0;
			border-top: 1px solid #000;
		}

		.hr-dash{
			border-style: dashed none none none;
		}

		table{
			font-size: 10px;
		}

		table thead tr td{
			padding: 5px;
		}

		.w-100{
			width: 100%;
		}

		.line{
			border: 0;
			border-top: 1px solid #000;
			border-style: dashed none none none;
		}

		.body{
			margin-top: -10px;
		}

		.b-p{
			font-size: 12px !important;
		}
		.b-p{
			font-size: 11px !important;
		}

		.w-long{
			width: 80px;
		}
	</style>
</head>
<body>
	<div class="header">
		<p class="uppercase bold d-block center b-p">{{ $market->nama_toko }}</p>
		<p class="top-min bold d-block center b-p-p">{{ $market->title }}</p>
		<p class="top-min d-block center">{{ $market->alamat }}</p>
		<p class="top-min d-block center">{{ $market->no_telp }}</p>
		<hr class="hr-dash">
		<table class="w-100">
			<tr>
				<td class="left w-long">Kode Transaksi : </td>
				<td class="left">{{ $transaction->kode_transaksi }}</td>
				<td class="right">Kepada: </td>
				@php
				$nama_pelanggan = explode(' ', $transaction->pelanggan);
				$pelanggan = $nama_pelanggan[0];
				@endphp
				<td class="right">{{ $pelanggan }}</td>
			</tr>
			<tr>
				<td class="left">Purwakarta, </td>
				<td class="left">{{ date('d M, Y', strtotime($transaction->created_at)) }}</td>
			</tr>
		</table>
		<hr class="hr-dash">
	</div>
	<div class="body">
		<table class="w-100">
			<thead>
				<tr>
					<td>Nama Barang</td>
					<td>Qty</td>
					<td>Harga</td>
					<td>Jumlah</td>
				</tr>
				<tr>
					<td colspan="4" class="line"></td>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaksi)
				<tr>
					<td>{{ $transaksi->nama_barang }}</td>
					<td>{{ $transaksi->jumlah }}</td>
					<td>{{ number_format($transaksi->harga,2,',','.') }}</td>
					<td>{{ number_format($transaksi->total_barang,2,',','.') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<hr class="hr-dash">
		<table class="w-100">
			<tr>
				<td class="left">Subtotal (Jumlah : {{ $transactions->count() }})</td>
				<td class="right">{{ number_format($transaction->subtotal,2,',','.') }}</td>
			</tr>
			<tr>
				<td class="left">Diskon ({{ $transaction->diskon }}%)</td>
				<td class="right">{{ number_format($diskon,2,',','.') }}</td>
			</tr>
			<tr>
				<td class="left">Total</td>
				<td class="right">{{ number_format($transaction->total,2,',','.') }}</td>
			</tr>
		</table>
		<hr class="hr-dash">
		<table class="w-100">
			<tr>
				<td class="left">Bayar</td>
				<td class="right">{{ number_format($transaction->bayar,2,',','.') }}</td>
			</tr>
			<tr>
				<td class="left">Kembali</td>
				<td class="right">{{ number_format($transaction->kembali,2,',','.') }}</td>
			</tr>
		</table>
		<hr class="hr-dash">
		<table class="w-100">
			<tr>
				<td class="left">Sales Menyetujui: </td>
				@php
				$nama_sales = explode(' ', $transaction->sales);
				$sales = $nama_sales[0];
				@endphp
				
			</tr>
			<tr>
				<td class="left uppercase"><strong>{{ $sales }}</strong></td>
			</tr>
		</table>
	</div>
	<div class="footer">
		<p class="center uppercase">Terima Kasih</p>
	</div>
</body>
</html>