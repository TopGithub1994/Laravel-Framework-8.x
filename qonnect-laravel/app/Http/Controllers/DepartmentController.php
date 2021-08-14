<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        // Eloquent 
        // $departments=Department::all();
        $departments=Department::paginate(5);
        $trashDepartments = Department::onlyTrashed()->paginate(3);
        // Query Builder 
        // $departments=DB::table('departments')->get();
        // $departments=DB::table('departments')->paginate(5);
        // $departments=DB::table('departments')
        // ->join('users','departments.user_id','users.id')
        // ->select('departments.*','users.name')->paginate(5);
        
        return view('admin.department.index',compact('departments','trashDepartments'));
    }

    public function store(Request $request){
        // dd($request->department_name);
        //validation
        $request->validate(
            [
                'department_name'=>'required|unique:departments|max:255'
            ],
            [
                'department_name.required'=>'กรุณาป้อนชื่อแผนก',
                'department_name.unique'=>'ชื่อซ้ำ',
                'department_name.max'=>'ห้ามป้อนชื่อเกิน 255 อักษร'
            ]
        );
        //Save Data - Eloquent 
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ");

        //Save Data - Query Builder 
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;
        
        // DB::table('departments')->insert($data);
        // return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ");
    }

    public function edit($id){
        $department = Department::find($id);
        // dd($department->department_name);
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request, $id){
        // dd($id, $request->department_name);
        $request->validate(
            [
                'department_name'=>'required|unique:departments|max:255'
            ],
            [
                'department_name.required'=>'กรุณาป้อนชื่อแผนก',
                'department_name.unique'=>'ชื่อซ้ำ',
                'department_name.max'=>'ห้ามป้อนชื่อเกิน 255 อักษร'
            ]
        );
        $update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);
        return redirect()->route('department')->with('success',"อัพเดตข้อมูลสำเร็จ");
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลสำเร็จ");
    }

    public function restore($id){
        $restore = Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',"กู้คืนข้อมูลสำเร็จ");
    }

    public function destroy($id){
        $destroy = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรสำเร็จ!!!");
    }
}
