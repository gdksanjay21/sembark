<?php

namespace App\Repositories\Member;

interface MemberRepositoryInterface
{
    public function getFilteredUrls($count, $request);
    public function storeShortUrl($data);
}
