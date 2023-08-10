<!-- Modal -->
<div class="modal fade" id="editMenu" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="" method="post" id="UpdateMenu">
        @csrf
        {{ method_field('PATCH') }}
        <input type="hidden" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close-update">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="up_name" aria-describedby="name"
                            name="name">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="kategori">Kategori</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="kategori">Options</label>
                                </div>
                                <select class="custom-select" id="up_kategori" name="kategori">
                                    <option selected>Choose...</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="up_harga" aria-describedby="harga"
                                name="harga">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="up_deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="form-row">
                            <div class="input-group col-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="up_gambar"
                                        aria-describedby="inputGroupFileAddon01" name="up_gambar">
                                    <label class="custom-file-label" for="gambar">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-4 text-center">
                                <img src="{{ asset('book.png') }}" alt="" width="90px" height="90px"
                                    id="gambar_menu">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary editMenu">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
