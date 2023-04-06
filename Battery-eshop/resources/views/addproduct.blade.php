@extends('admindash')
@section('superadmin')

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2">

</div>
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-body mt-20">
                    <div class="card-title">
                        {{ __('Product Listing') }}
                        <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#CreateProductModal">
                            Add Product 
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th width="150" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="CreateProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Product added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="productForm" action="{{route('ProductUpload')}}" enctype="multipart/form-data" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="SubmitCreateProductForm">ADD</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

                </form>
            </div>      
          </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal" id="EditProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Product Edit</h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Product was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditProductModalBody">
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditProductForm">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal" id="DeleteProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Product Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Product?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteProductForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
@endsection
<script type="text/javascript">
    $(document).ready(function() {
       
        // init datatable.

        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            scrollX: true,
            "order": [[ 0, "desc" ]],
            // ajax: '{{ ('Product') }}',
            columns: [
                {data: 'p_id', name: 'id'},
                {data: 'p_Name', name: 'title'},
                {data: 'p_Price', name: 'price'},
                {data: 'p_Category', name: 'category'},
                {data: 'p_images', name: 'image'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

        // Create Product Ajax request.
        $('#SubmitCreateProductForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('Product.store') }}",
                method: 'post',
                data: {
                    title: $('#title').val(),
                    price: $('#price').val(),
                    category: $('#category').val(),
                    image: $('#image').val(),

                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateProductModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        // Get single Product in EditModel
        $('.modelClose').on('click', function(){
            $('#EditProductModal').hide();
        });
        var id;
        $('body').on('click', '#getEditProductData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "Products/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditProductModalBody').html(result.html);
                    $('#EditProductModal').show();
                }
            });
        });

        // Update Product Ajax request.
        $('#SubmitEditProductForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "Products/"+id,
                method: 'PUT',
                data: {
                    title: $('#editTitle').val(),
                    price: $('#editPrice').val(),
                    category: $('#editCategory').val(),
                    image: $('#editImage').val(),

                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#EditProductModal').hide();
                        }, 2000);
                    }
                }
            });
        });

        // Delete Product Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteProductForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "Products/"+id,
                method: 'DELETE',
                success: function(result) {
                    setInterval(function(){ 
                        $('.datatable').DataTable().ajax.reload();
                        $('#DeleteProductModal').hide();
                    }, 1000);
                }
            });
        });
    });
</script>