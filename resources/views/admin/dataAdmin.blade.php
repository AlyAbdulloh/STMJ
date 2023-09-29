@extends('layouts.admin.main')

@section('title', 'Data Admin')

@section('page', 'Data Admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAdmin">
                            Tambah <i class="fas fa-user-plus ml-1"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="row">
                    
                    <div class="col-6 d-flex flex-row-reverse">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                id="searchMenu">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th width="160px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <a href="" class=" btn mr-2 text-warning" style="font-size: 23px;"><i
                                            class="fas fa-user-edit"></i></a>
                                    <a href=""
                                        class="btn text-danger {{ auth()->user()->name == $user->name ? 'disabled' : '' }}"
                                        style="font-size: 23px"><i class="fas fa-user-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @include('admin.modal.modalTambahAdmin')
@endsection
