<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Employee;
use App\Company;
class EmployeeController extends Controller
{
    public Employee $employeeModel;
    public Company $companyModel;
    public function __construct(Employee $employeeModel, Company $companyModel) 
    {
        $this->employeeModel = $employeeModel;
        $this->companyModel = $companyModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = $this->employeeModel->paginate(10);
        return view('employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employee = [
            "first_name" => "",
            "last_name" => "",
            "company_id" => "",
            "mobile_no" => "",
            "email" => "",
        ];
        $companies = $this->companyModel->get();
        return view('employee.create', ['companies' => $companies, 'employee' => (object) $employee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
       $this->employeeModel->create($request->except(['_token']));
        return redirect()->back()->with('success_msg', "Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = $this->companyModel->get();
        return view('employee.edit', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeModel->where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->back()->with('success_msg', "Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            return redirect()->back()->with('success_msg', 'Company Successfully Deleted!');
        }
    }
}
