<?php

namespace App\Http\Controllers\Api;

use App\Components\Avito\AvitoApiComponent;
use App\Http\Requests\adsRequest;
use App\Models\AdModel;
use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\JobFromAvitoAdsDownloading;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $project = ProjectModel::find($request->id);
        $ads = $project->ads;
        return response()->json([
            "success" => true,
            "message" => "Объявления успешно загружены.",
            "ads" => $ads
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, adsRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $ad = new AdModel($input);
        $ad->save();
        return response()->json([
            "success" => true,
            "message" => "Объявление добавлено успешно."
        ]);
    }

    /**
     * Загрузка всех объявлений с Авито
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAdsFromAvito(Request $request, adsRequest $req): \Illuminate\Http\JsonResponse
    {
        // проверка id проекта
        if(!$request->project_id){
            return response()->json([
                "success" => "Не указан id проекта"
            ]);
        }
        $project = ProjectModel::find($request->project_id);
        $result = JobFromAvitoAdsDownloading::dispatch($project);
        return response()->json([
            "success" => true,
            "message" => "Задание на получение объявлений отправлено"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, adsRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $ad = AdModel::find($input['id']);
        return response()->json([
            "success" => true,
            "message" => "Объявление успешно найдено.",
            "data" => $ad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, adsRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $ad = AdModel::find($input['id']);
        $ad->fill(request()->all())->save();
        return response()->json([
            "success" => true,
            "message" => "Объявление обновлено успешно."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, adsRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $ad = AdModel::find($input['id']);
        $ad->delete();
        return response()->json([
            "success" => true,
            "message" => "Объявление успешно удалено."
        ]);
    }
}
