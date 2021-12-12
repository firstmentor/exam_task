@extends('master')
@section('main_content') 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-2">
        @include('side_bar')
      </div> 
      <div class="col-md-1"></div>
      <div class="col-md-8">
        <div id="error_message"></div> 
        <div id="success_message"> </div>
        <div class="card"  style="margin-top:120px; box-shadow: 0px 0px 3px 0px #e4e2e2; background-color:#8080800a;"> 
          <div class="card-body">
            <h3 class="text-center" style="margin-top:20px; color:blue;">{{$page_title}}</h3> 
            &nbsp;&nbsp;&nbsp;
            @include('message_page')  
            <form id="formSubmit">  
              <div class="form-group">
                @if(isset($category->id))
                <input type="hidden" name="id", id="id" value="{{$category->id}}"> 
                @endif
                <label>Category Name</label> 
                @if(isset($category->name))
                <input type="text" class="form-control" name="name" placeholder="Category Name" id="name" value="{{$category->name}}">
                @else
                <input type="text" class="form-control" name="name" placeholder="Category Name" id="name" value="">

                @endif 
              </div> 
              <br> 
              <button type="submit" class="btn btn-info">Submit</button>  
            </form>
          </div> 
        </div> 
      </div>  
    </div> 
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
  <script>
    $('#formSubmit').on('submit',function(event){ 
      event.preventDefault();
      var name = $('#name').val();  
      var id = $('#id').val();  
      if(name == "") {
        $("#error_message").show().html('<div class="alert alert-dismissable" id="success_message" style="margin-top: 20px; color:white; background-color:blue;">'+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+'category name is required'+'</div>');
        setTimeout(function(){ $('#error_message').hide(); }, 1700);  
      }else {
        $.ajax({
          url: "{{ url('/submit-category') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            name:name,
            id:id
          },
          cache : false,
          success:function(success){ 
            if(success !=  null){  
              document.getElementById("formSubmit").reset();   
              $('#success_message').show().html('<div class="alert alert-dismissable" id="success_message" style="margin-top: 20px; color:white; background-color:blue;">'+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+ success.msg +'</div>');
              setTimeout(function(){ $('#success_message').hide(); }, 1700);  
              if(success.id !=  null){  
                window.setTimeout(() => {
                  window.location.reload(true);
                }, 1800);
              }
            }else{

            }
          }
        });
      }
    }); 
  </script> 
@stop

