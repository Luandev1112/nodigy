<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;

use App\Models\NewsCategory;

use App\Http\Resources\NewsCategoryResource;

class NewsCategoryController extends BaseController
{
    public function index(Request $request)
    {
        $allData = NewsCategory::select('news_category.*')
            ->where('category_status',NewsCategory::ACTIVE)
            ->orderBy('category_name','ASC')
            ->groupBy('id')
            ->get();

        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(NewsCategoryResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }
}