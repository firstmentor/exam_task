<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables; 
use Carbon\Carbon; 
use App\Category;
use App\Exam;

class ExamController extends Controller
{
  public function addExam(){
  	$data['page_title']='Add Exam';  
  	$data['category'] = Category::where('is_deleted', NULL)->orderBy('name','asc')->get();  
  	return view('add_question',$data);
	}

	public function examStore(Request $request){ 
    $exam = Exam::findOrNew($request->id);   
    $exam->category=isset($request->category)?$request->category:$exam->category; 
    $exam->question=isset($request->question)?$request->question:$exam->question; 
    $exam->option_no_one=isset($request->option_no_one)?$request->option_no_one:$exam->option_no_one; 
    $exam->option_no_two=isset($request->option_no_two)?$request->option_no_two:$exam->option_no_two; 
    $exam->option_no_three=isset($request->option_no_three)?$request->option_no_three:$exam->option_no_three; 
    $exam->option_no_four=isset($request->option_no_four)?$request->option_no_four:$exam->option_no_four;  
    $exam->save();
    if(!empty($request->id)){
      return response()->json(['exam' => $exam, 'msg' => 'exam update successfully','id' => $request->id]);
    }else{ 
      return response()->json(['exam' => $exam, 'msg' => 'exam add successfully']);
    }
  }

  public function editExam($id){
  	$data['page_title']='Edit Exam';  
  	$data['category'] = Category::where('is_deleted', NULL)->orderBy('name','asc')->get();   
  	$data['question'] = Exam::where('is_deleted', NULL)->where('id',$id)->first();  
  	return view('add_question',$data);
	}

	public function examView(){ 
		$data['page_title']='View Exam';   
		return view('view_question',$data);
	} 

	public function examViewList(){
		$exam = Exam::where('is_deleted', NULL)->get(); 
		$data = Datatables::of($exam)
		->addColumn(
			'action',
			function($row) { 
				$string = '<a style="margin: 1px;" href="edit-exam/'.$row->id.'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> ';  
				$string .= '<a style="margin: 1px;" href="delete-exam/'.$row->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
				return $string;
			}
		) 
		->editColumn( 
      'category',
      function ($row) { 
        $category = Category::where('id', $row->category)->first();  
        if(!empty($category)){
          return  $category->name;
        } 
      }
    )
		->editColumn(
			'created_at',
			function ($row) {
				return Carbon::parse($row->created_at)->formatLocalized('%b %d, %Y');
			}
		)  
		->make(true);
		return $data; 
	}  

  public function destroy($id){
    Exam::where('id',$id)->update([
      'is_deleted' => 1,
      'deleted_at' => carbon::now()
    ]);   
    return back()->with('msg','Exam Delete  Successfully'); 
  } 
}
