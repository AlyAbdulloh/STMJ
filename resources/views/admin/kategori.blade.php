@extends('layouts.admin.main')

@section('title', 'Kategori')

@section('page', 'Kategori')

@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <div class="card col-8">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategori">
                            Tambah
                        </button>
                    </div>
                    {{-- <div class="col-6 d-flex flex-row-reverse">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                id="searchKategori">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div> --}}
                </div>
            </div>
            <div class="card-body" id="table-data">
                <table class="table table-bordered table-hover mb-3">
                    <thead>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kategori as $item)
                            <tr>
                                <td id="box">
                                    <div class="row kat-data">
                                        <div class="col-12">
                                            {{ $item->name }}
                                        </div>
                                        <div class="btn-delete">
                                            <a href="" class="text-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategori->links() }}
            </div>
        </div>
    </div>
    @include('admin.modal.modalTambahKategori')

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
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            product(page);
        });

        function product(page) {
            $.ajax({
                url: '/pagination/paginate-data-kategori?page=' + page,
                success: (response) => {
                    $('#table-data').html(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        }

        //tambah kategori
        $(document).on('click', '.tambahKategori', function(e) {
            e.preventDefault;

            let name = $('#name').val();

            $.ajax({
                url: '{{ route('kategori.store') }}',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': name
                },
                success: (response) => {
                    $("#btn-close").click();
                    $("#formKategori")[0].reset();
                    $('#table-data').html(response);
                    // console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        })
    </script>

@endsection
