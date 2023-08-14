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
