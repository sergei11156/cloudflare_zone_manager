<?php

namespace App\Actions;

use App\Models\Account;
use App\Models\Domain;
use Cloudflare\API\Endpoints\Zones;

class SyncCloudflareDomainsAction
{


    public function handle()
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
                    Domain::updateOrCreate(['domain_id' => $zone->id], ['name' => $zone->name, 'account_id' => $account->id]);
                }
                $totalPages = $list->result_info->total_pages;
                $page++;
            }
        }

        return Domain::all();
    }
}
