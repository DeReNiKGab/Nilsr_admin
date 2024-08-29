<?php

namespace App\Http\Controllers\Api;



use Illuminate\Http\JsonResponse;

class MenuController
{
    /**
     * @param $lang
     * @return JsonResponse
     */
   public function index(): JsonResponse
   {
       $data = [];
       $menu = menu('main', '_json');
       foreach ($menu as $key=>&$single)
       {
           $data[$key."-main"]['id'] = $key;
           $data[$key."-main"]['title'] = $single->title;
           $data[$key."-main"]['url'] = $single->url;
           if (count($single->children) > 0)
           {
               foreach ($single->children as $i=>&$c)
               {
                    $data[$key."-main"]["sub"][$i] = [];
                    $data[$key."-main"]["sub"][$i]["id"] = $i;
                    $data[$key."-main"]["sub"][$i]["title"] = $c->title;
                    $data[$key."-main"]["sub"][$i]["url"] = $c->url;

                   if (count($c->children) > 0){
                        foreach ($c->children as $j=>&$cild3){
                            $data[$key."-main"]["sub"][$i]["sub"][$j] = [];
                            $data[$key."-main"]["sub"][$i]["sub"][$j]["id"] = $j;
                            $data[$key."-main"]["sub"][$i]["sub"][$j]["title"] = $cild3->title;
                            $data[$key."-main"]["sub"][$i]["sub"][$j]["url"] = $cild3->url;
                            $data[$key."-main"]["sub"][$i]["sub"][$j]['sub'] = [];
                        }
                    }else{
                        $data[$key."-main"]["sub"][$i]["sub"] = [];
                    }
               }
           }else{
               $data[$key."-main"]['sub'] = [];
           }

       }
       return response()->json([$data], 200);
   }
}
