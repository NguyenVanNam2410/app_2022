<?php

namespace App\Http\Controllers;

use App\Services\thematic\thematicService;
use Illuminate\Http\Request;
use App\http\Resources\ThematicResource;
use App\http\Requests\thematic\thematicRequest;
use App\Http\Resources\ThematicCollection;

class ThematicController extends Controller
{
    private $thematicService;
    public function __construct(thematicService $thematicService)
    {
        $this->thematicService = $thematicService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $searchName = $request->SearchName ?? '';
            $order = [
                'searchName' => $searchName,
            ];
            $data =  $this->thematicService->getAll(2, $order);
            return $this->sendSuccessResponse(new ThematicCollection($data), "success");
        } catch (\ErrorException $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'name'       => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ];
            $dataId = $this->thematicService->createThematic($data);
            return $this->sendSuccessResponse(new ThematicResource($dataId), "thêm chuyên đề thành công");
        } catch (\ErrorException $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        try {
            $dataId = $this->thematicService->get($id);
            return $this->sendSuccessResponse(new ThematicResource($dataId), "show id cần sửa");
        } catch (\ErrorException $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     try {
    //         $data = [
    //             'name1'   => 1,
    //             'name'       => $request->name,
    //             'description' => $request->description,
    //             'status' => $request->status,
    //         ];
    //         return $data;
    //         $dataId = $this->thematicService->updateId($data, $id);
    //         return $this->sendSuccessResponse(new ThematicResource($dataId), "success");
    //     } catch (\ErrorException $e) {
    //         return $this->sendErrorResponse($e->getMessage());
    //     }
    // }
    public function updateThematic(Request $request, $id)
    {
        try {
            $data = [
                'name'       => $request->name,
                'description' => $request->description,
                'status'    => $request->status,
            ];
            $dataId = $this->thematicService->updateId($data, $id);
            return $this->sendSuccessResponse(new ThematicResource($dataId), "Update tiêu đề thành công");
        } catch (\ErrorException $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
