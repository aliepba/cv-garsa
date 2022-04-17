<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pembayaran;
use App\Model\Pinjam;
use Illuminate\Support\Facades\DB;


class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $id_pinjam =  $request->input('peminjaman_id');

        $pinjam = Pinjam::findOrFail($id_pinjam);

        $bayar['bayar'] = $pinjam->bayar - $data['jumlah_pembayaran'] ;

        $pinjam->update($bayar);

        Pembayaran::create($data);

        return redirect('/pinjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('peminjaman')
                    ->join('pegawai', 'peminjaman.no_pegawai', '=', 'pegawai.no_pegawai')
                    ->select('peminjaman.*', 'pegawai.nama')
                    ->where('peminjaman.id', '=', $id)
                    ->get();
        
        
        $item = DB::table('pembayaran')
                    ->where('pembayaran.peminjaman_id', '=', $id)
                    ->get();

        
        return view('pages.hr.pembayaran.index', [
            'data' => $data[0],
            'item' => $item
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
