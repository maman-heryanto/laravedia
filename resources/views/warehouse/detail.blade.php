 @extends('templates.main')
 @extends('templates.sidebar')

 @section('content')
     <!-- page content -->
     {{-- {{ dd($warehousedtl) }} --}}
     <div class="right_col" role="main">
         <div class="">

             <div class="clearfix"></div>

             <div class="row">
                 <div class="x_panel">

                     <ul class="nav navbar-right panel_toolbox">
                         <li>
                             <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                         </li>
                         <li>
                             <a class="close-link" href="{{ Route('warehouse') }}"><i class="fa fa-close"></i></a>
                         </li>
                     </ul>
                     <div class="x_content">
                         <div class="x_title">
                             <h2>LIST PRODUCT ON WAREHOUSE </h2>

                             <div class="clearfix"></div>
                             <button type="button" class="btn btn-success" data-toggle="modal"
                                 data-target="#modalAddWarehouseProduct">
                                 <i class="fa fa-plus"></i> Warehouse Product
                             </button>
                         </div>
                         <div class="clearfix"></div>
                         {{-- <div>
                             <button type="button" class="btn btn-success" data-toggle="modal"
                                 data-target="#modalAddWarehouseProduct">
                                 <i class="fa fa-plus"></i> Warehouse Product
                             </button>
                         </div> --}}

                         @foreach ($warehousedtl as $dtl)
                             <div class="col-md-4 col-sm-4  profile_details">
                                 <div class="well profile_view">
                                     <div class="col-sm-12">
                                         <input type="hidden" value="{{ $dtl->id }}">
                                         <h4 class="brief"><i>{{ $dtl->warehouse_name }}</i></h4>
                                         <div class="left col-md-7 col-sm-7">
                                             <h2>{{ $dtl->product_name }}</h2>
                                             <p><strong>Description: </strong> {{ $dtl->product_description }}
                                             </p>

                                             <ul class="list-unstyled">
                                                 <li><i class="fa fa-cube"></i> stock: {{ $dtl->stock }}</li>
                                                 <li><i class="fa fa-map-marker"></i> address: {{ $dtl->warehouse_address }}
                                                 </li>
                                             </ul>
                                             <div class="product_price">
                                                 <span class="price-tax"><i class="fa fa-money"></i>Price:
                                                     {{ $dtl->product_price }}</span>
                                                 <br>
                                             </div>
                                         </div>
                                         <div class="right col-md-5 col-sm-5 text-center">
                                             <img src="{{ asset('assets/uploads/images/product') . '/' . $dtl->product_image }}"
                                                 alt="" class="img-circle img-fluid">
                                         </div>
                                     </div>
                                     <div class=" profile-bottom text-center">
                                         <div class=" col-sm-6 emphasis">
                                             <p class="ratings">
                                             <ul class="list-unstyled">
                                                 <li>
                                                     <i class="fa fa-calendar"></i>
                                                     {{ date('Y-m-d H:m:s', strtotime($dtl->created_at)) }}
                                                 </li>
                                             </ul>
                                             </p>
                                         </div>
                                         <div class=" col-sm-6 emphasis">
                                             <button type="button" class="btn btn-warning btn-sm" data-toggle='modal'
                                                 id='buttonEditWarehouseProduct'
                                                 data-warehouseProductId="{{ $dtl->id }}"> <i class="fa fa-edit"></i>
                                                 Edit</button>
                                             <button type="button" class="btn btn-danger btn-sm"> <i
                                                     class="fa fa-trash"></i> Delete</button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- /page content -->

     {{-- Modal add --}}
     <div class="modal fade" id="modalAddWarehouseProduct">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title"><i class="fa fa-plus"></i>Warehouse Product</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                 </div>
                 <form type="POST" enctype="multipart/form-data" id="formAddWarehouseProduct">
                     <div class="modal-body">
                         {{-- <p>{{ dd($warehouse) }}</p> --}}
                         <input type="hidden" class="form-control" name="warehouse" id="warehouse"
                             value="{{ $warehouse->id }}">
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Warehouse</label>
                             <div class="col-sm-9">
                                 <input autofocus type="text" class="form-control" value="{{ $warehouse->name }}"
                                     readonly disabled>
                                 <span class="text-danger form-validate" id="stockError"></span>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label class="control-label col-md-3 col-sm-3 ">Product</label>
                             <div class="col-md-9 col-sm-9 ">
                                 <select class="form-control" name="product" id="product">
                                     <option value="">Choose option</option>
                                     @foreach ($product as $p)
                                         <option value="{{ $p->id }}">{{ $p->name }}</option>
                                     @endforeach
                                 </select>
                                 <span class="text-danger form-validate" id="productError"></span>
                             </div>
                         </div>
                         {{-- <div class="form-group row">
                             <label class="control-label col-md-3 col-sm-3 ">Warehouse</label>
                             <div class="col-md-9 col-sm-9 ">
                                 <select class="form-control" name="warehouse" id="warehouse">
                                     <option value="">Choose option</option>
                                     @foreach ($warehouse as $w)
                                         <option value="{{ $w->id }}">{{ $w->name }}</option>
                                     @endforeach
                                 </select>
                                 <span class="text-danger form-validate" id="warehouseError"></span>
                             </div>
                         </div> --}}
                         <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Stock</label>
                             <div class="col-sm-9">
                                 <input autofocus type="number" class="form-control" placeholder="stock" name="stock"
                                     id="stock">
                                 <span class="text-danger form-validate" id="stockError"></span>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                         <div id="divBtnSubmitAddWarehouseProduct">
                             <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                         <div id="divBtnSubmitAddWarehouseProductLoading" style="display: none;">
                             <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     {{-- modal edit --}}
     <div class="modal fade" id="modal_edit_warehouseproduct">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <span class="fa fa-pencil"></span> &nbsp;&nbsp;&nbsp; <h5 class="modal-title">Edit Stock</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                 </div>
                 <form type="POST" enctype="multipart/form-data" id="formEditWarehouseProduct">
                     <input type="hidden" class="form-control" name="warehouseProductId_edit" id="id_edit">
                     <div class="modal-body">
                         <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label">Stock</label>
                             <div class="col-sm-9">
                                 <input autofocus type="text" class="form-control" placeholder="stock Warehouse"
                                     name="stock" id="stock_edit">
                                 <span class="text-danger form-validate" id="stockEditError"></span>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                         <div id="divBtnSubmitEditWarehouseProduct">
                             <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                         <div id="divBtnSubmitEditWarehouseProductLoading" style="display: none;">
                             <button class="btn btn-primary" disabled><i class="fa fa-spinner fa-spin"></i> Process
                             </button>
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
                 $('#formAddWarehouseProduct').on('submit', function(e) {
                     e.preventDefault();
                     var formData = new FormData($(this)[0]);
                     document.getElementById("divBtnSubmitAddWarehouseProduct").style.display = "none";
                     document.getElementById("divBtnSubmitAddWarehouseProductLoading").style.display = "block";
                     var product = $("#product").val();
                     var warehouse = $("#warehouse").val();
                     var stock = $("#stock").val();

                     let validation = 0;
                     //validation
                     if (product.length == 0 || product == "") {
                         $('#productError').text("Product is required");
                         $('#product').addClass('form-error');
                         validation++;
                     } else {
                         $('#productError').text("");
                         $('#product').removeClass('form-error');
                     }
                     if (warehouse.length == 0 || warehouse == "") {
                         $('#warehouseError').text("Warehouse is required");
                         $('#warehouse').addClass('form-error');
                         validation++;
                     } else {
                         $('#warehouseError').text("");
                         $('#warehouse').removeClass('form-error');
                     }

                     if (stock.length == 0 || stock == "") {
                         $('#stockError').text("Stock is required");
                         $('#stock').addClass('form-error');
                         validation++;
                     } else {
                         $('#stockError').text("");
                         $('#stock').removeClass('form-error');
                     }

                     if (validation > 0) {
                         document.getElementById("divBtnSubmitAddWarehouseProduct").style.display = "block";
                         document.getElementById("divBtnSubmitAddWarehouseProductLoading").style.display =
                             "none";
                         return false;
                     }
                     //end validation

                     e.preventDefault();
                     $.ajax({
                         url: "{{ route('warehousedtl.add') }}",
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
                                     text: 'Product warehouse success insert. .',
                                 }).then(function() {
                                     location.reload();
                                 });
                             } else {
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'Insert Failed!',
                                     text: response.message
                                 }).then(function() {
                                     document.getElementById(
                                             "divBtnSubmitAddWarehouseProduct")
                                         .style
                                         .display = "block";
                                     document.getElementById(
                                             "divBtnSubmitAddWarehouseProductLoading")
                                         .style.display = "none";
                                 });
                             }
                         },
                         error: function(response) {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Opps!',
                                 text: 'server error!'
                             }).then(function() {
                                 document.getElementById("divBtnSubmitAddWarehouseProduct")
                                     .style
                                     .display = "block";
                                 document.getElementById(
                                         "divBtnSubmitAddWarehouseProductLoading")
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
             $(document).on('click', '#buttonEditWarehouseProduct', function(event) {
                 event.preventDefault();
                 var warehouseProductId = $(this).attr('data-warehouseProductId');
                 $.ajax({
                     type: 'POST',
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     url: "{{ route('warehousedtl.data') }}",
                     data: {
                         id: warehouseProductId
                     },
                     beforeSend: function() {
                         $('#preloader').show();
                     },
                     success: function(result) {
                         $('#id_edit').val(result.id);
                         $('#stock_edit').val(result.stock);

                         $('#modal_edit_warehouseproduct').modal("show");
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
                 $('#formEditWarehouseProduct').on('submit', function(e) {
                     e.preventDefault();
                     var formData = new FormData($(this)[0]);
                     document.getElementById("divBtnSubmitEditWarehouseProduct").style.display = "none";
                     document.getElementById("divBtnSubmitEditWarehouseProductLoading").style.display = "block";
                     var warehouseProductId_edit = $("#id_edit").val();
                     var stock = $("#stock_edit").val();

                     let validation = 0;
                     //validation
                     if (stock.length == 0 || stock == "") {
                         $('#stockEditError').text("stock is required");
                         $('#stock_edit').addClass('form-error');
                         validation++;
                     } else {
                         $('#stockEditError').text("");
                         $('#stock_edit').removeClass('form-error');
                     }
                     if (validation > 0) {
                         document.getElementById("divBtnSubmitEditWarehouseProduct").style.display = "block";
                         document.getElementById("divBtnSubmitEditWarehouseProductLoading").style.display =
                             "none";
                         return false;
                     }
                     //end validation
                     $.ajax({
                         url: "{{ route('warehousedtl.edit') }}",
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
                                     title: 'Success Update Stock',
                                     text: 'success update stock. . .',
                                 }).then(function() {
                                     location.reload();
                                 });
                             } else {
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'update Failed!',
                                     text: response.message
                                 }).then(function() {
                                     document.getElementById(
                                             "divBtnSubmitEditWarehouseProduct")
                                         .style
                                         .display = "block";
                                     document.getElementById(
                                             "divBtnSubmitEditWarehouseProductLoading")
                                         .style.display = "none";
                                 });
                             }
                         },
                         error: function(response) {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Opps!',
                                 text: 'server error!'
                             }).then(function() {
                                 document.getElementById("divBtnSubmitEditWarehouseProduct")
                                     .style
                                     .display = "none";
                                 document.getElementById(
                                         "divBtnSubmitEditWarehouseProductLoading")
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
