@extends('master')
@section('main_content') 
  <div class="container"> 
    <div class="row">  
      <div class="col-md-8">
        <div id="error_message"></div> 
        <div id="success_message"> </div>
        <div class="card"  style="margin-top:120px; box-shadow: 0px 0px 3px 0px #e4e2e2; background-color:#8080800a;"> 
          <div class="card-body">
            <h3 class="text-center" style="margin-top:20px; color:blue;">{{$page_title}}</h3> 
            &nbsp;&nbsp;&nbsp;
             
          </div> 
        </div> 
      </div>  
    </div> 
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script> 
@stop

