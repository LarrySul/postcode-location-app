<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Postcode;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Traits\PostcodeUtils;
use App\Interfaces\StatusCode;
use App\Http\Controllers\Controller;

class PostcodeController extends Controller implements StatusCode
{
    use PostcodeUtils;

    public function getAllPostcodes(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string',
            'usertype' => 'required|integer',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        $searchParam = $request->q;

        $postcodes = Postcode::select('id', 'pcd', 'pcd2', 'pcds', 'long', 'lat')
                    ->where('usertype', $request->usertype)
                    ->where(function($query) use ($searchParam) {
                        if($searchParam){
                           return  $query->where('pcd', 'LIKE', '%' . $searchParam. '%')
                                ->orWhere('pcd2', 'LIKE', '%' . $searchParam . '%')
                                ->orWhere('pcds', 'LIKE', '%' . $searchParam . '%')
                                ->orWhere('long', 'LIKE', '%' . $searchParam . '%')
                                ->orWhere('lat', 'LIKE', '%' . $searchParam . '%');
                        }
                    })->paginate($request->limit ?? 10);

        if ($postcodes->isEmpty()) {
            return Response::setResponse(StatusCode::NOT_FOUND, [], 'Postcode not found');
        }

        return Response::setResponse(StatusCode::OK, $postcodes, 'Post code retrieved');

    }

    public function getNearbyPostcodes(Request $request)
    {
        $request->validate([
            'usertype' => 'required|integer',
            'lat' => 'nullable|numeric|min:-180|max:180',
            'long' => 'nullable|numeric|min:-90|max:90',
            'distance' => 'nullable|integer',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        $calculate_bound = $this->calculateBoundingBox($request->lat, $request->long, $request->distance);
        $nearByPostcodes = Postcode::select('id', 'pcd', 'pcd2', 'pcds', 'lat', 'long')
                    ->where('usertype', $request->usertype)
                    ->whereBetween('lat', [$calculate_bound['min_lat'], $calculate_bound['max_lat']])
                    ->whereBetween('long', [$calculate_bound['min_long'], $calculate_bound['max_long']])
                    ->paginate($request->limit ?? 10);

        if ($nearByPostcodes->isEmpty()) {
            return Response::setResponse(StatusCode::NOT_FOUND, [], 'Postcode not found');
        }

        return Response::setResponse(StatusCode::OK, $postcodes, 'Post code retrieved');
    }
}