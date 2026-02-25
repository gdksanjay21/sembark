<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Member\MemberRepositoryInterface;

class MemberController extends Controller
{
    private $memberRepo;

    /**
     * 
     * @param MemberRepositoryInterface $memberRepo
     */
    public function __construct(MemberRepositoryInterface $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    /**
     * 
     * @param Request $request
     * @return html
     */
    public function index(Request $request)
    {
        $count = 2;
        $shorturls = $this->memberRepo->getFilteredUrls($count, $request);
        
        return view('member.index', compact('shorturls'));

    }
    
    public function getUrls(Request $request)
    {
        $count = 10;
        $shorturls = $this->memberRepo->getFilteredUrls($count, $request);
        
        return view('member.shorturls', compact('shorturls'));
    }
    
    public function generateUrls()
    {
        return view('member.createurl');
    }
    
    public function storeUrl(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $user = $this->memberRepo->storeShortUrl($request->all());

        if ($user) {
            return redirect('/mdashboard')->with('success', 'Short URL generated successfully');
        } else {
            return back();
        }
    }
}
