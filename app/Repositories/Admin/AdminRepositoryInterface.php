<?php

namespace App\Repositories\Admin;

interface AdminRepositoryInterface
{
    public function getCompanyTeamMembers($count, $request);
    public function getFilteredUrls($count, $request);
    public function createAdminOrMember($data);    
    public function storeShortUrl($data);
}
