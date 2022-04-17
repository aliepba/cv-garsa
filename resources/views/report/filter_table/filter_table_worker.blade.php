@foreach($users as $user)
<tr>
  <td>
    <img src="{{ asset('pictures/' . $user->foto) }}">
    <span class="ml-2">{{ $user->nama }}</span>
  </td>
  <td>{{ $user->email }}</td>
  <td>
    @if($user->role == 'admin_sales')
    <span class="btn admin_sales-span">{{ $user->role }}</span>
    @else
    <span class="btn sales-span">{{ $user->role }}</span>
    @endif
  </td>
  @php
  $pasok = \App\Supply::where('id_pemasok', $user->id)
  ->count();
  @endphp
  <td class="pl-4"><span class="ammount-box bg-secondary"><i class="mdi mdi-import"></i></span>{{ $pasok }} X</td>
  @php
  $transaksi = \App\Transaction::where('id_sales', $user->id)
  ->select('kode_transaksi')
  ->distinct()
  ->get();
  @endphp
  <td class="pl-4"><span class="ammount-box bg-secondary"><i class="mdi mdi-swap-horizontal"></i></span>{{ $transaksi->count() }} X</td>
  <td>
    <a href="{{ url('/report/workers/detail/' . $user->id) }}" class="btn view-btn"><i class="mdi mdi-eye"></i> Lihat</a>
  </td>
</tr>
@endforeach