@extends('admindash')
@section('superadmin')
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">

<div class="container">
  <form action="{{URL::to('Product_Upload') }}" enctype="multipart/form-data" method="POST">
    @csrf   
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      <label>Product-Title:</label>
      <input type="text" name="title" class="form-control" placeholder="Add Title">
    </div>
    <div class="form-group">
      <label>Product-Price:</label>
      <input type="text" name="title" class="form-control" placeholder="Add Price">
    </div>
    <div class="form-group">
      <label>Product-Category:</label>
      <input type="text" name="title" class="form-control" placeholder="Add Category">
    </div>
    <div class="form-group">
      <label>Product-Image:</label>
      <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
      <button class="btn btn-success upload-image" type="submit">Upload Image</button>
    </div>
  </form>
</div>
</div>
</div>

<script type="text/javascript">
  $("body").on("click",".upload-image",function(e){
    $(this).parents("form").ajaxForm(options);
  });
  var options = { 
    complete: function(response) 
    {
        if($.isEmptyObject(response.responseJSON.error)){
            $("input[name='title']").val('');
            alert('Image Upload Successfully.');
        }else{
            printErrorMsg(response.responseJSON.error);
        }
    }
  };
  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }
</script>
@endsection