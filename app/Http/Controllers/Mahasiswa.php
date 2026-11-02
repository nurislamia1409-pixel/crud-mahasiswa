<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use Illuminate\Http\Request;

class Mahasiswa extends Controller
{
    // Tampilkan semua data + form input
    public function index()
    {
        $mahasiswa = Mahasiswas::orderBy('id', 'desc')->get();
        return view('index', compact('mahasiswa'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
        ]);

        Mahasiswas::create($request->only('nama', 'jenis_kelamin', 'alamat', 'no_hp'));

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Tampilkan halaman edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);
        return view('edit', compact('mahasiswa'));
    }

    // Simpan perubahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
        ]);

        $mahasiswa = Mahasiswas::findOrFail($id);
        $mahasiswa->update($request->only('nama', 'jenis_kelamin', 'alamat', 'no_hp'));

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diubah.');
    }

    // Hapus data
    public function destroy($id)
    {
        Mahasiswas::findOrFail($id)->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}