<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Filters\SuperSmartFilter;
use Illuminate\Support\Facades\Log;

trait SuperFilterable
{
    public function scopeSuperFilter($query, Request $request, array $whitelist = [], array $blacklist = [])
    {
        $filter = new SuperSmartFilter($request);
        return $filter->whitelist($whitelist)->blacklist($blacklist)->apply($query);
    }
}
