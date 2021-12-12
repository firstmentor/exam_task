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
        <div class="card"  style="margin-top:20px; box-shadow: 0px 0px 3px 0px #e4e2e2; background-color: #8080800a;"> 
          <div class="card-body">
            <h3 class="text-center" style="margin-top:20px; color:blue;">{{$page_title}}</h3> 
            &nbsp;&nbsp;&nbsp;
            @include('message_page')  
            <form id="formSubmit">  
              @if(isset($question->id))
                <input type="hidden" name="id", id="id" value="{{$question->id}}"> 
              @endif
              <div class="form-group"> 
                <label>Category</label> 
                @if(isset($question->category))
                  <select class="form-control" name="category" id="category">
                    <option>select</option>
                    @foreach($category as $categories)
                    <option value="{{$categories->id}}" @if($categories->id == $question->category)selected @endif>{{$categories->name}}</option>
                    @endforeach
                  </select> 
                @else
                  <select class="form-control" name="category" id="category">
                    <option>select</option>
                    @foreach($category as $categories)
                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                    @endforeach
                  </select> 
                @endif 
              </div> 
              <div class="form-group"> 
                <label>Question</label> 
                @if(isset($question->question))
                <input type="text" class="form-control" name="question" placeholder="Question" id="question" value="{{$question->question}}">
                @else
                <input type="text" class="form-control" name="question" placeholder="Question" id="question" value=""> 
                @endif 
              </div> 
              <div class="form-group"> 
                <label>Option No. 1</label> 
                @if(isset($question->option_no_one))
                <input type="text" class="form-control" name="option_no_one" placeholder="Option No. 1" id="option_no_one" value="{{$question->option_no_one}}">
                @else
                <input type="text" class="form-control" name="option_no_one" placeholder="Option No. 1" id="option_no_one" value=""> 
                @endif 
              </div> 
              <div class="form-group"> 
                <label>Option No. 2</label> 
                 @if(isset($question->option_no_two))
                <input type="text" class="form-control" name="option_no_two" placeholder="Option No. 2" id="option_no_two" value="{{$question->option_no_two}}">
                @else
                <input type="text" class="form-control" name="option_no_two" placeholder="Option No. 2" id="option_no_two" value=""> 
                @endif 
              </div> 
              <div class="form-group"> 
                <label>Option No. 3</label> 
                 @if(isset($question->option_no_three))
                <input type="text" class="form-control" name="option_no_three" placeholder="Option No. 3" id="option_no_three" value="{{$question->option_no_three}}">
                @else
                <input type="text" class="form-control" name="option_no_three" placeholder="Option No. 3" id="option_no_three" value=""> 
                @endif 
              </div> 
              <div class="form-group"> 
                <label>Option No. 4</label> 
                @if(isset($question->option_no_four))
                <input type="text" class="form-control" name="option_no_four" placeholder="Option No. 4" id="option_no_four" value="{{$question->option_no_four}}">
                @else
                <input type="text" class="form-control" name="option_no_four" placeholder="Option No. 4" id="option_no_four" value=""> 
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
      var id = $('#id').val();   
      var category = $('#category').val();  
      var question = $('#question').val();  
      var option_no_one = $('#option_no_one').val();  
      var option_no_two = $('#option_no_two').val();  
      var option_no_three = $('#option_no_three').val();  
      var option_no_four = $('#option_no_four').val();  
      if(category == "" || question == "" || option_no_one == "" || option_no_two == "" || option_no_three == "" || option_no_four == "" ) {
        $("#error_message").show().html('<div class="alert alert-dismissable" id="success_message" style="margin-top: 20px; color:white; background-color:blue;">'+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+'all field are required'+'</div>');
        setTimeout(function(){ $('#error_message').hide(); }, 1700);  
      }else {
        $.ajax({
          url: "{{ url('/submit-exam-question') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            id:id,
            category:category,
            question:question,
            option_no_one:option_no_one,
            option_no_two:option_no_two,
            option_no_three:option_no_three,
            option_no_four:option_no_four
          },
          cache : false,
          success:function(success){ 
            if(success !=  null){  
              console.log(success.msg);
              document.getElementById("formSubmit").reset();   
              $('#success_message').show().html('<div class="alert alert-dismissable" id="success_message" style="margin-top: 20px; color:white; background-color:blue;">'+'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+ success.msg +'</div>');
              setTimeout(function(){ $('#success_message').hide(); }, 1700);  
              if(success.id !=  null){  
                window.setTimeout(() => {
                  window.location.reload(true);
                }, 1800);
              }
            }else{
              //
            }
          }
        });
      }
    }); 
  </script> 
@stop

