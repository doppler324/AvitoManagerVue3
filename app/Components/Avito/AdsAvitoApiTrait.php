<?php

namespace App\Components\Avito;

use App\Models\AdModel;
use Illuminate\Support\Facades\Http;

trait AdsAvitoApiTrait
{
    /**
     * Возвращает список объявлений авторизованного пользователя - статус, категорию и ссылку на сайте
     * @return mixed
     */
    public function loadAds(): array
    {
        // объявление переменных
        $result = array();
        $response = array();
        // получаем объявления с Авито
        do {
            // делаем запрос к Авито в цикле, пока не загрузим все объявления, Авито отдает максимум по 100 штук
            $response =
                Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->access_token])
                    ->get('https://api.avito.ru/core/v1/items', [
                        'per_page' => 100,
                        'page' => !empty($response['meta']['page']) ? $response['meta']['page'] + 1 : 1,
                        'status' => "active,removed,old,blocked,rejected",
                    ])
                    // если вернулась ошибка, выбрасываем ошибку
                    ->throwIf(!empty($response["code"]) || !$response)
                    ->json();

            // добавляем объявления к результату
            $result = array_merge($result, $response['resources']);
        } while (!empty($response['resources']));
        return $result;
    }

    /**
     *  Возвращает данные об объявлении - его статус, список примененных услуг
     * @return mixed
     */
    public function loadAdInfo()
    {
        $result = array();
        try {
            foreach (AdModel::all()->chunk(1) as $item) {
                $response =
                    Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->getAccessTokenAttribute()])
                        ->get('https://api.avito.ru/core/v1/accounts/' . $this->project->avito_profiles_id . '/items/' .
                            $item->id . '/')
                        ->throw()
                        ->json();
                $result[] = $response;
                sleep(1);
            }
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return $ex->getMessage();
            }
        }
        return $result;
    }

    /**
     *  Получение информации о стоимости дополнительных услуг
     * @return mixed
     */
    public function loadAdsCostServices()
    {
        $result = array();
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->getAccessTokenAttribute()])
                ->post('https://api.avito.ru/core/v1/accounts/' . $this->project->avito_profiles_id . '/price/vas',
                    [
                        'itemIds' => AdModel::all()->get()->implode('id', ',')
                    ])
                ->throw()
                ->json();
            $result = $response;
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return $ex->getMessage();
            }
        }
        return $result;
    }

    /**
     *  Получение статистики по списку объявлений
     * @return mixed
     */
    public function loadAdsListInfo()
    {
        $result = array();
        try {
            foreach (AdModel::all()->chunk(200) as $item) {
                $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->getAccessTokenAttribute(),
                    'Content-Type' => 'application/json'])
                    ->post('https://api.avito.ru/stats/v1/accounts/' . $this->project->avito_profiles_id . '/items',
                        [
                            'dateFrom' => now()->subDays(270)->format('YYYY-MM-DD'),
                            'dateTo' => now()->format('YYYY-MM-DD'),
                            'fields' => 'uniqViews,uniqContacts,uniqFavorites',
                            'itemIds' => $item->get('id')->implode('id', ','),
                            'periodGrouping' => 'day'
                        ])
                    ->throw()
                    ->json();
                $result[] = $response['result'];
                sleep(1);
            }
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return $ex->getMessage();
            }
        }
        return $result;
    }

    /**
     *  Получение информации о стоимости пакетов дополнительных услуг
     * @return mixed
     */
    public function loadAdsCostPakagesServices()
    {
        $result = array();
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->getAccessTokenAttribute()])
                ->post('https://api.avito.ru/core/v1/accounts/' . $this->project->avito_profiles_id .
                    '/price/vas_packages',
                    [
                        'itemIds' => AdModel::all()->get('id')->implode('id', ',')
                    ])
                ->throw()
                ->json();
            $result = $response;
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return $ex->getMessage();
            }
        }
        return $result;
    }

    /**
     *  Получение статистики по звонкам
     * @return mixed
     */
    public function loadAdsCalls()
    {
        $result = array();
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->project->getAccessTokenAttribute(),
                'Content-Type' => 'application/json'])
                ->post('https://api.avito.ru/core/v1/accounts/' . $this->project->avito_profiles_id . '/calls/stats/',
                    [
                        'itemIds' => AdModel::all()->get('id')->implode('id', ',')
                    ])
                ->throw()
                ->json();
            $result = $response;
        } catch (Exception $ex) {
            if ($ex->getCode() != 200) {
                return $ex->getMessage();
            }
        }
        return $result;
    }
}