<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use DataTables;


class CompanyController extends Controller
{

    use UploadImages;

/*
|--------------------------------------------------------------------------
| All Compaines Method
|--------------------------------------------------------------------------
*/
    public function index()
    {
        return view('companies.all_companies');
    }


/*
|--------------------------------------------------------------------------
| Data for Yajra DataTable
|--------------------------------------------------------------------------
*/
    public function getCompaniesDatatable()
    {
            $data = Company::select('*');
        return   datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';

                    $btn .= '<a href="' . Route('company.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                    $btn .= '

                        <a id="deleteButton" company-id="' . $row->id . '" class="delete btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

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

    }


/*
|--------------------------------------------------------------------------
| Store Company Method
|--------------------------------------------------------------------------
*/
    public function store(StoreCompanyRequest $request)
    {
        $path = $this->upload_img($request,'logo','companies_logos');
        if($path){
            Company::create([
                'name' => $request->name,
                'address' => $request->address,
                'logo' => $path
            ]);
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('company.index');
        }
        toastr()->error('Data hasnot been saved!');
        return redirect()->route('company.index');
    }

/*
|--------------------------------------------------------------------------
| Show Method
|--------------------------------------------------------------------------
*/
    public function show(Company $company)
    {

    }


/*
|--------------------------------------------------------------------------
| Edit Company Method
|--------------------------------------------------------------------------
*/
    public function edit($id)
    {
        $company = Company::find($id);
        if($company){
            return view('companies.edit',compact('company'));
        }
        toastr()->error('Company not found!');
        return redirect()->route('company.index');
    }


/*
|--------------------------------------------------------------------------
| Update Data Company Method
|--------------------------------------------------------------------------
*/
    public function update(StoreCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        if($company){
            $company->name = $request->name;
            $company->address = $request->address;
            $img = $request->file('logo');
            if($img == NULL){
                $company->logo = $company->logo;
                $company->save();
                toastr()->success('Data has been Updated successfully!');
                return redirect()->route('company.index');
            }
            $new_path = $this->upload_img($request,'logo','companies_logos');
            $company->logo = $new_path;
            $company->save();
            toastr()->success('Data has been Updated successfully!');
            return redirect()->route('company.index');
        }
        toastr()->error('Company not found!');
        return redirect()->route('company.index');
    }


/*
|--------------------------------------------------------------------------
| Destroy Method
|--------------------------------------------------------------------------
*/
    public function destroy(Company $company)
    {

    }



/*
|--------------------------------------------------------------------------
| delete Method - Take Request not $id like destory
|--------------------------------------------------------------------------
*/
    public function delete(Request $req)
    {
        $company = Company::findOrFail($req->id);
        if($company){
            $company->delete();
            toastr()->warning('Company has been deleted successfully!');
            return redirect()->route('company.index');
        }
        toastr()->error('Company not found!');
        return redirect()->route('company.index');
    }



/*
|--------------------------------------------------------------------------
| Return All Employess And There Company Method
|--------------------------------------------------------------------------
*/
    public function company_employees_view($company_id=null){
        return view('companies.company_employees',compact('company_id'));
    }


/*
|--------------------------------------------------------------------------
| company_employees Method
|--------------------------------------------------------------------------
*/
    public function company_employees($company_id=null){
        if($company_id){
            $employees = Company::find($company_id)->Employee;
        }else{
            $employees = Employee::all();
        }

        return datatables()->of($employees)
            ->addIndexColumn()
            ->make(true);
    }


}
