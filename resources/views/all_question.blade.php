@extends('master')
@section('main_content') 
  <?php $question = DB::table('exams')->where('is_deleted', NULL)->get(); ?>         
  <style>
    body {
      font-family: "Lato", sans-serif;
    }

    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color:#8080800a; 
      padding-top: 20px;
      box-shadow: 2px 0px 3px 2px #e4e2e2; 
    }

    .sidenav a {
      padding: 6px 8px 6px 50px;
      text-decoration: none;
      font-size: 20px;
      color: black;
      display: block;
    } 
    .main {
      margin-left: 160px; /* Same as the width of the sidenav */
      font-size: 28px; /* Increased text to enable scrolling */
      padding: 0px 10px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
  </style>
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-2"> 
        <div class="sidenav">
          @foreach($category as $categories)
          <a href="#" id="all_question_{{$categories->id}}"  onclick="hello({{$categories->id}})"  value="5">{{$categories->name}}</a>
          @endforeach  
        </div>   
      </div> 
      <div class="col-md-1"></div>  
      <div class="col-md-8" style="margin-top:20px;">
        <h2 class="text-center" style="color:blue;">All Question</h2><br>
        <div id="exam_show">
        </div>
      </div>
    </div> 
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
  <script> 
    function hello(count){  
      var id = count;  
      $.ajax({
        url: "{{ url('/all-exam-question') }}",
        type:"post",
        data:{
          "_token": "{{ csrf_token() }}",
          id:id, 
        },
        cache : false,
        success:function(data){   
         count_num = 1;
         var QD = JSON.parse(JSON.stringify(data.question));
         var question_answer = ''; 
         if(data.question != ''){    
          $.each(QD, function( index, value ) {
            question_answer +=  '<h6 style="color:blue; text-align:justify; font-size:20px; text-transform:uppercase;"><b>Q.'+ count_num + '&nbsp;&nbsp;' + value.question + '?</b></h6><br><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">A.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_one + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">B.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_two + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">C.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_three + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">D.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_four + '</p>';  
            count_num++; 
          });   
          
          $('#exam_show').show(); 
          $('#exam_show').html(question_answer); 
        }else{   
          //$('#exam_show').hide(); 
          $('#exam_show').html('<h3 style="color:blue; text-align:center; font-size:20px; text-transform:uppercase; margin-top:200px;"><b>Question Not Added In That Category</b></h3>'); 
        }
      }
    });  
    }; 

    window.onload = function () {
    count_num = 1;  
      var question = <?php echo json_encode($question); ?>;   
      var QD = JSON.parse(JSON.stringify(question));
         var question_answer = ''; 
         if(question != ''){    
          $.each(QD, function( index, value ) {
            question_answer +=  '<h6 style="color:blue; text-align:justify; font-size:20px; text-transform:uppercase;"><b>Q.'+ count_num + '&nbsp;&nbsp;' + value.question + '?</b></h6><br><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">A.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_one + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">B.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_two + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">C.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_three + '</p><p style="padding-left:20px; font-size:15px; text-transform:uppercase;">D.&nbsp; <input type="radio"  name="answer_option">&nbsp;&nbsp;' + value.option_no_four + '</p>';   
             count_num++;
          });   
         
          $('#exam_show').show(); 
          $('#exam_show').html(question_answer); 
        }else{   
          $('#exam_show').html('<h3 style="color:blue; text-align:center; font-size:20px; text-transform:uppercase; margin-top:200px;"><b>Question Not Added In That Category</b></h3>'); 
        }
    }; 
  </script> 
@stop

