@extends('layouts.admin.app')
@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            @csrf
            <h1 class="h4">Edit Pelanggan</h1>
            <p class="mb-0">Form untuk mengedit data pelanggan.</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">
                <i class="far fa-question-circle me-1"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Sidebar --}}
    <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center">
                <span class="sidebar-icon">
                    <img src="{{ asset('assets-admin/img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
                </span>
                <span class="mt-1 ms-1 sidebar-text">Volt Overview</span>
            </a>
        </li>

        <li class="nav-item active">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                </span>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item active">
            <a href="{{ route('pelanggan.index') }}" class="nav-link">
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"></path>
                    </svg>
                </span>
                <span class="sidebar-text">Pelanggan</span>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">

                <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">

                        <div class="col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" id="first_name" class="form-control" name="first_name" required
                                       value="{{ $dataPelanggan->first_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" id="last_name" class="form-control" name="last_name" required
                                       value="{{ $dataPelanggan->last_name }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" id="birthday" class="form-control" name="birthday"
                                       value="{{ $dataPelanggan->birthday }}">
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control" required name="email"
                                       value="{{ $dataPelanggan->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone"
                                       value="{{ $dataPelanggan->phone }}">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
