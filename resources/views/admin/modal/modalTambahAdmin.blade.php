<div class="modal fade" id="tambahAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="" method="post" id="formAddAdmin">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close-add">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name"
                            placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" aria-describedby="email"
                            name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" aria-describedby="Username"
                            name="Username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="password" aria-describedby="password"
                            name="password" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tambahAdmin">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
