<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AbsenRequest;
use App\Model\Absen;
use App\Model\Pegawai;
use App\Model\Upah;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('absen')
                    ->join('pegawai', 'absen.no_pegawai', '=', 'pegawai.no_pegawai')
                    ->select('absen.*', 'pegawai.nama')
                    ->orderBy('absen.id', 'desc')
                    ->get();

        $pegawai = DB::table('pegawai')->get();
        $upah = Upah::all();

        // dd($pegawai);

        return view('pages.hr.absen.index', [
            'data' => $data,
            'pegawai' => $pegawai,
            'upah' => $upah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenRequest $request)
    {
        $data = $request->all();

        Absen::create($data);

        return redirect('/absen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Absen::find($id);

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
