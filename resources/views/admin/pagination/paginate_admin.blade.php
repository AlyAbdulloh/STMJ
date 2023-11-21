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
                    <a href="" class=" btn mr-2 text-warning edit-admin" style="font-size: 23px;" data-toggle="modal"
                        data-target="#editAdmin" data-id="{{ $admin->id }}" data-name="{{ $admin->name }}"
                        data-email="{{ $admin->email }}" data-username="{{ $admin->username }}"
                        data-password="{{ $admin->password }}"><i class="fas fa-user-edit"></i></a>
                    <a href=""
                        class="btn text-danger {{ auth()->user()->name == $admin->name ? 'disabled' : '' }} delete-admin"
                        data-id="{{ $admin->id }}" style="font-size: 23px"><i class="fas fa-user-times"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $admins->links() }}
