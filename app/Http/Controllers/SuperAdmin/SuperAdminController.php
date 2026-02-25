<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SuperAdmin\SuperAdminRepositoryInterface;

class SuperAdminController extends Controller
{
    private $superAdminRepo;

    /**
     * 
     * @param SuperAdminRepositoryInterface $superAdminRepo
     */
    public function __construct(SuperAdminRepositoryInterface $superAdminRepo)
    {
        $this->superAdminRepo = $superAdminRepo;
    }

    /**
     * 
     * @param Request $request
     * @return html
     */
    public function index(Request $request)
    {
        $count = 2;
        $companies = $this->superAdminRepo->getCompanyDashboardData($count, $request);
        $shorturls = $this->superAdminRepo->getFilteredUrls($count, $request);
        
        return view('superadmin.index', compact('companies', 'shorturls'));

    }
    
    public function clients(Request $request)
    {
        $count = 10;
        $companies = $this->superAdminRepo->getCompanyDashboardData($count, $request);
        
        return view('superadmin.clients', compact('companies'));
    }
    
    public function getAllUrls(Request $request)
    {
        $count = 10;
        $shorturls = $this->superAdminRepo->getFilteredUrls($count, $request);
        
        return view('superadmin.shorturls', compact('shorturls'));
    }
    
    public function invite()
    {        
        return view('superadmin.create');
    }
    
    public function storeCompanyWithAdmin(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        $company = $this->superAdminRepo->createCompanyWithAdmin($request->all());

        if ($company) {
            return redirect('/dashboard')->with('success', 'Company & Admin Created');
        } else {
            return back();
        }
    }
}
