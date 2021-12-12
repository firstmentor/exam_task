@extends('master')
@section('main_content')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="container"> 
    <div class="row">  
      <div class="col-md-2">
        @include('side_bar')
      </div> 
      <div class="col-md-10">
        @if(session('msg') != null)
        <div class="alert alert-dismissable" id="success_message" style="margin-top: 20px; color:white; background-color:blue;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{session('msg')}}</div> 
        @endif 
        <div class="card"  style="margin-top:10px; box-shadow: 0px 0px 3px 0px #e4e2e2; background-color: white !important;"> 
          <div class="card-body">  
            <a href="{{url('/add-exam')}}" class="btn btn-success" style="margin-top:0px; float:right;">
              Add New Exam  &nbsp;<i class="fa fa-plus"></i>
            </a>  <br>
            <h3 class="text-center" style="margin-top:20px; color:blue;">{{$page_title}}</h3>  
            <div class="box-body ">
              <table id="courses" class="table table-striped table-bordered table-responsive">
                <thead> 
                  <tr>
                    <th>Id</th>
                    <th>Category</th> 
                    <th>Question</th> 
                    <th>Option1</th> 
                    <th>Option2</th> 
                    <th>Option3</th> 
                    <th>Option4</th>  
                    <th>Created Date</th> 
                    <th>Action</th>
                  </tr> 
                </thead> 
                <tbody>  
                  {{--Ajax Load Data Here--}}
                </tbody> 
              </table>
            </div> 
          </div>
        </div> 
      </div> 
    </div> 
  </div> 
  @section('modals')
    @include('delete')
  @endsection 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    var  table = $('#courses').dataTable({
     // "sScrollY": "100%",
      "scrollCollapse": true,
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "order": [],
      "lengthMenu": [
        [10, 15, 20, -1],
        [10, 15, 20, "All"] // change per page values here
      ],
      "ajax": "{{url('view-exam-list')}}",
      "columns": [
        {data: 'id', name: 'id'},
        {data: 'category', name: 'category'}, 
        {data: 'question', name: 'question'}, 
        {data: 'option_no_one', name: 'option_no_one'}, 
        {data: 'option_no_two', name: 'option_no_two'}, 
        {data: 'option_no_three', name: 'option_no_three'}, 
        {data: 'option_no_four', name: 'option_no_four'}, 
        {data: 'created_at', name: 'created_at'},  
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      "oLanguage": {
        "sProcessing": '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>'
      }
    }); 
  </script>
@stop

