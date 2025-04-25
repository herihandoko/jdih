<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\Admin\ApiLink;

class ApiQuery
{
    protected $baseUrls;

    public function __construct()
    {
        $this->baseUrls = ApiLink::where('api_active', 1)->get();
    }

    public function fetchResults(array $params, $instansiId = null): Collection
    {
        $apiResults = collect();
        
        if ($instansiId != null) {
            $this->baseUrls = ApiLink::where('id', $instansiId)->where('api_active', 1)->get();
        }

        foreach ($this->baseUrls as $baseUrl) {
            
            $response = Http::get($baseUrl->api_url);

            if ($response->successful()) {
                $apiData = collect($response->json())->map(function ($item) use ($baseUrl) {
                    $item['api_name'] = $baseUrl->api_name;
                    return new ApiResult($item);
                });
                
                // Filter data di sini jika API tidak mendukung filter pencarian
                $filteredData = $apiData->filter(function ($item) use ($params) {
                    foreach ($params as $key => $value) {
                        if (!empty($value)) {
                            // Lakukan pengecekan eksplisit
                            $itemValue = $item->$key;
                            if ($itemValue === null || stripos($itemValue, $value) === false) {
                                return false;
                            }
                        }
                    }
                    return true;
                });

                $apiResults = $apiResults->concat($filteredData);
            }
        }

        return $apiResults;
    }
}