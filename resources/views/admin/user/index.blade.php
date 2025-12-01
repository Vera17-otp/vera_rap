@extends('layouts.admin.app')

@section('content')
    <div class="py-4 d-flex justify-content-between">
        <h1 class="h4">Data User</h1>
        <a href="{{ route('user.create') }}" class="btn btn-success">Tambah User</a>
    </div>

    @if (session('success'))
        <div class="alert alert-info">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password Hash</th>
                            <th>Action</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->profile_picture
                                        ? asset('storage/uploads/profile/' . $item->profile_picture)
                                        : asset('assets-admin/img/profile.jpg') }}"
                                        width="40" height="40" class="rounded-circle">
                                </td>

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->role }}</td>


                                <td>
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $dataUser->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}
@endsection
