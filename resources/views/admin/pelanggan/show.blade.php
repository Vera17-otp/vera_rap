@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <h1 class="h4">Detail Pelanggan</h1>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>First Name:</strong> {{ $pelanggan->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $pelanggan->last_name }}</p>
        <p><strong>Birthday:</strong> {{ $pelanggan->birthday }}</p>
        <p><strong>Gender:</strong> {{ $pelanggan->gender }}</p>
        <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
        <p><strong>Phone:</strong> {{ $pelanggan->phone }}</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5>Upload File</h5>
        <form action="{{ route('pelanggan.uploadFiles', $pelanggan->pelanggan_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="files[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>List File Pelanggan</h5>
        <ul class="list-group">
            @foreach ($pelanggan->files as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ asset('storage/' . $file->filename) }}" target="_blank">
                        {{ $file->original_name }}
                    </a>
                    <form action="{{ route('pelanggan.deleteFile', [$pelanggan->pelanggan_id, $file->id]) }}" method="POST" onsubmit="return confirm('Hapus file ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
