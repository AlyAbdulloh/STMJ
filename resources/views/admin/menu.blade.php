@extends('layouts.admin.main')

@section('title', 'Menu')

@section('page', 'Menu')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahMenu">
                            Tambah
                        </button>
                    </div>
                    <div class="col-6 d-flex flex-row-reverse">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body" id="table-data">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->kategori->name }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width="80px"
                                        height="80px">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning edit-menu" data-toggle="modal"
                                        data-target="#editMenu" data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}" data-kategori="{{ $item->kategori->id }}"
                                        data-harga="{{ $item->harga }}" data-deskripsi="{{ $item->deskripsi }}"
                                        data-gambar="{{ $item->gambar }}">
                                        Edit
                                    </button>
                                    <a href="" class="btn btn-danger delete-menu"
                                        data-id="{{ $item->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $menu->links() }}
            </div>
        </div>
    </div>
    @include('admin.modal.modalTambahMenu')
    @include('admin.modal.modalEditMenu')



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
        // tambahMenu
        $(document).on('click', '.tambahMenu', function(e) {
            e.preventDefault();
            var formData = new FormData();

            let name = $('#name').val();
            let kategori_id = $('#kategori').val();
            let harga = $('#harga').val();
            let deskripsi = $('#deskripsi').val();
            var gambar = $('#gambar').prop('files')[0];

            formData.append('name', name);
            formData.append('kategori_id', kategori_id);
            formData.append('harga', harga);
            formData.append('deskripsi', deskripsi);
            formData.append('gambar', gambar);

            $.ajax({
                url: '{{ route('menu.store') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: (response) => {
                    $("#btn-close").click();
                    $("#formMenu")[0].reset();
                    $('#table-data').html(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });

        });

        // edit menu
        $(document).on('click', '.edit-menu', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let name = $(this).data('name');
            let kategori = $(this).data('kategori');
            let harga = $(this).data('harga');
            let deskripsi = $(this).data('deskripsi');
            let gambar = $(this).data('gambar');

            var source = "{!! asset('storage/"+gambar+"') !!}";

            $("#up_id").val(id);
            $("#up_name").val(name);
            $("#up_kategori").val("" + kategori + "").change();
            $("#up_harga").val(harga);
            $("#up_deskripsi").val(deskripsi);
            $('#gambar_menu').attr('src', source);

        });

        $(document).on('click', '.editMenu', function(e) {
            e.preventDefault();

            var formData = new FormData();

            let up_id = $("#up_id").val();
            let name = $('#up_name').val();
            let kategori_id = $('#up_kategori').val();
            let harga = $('#up_harga').val();
            let deskripsi = $('#up_deskripsi').val();
            var gambar = $('#up_gambar').prop('files')[0];

            formData.append('up_id', up_id);
            formData.append('name', name);
            formData.append('kategori_id', kategori_id);
            formData.append('harga', harga);
            formData.append('deskripsi', deskripsi);
            formData.append('gambar', gambar);

            $.ajax({
                url: "{{ route('menu.update') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: (response) => {
                    $("#btn-close-update").click();
                    $("#UpdateMenu")[0].reset();
                    $('#table-data').html(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        })

        //delete menu
        $(document).on('click', '.delete-menu', function(e) {
            e.preventDefault();
            let delete_id = $(this).data('id');

            $.ajax({
                url: 'menu-delete/' + delete_id,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    $('#table-data').html(response);
                }
            });

        });

        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            product(page);
            // console.log(page)

        });

        function product(page) {
            $.ajax({
                url: "/pagination/paginate-data-menu?page=" + page,
                success: (response) => {
                    $('#table-data').html(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        }
    </script>
@endsection
