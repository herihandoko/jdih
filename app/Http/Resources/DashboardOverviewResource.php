<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardOverviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'total_produk_hukum' => $this['total_produk_hukum'],
            'total_peraturan' => $this['total_peraturan'],
            'total_artikel' => $this['total_artikel'],
            'total_monografi' => $this['total_monografi'],
            'total_putusan' => $this['total_putusan'],
            'total_views' => $this['total_views'],
            'peraturan_tahun_ini' => $this['peraturan_tahun_ini'],
            'peraturan_bulan_ini' => $this['peraturan_bulan_ini'],
            'last_updated' => now()->format('Y-m-d H:i:s'),
        ];
    }
}
