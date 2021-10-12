<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArticalRequest as APIArticalRequest;
use App\Http\Requests\ArticalRequest;
use App\Http\Resources\ArticalResource;
use App\Http\Resources\UserArtecalesResource;
use App\Models\article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()   
    {
        $this->middleware(['auth:api','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticalRequest $request)
    {
        $data = $request->validated();
        $artical= auth('api')->user()->articals()->create($data);
        $response = ['results' => new ArticalResource($artical),'message' =>'article created successfully.'];
        return response($response, 200);
        
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
    {
        try {
            $data = $request->all();
            $article->update($data);
            $response = ['results' => new ArticalResource($article),'message' =>'article update successfully.'];
            return response($response, 200);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        $article->delete();
        $response = ['message' =>'article delete successfully.'];
        return response($response, 200);
    }
}
