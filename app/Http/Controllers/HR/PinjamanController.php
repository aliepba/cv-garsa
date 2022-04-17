<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Model\Gaji;
use Illuminate\Http\Request;
use App\Model\Pinjam;
use App\Model\Pegawai;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = DB::table('peminjaman')
                    ->join('pegawai', 'peminjaman.no_pegawai', '=', 'pegawai.no_pegawai')
                    ->select('peminjaman.*', 'pegawai.nama')
                    ->get();

        return view('pages.hr.pinjam.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $pegawai = Pegawai::all();
        return view('pages.hr.pinjam.create', [
            'pegawai' => $pegawai
        ]);
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

        $data['status'] = 'PENDING';
        $data['bayar'] = $request->input('jumlah');

        Pinjam::create($data);

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
        $data = Pinjam::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pinjam::findOrFail($id);

        $pegawai = Pegawai::all();

        return view('pages.hr.pinjam.edit', [
            'data' => $data,
            'pegawai' => $pegawai
        ]);
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
        $data = $request->all();

        $data['bayar'] = $request->input('jumlah');

        $item = Pinjam::findOrFail($id);

        $item->update($data);

        return redirect('/pinjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pinjam::findOrFail($id);

        $item->delete();

        return redirect('/pinjaman');
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);

        $item = Pinjam::findOrFail($id);

        $item->status = $request->status;

        $item->save();

        return redirect('/pinjaman');
    }

    public function detail($id){
    
        $item = DB::table('pinjam')
                    ->join('pembayaran', 'pinjam.id', '=', 'pembayaran.peminjaman_id')
                    ->select('pinjam.*', 'pembayaran.*')
                    ->where('pinjam.id', '=', $id)
                    ->get();

        dd($item);
    }
}
