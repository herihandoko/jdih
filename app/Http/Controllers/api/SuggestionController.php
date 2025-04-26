<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuggestionController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('q');

        if (!$keyword || strlen($keyword) < 3) {
            return response()->json([
                'data' => []
            ]);
        }

        $products = ProdukHukumList::where('judul_peraturan', 'LIKE', "%{$keyword}%")
            ->select('id', DB::raw('judul_peraturan AS name'))
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $products
        ]);
    }
}
