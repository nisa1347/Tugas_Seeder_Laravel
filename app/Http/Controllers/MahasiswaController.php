<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['dosen', 'krs.mataKuliah'])->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all(); 
        return view('mahasiswa.create', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'npm' => 'required|unique:mahasiswa_table,npm',  
        'nama' => 'required|string|max:100',
        'nidn' => 'nullable|exists:dosen_table,nidn',    
    ]);

        Mahasiswa::create($request->only('npm', 'nama', 'nidn'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::with(['dosen', 'krs.mataKuliah'])->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = \App\Models\Dosen::all();
        
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);    // ✅ Cari via npm
    
        $request->validate([
            // ✅ Format unique untuk primary key custom: 'unique:table,field,excludeValue,excludeColumn'
            'npm' => 'required|unique:mahasiswa_table,npm,' . $mahasiswa->npm . ',npm',
            'nama' => 'required|string|max:100',
            'nidn' => 'nullable|exists:dosen_table,nidn',
        ]);

        $mahasiswa->update($request->only('npm', 'nama', 'nidn'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $mahasiswa->delete();
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
