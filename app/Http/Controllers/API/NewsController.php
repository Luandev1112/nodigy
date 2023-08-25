<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\News;

use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsResourceView;

class NewsController extends BaseController
{
    public function index(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $sqlQuery = News::select('news.*','news_category.category_name')
            ->leftJoin('news_category', 'news.news_category_id', '=', 'news_category.id')
            ->where('news.news_status',News::ACTIVE)
            ->where(DB::raw('DATE(publish_at)'), '<=', $now);

        $news_category_id = $request->get('news_category_id');
        if ($news_category_id !="") {
            $sqlQuery->where('news.news_category_id', '=',$news_category_id);
        }

        $allData = $sqlQuery->orderBy('news.id','DESC')
            ->groupBy('news.id')
            ->get();

        if(!empty($allData) && count($allData) > 0){
            return $this->sendResponse(NewsResource::collection($allData), 'List Successfully.');
        }else{
            return $this->sendError('data not found.');
        }
    }

    public function view($id)
    {
        $now = Carbon::now()->format('Y-m-d');
        $model = News::select('news.*','news_category.category_name')
            ->leftJoin('news_category', 'news.news_category_id', '=', 'news_category.id')
            ->where('news.news_status',News::ACTIVE)
            ->where(DB::raw('DATE(publish_at)'), '<=', $now)
            ->where('news.id',$id)
            ->groupBy('news.id')
            ->first();

        if(isset($model->id)){
            $resource = new NewsResourceView($model);
            return $this->sendResponse($resource, 'view Successfully.');
        }else{
            return $this->sendError('detail not found.');
        }
    }
}