<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ServerNameHelper;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(){
        $news = Partner::whereNull('deleted_at')
            ->orderByDesc('id')
            ->get();
        $data = [];
        foreach ($news as $key=>&$item) {
            $imgData = json_decode($item->img, true);
            $imgPath = '';

            if (!empty($imgData) && isset($imgData[0]['download_link'])) {
                $imgPath = ServerNameHelper::server_name() . "/storage/" . $imgData[0]['download_link'];
            }
            $data[$key]['id'] = $item->id;
            $data[$key]['title'] = $item->title;
            $data[$key]['description'] = $item->description;
            $data[$key]['img'] = $imgPath;
            $data[$key]['created_at'] = $item->created_at->format('Y-m-d');

        }
        return response()->json($data, 200);
    }
}
