<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class kantorController extends Controller
{
    public function index()
    {
        $kantor = Kantor::all();
        return view('Kantor.index', [
            'title' => 'kantor',
            'kantor' => $kantor,
        ]);
    }

    public function create()
    {
        return view(['title' => 'Tambah User']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255'

        ]);

        $kantor = new User;
        $kantor->nama = $request->nama;
        $kantor->jabatan = $request->jabatan;
        $kantor->telpon = $request->telpon;
        $kantor->alamat = $request->alamat;



        $kantor->save();

        return redirect()->route('kantor.index')->with('success', 'User Berhasil Dibuat.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $kantor = Kantor::findOrFail($id);


        return redirect()->route('kantor.index')->with('success', 'karyawan updated successfully');
    }
}
