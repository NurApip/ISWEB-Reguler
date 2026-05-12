<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Lapangan::query();

    // Logika Filter Area
    if ($request->has('area') && $request->area != '') {
        $query->where('lokasi', 'like', '%' . $request->area . '%');
    }

    // Logika Filter Tipe Rumput
    if ($request->has('tipe_rumput') && $request->tipe_rumput != '') {
        $query->where('tipe_rumput', $request->tipe_rumput);
    }

    $lapangan = $query->get();
    return view('lapangan.index', compact('lapangan'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Lapangan::create($request->all());
        return redirect('/lapangan')->with('success', 'Lapangan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
  public function show($id)
{
    // Mengambil data lapangan beserta galerinya sekaligus
    $lapangan = Lapangan::with('galeri')->findOrFail($id);
    
    return view('lapangan.show', compact('lapangan'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lapangan $lapangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lapangan $lapangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lapangan $lapangan)
    {
        //
    }
}
