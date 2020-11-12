<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Notifications\CompanyNotification;
use App\Company;
class CompanyController extends Controller
{

    public Company $companyModel;
    public function __construct(Company $companyModel)
    {
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
        $companies = $this->companyModel->get();
        
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $company = [
            'name' => "",
            'email' => "",
            'website' => ""
        ];
        return view('company.create', ['company' => (object) $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = $this->companyModel->create($request->except(['_token', 'logo']));
        $path = $request->logo->store('images','public');
        $company->logo = $path;
        $company->save();
        $company->notify(new CompanyNotification);
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
    public function edit(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $this->companyModel->where('id', $id)->update($request->except(['_token', '_method', 'logo']));
        if($request->has('logo')) {
            $path = $request->logo->store('public/images');
            $company->logo = $path;
            $company->save();
        }
        return redirect()->back()->with('success_msg', "Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->delete()) {
            return redirect()->back()->with('success_msg', 'Company Successfully Deleted!');
        }
    }
}
