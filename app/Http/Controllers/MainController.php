<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables; 
use Carbon\Carbon; 
use App\Category;
use App\Exam;

class MainController extends Controller
{
    public function allExam(){  
    	$data['page_title']='All Exam';   
    	$data['category'] = Category::where('is_deleted', NULL)->orderBy('name','asc')->get();  
    	return view('all_question',$data);
  	}

  	public function allExamQuestion(Request $request){ 
    	$category = Category::where('is_deleted', NULL)->where('id',$request->id)->first();    
    	$question = Exam::where('is_deleted', NULL)->where('category',$category->id)->get();  
      return response()->json(['question' => $question]); 
  	}
}
