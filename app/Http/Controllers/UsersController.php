<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.users.index', [
            'title' => 'Data User',
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('superadmin.users.create', ['title' => 'Tambah User']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'instansi' => 'nullable|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = new User;
        $user->nama_depan = $request->nama_depan;
        $user->nama_belakang = $request->nama_belakang;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->instansi = $request->instansi;
        $user->bidang = $request->bidang;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        $user->password = Hash::make($request->password);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Upload new photo
            $fotoPath = $request->file('foto')->store('photos', 'public');

            // Set foto path
            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User Berhasil Dibuat.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_depan' => 'nullable|string|max:255',
            'nama_belakang' => 'nullable|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:superadmin,admin,kepala_bidang,reporter,sub_bagian_approval',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'instansi' => 'nullable|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $user = User::findOrFail($id);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // Upload new photo
            $fotoPath = $request->file('foto')->store('photos', 'public');

            // Update foto path
            $user->foto = $fotoPath;
        }

        // Update data pengguna tanpa password dan foto
        $user->update($request->except(['password', 'foto']));

        // Jika ada password baru, enkripsi dan simpan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
