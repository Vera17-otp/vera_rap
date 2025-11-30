@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <h1 class="h4">Tambah User</h1>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">

                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" required name="name">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" required name="email">
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" required name="password">
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label>Foto Profil</label>
                                <input type="file" name="profile_picture" class="form-control">

                                <div class="mt-2">
                                    <p>Preview default:</p>
                                    <img src="{{ asset('assets-admin/img/profile.jpg') }}" width="120" class="img-thumbnail">
                                </div>
                            </div>

                            <button class="btn btn-primary mt-3">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary mt-3">Batal</a>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

