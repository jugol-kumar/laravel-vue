<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function index()
    {
        $employes = Employee::all();
        return response()->json($employes);
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:employees',
            'phone' => 'required|unique:employees',
            'position' => 'required',
        ]);

        if ($request->photo){
            $photo = $request->photo;
            $position = strpos($photo, ';');
            $subString = substr($photo, 0,$position);
            $imageExt = explode( '/',$subString )[1];
            $imageName = time().rand(0000,9999).'.'.$imageExt;
            $resize = Image::make($photo)->resize(200, 180)->encode('jpg');
            Storage::put("public/employee/$imageName", $resize->__toString());


            $uploadPath = "storage/employee/$imageName";

            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'address' => $request->address,
                'photo' => $uploadPath,
            ]);
            return response()->json(['message' =>'Employee save with image'], 200);
        }else{
            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                $userImage = ['user.svg', 'default.png'],
                'address' => $request->address,
                'photo' => 'storage/employee/'.$userImage[array_rand($userImage, 1)],
            ]);
            return response()->json(['message' =>'Employee save without image'], 200);
        }
    }
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:employees',
            'phone' => 'required|unique:employees',
            'position' => 'required',
        ]);

        $data = $request->all();
        $data['photo']  = 'defalultUpdate.png';
        $employee->update($data);
        return response()->json(['message' =>'Employee update successfully done.'], 200);
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' =>'Employee deleted successfully done.'], 200);
    }
}
