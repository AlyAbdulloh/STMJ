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
                    <div class="col-6 d-flex flex-row-reverse">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                id="searchAdmin">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body" id="table-data">
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
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>
                                    <a href="" class=" btn mr-2 text-warning edit-admin" style="font-size: 23px;"
                                        data-toggle="modal" data-target="#editAdmin" data-id="{{ $admin->id }}"
                                        data-name="{{ $admin->name }}" data-email="{{ $admin->email }}"
                                        data-username="{{ $admin->username }}" data-password="{{ $admin->password }}"><i
                                            class="fas fa-user-edit"></i></a>
                                    <a href=""
                                        class="btn text-danger {{ auth()->user()->name == $admin->name ? 'disabled' : '' }} delete-admin"
                                        data-id="{{ $admin->id }}" style="font-size: 23px"><i
                                            class="fas fa-user-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $admins->links() }}
            </div>
        </div>
    </div>
    @include('admin.modal.modalTambahAdmin')
    @include('admin.modal.modalEditAdmin')

    {{-- script --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>

    <script>
        function checkInputs(inputFields) {
            let isEmpty = false;
            inputFields.forEach(input => {
                if (input.value.trim() === '') {
                    isEmpty = true;
                }
            });
            return isEmpty;
        }

        function toggleSubmitButton(inputFields, btn) {
            if (checkInputs(inputFields)) {
                // submitButton.attr("disabled", true);
                btn.attr("disabled", true);
                // console.log(true);
            } else {
                // console.log(false);
                btn.attr("disabled", false);
            }
        }

        // tambah admin
        $(".tambahAdmin").on('click', function(e) {
            e.preventDefault()

            let name = $('#name').val();
            let email = $('#email').val();
            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{ route('admin.store') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': name,
                    'email': email,
                    'username': username,
                    'password': password
                },
                success: (response) => {
                    $("#btn-close-add").click();
                    $("#formAddAdmin")[0].reset();
                    $('#table-data').html(response);
                    // console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        })

        $(".close").on('click', function(e) {
            $("#formAddAdmin")[0].reset();
        })

        let formTambahAdmin = document.getElementById('formAddAdmin');
        let inputFormTambahAdmin = formTambahAdmin.querySelectorAll('input');
        let btnAddAdmin = $(".tambahAdmin");

        $('#formAddAdmin').on('input', function() {
            toggleSubmitButton(inputFormTambahAdmin, btnAddAdmin);
        })
        toggleSubmitButton(inputFormTambahAdmin, btnAddAdmin);

        // edit data
        $(document).on('click', '.edit-admin', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let username = $(this).data('username');

            $('#curr_id').val(id);
            $('#curr_name').val(name);
            $('#curr_email').val(email);
            $('#curr_username').val(username);

        });

        $(document).on('click', '.EditAdmin', function(e) {
            e.preventDefault();

            let id = $('#curr_id').val();
            let name = $('#curr_name').val();
            let email = $('#curr_email').val();
            let username = $('#curr_username').val();
            let password = $('#curr_password').val();

            $.ajax({
                url: "{{ route('admin.update') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': id,
                    'name': name,
                    'email': email,
                    'username': username,
                    'password': password
                },
                success: (response) => {
                    $("#btn-close-admin").click();
                    $("#formEditAdmin")[0].reset();
                    $('#table-data').html(response);
                    // console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        });

        let formEditAdmin = document.getElementById('formEditAdmin');
        let inputFormEditAdmin = formEditAdmin.querySelectorAll('input');
        let btnEditAdmin = $(".EditAdmin");

        $('#formEditAdmin').on('input', function() {
            toggleSubmitButton(inputFormEditAdmin, btnEditAdmin);
        })
        toggleSubmitButton(inputFormEditAdmin, btnEditAdmin);

        //delete admin
        $(document).on('click', '.delete-admin', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: "/admin-delete/" + id,
                type: "delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    // console.log(response);
                    $('#table-data').html(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        });

        //search admin
        $('#searchAdmin').on('keyup', function(e) {
            e.preventDefault()

            let name = $(this).val();

            $.ajax({
                url: '/dataAdmin',
                type: 'get',
                data: {
                    'val': name,
                },
                success: (response) => {
                    $('#table-data').html(response)
                    // console.log(response)
                },
                error: (response) => {
                    console.log(response);
                }
            });
        })
    </script>
@endsection
