<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Category;
use Yajra\DataTables\Facades\DataTables; 
use Carbon\Carbon;


class CategoryController extends Controller
{	 
  public function addCategory(){
    $data['page_title']='Add Category';  
    return view('add_categories',$data);
  }

  public function editCategory($id){
    $data['page_title']='Edit Category';  
    $data['category'] = Category::where('id',$id)->where('is_deleted', NULL)->first();  
    return view('add_categories',$data);
  }


  public function store(Request $request){ 
    $category = Category::findOrNew($request->id);   
    $category->name=isset($request->name)?$request->name:$category->name;  
    $category->save();
    if(!empty($request->id)){
      return response()->json(['category' => $category, 'msg' => 'category update successfully','id' => $request->id]);
    }else{ 
      return response()->json(['category' => $category, 'msg' => 'category add successfully']);
    }
  }

  public function categoryView(){ 
    $data['page_title']='View Category';   
    return view('view_categories',$data);
  } 
  
  public function categoryViewList(){
    $users = Category::where('is_deleted', NULL)->get(); 
    $data = Datatables::of($users)
    ->addColumn(
      'action',
      function($row) {
        // Edit Button
        $string = '<a style="margin: 1px;" href="edit-category/'.$row->id.'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> '; 
        // Delete Button 
        $string .= '<a style="margin: 1px;" href="delete-category/'.$row->id.'"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
        return $string;
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
    Category::where('id',$id)->update([
      'is_deleted' => 1,
      'deleted_at' => carbon::now()

    ]);   
    return back()->with('msg','Category Delete Successfully'); 
  }
}
