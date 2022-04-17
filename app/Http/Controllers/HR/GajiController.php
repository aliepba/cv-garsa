<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pegawai;
use App\Model\Gaji;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        $gaji = DB::table('gaji')
                ->join('pegawai', 'gaji.no_pegawai', '=', 'pegawai.no_pegawai')
                ->select('gaji.*', 'pegawai.nama')
                ->whereNull('gaji.deleted_at')
                ->orderBy('gaji.id', 'desc')
                ->get();

        return view('pages.hr.gaji.index', [
            'pegawai' => $pegawai,
            'gaji' => $gaji
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $no_pegawai = $request->input('no_pegawai');
        $jenis_pekerjaan = $request->input('jenis_pekerjaan');
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');

        $absen = DB::table('absen')->select()
                    ->where('no_pegawai', '=', $no_pegawai)
                    ->whereDate('tanggal_hadir', '>=' ,$tgl_mulai)
                    ->whereDate('tanggal_hadir', '<=' , $tgl_selesai)
                    ->get();

        $jumlah = DB::select("SELECT no_pegawai,
                    SUM(IF((schedule.upah_id) = 1, schedule.jumlah, 0)) AS korosok,
                    SUM(IF((schedule.upah_id) = 2, schedule.jumlah, 0)) AS pk20,
                    SUM(IF((schedule.upah_id) = 3, schedule.jumlah, 0)) AS pk40,
                    SUM(IF((schedule.upah_id) = 4, schedule.jumlah, 0)) AS pkk20,
                    SUM(IF((schedule.upah_id) = 5, schedule.jumlah, 0)) AS pkk40
                    FROM SCHEDULE
                    where no_pegawai = '$no_pegawai' AND
                    tanggal_hadir BETWEEN '$tgl_mulai' AND '$tgl_selesai'
                    GROUP BY no_pegawai");

        return view('pages.hr.gaji.create', [
            'pegawai' => $no_pegawai,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'absen' => count($absen),
            'jumlah' => $jumlah[0]
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

        Gaji::create($data);

        return redirect ('/penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Gaji::findOrFail($id);

        $absen = DB::table('absen')->select()
                    ->where('no_pegawai', '=', $item->no_pegawai)
                    ->whereDate('tanggal_hadir', '>=' , $item->tgl_mulai)
                    ->whereDate('tanggal_hadir', '<=' , $item->tgl_selesai)
                    ->get();

        $jumlah = DB::select("SELECT no_pegawai,
                    SUM(IF((schedule.upah_id) = 1, schedule.jumlah, 0)) AS korosok,
                    SUM(IF((schedule.upah_id) = 2, schedule.jumlah, 0)) AS pk20,
                    SUM(IF((schedule.upah_id) = 3, schedule.jumlah, 0)) AS pk40,
                    SUM(IF((schedule.upah_id) = 4, schedule.jumlah, 0)) AS pkk20,
                    SUM(IF((schedule.upah_id) = 5, schedule.jumlah, 0)) AS pkk40
                    FROM SCHEDULE
                    where no_pegawai = '$item->no_pegawai' AND
                    tanggal_hadir BETWEEN '$item->tgl_mulai' AND '$item->tgl_selesai'
                    GROUP BY no_pegawai");

        return view('pages.hr.gaji.edit', [
            'item' => $item,
            'absen' => count($absen),
            'jumlah' => $jumlah[0]
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
        $item = Gaji::findOrFail($id);

        $item->update($data);

        return redirect('/penggajian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gaji::findOrFail($id);

        $item->delete();

        return redirect('/penggajian');
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'approve' => 'required'
        ]);

        $item = Gaji::findOrFail($id);

        $item->approve = Carbon::now();

        $item->save();

        return redirect('/penggajian');
    }

    public function slipGaji($id){

        // $item = Gaji::findOrFail($id);

        $item = DB::table('gaji')
                    ->join('pegawai', 'gaji.no_pegawai', '=', 'pegawai.no_pegawai')
                    ->select('gaji.*', 'pegawai.nama')
                    ->where('gaji.id', '=', $id)
                    ->get();

                    // dd($item[0]->tgl_mulai);

        $pdf = PDF::loadView('pages.hr.gaji.slip', [
            'item' => $item[0]
        ]);

        return $pdf->stream('slip-gaji');

    }
}
