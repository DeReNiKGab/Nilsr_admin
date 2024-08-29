<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UsefulLink;
use Illuminate\Http\JsonResponse;


class UsefulLinksController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(){
        $news = UsefulLink::whereNull('deleted_at')
            ->orderByDesc('id')
            ->get();
        $data = [];
        foreach ($news as $key=>&$item) {
            $data[$key]['id'] = $item->id;
            $data[$key]['title'] = $item->title;
            $data[$key]['url'] = $item->url;
            $data[$key]['created_at'] = $item->created_at->format('Y-m-d');
        }
        return response()->json($data, 200);
    }
}
