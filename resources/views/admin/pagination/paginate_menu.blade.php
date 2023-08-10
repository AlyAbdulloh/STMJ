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
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width="80px" height="80px">
                </td>
                <td>
                    <button type="button" class="btn btn-warning edit-menu" data-toggle="modal" data-target="#editMenu"
                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                        data-kategori="{{ $item->kategori->id }}" data-harga="{{ $item->harga }}"
                        data-deskripsi="{{ $item->deskripsi }}" data-gambar="{{ $item->gambar }}">
                        Edit
                    </button>
                    <a href="" class="btn btn-danger delete-menu" data-id="{{ $item->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $menu->links() }}
