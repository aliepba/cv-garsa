<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use Illuminate\Http\Request;
use App\Model\Jabatan;
use App\Model\Pegawai;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = DB::table('pegawai')
                        ->join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan.id')
                        ->select('pegawai.*', 'jabatan.nama_jabatan')
                        ->whereNull('pegawai.deleted_at')
                        ->get();

            return view('pages.hr.pegawai.index', [
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
        $data = Jabatan::all();
        return view('pages.hr.pegawai.create', [
            'data' => $data
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
        $data['no_pegawai'] = 'GS005'.rand(1, 1000);

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store(
                'file/photo', 'public'
            );
        }else{
            $data['photo'] = 'file/nofile.pdf';
        }

        Pegawai::create($data);

        return redirect('/pegawai');
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
        $data = DB::table('pegawai')
        ->join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'jabatan.nama_jabatan')
        ->where('pegawai.id', '=', $id)
        ->first();

        $jabatan = Jabatan::all();

        return view('pages.hr.pegawai.edit', [
            'data' => $data,
            'jabatan' => $jabatan
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
        $item = Pegawai::findOrFail($id);

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store(
                'file/photo', 'public'
            );
        }else{
            $data['photo'] = $item->photo;
        }

        $item->update($data);

        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);

        $data->delete();

        return redirect('/pegawai');
    }
}
