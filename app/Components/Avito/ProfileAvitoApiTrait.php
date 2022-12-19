<?php
namespace App\Components\Avito;

use Illuminate\Support\Facades\Http;

trait ProfileAvitoApiTrait{

    /**
     *  Получение баланса кошелька пользователя
     * * @param string $id
     * @return mixed
     */
    public function loadBalance($project): array
    {
        $response = "";
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $project->access_token,
                'Content-Type' => 'application/json'])
                ->get('https://api.avito.ru/core/v1/accounts/' . $project->profile_id . '/balance/')
                ->throwIf(!empty($response["error"]))
                ->json();
            $project->fill([
                "balance" => $response["real"],
                "bonus_balance" => $response["bonus"],
            ]);
            $project->save();
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return [
                    "success" => false,
                    "message" => $ex->getMessage(),
                    "messageFromAvito" => $response['error']
                ];
            }
        }
        return [
            "success" => true
        ];
    }

    /**
     *  Получение информации об авторизованном пользователе
     * @return mixed
     */
    public function loadInfoProject($project): array
    {
        $response = array();
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $project->access_token,
                'Content-Type' => 'application/json'])
                ->get('https://api.avito.ru/core/v1/accounts/self/')
                ->throwIf(!empty($response["error"]))
                ->json();
            $project->fill([
                "email" => $response["email"],
                "name" => $response["name"],
                "phone" => $response["phone"],
                "profile_url" => $response["profile_url"],
                "profile_id" => $response["id"],
            ]);
            $project->save();
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return [
                    "success" => false,
                    "message" => $ex->getMessage(),
                    "messageFromAvito" => $response["error"]
                ];
            }
        }
        return [
            "success" => true
        ];
    }
}