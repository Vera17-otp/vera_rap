<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gunakan paginate agar bisa memakai links() dan appends()
        $data['dataUser'] = User::paginate(10);

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        // Upload foto jika ada
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/profile/', $filename, 'public');
            $data['profile_picture'] = $filename;
        } else {
            $data['profile_picture'] = null;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;

        // update password hanya jika diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto
        if ($request->hasFile('profile_picture')) {

            // hapus lama
            if ($user->profile_picture && file_exists(storage_path('app/public/uploads/profile/'.$user->profile_picture))) {
                unlink(storage_path('app/public/uploads/profile/'.$user->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/profile/', $filename, 'public');
            $user->profile_picture = $filename;

        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture && file_exists(storage_path('app/public/uploads/profile/'.$user->profile_picture))) {
            unlink(storage_path('app/public/uploads/profile/'.$user->profile_picture));
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus');
    }
}
