<?php

namespace App\Repositories\SuperAdmin;

interface SuperAdminRepositoryInterface
{
    public function getCompanyDashboardData($count, $request);
    public function getFilteredUrls($count, $request);
    public function createCompanyWithAdmin($data);
}
