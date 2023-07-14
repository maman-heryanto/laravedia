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
                        <h2>LIST WAREHOUSE</h2>
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
                                        data-target="#modalAddWarehouse">
                                        <i class="fa fa-plus"></i> Warehouse
                                    </button>
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Image</th>
                                                <th>Total Product</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($warehouse) }} --}}
                                            @foreach ($warehouse as $w)
                                                <tr>
                                                    <td>{{ $w->name }}</td>
                                                    <td>{{ $w->address }}</td>
                                                    <td style="text-align: center;"><img
                                                            src="{{ asset('/assets/uploads/images/warehouse') . '/' . $w->image }}"
                                                            style="width: 150px;" />
                                                    </td>
                                                    <td>{{ $w->total_product }} Product</td>
                                                    <td>
                                                        {{-- <a class="btn bg-primary " data-toggle='modal'
                                                            id='buttonDetailWarehouse'
                                                            data-warehouseId="{{ $w->id }}"
                                                            data-warehouseName="{{ $w->name }}"><i
                                                                class='glyphicon glyphicon-resize-full'></i>
                                                        </a> --}}
                                                        <a class="btn bg-primary btn_detail"
                                                            data-url="{{ Route('warehousedtl', ['id' => $w->id]) }}"><i
                                                                class='glyphicon glyphicon-resize-full'></i>
                                                        </a>

                                                        <a class="btn bg-warning" data-toggle='modal'
                                                            id='buttonEditWarehouse' data-warehouseId="{{ $w->id }}"
                                                            data-warehouseName="{{ $w->name }}"><i
                                                                class='glyphicon glyphicon-edit'></i>
                                                        </a>
                                                        <a class="btn bg-red" data-toggle='modal' id='buttonDeleteWarehouse'
                                                            data-target='#deleteWarehouse'
                                                            data-warehouseId="{{ $w->id }}"><i
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

    {{-- Modal add --}}
    <div class="modal fade" id="modalAddWarehouse">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i>Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formAddWarehouse">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name Warehouse"
                                    name="name" id="name">
                                <span class="text-danger form-validate" id="nameError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Address" name="address"
                                    id="address">
                                <span class="text-danger form-validate" id="addressError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="imageWarehouse" id="imageWarehouse">
                                <span class="text-danger form-validate" id="imageWarehouseError"></span>
                                <img id="previewImageWarehouse" src="#" alt="your image" class="mt-3"
                                    style="display:none; width:80%;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitAddWarehouse">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitAddWarehouseLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit_warehouse">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fa fa-pencil"></span> &nbsp;&nbsp;&nbsp; <h5 class="modal-title"> Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formEditWarehouse">
                    <input type="hidden" class="form-control" name="warehouseId_edit" id="id_edit">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name Warehouse"
                                    name="name" id="name_edit">
                                <span class="text-danger form-validate" id="nameEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Address Warehouse"
                                    name="address" id="address_edit">
                                <span class="text-danger form-validate" id="addressEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="imageWarehouseEdit"
                                    id="imageWarehouseEdit">
                                <span class="text-danger form-validate" id="imageWarehouseError"></span>
                                <img id="previewImageWarehouseEdit" src="#" alt="your image" class="mt-3"
                                    style="display:none; width:80%;" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitEditWarehouse">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitEditWarehouseLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
    <div class="modal fade" id="modal_delete_warehouse">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fa fa-trash"></span> &nbsp;&nbsp;&nbsp; <h5 class="modal-title"> Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formDeleteWarehouse">
                    <input type="text" class="form-control" name="warehouseId_delete" id="id_delete">
                    <input type="text" class="form-control" name="name_delete" id="name_delete">
                    <input type="text" class="form-control" name="imageWarehouseDelete" id="imageWarehouseDelete">
                    <div class="modal-body">
                        <p id="deleteConfirmationMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitDeleteWarehouse">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitDeleteWarehouseLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        imageWarehouse.onchange = evt => {
            previewImageWarehouse = document.getElementById('previewImageWarehouse');
            previewImageWarehouse.style.display = 'block';
            const [file] = imageWarehouse.files
            if (file) {
                previewImageWarehouse.src = URL.createObjectURL(file)
            }
        }
        // edit
        imageWarehouseEdit.onchange = evt => {
            previewImageWarehouseEdit = document.getElementById('previewImageWarehouseEdit');
            previewImageWarehouseEdit.style.display = 'block';
            const [file] = imageWarehouseEdit.files
            if (file) {
                previewImageWarehouseEdit.src = URL.createObjectURL(file)
            }
        }
    </script>
    @push('scripts')
        {{-- add --}}
        <script>
            $(document).ready(function() {
                $('#formAddWarehouse').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitAddWarehouse").style.display = "none";
                    document.getElementById("divBtnSubmitAddWarehouseLoading").style.display = "block";
                    var name = $("#name").val();
                    var image = $("#imageWarehouse").val();
                    var address = $("#address").val();

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
                    if (address.length == 0 || address == "") {
                        $('#addressError').text("address is required");
                        $('#address').addClass('form-error');
                        validation++;
                    } else {
                        $('#addressError').text("");
                        $('#address').removeClass('form-error');
                    }
                    if (image.length == 0 || image == "") {
                        $('#imageWarehouseError').text("Image is required");
                        $('#imageWarehouse').addClass('form-error');
                        validation++;
                    } else {
                        $('#imageWarehouseError').text("");
                        $('#imageWarehouse').removeClass('form-error');
                    }
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitAddWarehouse").style.display = "block";
                        document.getElementById("divBtnSubmitAddWarehouseLoading").style.display = "none";
                        return false;
                    }
                    //end validation

                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('warehouse.add') }}",
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
                                    type: 'success',
                                    title: 'Insert Success',
                                    text: 'Warehouse success insert. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Insert Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitAddWarehouse")
                                        .style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitAddWarehouseLoading")
                                        .style.display = "none";
                                });
                            }
                        },
                        error: function(response) {
                            // console.log(response.message);
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            }).then(function() {
                                document.getElementById("divBtnSubmitAddWarehouse").style
                                    .display = "block";
                                document.getElementById("divBtnSubmitAddWarehouseLoading")
                                    .style
                                    .display = "none";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- edit --}}
        <script>
            $(document).on('click', '#buttonEditWarehouse', function(event) {
                event.preventDefault();
                var warehouseId = $(this).attr('data-warehouseId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('warehouse.data') }}",
                    data: {
                        id: warehouseId
                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_edit').val(result.id);
                        $('#name_edit').val(result.name);
                        $('#address_edit').val(result.address);
                        $('#image_edit').val(result.image);
                        // Display the image preview
                        var previewImageWarehouseEdit = $('#previewImageWarehouseEdit');
                        previewImageWarehouseEdit.attr('src',
                            "{{ asset('/assets/uploads/images/warehouse/') }}/" + result.image);
                        previewImageWarehouseEdit.show();

                        $('#modal_edit_warehouse').modal("show");
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

            // post edit
            $(document).ready(function() {
                $('#formEditWarehouse').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitEditWarehouse").style.display = "none";
                    document.getElementById("divBtnSubmitEditWarehouseLoading").style.display = "block";
                    var warehouseId_edit = $("#id_edit").val();
                    var name = $("#name_edit").val();
                    // var image = $("#imageWarehouseEdit").val();
                    var address = $("#address_edit").val();

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

                    if (address.length == 0 || address == "") {
                        $('#addressEditError').text("address is required");
                        $('#address_edit').addClass('form-error');
                        validation++;
                    } else {
                        $('#addressEditError').text("");
                        $('#address_edit').removeClass('form-error');
                    }
                    console.log(validation);
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitEditWarehouse").style.display = "block";
                        document.getElementById("divBtnSubmitEditWarehouseLoading").style.display = "none";
                        return false;
                    }
                    //end validation
                    $.ajax({
                        url: "{{ route('warehouse.edit') }}",
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
                                    type: 'success',
                                    title: 'Success Update Warehouse',
                                    text: 'success update warehouse. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'update Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitEditWarehouse")
                                        .style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitEditWarehouseLoading")
                                        .style.display = "none";
                                });
                            }
                        },
                        error: function(response) {
                            // console.log(response.message);
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            }).then(function() {
                                document.getElementById("divBtnSubmitEditWarehouse").style
                                    .display = "none";
                                document.getElementById("divBtnSubmitEditWarehouseLoading")
                                    .style.display = "block";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- delete --}}
        <script>
            $(document).on('click', '#buttonDeleteWarehouse', function(event) {
                event.preventDefault();
                var warehouseId = $(this).attr('data-warehouseId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('warehouse.data') }}",
                    data: {
                        id: warehouseId

                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_delete').val(result.id);
                        $('#name_delete').val(result.name);
                        $('#imageWarehouseDelete').val(result.image);
                        $('#modal_delete_warehouse').modal("show");
                        $('#deleteConfirmationMessage').html(
                            "<p>Are you sure you want to delete the warehouse <b>'" +
                            result.name +
                            "'</b>?</p>");
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
                $('#formDeleteWarehouse').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitDeleteWarehouse").style.display = "none";
                    document.getElementById("divBtnSubmitDeleteWarehouseLoading").style.display = "block";
                    var warehouseId_edit = $("#id_edit").val();
                    var name_delete = $("#name_delete").val();
                    var imageWarehouseDelete = $("#imageWarehouseDelete").val();

                    let validation = 0;
                    //validation
                    $.ajax({
                        url: "{{ route('warehouse.delete') }}",
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
                                    title: 'Success Delete Warehouse',
                                    text: 'success delete warehouse. . .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Delete Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitDeleteWarehouse")
                                        .style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitDeleteWarehouseLoading")
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
                                document.getElementById("divBtnSubmitDeleteWarehouse").style
                                    .display = "none";
                                document.getElementById(
                                        "divBtnSubmitDeleteWarehouseLoading")
                                    .style.display = "block";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- see detail warehouse --}}
        <script>
            jQuery(document).ready(function() {
                jQuery(document).on('click', '.btn_detail', function(e) {
                    e.preventDefault();
                    var current = jQuery(this);
                    var url = current.data('url');
                    var idParam = new URLSearchParams(window.location.search).get(
                        'id');
                    window.location.href = url;
                });
            });
        </script>
    @endpush
@endsection

@extends('templates.footer')
