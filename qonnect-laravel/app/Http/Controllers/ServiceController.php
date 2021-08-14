<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index(){
        // Eloquent 
        // $departments=Department::all();
        $services=Service::paginate(5);
        // Query Builder 
        
        return view('admin.service.index',compact('services'));
    }

    public function store(Request $request){
        // dd($request->department_name);
        //validation
        $request->validate(
            [
                'service_name'=>'required|unique:services|max:255',
                'service_image'=>'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required'=>'กรุณาป้อนชื่อภาพ',
                'service_name.unique'=>'ชื่อซ้ำ',
                'service_name.max'=>'ห้ามป้อนชื่อเกิน 255 อักษร',
                'service_image.required'=>'ใส่ภาพประกอบ'
            ]
        );
        //encrypt image
        $services_image = $request->file('service_image');
        // dd($services_image);

        // Generate img name
        $name_gen = hexdec(uniqid()); 

        // img Extension
        $img_ext = strtolower($services_image->getClientOriginalExtension());
        $img_name = $name_gen .".". $img_ext;

        // Upload and Save
        $upload_location = 'image/service/';
        $full_path = $upload_location.$img_name;

        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now()
        ]);
        // upload
        $services_image->move($upload_location,$img_name);

        return redirect()->back()->with('success',"บันทึกข้อมูลสำเร็จ");
    }

    public function edit($id){
        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'service_name'=>'required|max:255',
                'service_image'=>'mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required'=>'กรุณาป้อนชื่อภาพ',
                'service_name.max'=>'ห้ามป้อนชื่อเกิน 255 อักษร',
            ]
        );
        //encrypt image
        $services_image = $request->file('service_image');

        // update name and image
        if($services_image){
            // Generate img name
            $name_gen = hexdec(uniqid()); 

            // img Extension
            $img_ext = strtolower($services_image->getClientOriginalExtension());
            $img_name = $name_gen .".". $img_ext;
            
            // Upload and Save
            $upload_location = 'image/service/';
            $full_path = $upload_location.$img_name;

            Service::find($id)->update([
                'service_name'=>$request->service_name,
                'service_image'=>$full_path,
                'updated_at'=>Carbon::now()
            ]);

            // delete old one and up the new one
            $old_image = $request->old_image;
            unlink($old_image); // delete old image
            // upload new one
            $services_image->move($upload_location,$img_name);

            return redirect()->route('services')->with('success',"อัพเดตข้อมูลสำเร็จ");
        }
        else{
            Service::find($id)->update([
                'service_name'=>$request->service_name,
                'updated_at'=>Carbon::now()
            ]);
            return redirect()->route('services')->with('success',"อัพเดตข้อมูลสำเร็จ");
        }      
    }

    public function destroy($id){
        // delete image
        $image = Service::find($id)->service_image;
        unlink($image);

        // Delete date from database
        $destroy = Service::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรสำเร็จ!!!");
    }

}
