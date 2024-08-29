<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ServerNameHelper;
use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $structure = Structure::whereNull('deleted_at')->first();
        if (!$structure) {
            return response()->json(['error' => 'Structure item not found'], 404);
        }


        $imgData = json_decode($structure->img, true);

        $imgPath = '';

        if (!empty($imgData) && isset($imgData[0]['download_link'])) {
            $imgPath = ServerNameHelper::server_name() . "/storage/" . $imgData[0]['download_link'];
        }

        $data = [
            'id' => $structure->id,
            'title' => $structure->title,
            'description' => $structure->description,
            'img' => $imgPath,
        ];

        return response()->json($data, 200);
    }




}
