<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Domain;
use Cloudflare\API\Endpoints\Zones;

class SyncController extends Controller
{
    public function sync()
    {
        $accounts = Account::all();
        foreach ($accounts as $account) {
            $api_key = $account->api_key;

            $key = new \Cloudflare\API\Auth\APIToken($api_key);
            $adapter = new \Cloudflare\API\Adapter\Guzzle($key);
            $zones = new Zones($adapter);

            $page = 1;
            $perPage = 50;
            $totalPages = 1;
            while ($totalPages >= $page) {
                $list = $zones->listZones('', '', $page, $perPage);
                foreach ($list->result as $zone) {

                    $domain = new Domain();
                    $domain->name = $zone->name;
                    $domain->account_id = $account->id;
                    $domain->domain_id = $zone->id;
                    try {
                        $domain->saveOrFail();
                    } catch (\Throwable $e) {
                        $domain->update();
                    }
                }
                $totalPages = $list->result_info->total_pages;
                $page++;
            }
        }
    }
}

