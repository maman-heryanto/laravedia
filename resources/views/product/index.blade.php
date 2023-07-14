@extends('templates.main')
@extends('templates.sidebar')

{{-- modal delete error --}}
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- used --}}
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>LIST PRODUCT</h2>
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
                                        data-target="#modalAddProduct">
                                        <i class="fa fa-plus"></i> Product
                                    </button>
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($product) }} --}}
                                            @foreach ($product as $p)
                                                <tr>
                                                    {{-- <td>{{ dd($p->id) }}</td> --}}
                                                    <td>{{ $p->name }}</td>
                                                    <td style="text-align: center;"><img
                                                            src="{{ asset('/assets/uploads/images/product') . '/' . $p->image }}"
                                                            style="width: 150px;" />
                                                    </td>
                                                    <td>{{ $p->description }}</td>
                                                    <td>{{ $p->price }}</td>
                                                    <td>
                                                        <a class="btn bg-warning " data-toggle='modal'
                                                            id='buttonEditProduct' data-productId="{{ $p->id }}"
                                                            data-productName="{{ $p->name }}"><i
                                                                class='glyphicon glyphicon-edit'></i>
                                                        </a>
                                                        <a class="btn bg-red" data-toggle='modal' id='buttonDeleteProduct'
                                                            data-target='#deleteProduct'
                                                            data-productId="{{ $p->id }}"><i
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
    <div class="modal fade" id="modalAddProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i>Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formAddProduct">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name Product"
                                    name="name" id="name">
                                <span class="text-danger form-validate" id="nameError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="imageProduct" id="imageProduct">
                                <span class="text-danger form-validate" id="imageProductError"></span>
                                <img id="previewImageProduct" src="#" alt="your image" class="mt-3"
                                    style="display:none; width:80%;" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Description Product"
                                    name="description" id="description">
                                <span class="text-danger form-validate" id="descriptionError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input autofocus type="number" class="form-control" placeholder="Price Product"
                                    name="price" id="price">
                                <span class="text-danger form-validate" id="priceError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitAddProduct">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitAddProductLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit_product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fa fa-pencil"></span> &nbsp;&nbsp;&nbsp; <h5 class="modal-title"> Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formEditProduct">
                    <input type="hidden" class="form-control" name="productId_edit" id="id_edit">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Name Product"
                                    name="name" id="name_edit">
                                <span class="text-danger form-validate" id="nameEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="imageProductEdit"
                                    id="imageProductEdit">
                                <span class="text-danger form-validate" id="imageProductError"></span>
                                <img id="previewImageProductEdit" src="#" alt="your image" class="mt-3"
                                    style="display:none; width:80%;" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input autofocus type="text" class="form-control" placeholder="Product description"
                                    name="description" id="description_edit">
                                <span class="text-danger form-validate" id="descriptionEditError"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input autofocus type="number" class="form-control" placeholder="Product Price"
                                    name="price" id="price_edit">
                                <span class="text-danger form-validate" id="priceEditError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitEditProduct">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitEditProductLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
    <div class="modal fade" id="modal_delete_product">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fa fa-trash"></span> &nbsp;&nbsp;&nbsp; <h5 class="modal-title"> Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form type="POST" enctype="multipart/form-data" id="formDeleteProduct">
                    <input type="hidden" class="form-control" name="productId_delete" id="id_delete">
                    <input type="hidden" class="form-control" name="name_delete" id="name_delete">
                    <input type="hidden" class="form-control" name="imageProductDelete" id="imageProductDelete">
                    <div class="modal-body">
                        <p id="deleteConfirmationMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                        <div id="divBtnSubmitDeleteProduct">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div id="divBtnSubmitDeleteProductLoading" style="display: none;">
                            <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        imageProduct.onchange = evt => {
            previewImageProduct = document.getElementById('previewImageProduct');
            previewImageProduct.style.display = 'block';
            const [file] = imageProduct.files
            if (file) {
                previewImageProduct.src = URL.createObjectURL(file)
            }
        }
        // edit
        imageProductEdit.onchange = evt => {
            previewImageProductEdit = document.getElementById('previewImageProductEdit');
            previewImageProductEdit.style.display = 'block';
            const [file] = imageProductEdit.files
            if (file) {
                previewImageProductEdit.src = URL.createObjectURL(file)
            }
        }
    </script>
    @push('scripts')
        {{-- add --}}
        <script>
            $(document).ready(function() {
                $('#formAddProduct').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitAddProduct").style.display = "none";
                    document.getElementById("divBtnSubmitAddProductLoading").style.display = "block";
                    var name = $("#name").val();
                    var image = $("#imageProduct").val();
                    var description = $("#description").val();
                    var price = $("#price").val();

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
                    // if (image.length == 0 || image == "") {
                    //     $('#imageProductError').text("Image is required");
                    //     $('#imageProduct').addClass('form-error');
                    //     validation++;
                    // } else {
                    //     $('#imageProductError').text("");
                    //     $('#imageProduct').removeClass('form-error');
                    // }
                    if (description.length == 0 || description == "") {
                        $('#descriptionError').text("description is required");
                        $('#description').addClass('form-error');
                        validation++;
                    } else {
                        $('#descriptionError').text("");
                        $('#description').removeClass('form-error');
                    }
                    if (price.length == 0 || price == "") {
                        $('#priceError').text("Price is required");
                        $('#price').addClass('form-error');
                        validation++;
                    } else {
                        $('#priceError').text("");
                        $('#price').removeClass('form-error');
                    }
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitAddProduct").style.display = "block";
                        document.getElementById("divBtnSubmitAddProductLoading").style.display = "none";
                        return false;
                    }
                    //end validation

                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('product.add') }}",
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
                                    text: 'Product success insert. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Insert Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitAddProduct").style
                                        .display = "block";
                                    document.getElementById("divBtnSubmitAddProductLoading")
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
                                document.getElementById("divBtnSubmitAddProduct").style
                                    .display = "block";
                                document.getElementById("divBtnSubmitAddProductLoading")
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
            $(document).on('click', '#buttonEditProduct', function(event) {
                event.preventDefault();
                var productId = $(this).attr('data-productId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('product.data') }}",
                    data: {
                        id: productId
                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_edit').val(result.id);
                        $('#name_edit').val(result.name);
                        $('#price_edit').val(result.price);
                        $('#description_edit').val(result.description);
                        $('#image_edit').val(result.image);
                        // Display the image preview
                        var previewImageProductEdit = $('#previewImageProductEdit');
                        previewImageProductEdit.attr('src',
                            "{{ asset('/assets/uploads/images/product/') }}/" + result.image);
                        previewImageProductEdit.show();

                        $('#modal_edit_product').modal("show");
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
                $('#formEditProduct').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitEditProduct").style.display = "none";
                    document.getElementById("divBtnSubmitEditProductLoading").style.display = "block";
                    var productId_edit = $("#id_edit").val();
                    var name = $("#name_edit").val();
                    // var image = $("#imageProductEdit").val();
                    var description = $("#description_edit").val();
                    var price = $("#price_edit").val();

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

                    if (description.length == 0 || description == "") {
                        $('#descriptionEditError').text("description is required");
                        $('#description_edit').addClass('form-error');
                        validation++;
                    } else {
                        $('#descriptionEditError').text("");
                        $('#description_edit').removeClass('form-error');
                    }

                    if (price.length == 0 || price == "") {
                        $('#priceEditError').text("Price is required");
                        $('#price_edit').addClass('form-error');
                        validation++;
                    } else {
                        $('#priceEditError').text("");
                        $('#price_edit').removeClass('form-error');
                    }
                    console.log(validation);
                    if (validation > 0) {
                        document.getElementById("divBtnSubmitEditProduct").style.display = "block";
                        document.getElementById("divBtnSubmitEditProductLoading").style.display = "none";
                        return false;
                    }
                    //end validation
                    $.ajax({
                        url: "{{ route('product.edit') }}",
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
                                    title: 'Success Update Product',
                                    text: 'success Update product. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Insert Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitEditProduct").style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitEditProductLoading")
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
                                document.getElementById("divBtnSubmitEditProduct").style
                                    .display = "none";
                                document.getElementById("divBtnSubmitEditProductLoading")
                                    .style.display = "block";
                            });
                        }
                    });
                });
            });
        </script>
        {{-- delete --}}
        <script>
            $(document).on('click', '#buttonDeleteProduct', function(event) {
                event.preventDefault();
                var productId = $(this).attr('data-productId');
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('product.data') }}",
                    data: {
                        id: productId

                    },
                    beforeSend: function() {
                        $('#preloader').show();
                    },
                    success: function(result) {
                        $('#id_delete').val(result.id);
                        $('#name_delete').val(result.name);
                        $('#imageProductDelete').val(result.image);
                        $('#modal_delete_product').modal("show");
                        $('#deleteConfirmationMessage').html(
                            "<p>Are you sure you want to delete the product <b>'" +
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
                $('#formDeleteProduct').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData($(this)[0]);
                    document.getElementById("divBtnSubmitDeleteProduct").style.display = "none";
                    document.getElementById("divBtnSubmitDeleteProductLoading").style.display = "block";
                    var productId_edit = $("#id_edit").val();
                    var name_delete = $("#name_delete").val();
                    var imageProductDelete = $("#imageProductDelete").val();

                    let validation = 0;
                    //validation
                    $.ajax({
                        url: "{{ route('product.delete') }}",
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
                                    title: 'Success Delete Product',
                                    text: 'success Delete product. .',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Delete Failed!',
                                    text: response.message
                                }).then(function() {
                                    document.getElementById("divBtnSubmitDeleteProduct")
                                        .style
                                        .display = "block";
                                    document.getElementById(
                                            "divBtnSubmitDeleteProductLoading")
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
                                document.getElementById("divBtnSubmitDeleteProduct").style
                                    .display = "none";
                                document.getElementById("divBtnSubmitDeleteProductLoading")
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
