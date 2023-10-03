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
                    <a href="" class=" btn mr-2 text-warning edit-admin" style="font-size: 23px;" data-toggle="modal"
                        data-target="#editAdmin" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}" data-username="{{ $user->username }}"
                        data-password="{{ $user->password }}"><i class="fas fa-user-edit"></i></a>
                    <a href=""
                        class="btn text-danger {{ auth()->user()->name == $user->name ? 'disabled' : '' }} delete-admin"
                        data-id="{{ $user->id }}" style="font-size: 23px"><i class="fas fa-user-times"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
