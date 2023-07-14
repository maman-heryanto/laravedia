@extends('templates.main')
@extends('templates.sidebar')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- used --}}
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>LIST USERS</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalAddUser">
                                        <i class="fa fa-plus"></i> User
                                    </button>
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Image</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($users) }} --}}
                                            @foreach ($users as $user)
                                                <tr>
                                                    {{-- <td>{{ dd($user->id) }}</td> --}}
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td style="text-align: center;"><img
                                                            src="{{ asset('/assets/uploads/images/user') . '/' . $user->image }}"
                                                            style="width: 80px;" /> </td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <a class="btn bg-warning " data-toggle='modal' id='buttonEditUser'
                                                            data-userId="{{ $user->id }}"
                                                            data-userName="{{ $user->name }}"><i
                                                                class='glyphicon glyphicon-edit'></i>
                                                        </a>
                                                        <a class="btn bg-red" data-toggle='modal' id='buttonDeleteUser'
                                                            data-target='#deleteUser' data-userId="{{ $user->id }}"><i
                                                                class='glyphicon glyphicon-trash'></i>
                                                        </a>
                                                    </td>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- endused --}}
        </div>
    </div>
    <!-- /page content -->

    {{-- modal delete --}}
    <div class="modal fade" id="modal_delete_user">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-trash"></i>
                        User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formDeleteUser">
                    <input type="hidden" class="form-control" name="userId_delete" id="id_delete">
                    <input type="hidden" class="form-control" name="name_delete" id="name_delete">
                    <input type="hidden" class="form-control" name="email_delete" id="email_delete">
                    <input type="hidden" class="form-control" name="imageUserDelete" id="imageUserDelete">
                    <div class="modal-body">
                        <p id="deleteConfirmationMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitDeleteUser">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitDeleteUserLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal add --}}
    <div class="modal fade" id="modalAddUser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i>User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formAddUser">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name Users"
                                    name="name" id="name">
                                <span class="text-danger form-validate" id="nameError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Email Users"
                                    name="email" id="email">
                                <span class="text-danger form-validate" id="emailError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitAddUser">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitAddUserLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit_user">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-pencil"></i>user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formEditUser">
                    <input type="hidden" class="form-control" name="userId_edit" id="id_edit">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name User"
                                    name="name" id="name_edit">
                                <span class="text-danger form-validate" id="nameEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Email User"
                                    name="email" id="email_edit">
                                <span class="text-danger form-validate" id="EmailEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="imageUserEdit" id="imageUserEdit">
                                <span class="text-danger form-validate" id="imageUserError"></span>
                                <img id="previewImageUserEdit" src="#" alt="your image" class="mt-3"
                                    style="display:none; width:30%;" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Role</label>
                            <select id="role_edit" class="form-control" name="role"required>
                                <option value="admin">Administrator</option>
                                <option value="user">User</option>
                            </select>
                            <span class="text-danger form-validate" id="roleEditError"></span>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                            <div id="divBtnSubmitEditUser">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div id="divBtnSubmitEditUserLoading" style="display: none;">
                                <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        {{-- add --}}
        <script>
            $(document).ready(function() {
                $('#formAddUser').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitAddUser").style.display = "none";
                    document.getElementById("divBtnSubmitAddUserLoading").style.display = "block";
                    var name = $("#name").val();
                    var email = $("#email").val();
                    let validation = 0;
                    //validation
                    if (name.length == 0 || name == "") {
                        $('#nameError').text("Name is required");
                        $('#name').addClass('form-error');
                        validation++;
                    } else {
                        $('#nameError').text("");
                        $('#name').removeClass('form-error');
                    }
                    if (email.length == 0 || email == "") {
                        $('#emailError').text("email is required");
                        $('#email').addClass('form-error');
                        validation++
                    } else {
                        if (!email.toString().toLowerCase().match(
                                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                            )) {
                            $('#emailError').text("Plase check the email format");
                            $('#email').addClass('form-error');
                            validation++;
                        } else {
                            $('#emailError').text("");
                            $('#email').removeClass('form-error');
                        }
                    }
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitAddUser").style.display = "block";
                        document.getElementById("divBtnSubmitAddUserLoading").style.display = "none";
                        return false;
                    }
                    //end validation

                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('user.add') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Insert Success',
                                    text: 'User success insert. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Insert Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitAddUser").style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitAddUserLoading")
                                        .style.display = "none";
                                });
                            }
                        },
                        error: function(response) {
                            // console.log(response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            }).then(function() {
                                document.getElementById("divBtnSubmitAddUser").style
                                    .display = "block";
                                document.getElementById("divBtnSubmitAddUserLoading")
                                    .style.display = "none";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- edit --}}
        <script>
            $(document).on('click', '#buttonEditUser', function(event) {
                event.preventDefault();
                var userId = $(this).attr('data-userId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('user.data') }}",
                    data: {
                        id: userId
                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_edit').val(result.id);
                        $('#name_edit').val(result.name);
                        $('#email_edit').val(result.email);
                        $('#role_edit').val(result.role);
                        $('#image_edit').val(result.image);

                        // Display the image preview
                        var previewImageUserEdit = $('#previewImageUserEdit');
                        previewImageUserEdit.attr('src',
                            "{{ asset('/assets/uploads/images/user/') }}/" + result.image);
                        previewImageUserEdit.show();

                        $('#modal_edit_user').modal("show");
                    },
                    complete: function() {
                        $('#preloader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#preloader').hide();
                    },
                    timeout: 8000
                })
            });
            // POST EDIT
            $(document).ready(function() {
                $('#formEditUser').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitEditUser").style.display = "none";
                    document.getElementById("divBtnSubmitEditUserLoading").style.display = "block";
                    var userId_edit = $("#id_edit").val();
                    var name = $("#name_edit").val();
                    // var image = $("#imageUserEdit").val();
                    var email = $("#email_edit").val();
                    var role = $("#role_edit").val();

                    let validation = 0;
                    //validation
                    if (name.length == 0 || name == "") {
                        $('#nameEditError').text("Name is required");
                        $('#name_edit').addClass('form-error');
                        validation++;
                    } else {
                        $('#nameEditError').text("");
                        $('#name_edit').removeClass('form-error');
                    }
                    if (email.length == 0 || email == "") {
                        $('#emailError').text("email is required");
                        $('#email').addClass('form-error');
                        validation++
                    } else {
                        if (!email.toString().toLowerCase().match(
                                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                            )) {
                            $('#emailError').text("Plase check the email format");
                            $('#email').addClass('form-error');
                            validation++;
                        } else {
                            $('#emailError').text("");
                            $('#email').removeClass('form-error');
                        }
                    }

                    if (role.length == 0 || role == "") {
                        $('#roleEditError').text("role is required");
                        $('#role_edit').addClass('form-error');
                        validation++;
                    } else {
                        $('#roleEditError').text("");
                        $('#role_edit').removeClass('form-error');
                    }

                    console.log(validation);
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitEditUser").style.display = "block";
                        document.getElementById("divBtnSubmitEditUserLoading").style.display = "none";
                        return false;
                    }
                    //end validation
                    $.ajax({
                        url: "{{ route('user.edit') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success Update User',
                                    text: 'success Update User. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitEditUser").style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitEditUserLoading")
                                        .style.display = "none";
                                });
                            }
                        },
                        error: function(response) {
                            // console.log(response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            }).then(function() {
                                document.getElementById("divBtnSubmitEditUser").style
                                    .display = "none";
                                document.getElementById("divBtnSubmitEditUserLoading")
                                    .style.display = "block";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- delete --}}
        <script>
            $(document).on('click', '#buttonDeleteUser', function(event) {
                event.preventDefault();
                var userId = $(this).attr('data-userId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('user.data') }}",
                    data: {
                        id: userId

                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_delete').val(result.id);
                        $('#name_delete').val(result.name);
                        $('#email_delete').val(result.email);
                        $('#imageUserDelete').val(result.image);
                        $('#modal_delete_user').modal("show");
                        $('#deleteConfirmationMessage').text(
                            "Are you sure you want to delete the user '" + result.email + "'?");
                    },
                    complete: function() {
                        $('#preloader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#preloader').hide();
                    },
                    timeout: 8000
                })
            });

            // POST DELETE
            $(document).ready(function() {
                $('#formDeleteUser').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitDeleteUser").style.display = "none";
                    document.getElementById("divBtnSubmitDeleteUserLoading").style.display = "block";
                    var userId_edit = $("#id_edit").val();
                    var email_delete = $("#email_delete").val();
                    var name_delete = $("#name_delete").val();
                    var imageUserDelete = $("#imageUserDelete").val();

                    let validation = 0;
                    //validation
                    $.ajax({
                        url: "{{ route('user.delete') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success Delete User',
                                    text: 'success Delete User. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Delete Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitDeleteUser")
                                        .style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitDeleteUserLoading")
                                        .style.display = "none";
                                });
                            }
                        },
                        error: function(response) {
                            // console.log(response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            }).then(function() {
                                document.getElementById("divBtnSubmitDeleteUser").style
                                    .display = "none";
                                document.getElementById("divBtnSubmitDeleteUserLoading")
                                    .style.display = "block";
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection

@extends('templates.footer')
