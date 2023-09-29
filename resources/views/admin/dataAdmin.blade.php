@extends('layouts.admin.main')

@section('title', 'Data Admin')

@section('page', 'Data Admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                {{-- <div class="row">
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahMenu">
                            Tambah
                        </button>
                    </div>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
