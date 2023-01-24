<?php

namespace App\Http\Controllers;

use App\Events\RegisterEmployee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use UploadImages;

/*
|--------------------------------------------------------------------------
| All Employees Method
|--------------------------------------------------------------------------
*/
    public function index()
    {
        return view('employees.all_employees');
    }


/*
|--------------------------------------------------------------------------
| Data for Yajra DataTable
|--------------------------------------------------------------------------
*/
    public function getEmployeesDatatable()
    {
        $data = Employee::select('*');
        return   datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';

                $btn .= '<a href="' . Route('employee.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '

                        <a id="deleteButton" employee-id="' . $row->id . '" class="delete btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


/*
|--------------------------------------------------------------------------
| Create View Method
|--------------------------------------------------------------------------
*/
    public function create()
    {
        //
    }


/*
|--------------------------------------------------------------------------
| Store Employee Method
|--------------------------------------------------------------------------
*/
    public function store(StoreEmployeeRequest $request)
    {
        $path = $this->upload_img($request,'img','employees_images');
        if($path){
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $request->company,
                'image' => $path,
            ]);

            if($employee){
                event(new RegisterEmployee($employee));
            }

            toastr()->success('Employess has been saved successfully!');
            return redirect()->route('employee.index');
        }
        toastr()->error('Employess hasnot been saved!');
        return redirect()->route('employee.index');
    }



/*
|--------------------------------------------------------------------------
| Show Method
|--------------------------------------------------------------------------
*/
    public function show(Employee $employee)
    {

    }


/*
|--------------------------------------------------------------------------
| Edit Employee Method
|--------------------------------------------------------------------------
*/
    public function edit($id)
    {
        $employee = Employee::find($id);
        if($employee){
            return view('employees.edit',compact('employee'));
        }
        toastr()->error('Employee not found!');
        return redirect()->route('employee.index');
    }


/*
|--------------------------------------------------------------------------
| Update Data Employee Method
|--------------------------------------------------------------------------
*/
    public function update(StoreEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        if($employee){
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->password = $request->password;
            $employee->company_id = $request->company;
            $img = $request->file('img');
            if($img == NULL){
                $employee->image = $employee->image;
                $employee->save();
                toastr()->success('Employee has been Updated successfully!');
                return redirect()->route('employee.index');
            }
            $new_path = $this->upload_img($request,'img','employees_images');
            $employee->image = $new_path;
            $employee->save();
            toastr()->success('Employee has been Updated successfully!');
            return redirect()->route('employee.index');
        }
        toastr()->error('Employee not found!');
        return redirect()->route('employee.index');
    }


/*
|--------------------------------------------------------------------------
| Destroy Method
|--------------------------------------------------------------------------
*/
    public function destroy(Employee $employee)
    {

    }


/*
|--------------------------------------------------------------------------
| delete Method - Take Request not $id like destory
|--------------------------------------------------------------------------
*/
    public function delete(Request $req)
    {
        $employee = Employee::findOrFail($req->id);
        if($employee){
            $employee->delete();
            toastr()->warning('Employee has been deleted successfully!');
            return redirect()->route('employee.index');
        }
        toastr()->error('Employee not found!');
        return redirect()->route('employee.index');
    }

}
