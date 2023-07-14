@extends('templates.main')
@extends('templates.sidebar')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            {{-- <div class="page-title">
                <div class="title_left">
                    <h3>User Profile</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                            src="{{ asset('assets/uploads/images/user') . '/' . $image }}" alt="Avatar"
                                            title="Change the avatar" width="70%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 ">
                                {{-- <br /> --}}
                                <h3>{{ $name }}</h3>
                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-envelope user-profile-icon"></i> Email: {{ $email }}
                                    </li>

                                    <li>
                                        <i class="fa fa-cog user-profile-icon"></i> Role: {{ $role }}
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-plus-circle user-profile-icon"></i> Created:
                                        {{ date('Y-m-d H:m:s', strtotime($created_at)) }}
                                    </li>
                                </ul>
                                <a class="btn btn-success text-white" data-toggle='modal' id='buttonEditUser'
                                    data-userId="{{ $id }}"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                                <a class="btn btn-warning text-white" data-toggle='modal' id='buttonChangePasswordUser'
                                    data-userId="{{ $id }}"><i class="fa fa-lock m-right-xs"></i> Change
                                    Password</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->

    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit_user">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i>My Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formEditUser">
                    <input type="hidden" class="form-control" name="userId_edit" id="id_edit">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name User" name="name"
                                    id="name_edit">
                                <span class="text-danger form-validate" id="nameEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Email User" name="email"
                                    id="email_edit">
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
    {{-- modal change password --}}
    <div class="modal fade" id="modal_change_password_user">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i>Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formChangePasswordUser">
                    <input type="hidden" class="form-control" name="userId_changepassword" id="id_changepassword">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Old Password</label>
                            <div class="col-sm-9">
                                <input autofocus type="password" class="form-control" placeholder="Old Password"
                                    name="oldPassword" id="oldPassword">
                                <span class="text-danger form-validate" id="oldPasswordError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input autofocus type="password" class="form-control" placeholder="New Password"
                                    name="password" id="password">
                                <span class="text-danger form-validate" id="passwordError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">New Re-Password</label>
                            <div class="col-sm-9">
                                <input autofocus type="password" class="form-control" placeholder="New Re-Password"
                                    name="repassword" id="repassword">
                                <span class="text-danger form-validate" id="repasswordError"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                            <div id="divBtnSubmitChangePasswordUser">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div id="divBtnSubmitChangePasswordUserLoading" style="display: none;">
                                <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        imageUserEdit.onchange = evt => {
            previewImageUserEdit = document.getElementById('previewImageUserEdit');
            previewImageUserEdit.style.display = 'block';
            const [file] = imageUserEdit.files
            if (file) {
                previewImageUserEdit.src = URL.createObjectURL(file)
            }
        }
    </script>
    @push('scripts')
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
                    url: "{{ route('profile.data') }}",
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

                    console.log(validation);
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitEditUser").style.display = "block";
                        document.getElementById("divBtnSubmitEditUserLoading").style.display = "none";
                        return false;
                    }
                    //end validation
                    $.ajax({
                        url: "{{ route('profile.edit') }}",
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
                                    title: 'Success Update Profile',
                                    text: 'success update profile. .',
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
        {{-- change password --}}
        <script>
            $(document).on('click', '#buttonChangePasswordUser', function(event) {
                event.preventDefault();
                var userId = $(this).attr('data-userId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('profile.data') }}",
                    data: {
                        id: userId
                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        console.log(result.id);
                        $('#id_changepassword').val(result.id);

                        $('#modal_change_password_user').modal("show");
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
            // POST changePassword
            $(document).ready(function() {
                $('#formChangePasswordUser').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitChangePasswordUser").style.display = "none";
                    document.getElementById("divBtnSubmitChangePasswordUserLoading").style.display = "block";
                    var userId_changepassword = $("#userId_changepassword").val();
                    var oldPassword = $("#oldPassword").val();
                    var password = $("#password").val();
                    var repassword = $("#repassword").val();

                    let validation = 0;
                    //validation
                    //old password validation
                    if (oldPassword.length == 0 || oldPassword == "") {
                        $('#oldPasswordError').text("Old password is required");
                        $('#oldPassword').addClass('form-error');
                    } else {
                        $('#oldPasswordError').text("");
                        $('#oldPassword').removeClass('form-error');
                    }
                    //password validation
                    if (password.length == 0 || password == "") {
                        $('#passwordError').text("Password is required");
                        $('#password').addClass('form-error');
                    } else {
                        $('#passwordError').text("");
                        $('#password').removeClass('form-error');
                    }
                    //repassword validation
                    if (password !== repassword) {
                        $('#repasswordError').text("Retype Password must be the same as the Password");
                        $('#repassword').addClass('form-error');
                    } else {
                        $('#repasswordError').text("");
                        $('#repassword').removeClass('form-error');
                    }

                    if (validation > 0) {
                        document.getElementById("divBtnSubmitChangePasswordUser").style.display = "block";
                        document.getElementById("divBtnSubmitChangePasswordUserLoading").style.display = "none";
                        return false;
                    }
                    //end validation
                    console.log('end validation')
                    $.ajax({
                        url: "{{ route('profile.changepassword') }}",
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
                                    title: 'Success Change Password',
                                    text: 'success change password. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else if (response.status == 202) {
                                $('#oldPasswordError').text(response.message);
                                $('#oldPassword').addClass('form-error');
                                document.getElementById(
                                        "divBtnSubmitChangePasswordUser").style
                                    .display = "block";
                                document.getElementById(
                                        "divBtnSubmitChangePasswordUserLoading")
                                    .style.display = "none";
                            } else {
                                console.log('error update');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Change Password Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById(
                                            "divBtnSubmitChangePasswordUser").style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitChangePasswordUserLoading")
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
                                document.getElementById("divBtnSubmitChangePasswordUser")
                                    .style
                                    .display = "block";
                                document.getElementById(
                                        "divBtnSubmitChangePasswordUserLoading")
                                    .style.display = "none";
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection

@extends('templates.footer')
