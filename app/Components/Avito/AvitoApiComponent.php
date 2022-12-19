<?php

namespace App\Components\Avito;

use App\Models\AdModel;
use App\Models\ProjectModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Encryption\Encrypter;
use PhpParser\Node\Expr\Array_;


class AvitoApiComponent
{
    use AdsAvitoApiTrait, ProfileAvitoApiTrait, CategoryAvitoTrait;

    // Текущий проект
    protected ?ProjectModel $project;

    function __construct(ProjectModel $project)
    {
        $this->project = $project;
        try {
            self::checkAccessToken();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Получение или обновление access token
     * @return string
     */
    public function setAccessToken()
    {
        try {
            $response = Http::asForm()->post('https://api.avito.ru/token', [
                'client_id' => $this->project->client_id,
                'client_secret' => $this->project->client_secret,
                'grant_type' => 'client_credentials',
            ])->throw()->json();
            $this->project->access_token = $response['access_token'];
            $this->project->access_token_time = now();
            $this->project->save();
        } catch (Exception $ex) {
            return $ex->getCode();
        }
    }

    /**
     * Проверка устарел ли access token и получение нового в случае отсутсвия или истечения срока
     * @return bool
     */
    public function checkAccessToken(): bool
    {
        if (empty($this->project->access_token) || now()->gte($this->project->access_token_time)) {
            return self::setAccessToken() == 200;
        }
        return true;
    }

    /**
     *  Парсинг категорий с сайта Авито
     * @return mixed
     */
    public
    static function loadCategories()
    {
        $link = "https://avito.ru";
        // получаем страницу get-запросом
        try {
            $body = Http::get($link)->throw()->body();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        // создаём краулер для получения данных
        $crawler = new Crawler(null, $link);
        $crawler->addHtmlContent($body, 'UTF-8');
        // Получение категорий
        $categories = $crawler->filter('#category option')->each(
            function ($node, $i) {
                if ($node->text() == 'Любая категория') {
                    return false;
                }
                $id = $node->attr('value');
                $name = $node->text();
                return array($id, $name);
            }
        );
        unset($crawler);
        return $categories;
    }
}
