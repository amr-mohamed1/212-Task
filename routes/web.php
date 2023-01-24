<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Companies Routes
|--------------------------------------------------------------------------
*/
Route::resource('company',CompanyController::class);
Route::get('/companies/all', [CompanyController::class, 'getCompaniesDatatable'])->name('companies.all');
Route::Post('/companies/delete', [CompanyController::class, 'delete'])->name('companies.delete');



/*
|--------------------------------------------------------------------------
| Employees Routes
|--------------------------------------------------------------------------
*/
Route::resource('employee',EmployeeController::class);
Route::get('/employees/all', [EmployeeController::class, 'getEmployeesDatatable'])->name('employees.all');
Route::Post('/employees/delete', [EmployeeController::class, 'delete'])->name('employees.delete');



/*
|--------------------------------------------------------------------------
| Company Employees Route
|--------------------------------------------------------------------------
*/
Route::get('/companyEmployeesView/', [CompanyController::class, 'company_employees_view'])->name('all_company_employees');
Route::get('/companyEmployeesByID/{id}', [CompanyController::class, 'company_employees_view'])->name('company_employees_view');
Route::get('/companyEmployeesView/all/{id?}', [CompanyController::class, 'company_employees'])->name('company_employees');

