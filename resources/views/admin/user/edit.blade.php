@extends('layouts.admin.app')

@section('content')
    <div class="mt-4">
        <h4>Edit Data Pelanggan</h4>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST"
            enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ $dataPelanggan->first_name }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ $dataPelanggan->last_name }}" class="form-control">
                </div>

                <div class="col-md-4 mt-3">
                    <label>Birthday</label>
                    <input type="date" name="birthday" value="{{ $dataPelanggan->birthday }}" class="form-control">
                </div>

                <div class="col-md-4 mt-3">
                    <label>Gender</label>
                    <select name="role" class="form-control">
                        <option value="Super Admin" {{ $dataPelanggan->role == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="Pelanggan" {{ $dataPelanggan->role == 'Pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                        <option value="Mitra" {{ $dataPelanggan->role == 'Mitra' ? 'selected' : '' }}>Mitra</option>
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ $dataPelanggan->phone }}" class="form-control">
                </div>

                <div class="col-md-12 mt-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $dataPelanggan->email }}" class="form-control">
                </div>

                <div class="col-md-12 mt-4">
                    <label>Upload Foto (Multiple)</label>
                    <input type="file" name="photos[]" multiple class="form-control">
                </div>

                <div class="col-md-12 mt-3">
                    <label>Foto Saat Ini:</label>
                    <div class="d-flex gap-3">
                        @if ($dataPelanggan->photos)
                            @foreach ($dataPelanggan->photos as $foto)
                                <img src="{{ asset($foto) }}" width="100" class="rounded">
                            @endforeach
                        @else
                            <p class="text-muted">Tidak ada foto.</p>
                        @endif
                    </div>

                </div>
            </div>

            <button class="btn btn-primary mt-4">Update</button>
        </form>
    </div>
@endsection
