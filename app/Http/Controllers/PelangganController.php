<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email'];

        $pageData['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('admin.pelanggan.index', $pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDASI DASAR saja
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = date('Y-m-d', strtotime($request->birthday));
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Validasi foto multiple
        $request->validate([
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data biasa
        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = date('Y-m-d', strtotime($request->birthday));
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        // Foto lama (kalau ada)
        $oldPhotos = $pelanggan->photos ?? [];

        // Upload foto baru jika ada
        if ($request->hasFile('photos')) {
            $newPhotos = [];

            foreach ($request->file('photos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();

                // SIMPAN FOTO KE PUBLIC/PELANGGAN
                $file->move(public_path('pelanggan'), $filename);
                $newPhotos[] = 'pelanggan/' . $filename;
            }

            // Gabungkan foto lama + baru
            $pelanggan->photos = array_merge($oldPhotos, $newPhotos);
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.edit', $id)
            ->with('success', 'Data pelanggan & foto berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus!');
    }
}
