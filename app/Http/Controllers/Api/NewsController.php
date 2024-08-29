<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ServerNameHelper;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index($page)
    {
        $perPage = 12;
        $news = News::whereNull('deleted_at')
            ->orderByDesc('id')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $news_count = News::whereNull('deleted_at')
            ->selectRaw('count(id) as cnt')
            ->pluck('cnt')
            ->first();

        $data = [];

        foreach ($news as $key => $item) {
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
            $data[$key]['count'] = $news_count;
        }

        return response()->json($data, 200);

    }
    public function newsHeader(){
        $news = News::whereNull('deleted_at')->orderByDesc('id')->take(5)->get();
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

    /***
     * @param $id
     * @param $lang
     * @return JsonResponse
     */
    public function newsItem($id)
    {
        $news = News::where("id", $id)->whereNull('deleted_at')->first();
        if (!$news) {
            return response()->json(['error' => 'News item not found'], 404);
        }
        $data = [];
        $imgData = json_decode($news->img, true);
        $imgPath = '';
        if (!empty($imgData) && isset($imgData[0]['download_link'])) {
            $imgPath = ServerNameHelper::server_name() . "/storage/" . $imgData[0]['download_link'];
        }

        $data['id'] = $news->id;
        $data['title'] = $news->title;
        $data['description'] = $news->description;
        $data['img'] = $imgPath;
        $data['created_at'] = $news->created_at->format('Y-m-d');

        return response()->json($data, 200);
    }
}
