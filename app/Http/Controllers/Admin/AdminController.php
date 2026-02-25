<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepositoryInterface;

class AdminController extends Controller
{
    private $adminRepo;

    /**
     * 
     * @param AdminRepositoryInterface $adminRepo
     */
    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    /**
     * 
     * @param Request $request
     * @return html
     */
    public function index(Request $request)
    {
        $count = 2;
        $users = $this->adminRepo->getCompanyTeamMembers($count, $request);
        $shorturls = $this->adminRepo->getFilteredUrls($count, $request);
        
        return view('admin.index', compact('users', 'shorturls'));

    }
    
    public function members(Request $request)
    {
        $count = 10;
        $users = $this->adminRepo->getCompanyTeamMembers($count, $request);
        
        return view('admin.users', compact('users'));
    }
    
    public function memberInvite()
    {        
        return view('admin.create');
    }
    
    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ]);

        $user = $this->adminRepo->createAdminOrMember($request->all());

        if ($user) {
            return redirect('/adashboard')->with('success', 'Team member created successfully');
        } else {
            return back();
        }
    }
    
    public function getUrls(Request $request)
    {
        $count = 10;
        $shorturls = $this->adminRepo->getFilteredUrls($count, $request);
        
        return view('admin.shorturls', compact('shorturls'));
    }
    
    public function generateUrls()
    {
        return view('admin.createurl');
    }
    
    public function storeUrl(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $user = $this->adminRepo->storeShortUrl($request->all());

        if ($user) {
            return redirect('/adashboard')->with('success', 'Short URL generated successfully');
        } else {
            return back();
        }
    }
}
