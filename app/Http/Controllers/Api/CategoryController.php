<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\AdModel;
use App\Models\CategoryModel;
use App\Jobs\JobAvitoAdsDownloading;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Components\Avito\AvitoApiComponent;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class CategoryController extends Controller
{
    function buildTree(array &$elements, &$depth_level = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if (isset($element['children']) ) {
                $depth_level += 1;
                $this->buildTree($element['children'], $depth_level);
            }
            $category = new CategoryModel([
                "name" => (string)$element["title"],
                "avito_id" => (int)$element["id"],
                "avito_parent_id" => (int)($element["parentId"] ?? 0),
                "depth_level" => &$depth_level
            ]);
            $category->save();
        }
        return $branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $text = json_decode('{"1" : {
          "id": 29369,
          "title": "AVITO",
          "navigation": {},
          "children": [
            {
              "id": 29370,
              "parentId": 29369,
              "title": "Транспорт",
              "navigation": {
                "categoryId": 1
              },
              "children": [
                {
                  "id": 29371,
                  "parentId": 29370,
                  "title": "Автомобили",
                  "navigation": {
                    "categoryId": 9
                  },
                  "children": [
                    {
                      "id": 29372,
                      "parentId": 29371,
                      "title": "С пробегом",
                      "navigation": {
                        "categoryId": 9,
                        "attributes": [
                          {
                            "value": 14756,
                            "id": 1283
                          }
                        ]
                      }
                    },
                    {
                      "id": 29373,
                      "parentId": 29371,
                      "title": "Новый",
                      "navigation": {
                        "categoryId": 9,
                        "attributes": [
                          {
                            "value": 14755,
                            "id": 1283
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29374,
                  "parentId": 29370,
                  "title": "Мотоциклы и мототехника",
                  "navigation": {
                    "categoryId": 14
                  },
                  "children": [
                    {
                      "id": 29376,
                      "parentId": 29374,
                      "title": "Вездеходы",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 112,
                            "id": 30
                          }
                        ]
                      }
                    },
                    {
                      "id": 29377,
                      "parentId": 29374,
                      "title": "Картинг",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 4967,
                            "id": 30
                          }
                        ]
                      }
                    },
                    {
                      "id": 29379,
                      "parentId": 29374,
                      "title": "Мопеды и скутеры",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 109,
                            "id": 30
                          }
                        ]
                      }
                    },
                    {
                      "id": 29380,
                      "parentId": 29374,
                      "title": "Мотоциклы",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 4969,
                            "id": 30
                          }
                        ]
                      }
                    },
                    {
                      "id": 29386,
                      "parentId": 29374,
                      "title": "Снегоходы",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 2833,
                            "id": 30
                          }
                        ]
                      }
                    },
                    {
                      "id": 29378,
                      "parentId": 29374,
                      "title": "Квадроциклы и багги",
                      "navigation": {
                        "categoryId": 14,
                        "attributes": [
                          {
                            "value": 110,
                            "id": 30
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29387,
                  "parentId": 29370,
                  "title": "Грузовики и спецтехника",
                  "navigation": {
                    "categoryId": 81
                  },
                  "children": [
                    {
                      "id": 29388,
                      "parentId": 29387,
                      "title": "Автобусы",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 135,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29389,
                      "parentId": 29387,
                      "title": "Автодома",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 5065,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29390,
                      "parentId": 29387,
                      "title": "Автокраны",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4973,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29391,
                      "parentId": 29387,
                      "title": "Бульдозеры",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4974,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29392,
                      "parentId": 29387,
                      "title": "Грузовики",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 136,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29393,
                      "parentId": 29387,
                      "title": "Коммунальная техника",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 2840,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29394,
                      "parentId": 29387,
                      "title": "Лёгкий коммерческий транспорт",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4975,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 30197,
                      "parentId": 29387,
                      "title": "Навесное оборудование",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 729097,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29395,
                      "parentId": 29387,
                      "title": "Погрузчики",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4976,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29396,
                      "parentId": 29387,
                      "title": "Прицепы",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4977,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29397,
                      "parentId": 29387,
                      "title": "Сельхозтехника",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 2842,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29398,
                      "parentId": 29387,
                      "title": "Строительная техника",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 137,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29399,
                      "parentId": 29387,
                      "title": "Техника для лесозаготовки",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 2841,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29400,
                      "parentId": 29387,
                      "title": "Тягачи",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4978,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 29401,
                      "parentId": 29387,
                      "title": "Экскаваторы",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 4979,
                            "id": 42
                          }
                        ]
                      }
                    },
                    {
                      "id": 30243,
                      "parentId": 29387,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 81,
                        "attributes": [
                          {
                            "value": 753708,
                            "id": 42
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29402,
                  "parentId": 29370,
                  "title": "Водный транспорт",
                  "navigation": {
                    "categoryId": 11
                  },
                  "children": [
                    {
                      "id": 29403,
                      "parentId": 29402,
                      "title": "Вёсельные лодки",
                      "navigation": {
                        "categoryId": 11,
                        "attributes": [
                          {
                            "value": 26,
                            "id": 7
                          }
                        ]
                      }
                    },
                    {
                      "id": 29404,
                      "parentId": 29402,
                      "title": "Гидроциклы",
                      "navigation": {
                        "categoryId": 11,
                        "attributes": [
                          {
                            "value": 30,
                            "id": 7
                          }
                        ]
                      }
                    },
                    {
                      "id": 29405,
                      "parentId": 29402,
                      "title": "Катера и яхты",
                      "navigation": {
                        "categoryId": 11,
                        "attributes": [
                          {
                            "value": 31,
                            "id": 7
                          }
                        ]
                      }
                    },
                    {
                      "id": 29407,
                      "parentId": 29402,
                      "title": "Моторные лодки и моторы",
                      "navigation": {
                        "categoryId": 11,
                        "attributes": [
                          {
                            "value": 28,
                            "id": 7
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29409,
                  "parentId": 29370,
                  "title": "Запчасти и аксессуары",
                  "navigation": {
                    "categoryId": 10
                  },
                  "children": [
                    {
                      "id": 29410,
                      "parentId": 29409,
                      "title": "Запчасти",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 18,
                            "id": 5
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29411,
                          "parentId": 29410,
                          "title": "Для автомобилей",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 18,
                                "id": 5
                              },
                              {
                                "value": 6396,
                                "id": 598
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 29412,
                              "parentId": 29411,
                              "title": "Автосвет",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11618,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29413,
                              "parentId": 29411,
                              "title": "Автомобиль на запчасти",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 192855,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29414,
                              "parentId": 29411,
                              "title": "Аккумуляторы",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11619,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29415,
                              "parentId": 29411,
                              "title": "Двигатель",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11620,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29416,
                              "parentId": 29411,
                              "title": "Запчасти для ТО",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11621,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29417,
                              "parentId": 29411,
                              "title": "Кузов",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11622,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29418,
                              "parentId": 29411,
                              "title": "Подвеска",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11623,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29419,
                              "parentId": 29411,
                              "title": "Рулевое управление",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11624,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29420,
                              "parentId": 29411,
                              "title": "Салон",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11625,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29421,
                              "parentId": 29411,
                              "title": "Система охлаждения",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 16521,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29422,
                              "parentId": 29411,
                              "title": "Стекла",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11626,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29423,
                              "parentId": 29411,
                              "title": "Топливная и выхлопная системы",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11627,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29424,
                              "parentId": 29411,
                              "title": "Тормозная система",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11628,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29425,
                              "parentId": 29411,
                              "title": "Трансмиссия и привод",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11629,
                                    "id": 817
                                  }
                                ]
                              }
                            },
                            {
                              "id": 29426,
                              "parentId": 29411,
                              "title": "Электрооборудование",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6396,
                                    "id": 598
                                  },
                                  {
                                    "value": 11630,
                                    "id": 817
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 29427,
                          "parentId": 29410,
                          "title": "Для мототехники",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 18,
                                "id": 5
                              },
                              {
                                "value": 6401,
                                "id": 598
                              }
                            ]
                          }
                        },
                        {
                          "id": 29429,
                          "parentId": 29410,
                          "title": "Для водного транспорта",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 18,
                                "id": 5
                              },
                              {
                                "value": 6411,
                                "id": 598
                              }
                            ]
                          }
                        },
                        {
                          "id": 29428,
                          "parentId": 29410,
                          "title": "Для грузовиков и спецтехники",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 18,
                                "id": 5
                              },
                              {
                                "value": 6406,
                                "id": 598
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31102,
                              "parentId": 29428,
                              "title": "Двигатели и комплектующие",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2914995,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31103,
                              "parentId": 29428,
                              "title": "Трансмиссия",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2914996,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31104,
                              "parentId": 29428,
                              "title": "Подвеска",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2914997,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31105,
                              "parentId": 29428,
                              "title": "Кабина",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2914998,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31106,
                              "parentId": 29428,
                              "title": "Будки, платформы, кузова",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2914999,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31107,
                              "parentId": 29428,
                              "title": "Автоэлектрика и автосвет",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2915000,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31108,
                              "parentId": 29428,
                              "title": "Гидравлические и пневмосистемы",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 2915001,
                                    "id": 122598
                                  }
                                ]
                              }
                            },
                            {
                              "id": 34321,
                              "parentId": 29428,
                              "title": "Навесное оборудование в разборе",
                              "navigation": {
                                "categoryId": 10,
                                "attributes": [
                                  {
                                    "value": 18,
                                    "id": 5
                                  },
                                  {
                                    "value": 6406,
                                    "id": 598
                                  },
                                  {
                                    "value": 3198122,
                                    "id": 122598
                                  }
                                ]
                              }
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "id": 29430,
                      "parentId": 29409,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4943,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29431,
                      "parentId": 29409,
                      "title": "GPS-навигаторы",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 21,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29432,
                      "parentId": 29409,
                      "title": "Масла и автохимия",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4942,
                            "id": 5
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 32597,
                          "parentId": 29432,
                          "title": "Моторные масла",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064743,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32598,
                          "parentId": 29432,
                          "title": "Трансмиссионные масла",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064744,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32599,
                          "parentId": 29432,
                          "title": "Охлаждающие жидкости",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064745,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32600,
                          "parentId": 29432,
                          "title": "Тормозные жидкости",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064746,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32601,
                          "parentId": 29432,
                          "title": "Гидравлические жидкости",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064747,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32602,
                          "parentId": 29432,
                          "title": "Жидкости для омывателя стекла",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064748,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32603,
                          "parentId": 29432,
                          "title": "Промывочные жидкости, присадки и смазки",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064749,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32604,
                          "parentId": 29432,
                          "title": "Другие масла",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064750,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32605,
                          "parentId": 29432,
                          "title": "Автокосметика и аксессуары",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064751,
                                "id": 129182
                              }
                            ]
                          }
                        },
                        {
                          "id": 32606,
                          "parentId": 29432,
                          "title": "Топливо",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4942,
                                "id": 5
                              },
                              {
                                "value": 3064752,
                                "id": 129182
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29433,
                      "parentId": 29409,
                      "title": "Аудио- и видеотехника",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 20,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29434,
                      "parentId": 29409,
                      "title": "Багажники и фаркопы",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4964,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29435,
                      "parentId": 29409,
                      "title": "Инструменты",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4963,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29436,
                      "parentId": 29409,
                      "title": "Прицепы",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4965,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29437,
                      "parentId": 29409,
                      "title": "Противоугонные устройства",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 4944,
                            "id": 5
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29438,
                          "parentId": 29437,
                          "title": "Автосигнализации",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4944,
                                "id": 5
                              },
                              {
                                "value": 11631,
                                "id": 818
                              }
                            ]
                          }
                        },
                        {
                          "id": 29439,
                          "parentId": 29437,
                          "title": "Иммобилайзеры",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4944,
                                "id": 5
                              },
                              {
                                "value": 11632,
                                "id": 818
                              }
                            ]
                          }
                        },
                        {
                          "id": 29440,
                          "parentId": 29437,
                          "title": "Механические блокираторы",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4944,
                                "id": 5
                              },
                              {
                                "value": 11633,
                                "id": 818
                              }
                            ]
                          }
                        },
                        {
                          "id": 29441,
                          "parentId": 29437,
                          "title": "Спутниковые системы",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 4944,
                                "id": 5
                              },
                              {
                                "value": 11634,
                                "id": 818
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29442,
                      "parentId": 29409,
                      "title": "Тюнинг",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 22,
                            "id": 5
                          }
                        ]
                      }
                    },
                    {
                      "id": 29443,
                      "parentId": 29409,
                      "title": "Шины, диски и колёса",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 19,
                            "id": 5
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29444,
                          "parentId": 29443,
                          "title": "Легковые шины",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 10048,
                                "id": 709
                              }
                            ]
                          }
                        },
                        {
                          "id": 30975,
                          "parentId": 29443,
                          "title": "Шины для грузовиков и спецтехники",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 2849575,
                                "id": 709
                              }
                            ]
                          }
                        },
                        {
                          "id": 29445,
                          "parentId": 29443,
                          "title": "Мотошины",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 10047,
                                "id": 709
                              }
                            ]
                          }
                        },
                        {
                          "id": 29446,
                          "parentId": 29443,
                          "title": "Диски",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 10046,
                                "id": 709
                              }
                            ]
                          }
                        },
                        {
                          "id": 29447,
                          "parentId": 29443,
                          "title": "Колёса",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 10045,
                                "id": 709
                              }
                            ]
                          }
                        },
                        {
                          "id": 29448,
                          "parentId": 29443,
                          "title": "Колпаки",
                          "navigation": {
                            "categoryId": 10,
                            "attributes": [
                              {
                                "value": 19,
                                "id": 5
                              },
                              {
                                "value": 10044,
                                "id": 709
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29449,
                      "parentId": 29409,
                      "title": "Экипировка",
                      "navigation": {
                        "categoryId": 10,
                        "attributes": [
                          {
                            "value": 6416,
                            "id": 5
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 29450,
              "parentId": 29369,
              "title": "Недвижимость",
              "navigation": {
                "categoryId": 4
              },
              "children": [
                {
                  "id": 29510,
                  "parentId": 29450,
                  "title": "Коммерческая недвижимость",
                  "navigation": {
                    "categoryId": 42
                  },
                  "children": [
                    {
                      "id": 29511,
                      "parentId": 29510,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 42,
                        "attributes": [
                          {
                            "value": 5545,
                            "id": 536
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29512,
                          "parentId": 29511,
                          "title": "Офисное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 5957,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29513,
                          "parentId": 29511,
                          "title": "Помещение свободного назначения",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 5959,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29514,
                          "parentId": 29511,
                          "title": "Торговое помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 5960,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29515,
                          "parentId": 29511,
                          "title": "Складское помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 5961,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29516,
                          "parentId": 29511,
                          "title": "Производственное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 5958,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29517,
                          "parentId": 29511,
                          "title": "Помещение общественного питания",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 16352,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29518,
                          "parentId": 29511,
                          "title": "Гостиница",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 11013,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29519,
                          "parentId": 29511,
                          "title": "Автосервис",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 473321,
                                "id": 579
                              }
                            ]
                          }
                        },
                        {
                          "id": 29520,
                          "parentId": 29511,
                          "title": "Здание",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5545,
                                "id": 536
                              },
                              {
                                "value": 473322,
                                "id": 579
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29521,
                      "parentId": 29510,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 42,
                        "attributes": [
                          {
                            "value": 5546,
                            "id": 536
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29522,
                          "parentId": 29521,
                          "title": "Офисное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 5723,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29523,
                          "parentId": 29521,
                          "title": "Помещение свободного назначения",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 5725,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29524,
                          "parentId": 29521,
                          "title": "Торговое помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 5726,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29525,
                          "parentId": 29521,
                          "title": "Складское помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 5727,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29526,
                          "parentId": 29521,
                          "title": "Производственное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 5724,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29527,
                          "parentId": 29521,
                          "title": "Помещение общественного питания",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 16351,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29528,
                          "parentId": 29521,
                          "title": "Гостиница",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 11014,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29529,
                          "parentId": 29521,
                          "title": "Автосервис",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 473319,
                                "id": 554
                              }
                            ]
                          }
                        },
                        {
                          "id": 29530,
                          "parentId": 29521,
                          "title": "Здание",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 5546,
                                "id": 536
                              },
                              {
                                "value": 473320,
                                "id": 554
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29531,
                      "parentId": 29510,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 42,
                        "attributes": [
                          {
                            "value": 10693,
                            "id": 536
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29532,
                          "parentId": 29531,
                          "title": "Офисное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 10695,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29533,
                          "parentId": 29531,
                          "title": "Помещение свободного назначения",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 10696,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29534,
                          "parentId": 29531,
                          "title": "Торговое помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 10697,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29535,
                          "parentId": 29531,
                          "title": "Складское помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 10698,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29536,
                          "parentId": 29531,
                          "title": "Производственное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 10701,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29537,
                          "parentId": 29531,
                          "title": "Помещение общественного питания",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 16349,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29538,
                          "parentId": 29531,
                          "title": "Гостиница",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 11015,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29539,
                          "parentId": 29531,
                          "title": "Автосервис",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 473323,
                                "id": 748
                              }
                            ]
                          }
                        },
                        {
                          "id": 29540,
                          "parentId": 29531,
                          "title": "Здание",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10693,
                                "id": 536
                              },
                              {
                                "value": 473324,
                                "id": 748
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29541,
                      "parentId": 29510,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 42,
                        "attributes": [
                          {
                            "value": 10694,
                            "id": 536
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29542,
                          "parentId": 29541,
                          "title": "Офисное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 10702,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29543,
                          "parentId": 29541,
                          "title": "Помещение свободного назначения",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 10703,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29544,
                          "parentId": 29541,
                          "title": "Торговое помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 10704,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29545,
                          "parentId": 29541,
                          "title": "Складское помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 10705,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29546,
                          "parentId": 29541,
                          "title": "Производственное помещение",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 10708,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29547,
                          "parentId": 29541,
                          "title": "Помещение общественного питания",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 16350,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29548,
                          "parentId": 29541,
                          "title": "Гостиница",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 11016,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29549,
                          "parentId": 29541,
                          "title": "Автосервис",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 473325,
                                "id": 749
                              }
                            ]
                          }
                        },
                        {
                          "id": 29550,
                          "parentId": 29541,
                          "title": "Здание",
                          "navigation": {
                            "categoryId": 42,
                            "attributes": [
                              {
                                "value": 10694,
                                "id": 536
                              },
                              {
                                "value": 473326,
                                "id": 749
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29551,
                  "parentId": 29450,
                  "title": "Недвижимость за рубежом",
                  "navigation": {
                    "categoryId": 86
                  },
                  "children": [
                    {
                      "id": 29552,
                      "parentId": 29551,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 86,
                        "attributes": [
                          {
                            "value": 1079,
                            "id": 205
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29553,
                          "parentId": 29552,
                          "title": "Квартира, апартаменты",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1079,
                                "id": 205
                              },
                              {
                                "value": 5540,
                                "id": 535
                              }
                            ]
                          }
                        },
                        {
                          "id": 29554,
                          "parentId": 29552,
                          "title": "Дом, вилла",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1079,
                                "id": 205
                              },
                              {
                                "value": 5541,
                                "id": 535
                              }
                            ]
                          }
                        },
                        {
                          "id": 29555,
                          "parentId": 29552,
                          "title": "Земельный участок",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1079,
                                "id": 205
                              },
                              {
                                "value": 10717,
                                "id": 535
                              }
                            ]
                          }
                        },
                        {
                          "id": 29556,
                          "parentId": 29552,
                          "title": "Гараж, машиноместо",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1079,
                                "id": 205
                              },
                              {
                                "value": 10718,
                                "id": 535
                              }
                            ]
                          }
                        },
                        {
                          "id": 29557,
                          "parentId": 29552,
                          "title": "Коммерческая недвижимость",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1079,
                                "id": 205
                              },
                              {
                                "value": 5542,
                                "id": 535
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29558,
                      "parentId": 29551,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 86,
                        "attributes": [
                          {
                            "value": 1080,
                            "id": 205
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29559,
                          "parentId": 29558,
                          "title": "Квартира, апартаменты",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1080,
                                "id": 205
                              },
                              {
                                "value": 6078,
                                "id": 591
                              }
                            ]
                          }
                        },
                        {
                          "id": 29560,
                          "parentId": 29558,
                          "title": "Дом, вилла",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1080,
                                "id": 205
                              },
                              {
                                "value": 6079,
                                "id": 591
                              }
                            ]
                          }
                        },
                        {
                          "id": 29561,
                          "parentId": 29558,
                          "title": "Земельный участок",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1080,
                                "id": 205
                              },
                              {
                                "value": 10719,
                                "id": 591
                              }
                            ]
                          }
                        },
                        {
                          "id": 29562,
                          "parentId": 29558,
                          "title": "Гараж, машиноместо",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1080,
                                "id": 205
                              },
                              {
                                "value": 10720,
                                "id": 591
                              }
                            ]
                          }
                        },
                        {
                          "id": 29563,
                          "parentId": 29558,
                          "title": "Коммерческая недвижимость",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1080,
                                "id": 205
                              },
                              {
                                "value": 6077,
                                "id": 591
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29564,
                      "parentId": 29551,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 86,
                        "attributes": [
                          {
                            "value": 1078,
                            "id": 205
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29565,
                          "parentId": 29564,
                          "title": "Квартира, апартаменты",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1078,
                                "id": 205
                              },
                              {
                                "value": 10721,
                                "id": 752
                              }
                            ]
                          }
                        },
                        {
                          "id": 29566,
                          "parentId": 29564,
                          "title": "Дом, вилла",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1078,
                                "id": 205
                              },
                              {
                                "value": 10722,
                                "id": 752
                              }
                            ]
                          }
                        },
                        {
                          "id": 29567,
                          "parentId": 29564,
                          "title": "Земельный участок",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1078,
                                "id": 205
                              },
                              {
                                "value": 10723,
                                "id": 752
                              }
                            ]
                          }
                        },
                        {
                          "id": 29568,
                          "parentId": 29564,
                          "title": "Гараж, машиноместо",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1078,
                                "id": 205
                              },
                              {
                                "value": 10724,
                                "id": 752
                              }
                            ]
                          }
                        },
                        {
                          "id": 29569,
                          "parentId": 29564,
                          "title": "Коммерческая недвижимость",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1078,
                                "id": 205
                              },
                              {
                                "value": 10725,
                                "id": 752
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29570,
                      "parentId": 29551,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 86,
                        "attributes": [
                          {
                            "value": 1081,
                            "id": 205
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29571,
                          "parentId": 29570,
                          "title": "Квартира, апартаменты",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1081,
                                "id": 205
                              },
                              {
                                "value": 10726,
                                "id": 753
                              }
                            ]
                          }
                        },
                        {
                          "id": 29572,
                          "parentId": 29570,
                          "title": "Дом, вилла",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1081,
                                "id": 205
                              },
                              {
                                "value": 10727,
                                "id": 753
                              }
                            ]
                          }
                        },
                        {
                          "id": 29573,
                          "parentId": 29570,
                          "title": "Земельный участок",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1081,
                                "id": 205
                              },
                              {
                                "value": 10728,
                                "id": 753
                              }
                            ]
                          }
                        },
                        {
                          "id": 29574,
                          "parentId": 29570,
                          "title": "Гараж, машиноместо",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1081,
                                "id": 205
                              },
                              {
                                "value": 10729,
                                "id": 753
                              }
                            ]
                          }
                        },
                        {
                          "id": 29575,
                          "parentId": 29570,
                          "title": "Коммерческая недвижимость",
                          "navigation": {
                            "categoryId": 86,
                            "attributes": [
                              {
                                "value": 1081,
                                "id": 205
                              },
                              {
                                "value": 10730,
                                "id": 753
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29451,
                  "parentId": 29450,
                  "title": "Квартиры",
                  "navigation": {
                    "categoryId": 24
                  },
                  "children": [
                    {
                      "id": 29452,
                      "parentId": 29451,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 24,
                        "attributes": [
                          {
                            "value": 1059,
                            "id": 201
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29453,
                          "parentId": 29452,
                          "title": "Вторичка",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1059,
                                "id": 201
                              },
                              {
                                "value": 11021,
                                "id": 549
                              },
                              {
                                "value": 5254,
                                "id": 499
                              }
                            ]
                          }
                        },
                        {
                          "id": 29454,
                          "parentId": 29452,
                          "title": "Новостройка",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1059,
                                "id": 201
                              },
                              {
                                "value": 11021,
                                "id": 549
                              },
                              {
                                "value": 5255,
                                "id": 499
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29455,
                      "parentId": 29451,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 24,
                        "attributes": [
                          {
                            "value": 1060,
                            "id": 201
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29456,
                          "parentId": 29455,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1060,
                                "id": 201
                              },
                              {
                                "value": 5256,
                                "id": 504
                              }
                            ]
                          }
                        },
                        {
                          "id": 29457,
                          "parentId": 29455,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1060,
                                "id": 201
                              },
                              {
                                "value": 5257,
                                "id": 504
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29458,
                      "parentId": 29451,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 24,
                        "attributes": [
                          {
                            "value": 1058,
                            "id": 201
                          }
                        ]
                      }
                    },
                    {
                      "id": 29459,
                      "parentId": 29451,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 24,
                        "attributes": [
                          {
                            "value": 1061,
                            "id": 201
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29460,
                          "parentId": 29459,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1061,
                                "id": 201
                              },
                              {
                                "value": 10958,
                                "id": 765
                              }
                            ]
                          }
                        },
                        {
                          "id": 29461,
                          "parentId": 29459,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 24,
                            "attributes": [
                              {
                                "value": 1061,
                                "id": 201
                              },
                              {
                                "value": 10957,
                                "id": 765
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29462,
                  "parentId": 29450,
                  "title": "Комнаты",
                  "navigation": {
                    "categoryId": 23
                  },
                  "children": [
                    {
                      "id": 29463,
                      "parentId": 29462,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 23,
                        "attributes": [
                          {
                            "value": 1054,
                            "id": 200
                          }
                        ]
                      }
                    },
                    {
                      "id": 29464,
                      "parentId": 29462,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 23,
                        "attributes": [
                          {
                            "value": 1055,
                            "id": 200
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29465,
                          "parentId": 29464,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 23,
                            "attributes": [
                              {
                                "value": 1055,
                                "id": 200
                              },
                              {
                                "value": 6203,
                                "id": 596
                              }
                            ]
                          }
                        },
                        {
                          "id": 29466,
                          "parentId": 29464,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 23,
                            "attributes": [
                              {
                                "value": 1055,
                                "id": 200
                              },
                              {
                                "value": 6204,
                                "id": 596
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29467,
                      "parentId": 29462,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 23,
                        "attributes": [
                          {
                            "value": 1053,
                            "id": 200
                          }
                        ]
                      }
                    },
                    {
                      "id": 29468,
                      "parentId": 29462,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 23,
                        "attributes": [
                          {
                            "value": 1056,
                            "id": 200
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29469,
                          "parentId": 29468,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 23,
                            "attributes": [
                              {
                                "value": 1056,
                                "id": 200
                              },
                              {
                                "value": 10979,
                                "id": 778
                              }
                            ]
                          }
                        },
                        {
                          "id": 29470,
                          "parentId": 29468,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 23,
                            "attributes": [
                              {
                                "value": 1056,
                                "id": 200
                              },
                              {
                                "value": 10980,
                                "id": 778
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29471,
                  "parentId": 29450,
                  "title": "Дома, дачи, коттеджи",
                  "navigation": {
                    "categoryId": 25
                  },
                  "children": [
                    {
                      "id": 29476,
                      "parentId": 29471,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 25,
                        "attributes": [
                          {
                            "value": 1063,
                            "id": 202
                          }
                        ]
                      }
                    },
                    {
                      "id": 29477,
                      "parentId": 29471,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 25,
                        "attributes": [
                          {
                            "value": 1066,
                            "id": 202
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29478,
                          "parentId": 29477,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 25,
                            "attributes": [
                              {
                                "value": 1066,
                                "id": 202
                              },
                              {
                                "value": 5748,
                                "id": 559
                              },
                              {
                                "value": 11010,
                                "id": 791
                              }
                            ]
                          }
                        },
                        {
                          "id": 29479,
                          "parentId": 29477,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 25,
                            "attributes": [
                              {
                                "value": 1066,
                                "id": 202
                              },
                              {
                                "value": 5748,
                                "id": 559
                              },
                              {
                                "value": 11009,
                                "id": 791
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29472,
                      "parentId": 29471,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 25,
                        "attributes": [
                          {
                            "value": 1064,
                            "id": 202
                          }
                        ]
                      }
                    },
                    {
                      "id": 29473,
                      "parentId": 29471,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 25,
                        "attributes": [
                          {
                            "value": 1065,
                            "id": 202
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29475,
                          "parentId": 29473,
                          "title": "На длительный срок",
                          "navigation": {
                            "categoryId": 25,
                            "attributes": [
                              {
                                "value": 1065,
                                "id": 202
                              },
                              {
                                "value": 5740,
                                "id": 557
                              },
                              {
                                "value": 5476,
                                "id": 528
                              }
                            ]
                          }
                        },
                        {
                          "id": 29474,
                          "parentId": 29473,
                          "title": "Посуточно",
                          "navigation": {
                            "categoryId": 25,
                            "attributes": [
                              {
                                "value": 1065,
                                "id": 202
                              },
                              {
                                "value": 5740,
                                "id": 557
                              },
                              {
                                "value": 5477,
                                "id": 528
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29480,
                  "parentId": 29450,
                  "title": "Земельные участки",
                  "navigation": {
                    "categoryId": 26
                  },
                  "children": [
                    {
                      "id": 29481,
                      "parentId": 29480,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 26,
                        "attributes": [
                          {
                            "value": 1069,
                            "id": 203
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29482,
                          "parentId": 29481,
                          "title": "Поселений (ИЖС)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1069,
                                "id": 203
                              },
                              {
                                "value": 5491,
                                "id": 531
                              }
                            ]
                          }
                        },
                        {
                          "id": 29483,
                          "parentId": 29481,
                          "title": "Сельхозназначения (СНТ, ДНП)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1069,
                                "id": 203
                              },
                              {
                                "value": 5492,
                                "id": 531
                              }
                            ]
                          }
                        },
                        {
                          "id": 29484,
                          "parentId": 29481,
                          "title": "Промназначения",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1069,
                                "id": 203
                              },
                              {
                                "value": 5493,
                                "id": 531
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29485,
                      "parentId": 29480,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 26,
                        "attributes": [
                          {
                            "value": 1070,
                            "id": 203
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29486,
                          "parentId": 29485,
                          "title": "Поселений (ИЖС)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1070,
                                "id": 203
                              },
                              {
                                "value": 10515,
                                "id": 744
                              }
                            ]
                          }
                        },
                        {
                          "id": 29487,
                          "parentId": 29485,
                          "title": "Сельхозназначения (СНТ, ДНП)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1070,
                                "id": 203
                              },
                              {
                                "value": 10517,
                                "id": 744
                              }
                            ]
                          }
                        },
                        {
                          "id": 29488,
                          "parentId": 29485,
                          "title": "Промназначения",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1070,
                                "id": 203
                              },
                              {
                                "value": 10516,
                                "id": 744
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29489,
                      "parentId": 29480,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 26,
                        "attributes": [
                          {
                            "value": 1068,
                            "id": 203
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29490,
                          "parentId": 29489,
                          "title": "Поселений (ИЖС)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1068,
                                "id": 203
                              },
                              {
                                "value": 10714,
                                "id": 751
                              }
                            ]
                          }
                        },
                        {
                          "id": 29491,
                          "parentId": 29489,
                          "title": "Сельхозназначения (СНТ, ДНП)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1068,
                                "id": 203
                              },
                              {
                                "value": 10712,
                                "id": 751
                              }
                            ]
                          }
                        },
                        {
                          "id": 29492,
                          "parentId": 29489,
                          "title": "Промназначения",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1068,
                                "id": 203
                              },
                              {
                                "value": 10713,
                                "id": 751
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29493,
                      "parentId": 29480,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 26,
                        "attributes": [
                          {
                            "value": 1071,
                            "id": 203
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29494,
                          "parentId": 29493,
                          "title": "Поселений (ИЖС)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1071,
                                "id": 203
                              },
                              {
                                "value": 10688,
                                "id": 746
                              }
                            ]
                          }
                        },
                        {
                          "id": 29495,
                          "parentId": 29493,
                          "title": "Сельхозназначения (СНТ, ДНП)",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1071,
                                "id": 203
                              },
                              {
                                "value": 10689,
                                "id": 746
                              }
                            ]
                          }
                        },
                        {
                          "id": 29496,
                          "parentId": 29493,
                          "title": "Промназначения",
                          "navigation": {
                            "categoryId": 26,
                            "attributes": [
                              {
                                "value": 1071,
                                "id": 203
                              },
                              {
                                "value": 10690,
                                "id": 746
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29497,
                  "parentId": 29450,
                  "title": "Гаражи и машиноместа",
                  "navigation": {
                    "categoryId": 85
                  },
                  "children": [
                    {
                      "id": 29498,
                      "parentId": 29497,
                      "title": "Продам",
                      "navigation": {
                        "categoryId": 85,
                        "attributes": [
                          {
                            "value": 1074,
                            "id": 204
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29499,
                          "parentId": 29498,
                          "title": "Гараж",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1074,
                                "id": 204
                              },
                              {
                                "value": 5494,
                                "id": 532
                              }
                            ]
                          }
                        },
                        {
                          "id": 29500,
                          "parentId": 29498,
                          "title": "Машиноместо",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1074,
                                "id": 204
                              },
                              {
                                "value": 5495,
                                "id": 532
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29501,
                      "parentId": 29497,
                      "title": "Сдам",
                      "navigation": {
                        "categoryId": 85,
                        "attributes": [
                          {
                            "value": 1075,
                            "id": 204
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29502,
                          "parentId": 29501,
                          "title": "Гараж",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1075,
                                "id": 204
                              },
                              {
                                "value": 5819,
                                "id": 563
                              }
                            ]
                          }
                        },
                        {
                          "id": 29503,
                          "parentId": 29501,
                          "title": "Машиноместо",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1075,
                                "id": 204
                              },
                              {
                                "value": 5820,
                                "id": 563
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29504,
                      "parentId": 29497,
                      "title": "Куплю",
                      "navigation": {
                        "categoryId": 85,
                        "attributes": [
                          {
                            "value": 1073,
                            "id": 204
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29505,
                          "parentId": 29504,
                          "title": "Гараж",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1073,
                                "id": 204
                              },
                              {
                                "value": 10897,
                                "id": 756
                              }
                            ]
                          }
                        },
                        {
                          "id": 29506,
                          "parentId": 29504,
                          "title": "Машиноместо",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1073,
                                "id": 204
                              },
                              {
                                "value": 10898,
                                "id": 756
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29507,
                      "parentId": 29497,
                      "title": "Сниму",
                      "navigation": {
                        "categoryId": 85,
                        "attributes": [
                          {
                            "value": 1076,
                            "id": 204
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29509,
                          "parentId": 29507,
                          "title": "Машиноместо",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1076,
                                "id": 204
                              },
                              {
                                "value": 10982,
                                "id": 779
                              }
                            ]
                          }
                        },
                        {
                          "id": 29508,
                          "parentId": 29507,
                          "title": "Гараж",
                          "navigation": {
                            "categoryId": 85,
                            "attributes": [
                              {
                                "value": 1076,
                                "id": 204
                              },
                              {
                                "value": 10981,
                                "id": 779
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                }
              ]
            },
            {
              "id": 29576,
              "parentId": 29369,
              "title": "Работа",
              "navigation": {
                "categoryId": 110
              },
              "children": [
                {
                  "id": 29603,
                  "parentId": 29576,
                  "title": "Резюме",
                  "navigation": {
                    "categoryId": 112
                  },
                  "children": [
                    {
                      "id": 29604,
                      "parentId": 29603,
                      "title": "IT, интернет, телеком",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10166,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29605,
                      "parentId": 29603,
                      "title": "Автомобильный бизнес",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10180,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29606,
                      "parentId": 29603,
                      "title": "Административная работа",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10191,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29607,
                      "parentId": 29603,
                      "title": "Банки, инвестиции",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10192,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29608,
                      "parentId": 29603,
                      "title": "Без опыта, студенты",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10175,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29609,
                      "parentId": 29603,
                      "title": "Бухгалтерия, финансы",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10181,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29610,
                      "parentId": 29603,
                      "title": "Высший менеджмент",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10182,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29611,
                      "parentId": 29603,
                      "title": "Госслужба, НКО",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10183,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29612,
                      "parentId": 29603,
                      "title": "Домашний персонал",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 16844,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29613,
                      "parentId": 29603,
                      "title": "ЖКХ, эксплуатация",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10184,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29614,
                      "parentId": 29603,
                      "title": "Искусство, развлечения",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10185,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29615,
                      "parentId": 29603,
                      "title": "Консультирование",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10186,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 31209,
                      "parentId": 29603,
                      "title": "Курьерская доставка",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 2804251,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29616,
                      "parentId": 29603,
                      "title": "Маркетинг, реклама, PR",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10187,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29617,
                      "parentId": 29603,
                      "title": "Медицина, фармацевтика",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10167,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29618,
                      "parentId": 29603,
                      "title": "Образование, наука",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10171,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29619,
                      "parentId": 29603,
                      "title": "Охрана, безопасность",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10188,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29620,
                      "parentId": 29603,
                      "title": "Продажи",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10168,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29621,
                      "parentId": 29603,
                      "title": "Производство, сырьё, с/х",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10193,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29622,
                      "parentId": 29603,
                      "title": "Страхование",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10169,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29623,
                      "parentId": 29603,
                      "title": "Строительство",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10172,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 31208,
                      "parentId": 29603,
                      "title": "Такси",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 2804250,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29624,
                      "parentId": 29603,
                      "title": "Транспорт, логистика",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10170,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29625,
                      "parentId": 29603,
                      "title": "Туризм, рестораны",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10173,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29626,
                      "parentId": 29603,
                      "title": "Управление персоналом",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10189,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29627,
                      "parentId": 29603,
                      "title": "Фитнес, салоны красоты",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10174,
                            "id": 714
                          }
                        ]
                      }
                    },
                    {
                      "id": 29628,
                      "parentId": 29603,
                      "title": "Юриспруденция",
                      "navigation": {
                        "categoryId": 112,
                        "attributes": [
                          {
                            "value": 10190,
                            "id": 714
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29577,
                  "parentId": 29576,
                  "title": "Вакансии",
                  "navigation": {
                    "categoryId": 111
                  },
                  "children": [
                    {
                      "id": 29578,
                      "parentId": 29577,
                      "title": "IT, интернет, телеком",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10106,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29579,
                      "parentId": 29577,
                      "title": "Автомобильный бизнес",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10120,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29580,
                      "parentId": 29577,
                      "title": "Административная работа",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10131,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29581,
                      "parentId": 29577,
                      "title": "Банки, инвестиции",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10132,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29582,
                      "parentId": 29577,
                      "title": "Без опыта, студенты",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10115,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29583,
                      "parentId": 29577,
                      "title": "Бухгалтерия, финансы",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10121,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29584,
                      "parentId": 29577,
                      "title": "Высший менеджмент",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10122,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29585,
                      "parentId": 29577,
                      "title": "Госслужба, НКО",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10123,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29586,
                      "parentId": 29577,
                      "title": "Домашний персонал",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 16845,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29587,
                      "parentId": 29577,
                      "title": "ЖКХ, эксплуатация",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10124,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29588,
                      "parentId": 29577,
                      "title": "Искусство, развлечения",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10125,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29589,
                      "parentId": 29577,
                      "title": "Консультирование",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10126,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 31207,
                      "parentId": 29577,
                      "title": "Курьерская доставка",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 2804249,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29590,
                      "parentId": 29577,
                      "title": "Маркетинг, реклама, PR",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10127,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29591,
                      "parentId": 29577,
                      "title": "Медицина, фармацевтика",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10107,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29592,
                      "parentId": 29577,
                      "title": "Образование, наука",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10111,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29593,
                      "parentId": 29577,
                      "title": "Охрана, безопасность",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10128,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29594,
                      "parentId": 29577,
                      "title": "Продажи",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10108,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29595,
                      "parentId": 29577,
                      "title": "Производство, сырьё, с/х",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10133,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29596,
                      "parentId": 29577,
                      "title": "Страхование",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10109,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29597,
                      "parentId": 29577,
                      "title": "Строительство",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10112,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 31206,
                      "parentId": 29577,
                      "title": "Такси",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 2804093,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29598,
                      "parentId": 29577,
                      "title": "Транспорт, логистика",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10110,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29599,
                      "parentId": 29577,
                      "title": "Туризм, рестораны",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10113,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29600,
                      "parentId": 29577,
                      "title": "Управление персоналом",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10129,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29601,
                      "parentId": 29577,
                      "title": "Фитнес, салоны красоты",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10114,
                            "id": 711
                          }
                        ]
                      }
                    },
                    {
                      "id": 29602,
                      "parentId": 29577,
                      "title": "Юриспруденция",
                      "navigation": {
                        "categoryId": 111,
                        "attributes": [
                          {
                            "value": 10130,
                            "id": 711
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 29629,
              "parentId": 29369,
              "title": "Услуги",
              "navigation": {
                "categoryId": 113
              },
              "children": [
                {
                  "id": 29630,
                  "parentId": 29629,
                  "title": "Предложение услуг",
                  "navigation": {
                    "categoryId": 114
                  },
                  "children": [
                    {
                      "id": 29631,
                      "parentId": 29630,
                      "title": "IT, интернет, телеком",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10195,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29632,
                          "parentId": 29631,
                          "title": "Cоздание и продвижение сайтов",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10195,
                                "id": 716
                              },
                              {
                                "value": 15328,
                                "id": 1371
                              }
                            ]
                          }
                        },
                        {
                          "id": 29635,
                          "parentId": 29631,
                          "title": "Мастер на все случаи",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10195,
                                "id": 716
                              },
                              {
                                "value": 15330,
                                "id": 1371
                              }
                            ]
                          }
                        },
                        {
                          "id": 29634,
                          "parentId": 29631,
                          "title": "Настройка интернета и сетей",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10195,
                                "id": 716
                              },
                              {
                                "value": 15329,
                                "id": 1371
                              }
                            ]
                          }
                        },
                        {
                          "id": 29633,
                          "parentId": 29631,
                          "title": "Установка и настройка ПО",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10195,
                                "id": 716
                              },
                              {
                                "value": 15331,
                                "id": 1371
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29636,
                      "parentId": 29630,
                      "title": "Бытовые услуги",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10200,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29637,
                          "parentId": 29636,
                          "title": "Изготовление ключей",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10200,
                                "id": 716
                              },
                              {
                                "value": 10225,
                                "id": 718
                              }
                            ]
                          }
                        },
                        {
                          "id": 29638,
                          "parentId": 29636,
                          "title": "Пошив и ремонт одежды",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10200,
                                "id": 716
                              },
                              {
                                "value": 10227,
                                "id": 718
                              }
                            ]
                          }
                        },
                        {
                          "id": 29639,
                          "parentId": 29636,
                          "title": "Ремонт часов",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10200,
                                "id": 716
                              },
                              {
                                "value": 10229,
                                "id": 718
                              }
                            ]
                          }
                        },
                        {
                          "id": 29640,
                          "parentId": 29636,
                          "title": "Химчистка, стирка",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10200,
                                "id": 716
                              },
                              {
                                "value": 10233,
                                "id": 718
                              }
                            ]
                          }
                        },
                        {
                          "id": 29641,
                          "parentId": 29636,
                          "title": "Ювелирные услуги",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10200,
                                "id": 716
                              },
                              {
                                "value": 10234,
                                "id": 718
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29642,
                      "parentId": 29630,
                      "title": "Деловые услуги",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10201,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29643,
                          "parentId": 29642,
                          "title": "Бухгалтерия, финансы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 10235,
                                "id": 719
                              }
                            ]
                          }
                        },
                        {
                          "id": 29644,
                          "parentId": 29642,
                          "title": "Консультирование",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 10236,
                                "id": 719
                              }
                            ]
                          }
                        },
                        {
                          "id": 29645,
                          "parentId": 29642,
                          "title": "Набор и коррекция текста",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 10238,
                                "id": 719
                              }
                            ]
                          }
                        },
                        {
                          "id": 29646,
                          "parentId": 29642,
                          "title": "Перевод",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 10239,
                                "id": 719
                              }
                            ]
                          }
                        },
                        {
                          "id": 29647,
                          "parentId": 29642,
                          "title": "Юридические услуги",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 10241,
                                "id": 719
                              }
                            ]
                          }
                        },
                        {
                          "id": 34207,
                          "parentId": 29642,
                          "title": "Страхование",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10201,
                                "id": 716
                              },
                              {
                                "value": 3155208,
                                "id": 719
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29648,
                      "parentId": 29630,
                      "title": "Искусство",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10220,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29649,
                      "parentId": 29630,
                      "title": "Красота, здоровье",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10197,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29650,
                          "parentId": 29649,
                          "title": "Услуги парикмахера",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19971,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29651,
                          "parentId": 29649,
                          "title": "Маникюр, педикюр",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19968,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29652,
                          "parentId": 29649,
                          "title": "Макияж",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19967,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29653,
                          "parentId": 29649,
                          "title": "Косметология, эпиляция",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19966,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29654,
                          "parentId": 29649,
                          "title": "СПА-услуги, здоровье",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19969,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29655,
                          "parentId": 29649,
                          "title": "Тату, пирсинг",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19970,
                                "id": 2769
                              }
                            ]
                          }
                        },
                        {
                          "id": 29656,
                          "parentId": 29649,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10197,
                                "id": 716
                              },
                              {
                                "value": 19972,
                                "id": 2769
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29657,
                      "parentId": 29630,
                      "title": "Курьерские поручения",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 15731,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29658,
                      "parentId": 29630,
                      "title": "Мастер на час",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 15326,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29659,
                      "parentId": 29630,
                      "title": "Няни, сиделки",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10196,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29660,
                      "parentId": 29630,
                      "title": "Оборудование, производство",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10202,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29661,
                          "parentId": 29660,
                          "title": "Аренда оборудования",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10202,
                                "id": 716
                              },
                              {
                                "value": 10242,
                                "id": 720
                              }
                            ]
                          }
                        },
                        {
                          "id": 29662,
                          "parentId": 29660,
                          "title": "Монтаж и обслуживание оборудования",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10202,
                                "id": 716
                              },
                              {
                                "value": 10243,
                                "id": 720
                              }
                            ]
                          }
                        },
                        {
                          "id": 29663,
                          "parentId": 29660,
                          "title": "Производство, обработка",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10202,
                                "id": 716
                              },
                              {
                                "value": 10244,
                                "id": 720
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29664,
                      "parentId": 29630,
                      "title": "Обучение, курсы",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10203,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29665,
                          "parentId": 29664,
                          "title": "Предметы школы и ВУЗа",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19977,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29666,
                          "parentId": 29664,
                          "title": "Иностранные языки",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19975,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29667,
                          "parentId": 29664,
                          "title": "Вождение",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19973,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29668,
                          "parentId": 29664,
                          "title": "Музыка, театр",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19976,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29669,
                          "parentId": 29664,
                          "title": "Спорт, танцы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19980,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29670,
                          "parentId": 29664,
                          "title": "Рисование, дизайн, рукоделие",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19979,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29671,
                          "parentId": 29664,
                          "title": "Профессиональная подготовка",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19978,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29672,
                          "parentId": 29664,
                          "title": "Детское развитие, логопеды",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19974,
                                "id": 2770
                              }
                            ]
                          }
                        },
                        {
                          "id": 29673,
                          "parentId": 29664,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10203,
                                "id": 716
                              },
                              {
                                "value": 19981,
                                "id": 2770
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29674,
                      "parentId": 29630,
                      "title": "Охрана, безопасность",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10204,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29675,
                      "parentId": 29630,
                      "title": "Питание, кейтеринг",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10205,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29676,
                      "parentId": 29630,
                      "title": "Праздники, мероприятия",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10206,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29677,
                      "parentId": 29630,
                      "title": "Реклама, полиграфия",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10207,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29678,
                          "parentId": 29677,
                          "title": "Маркетинг, реклама, PR",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10207,
                                "id": 716
                              },
                              {
                                "value": 10245,
                                "id": 721
                              }
                            ]
                          }
                        },
                        {
                          "id": 29679,
                          "parentId": 29677,
                          "title": "Полиграфия, дизайн",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10207,
                                "id": 716
                              },
                              {
                                "value": 10246,
                                "id": 721
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29680,
                      "parentId": 29630,
                      "title": "Ремонт и обслуживание техники",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 15834,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29681,
                          "parentId": 29680,
                          "title": "Телевизоры",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15853,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29686,
                          "parentId": 29680,
                          "title": "Компьютерная техника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15855,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29687,
                          "parentId": 29680,
                          "title": "Игровые приставки",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15854,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29685,
                          "parentId": 29680,
                          "title": "Крупная бытовая техника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15858,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29684,
                          "parentId": 29680,
                          "title": "Мелкая бытовая техника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15856,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29683,
                          "parentId": 29680,
                          "title": "Мобильные устройства",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15857,
                                "id": 1391
                              }
                            ]
                          }
                        },
                        {
                          "id": 29682,
                          "parentId": 29680,
                          "title": "Фото-, аудио-, видеотехника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15834,
                                "id": 716
                              },
                              {
                                "value": 15859,
                                "id": 1391
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29688,
                      "parentId": 29630,
                      "title": "Ремонт и отделка",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10208,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29689,
                          "parentId": 29688,
                          "title": "Сборка и ремонт мебели",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15702,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 29691,
                          "parentId": 29688,
                          "title": "Электрика",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15704,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 29692,
                          "parentId": 29688,
                          "title": "Сантехника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15705,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 29693,
                          "parentId": 29688,
                          "title": "Ремонт офиса",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15706,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 29694,
                          "parentId": 29688,
                          "title": "Остекление балконов",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15707,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34105,
                          "parentId": 29688,
                          "title": "Вентиляция",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128989,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 29699,
                          "parentId": 29688,
                          "title": "Ремонт квартир и домов под ключ",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 15712,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34106,
                          "parentId": 29688,
                          "title": "Высотные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128990,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34107,
                          "parentId": 29688,
                          "title": "Гипсокартонные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128991,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34108,
                          "parentId": 29688,
                          "title": "Двери",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128992,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34109,
                          "parentId": 29688,
                          "title": "Изоляция",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128993,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34110,
                          "parentId": 29688,
                          "title": "Металлоконструкции и кованые изделия",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128994,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34112,
                          "parentId": 29688,
                          "title": "Плиточные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128996,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34113,
                          "parentId": 29688,
                          "title": "Поклейка обоев и малярные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128997,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34114,
                          "parentId": 29688,
                          "title": "Полы и напольные покрытия",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128998,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34115,
                          "parentId": 29688,
                          "title": "Потолки",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3128999,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34116,
                          "parentId": 29688,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3129000,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34117,
                          "parentId": 29688,
                          "title": "Столярные и плотницкие работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3129152,
                                "id": 1378
                              }
                            ]
                          }
                        },
                        {
                          "id": 34118,
                          "parentId": 29688,
                          "title": "Штукатурные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10208,
                                "id": 716
                              },
                              {
                                "value": 3129153,
                                "id": 1378
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 34717,
                      "parentId": 29630,
                      "title": "Строительство",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 3024848,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 34731,
                          "parentId": 34717,
                          "title": "Строительство бань, саун",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 3024848,
                                "id": 716
                              },
                              {
                                "value": 3024846,
                                "id": 123887
                              }
                            ]
                          }
                        },
                        {
                          "id": 34732,
                          "parentId": 34717,
                          "title": "Строительство домов, коттеджей",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 3024848,
                                "id": 716
                              },
                              {
                                "value": 3024847,
                                "id": 123887
                              }
                            ]
                          }
                        },
                        {
                          "id": 34733,
                          "parentId": 34717,
                          "title": "Отделка деревянных домов, бань, саун",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 3024848,
                                "id": 716
                              },
                              {
                                "value": 3204142,
                                "id": 123887
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29700,
                      "parentId": 29630,
                      "title": "Сад, благоустройство",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10209,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31358,
                          "parentId": 29700,
                          "title": "Cкважины, колодцы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707833,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31359,
                          "parentId": 29700,
                          "title": "Водоёмы и фонтаны",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707834,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31360,
                          "parentId": 29700,
                          "title": "Дорожное строительство",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707835,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31361,
                          "parentId": 29700,
                          "title": "Заборы, ограждения, навесы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707836,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31362,
                          "parentId": 29700,
                          "title": "Земляные работы",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707837,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31363,
                          "parentId": 29700,
                          "title": "Озеленение, уход за садом и огородом",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707838,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31364,
                          "parentId": 29700,
                          "title": "Рольставни и ворота",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 1707839,
                                "id": 117672
                              }
                            ]
                          }
                        },
                        {
                          "id": 31365,
                          "parentId": 29700,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10209,
                                "id": 716
                              },
                              {
                                "value": 2309151,
                                "id": 117672
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29701,
                      "parentId": 29630,
                      "title": "Транспорт, перевозки",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10210,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29702,
                          "parentId": 29701,
                          "title": "Автосервис",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 10221,
                                "id": 717
                              }
                            ]
                          }
                        },
                        {
                          "id": 29703,
                          "parentId": 29701,
                          "title": "Аренда авто",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 15871,
                                "id": 717
                              }
                            ]
                          }
                        },
                        {
                          "id": 29704,
                          "parentId": 29701,
                          "title": "Коммерческие перевозки",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 15876,
                                "id": 717
                              }
                            ]
                          }
                        },
                        {
                          "id": 29705,
                          "parentId": 29701,
                          "title": "Грузчики",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 15877,
                                "id": 717
                              }
                            ]
                          }
                        },
                        {
                          "id": 29706,
                          "parentId": 29701,
                          "title": "Переезды",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 15878,
                                "id": 717
                              }
                            ]
                          }
                        },
                        {
                          "id": 29707,
                          "parentId": 29701,
                          "title": "Спецтехника",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 10210,
                                "id": 716
                              },
                              {
                                "value": 10222,
                                "id": 717
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29708,
                      "parentId": 29630,
                      "title": "Уборка",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 15833,
                            "id": 716
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29709,
                          "parentId": 29708,
                          "title": "Вывоз мусора",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15837,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29710,
                          "parentId": 29708,
                          "title": "Генеральная уборка",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15838,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29711,
                          "parentId": 29708,
                          "title": "Глажка белья",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15839,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29712,
                          "parentId": 29708,
                          "title": "Мойка окон",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15840,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29713,
                          "parentId": 29708,
                          "title": "Простая уборка",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15841,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29714,
                          "parentId": 29708,
                          "title": "Уборка после ремонта",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15842,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29715,
                          "parentId": 29708,
                          "title": "Чистка ковров",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15843,
                                "id": 1389
                              }
                            ]
                          }
                        },
                        {
                          "id": 29716,
                          "parentId": 29708,
                          "title": "Чистка мягкой мебели",
                          "navigation": {
                            "categoryId": 114,
                            "attributes": [
                              {
                                "value": 15833,
                                "id": 716
                              },
                              {
                                "value": 15844,
                                "id": 1389
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29717,
                      "parentId": 29630,
                      "title": "Установка техники",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 15725,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29718,
                      "parentId": 29630,
                      "title": "Уход за животными",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10211,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29719,
                      "parentId": 29630,
                      "title": "Фото- и видеосъёмка",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10212,
                            "id": 716
                          }
                        ]
                      }
                    },
                    {
                      "id": 29720,
                      "parentId": 29630,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 114,
                        "attributes": [
                          {
                            "value": 10213,
                            "id": 716
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 29721,
              "parentId": 29369,
              "title": "Личные вещи",
              "navigation": {
                "categoryId": 5
              },
              "children": [
                {
                  "id": 29722,
                  "parentId": 29721,
                  "title": "Одежда, обувь, аксессуары",
                  "navigation": {
                    "categoryId": 27
                  },
                  "children": [
                    {
                      "id": 29723,
                      "parentId": 29722,
                      "title": "Женская одежда",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 747,
                            "id": 175
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29724,
                          "parentId": 29723,
                          "title": "Брюки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 240,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29725,
                          "parentId": 29723,
                          "title": "Верхняя одежда",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 241,
                                "id": 83
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 30364,
                              "parentId": 29725,
                              "title": "Шубы",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908120,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30365,
                              "parentId": 29725,
                              "title": "Пальто",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908121,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30539,
                              "parentId": 29725,
                              "title": "Зимние куртки и пуховики",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908122,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30366,
                              "parentId": 29725,
                              "title": "Демисезонные куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908123,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30367,
                              "parentId": 29725,
                              "title": "Плащи и тренчи",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908124,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30368,
                              "parentId": 29725,
                              "title": "Парки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908125,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30369,
                              "parentId": 29725,
                              "title": "Жилеты",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908126,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30370,
                              "parentId": 29725,
                              "title": "Джинсовые куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908127,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30371,
                              "parentId": 29725,
                              "title": "Лёгкие куртки и ветровки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908128,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30372,
                              "parentId": 29725,
                              "title": "Дублёнки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908129,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30373,
                              "parentId": 29725,
                              "title": "Кожаные куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908130,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30374,
                              "parentId": 29725,
                              "title": "Косухи",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908131,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30375,
                              "parentId": 29725,
                              "title": "Бомберы",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908132,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30376,
                              "parentId": 29725,
                              "title": "Пончо",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908133,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30377,
                              "parentId": 29725,
                              "title": "Анораки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908134,
                                    "id": 114144
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30378,
                              "parentId": 29725,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 747,
                                    "id": 175
                                  },
                                  {
                                    "value": 241,
                                    "id": 83
                                  },
                                  {
                                    "value": 908135,
                                    "id": 114144
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 29726,
                          "parentId": 29723,
                          "title": "Джинсы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 242,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29727,
                          "parentId": 29723,
                          "title": "Купальники",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 4829,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29728,
                          "parentId": 29723,
                          "title": "Нижнее бельё",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 4830,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29730,
                          "parentId": 29723,
                          "title": "Пиджаки и костюмы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 244,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29731,
                          "parentId": 29723,
                          "title": "Платья и юбки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 245,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29732,
                          "parentId": 29723,
                          "title": "Рубашки и блузки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 246,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29733,
                          "parentId": 29723,
                          "title": "Свадебные платья",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 4828,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29734,
                          "parentId": 29723,
                          "title": "Топы и футболки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 247,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29735,
                          "parentId": 29723,
                          "title": "Трикотаж",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 248,
                                "id": 83
                              }
                            ]
                          }
                        },
                        {
                          "id": 29736,
                          "parentId": 29723,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 747,
                                "id": 175
                              },
                              {
                                "value": 249,
                                "id": 83
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 30988,
                      "parentId": 29722,
                      "title": "Женская обувь",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 2804318,
                            "id": 175
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31652,
                          "parentId": 30988,
                          "title": "Туфли",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262787,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31653,
                          "parentId": 30988,
                          "title": "Сапоги",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262788,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31654,
                          "parentId": 30988,
                          "title": "Босоножки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262789,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31655,
                          "parentId": 30988,
                          "title": "Ботильоны",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262790,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31656,
                          "parentId": 30988,
                          "title": "Ботинки и полуботинки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262791,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31657,
                          "parentId": 30988,
                          "title": "Кроссовки и кеды",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262792,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31658,
                          "parentId": 30988,
                          "title": "Полусапоги",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262793,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31659,
                          "parentId": 30988,
                          "title": "Балетки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262794,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31660,
                          "parentId": 30988,
                          "title": "Угги, валенки, дутики",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262795,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31661,
                          "parentId": 30988,
                          "title": "Сабо и мюли",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262796,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31662,
                          "parentId": 30988,
                          "title": "Резиновая обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262797,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31663,
                          "parentId": 30988,
                          "title": "Мокасины и лоферы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262798,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31664,
                          "parentId": 30988,
                          "title": "Сандалии",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262799,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31665,
                          "parentId": 30988,
                          "title": "Шлёпанцы и сланцы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262800,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31666,
                          "parentId": 30988,
                          "title": "Домашняя обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262801,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31667,
                          "parentId": 30988,
                          "title": "Спортивная обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262802,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31737,
                          "parentId": 30988,
                          "title": "Слипоны и эспадрильи",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262803,
                                "id": 118570
                              }
                            ]
                          }
                        },
                        {
                          "id": 31668,
                          "parentId": 30988,
                          "title": "Уход за обувью",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804318,
                                "id": 175
                              },
                              {
                                "value": 2262804,
                                "id": 118570
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29737,
                      "parentId": 29722,
                      "title": "Мужская одежда",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 748,
                            "id": 175
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29740,
                          "parentId": 29737,
                          "title": "Джинсы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 752,
                                "id": 176
                              }
                            ]
                          }
                        },
                        {
                          "id": 29738,
                          "parentId": 29737,
                          "title": "Брюки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 750,
                                "id": 176
                              }
                            ]
                          }
                        },
                        {
                          "id": 29739,
                          "parentId": 29737,
                          "title": "Верхняя одежда",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 751,
                                "id": 176
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 30379,
                              "parentId": 29739,
                              "title": "Зимние куртки и пуховики",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908136,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30380,
                              "parentId": 29739,
                              "title": "Лёгкие куртки и ветровки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908137,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30381,
                              "parentId": 29739,
                              "title": "Демисезонные куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908138,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30382,
                              "parentId": 29739,
                              "title": "Пальто",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908139,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30383,
                              "parentId": 29739,
                              "title": "Дублёнки и шубы",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908140,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30384,
                              "parentId": 29739,
                              "title": "Жилеты",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908141,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30385,
                              "parentId": 29739,
                              "title": "Парки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908142,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30386,
                              "parentId": 29739,
                              "title": "Джинсовые куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908143,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30387,
                              "parentId": 29739,
                              "title": "Кожаные куртки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908144,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30388,
                              "parentId": 29739,
                              "title": "Бомберы",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908145,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30389,
                              "parentId": 29739,
                              "title": "Плащи и тренчи",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908146,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30390,
                              "parentId": 29739,
                              "title": "Косухи",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908147,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30391,
                              "parentId": 29739,
                              "title": "Анораки",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908148,
                                    "id": 114145
                                  }
                                ]
                              }
                            },
                            {
                              "id": 30392,
                              "parentId": 29739,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 27,
                                "attributes": [
                                  {
                                    "value": 748,
                                    "id": 175
                                  },
                                  {
                                    "value": 751,
                                    "id": 176
                                  },
                                  {
                                    "value": 908149,
                                    "id": 114145
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 29742,
                          "parentId": 29737,
                          "title": "Пиджаки и костюмы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 754,
                                "id": 176
                              }
                            ]
                          }
                        },
                        {
                          "id": 29743,
                          "parentId": 29737,
                          "title": "Рубашки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 942,
                                "id": 176
                              }
                            ]
                          }
                        },
                        {
                          "id": 29744,
                          "parentId": 29737,
                          "title": "Трикотаж и футболки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 756,
                                "id": 176
                              }
                            ]
                          }
                        },
                        {
                          "id": 29745,
                          "parentId": 29737,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 748,
                                "id": 175
                              },
                              {
                                "value": 757,
                                "id": 176
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 30990,
                      "parentId": 29722,
                      "title": "Мужская обувь",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 2804317,
                            "id": 175
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31637,
                          "parentId": 30990,
                          "title": "Кроссовки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262814,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31638,
                          "parentId": 30990,
                          "title": "Ботинки и полуботинки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262815,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31639,
                          "parentId": 30990,
                          "title": "Туфли",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262816,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31640,
                          "parentId": 30990,
                          "title": "Кеды",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262817,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31641,
                          "parentId": 30990,
                          "title": "Сапоги и полусапоги",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262818,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31642,
                          "parentId": 30990,
                          "title": "Мокасины и лоферы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262819,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31643,
                          "parentId": 30990,
                          "title": "Спортивная обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262820,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31644,
                          "parentId": 30990,
                          "title": "Угги, валенки, дутики",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262821,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31645,
                          "parentId": 30990,
                          "title": "Рабочая обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262822,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31646,
                          "parentId": 30990,
                          "title": "Резиновая обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262823,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31647,
                          "parentId": 30990,
                          "title": "Сандалии",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262824,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31648,
                          "parentId": 30990,
                          "title": "Шлёпанцы и сланцы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262825,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31649,
                          "parentId": 30990,
                          "title": "Домашняя обувь",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262826,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31650,
                          "parentId": 30990,
                          "title": "Слипоны и эспадрильи",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262827,
                                "id": 118631
                              }
                            ]
                          }
                        },
                        {
                          "id": 31651,
                          "parentId": 30990,
                          "title": "Уход за обувью",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804317,
                                "id": 175
                              },
                              {
                                "value": 2262828,
                                "id": 118631
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 31043,
                      "parentId": 29722,
                      "title": "Сумки, рюкзаки и чемоданы",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 2804316,
                            "id": 175
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31062,
                          "parentId": 31043,
                          "title": "Сумки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804331,
                                "id": 120473
                              }
                            ]
                          }
                        },
                        {
                          "id": 31063,
                          "parentId": 31043,
                          "title": "Рюкзаки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804332,
                                "id": 120473
                              }
                            ]
                          }
                        },
                        {
                          "id": 31064,
                          "parentId": 31043,
                          "title": "Чемоданы и дорожные сумки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804333,
                                "id": 120473
                              }
                            ]
                          }
                        },
                        {
                          "id": 31065,
                          "parentId": 31043,
                          "title": "Портфели и борсетки",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804334,
                                "id": 120473
                              }
                            ]
                          }
                        },
                        {
                          "id": 31066,
                          "parentId": 31043,
                          "title": "Кошельки, визитницы, ключницы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804335,
                                "id": 120473
                              }
                            ]
                          }
                        },
                        {
                          "id": 31067,
                          "parentId": 31043,
                          "title": "Косметички и бьюти–кейсы",
                          "navigation": {
                            "categoryId": 27,
                            "attributes": [
                              {
                                "value": 2804316,
                                "id": 175
                              },
                              {
                                "value": 2804336,
                                "id": 120473
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29746,
                      "parentId": 29722,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 27,
                        "attributes": [
                          {
                            "value": 749,
                            "id": 175
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29747,
                  "parentId": 29721,
                  "title": "Детская одежда и обувь",
                  "navigation": {
                    "categoryId": 29
                  },
                  "children": [
                    {
                      "id": 29748,
                      "parentId": 29747,
                      "title": "Для девочек",
                      "navigation": {
                        "categoryId": 29,
                        "attributes": [
                          {
                            "value": 758,
                            "id": 178
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29749,
                          "parentId": 29748,
                          "title": "Брюки",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 761,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29750,
                          "parentId": 29748,
                          "title": "Верхняя одежда",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 762,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29751,
                          "parentId": 29748,
                          "title": "Комбинезоны и боди",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 763,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29752,
                          "parentId": 29748,
                          "title": "Обувь",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 768,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29753,
                          "parentId": 29748,
                          "title": "Пижамы",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 764,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29754,
                          "parentId": 29748,
                          "title": "Платья и юбки",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 765,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29755,
                          "parentId": 29748,
                          "title": "Трикотаж",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 4880,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29756,
                          "parentId": 29748,
                          "title": "Шапки, варежки, шарфы",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 766,
                                "id": 179
                              }
                            ]
                          }
                        },
                        {
                          "id": 29757,
                          "parentId": 29748,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 758,
                                "id": 178
                              },
                              {
                                "value": 767,
                                "id": 179
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29758,
                      "parentId": 29747,
                      "title": "Для мальчиков",
                      "navigation": {
                        "categoryId": 29,
                        "attributes": [
                          {
                            "value": 759,
                            "id": 178
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29759,
                          "parentId": 29758,
                          "title": "Брюки",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 403,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29760,
                          "parentId": 29758,
                          "title": "Верхняя одежда",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 404,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29761,
                          "parentId": 29758,
                          "title": "Комбинезоны и боди",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 405,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29762,
                          "parentId": 29758,
                          "title": "Обувь",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 409,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29763,
                          "parentId": 29758,
                          "title": "Пижамы",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 406,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29764,
                          "parentId": 29758,
                          "title": "Трикотаж",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 4879,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29765,
                          "parentId": 29758,
                          "title": "Шапки, варежки, шарфы",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 407,
                                "id": 110
                              }
                            ]
                          }
                        },
                        {
                          "id": 29766,
                          "parentId": 29758,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 29,
                            "attributes": [
                              {
                                "value": 759,
                                "id": 178
                              },
                              {
                                "value": 408,
                                "id": 110
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29767,
                  "parentId": 29721,
                  "title": "Товары для детей и игрушки",
                  "navigation": {
                    "categoryId": 30
                  },
                  "children": [
                    {
                      "id": 29768,
                      "parentId": 29767,
                      "title": "Автомобильные кресла",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 585,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29769,
                      "parentId": 29767,
                      "title": "Велосипеды и самокаты",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 8592,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29770,
                      "parentId": 29767,
                      "title": "Детская мебель",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 586,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29771,
                      "parentId": 29767,
                      "title": "Детские коляски",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 588,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29772,
                      "parentId": 29767,
                      "title": "Игрушки",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 587,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29773,
                      "parentId": 29767,
                      "title": "Постельные принадлежности",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 5090,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29774,
                      "parentId": 29767,
                      "title": "Товары для кормления",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 4873,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29775,
                      "parentId": 29767,
                      "title": "Товары для купания",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 5091,
                            "id": 127
                          }
                        ]
                      }
                    },
                    {
                      "id": 29776,
                      "parentId": 29767,
                      "title": "Товары для школы",
                      "navigation": {
                        "categoryId": 30,
                        "attributes": [
                          {
                            "value": 5092,
                            "id": 127
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29777,
                  "parentId": 29721,
                  "title": "Часы и украшения",
                  "navigation": {
                    "categoryId": 28
                  },
                  "children": [
                    {
                      "id": 29778,
                      "parentId": 29777,
                      "title": "Бижутерия",
                      "navigation": {
                        "categoryId": 28,
                        "attributes": [
                          {
                            "value": 389,
                            "id": 104
                          }
                        ]
                      }
                    },
                    {
                      "id": 29779,
                      "parentId": 29777,
                      "title": "Часы",
                      "navigation": {
                        "categoryId": 28,
                        "attributes": [
                          {
                            "value": 387,
                            "id": 104
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 35282,
                          "parentId": 29779,
                          "title": "Наручные или карманные",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 387,
                                "id": 104
                              },
                              {
                                "value": 3204542,
                                "id": 144898
                              }
                            ]
                          }
                        },
                        {
                          "id": 35283,
                          "parentId": 29779,
                          "title": "Смарт-часы или браслет",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 387,
                                "id": 104
                              },
                              {
                                "value": 3204543,
                                "id": 144898
                              }
                            ]
                          }
                        },
                        {
                          "id": 35284,
                          "parentId": 29779,
                          "title": "Для интерьера",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 387,
                                "id": 104
                              },
                              {
                                "value": 3204544,
                                "id": 144898
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29780,
                      "parentId": 29777,
                      "title": "Ювелирные изделия",
                      "navigation": {
                        "categoryId": 28,
                        "attributes": [
                          {
                            "value": 388,
                            "id": 104
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 34495,
                          "parentId": 29780,
                          "title": "Кольца и перстни",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520622,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34496,
                          "parentId": 29780,
                          "title": "Серьги",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520623,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34497,
                          "parentId": 29780,
                          "title": "Кулоны и подвески",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520624,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34498,
                          "parentId": 29780,
                          "title": "Браслеты",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520625,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34499,
                          "parentId": 29780,
                          "title": "Пирсинг",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 3201605,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34500,
                          "parentId": 29780,
                          "title": "Цепи",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520626,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34501,
                          "parentId": 29780,
                          "title": "Колье",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520627,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34502,
                          "parentId": 29780,
                          "title": "Шармы",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520628,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34503,
                          "parentId": 29780,
                          "title": "Броши",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520629,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34504,
                          "parentId": 29780,
                          "title": "Комплекты",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520630,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34505,
                          "parentId": 29780,
                          "title": "Религиозные изделия",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520807,
                                "id": 111025
                              }
                            ]
                          }
                        },
                        {
                          "id": 34506,
                          "parentId": 29780,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 28,
                            "attributes": [
                              {
                                "value": 388,
                                "id": 104
                              },
                              {
                                "value": 520808,
                                "id": 111025
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29781,
                  "parentId": 29721,
                  "title": "Красота и здоровье",
                  "navigation": {
                    "categoryId": 88
                  },
                  "children": [
                    {
                      "id": 29782,
                      "parentId": 29781,
                      "title": "Косметика",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 593,
                            "id": 130
                          }
                        ]
                      }
                    },
                    {
                      "id": 29783,
                      "parentId": 29781,
                      "title": "Парфюмерия",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 595,
                            "id": 130
                          }
                        ]
                      }
                    },
                    {
                      "id": 29784,
                      "parentId": 29781,
                      "title": "Приборы и аксессуары",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 592,
                            "id": 130
                          }
                        ]
                      }
                    },
                    {
                      "id": 29785,
                      "parentId": 29781,
                      "title": "Средства гигиены",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 597,
                            "id": 130
                          }
                        ]
                      }
                    },
                    {
                      "id": 29786,
                      "parentId": 29781,
                      "title": "Средства для волос",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 5093,
                            "id": 130
                          }
                        ]
                      }
                    },
                    {
                      "id": 29787,
                      "parentId": 29781,
                      "title": "Медицинские изделия",
                      "navigation": {
                        "categoryId": 88,
                        "attributes": [
                          {
                            "value": 596,
                            "id": 130
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 29790,
              "parentId": 29369,
              "title": "Для дома и дачи",
              "navigation": {
                "categoryId": 2
              },
              "children": [
                {
                  "id": 29791,
                  "parentId": 29790,
                  "title": "Бытовая техника",
                  "navigation": {
                    "categoryId": 21
                  },
                  "children": [
                    {
                      "id": 29792,
                      "parentId": 29791,
                      "title": "Для дома",
                      "navigation": {
                        "categoryId": 21,
                        "attributes": [
                          {
                            "value": 5074,
                            "id": 48
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29793,
                          "parentId": 29792,
                          "title": "Пылесосы",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5074,
                                "id": 48
                              },
                              {
                                "value": 5076,
                                "id": 487
                              }
                            ]
                          }
                        },
                        {
                          "id": 29794,
                          "parentId": 29792,
                          "title": "Стиральные машины",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5074,
                                "id": 48
                              },
                              {
                                "value": 5075,
                                "id": 487
                              }
                            ]
                          }
                        },
                        {
                          "id": 29795,
                          "parentId": 29792,
                          "title": "Утюги",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5074,
                                "id": 48
                              },
                              {
                                "value": 5077,
                                "id": 487
                              }
                            ]
                          }
                        },
                        {
                          "id": 29796,
                          "parentId": 29792,
                          "title": "Швейные машины",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5074,
                                "id": 48
                              },
                              {
                                "value": 5078,
                                "id": 487
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29797,
                      "parentId": 29791,
                      "title": "Для индивидуального ухода",
                      "navigation": {
                        "categoryId": 21,
                        "attributes": [
                          {
                            "value": 5079,
                            "id": 48
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29798,
                          "parentId": 29797,
                          "title": "Бритвы и триммеры",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5079,
                                "id": 48
                              },
                              {
                                "value": 5080,
                                "id": 488
                              }
                            ]
                          }
                        },
                        {
                          "id": 29799,
                          "parentId": 29797,
                          "title": "Машинки для стрижки",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5079,
                                "id": 48
                              },
                              {
                                "value": 5081,
                                "id": 488
                              }
                            ]
                          }
                        },
                        {
                          "id": 29800,
                          "parentId": 29797,
                          "title": "Фены и приборы для укладки",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5079,
                                "id": 48
                              },
                              {
                                "value": 5082,
                                "id": 488
                              }
                            ]
                          }
                        },
                        {
                          "id": 29801,
                          "parentId": 29797,
                          "title": "Эпиляторы",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5079,
                                "id": 48
                              },
                              {
                                "value": 5083,
                                "id": 488
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29802,
                      "parentId": 29791,
                      "title": "Для кухни",
                      "navigation": {
                        "categoryId": 21,
                        "attributes": [
                          {
                            "value": 5067,
                            "id": 48
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29803,
                          "parentId": 29802,
                          "title": "Вытяжки",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5068,
                                "id": 486
                              }
                            ]
                          }
                        },
                        {
                          "id": 29804,
                          "parentId": 29802,
                          "title": "Мелкая кухонная техника",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5073,
                                "id": 486
                              }
                            ]
                          }
                        },
                        {
                          "id": 29805,
                          "parentId": 29802,
                          "title": "Микроволновые печи",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5069,
                                "id": 486
                              }
                            ]
                          }
                        },
                        {
                          "id": 29806,
                          "parentId": 29802,
                          "title": "Плиты",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5070,
                                "id": 486
                              }
                            ]
                          }
                        },
                        {
                          "id": 29807,
                          "parentId": 29802,
                          "title": "Посудомоечные машины",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5071,
                                "id": 486
                              }
                            ]
                          }
                        },
                        {
                          "id": 29808,
                          "parentId": 29802,
                          "title": "Холодильники и морозильные камеры",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5067,
                                "id": 48
                              },
                              {
                                "value": 5072,
                                "id": 486
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29809,
                      "parentId": 29791,
                      "title": "Климатическое оборудование",
                      "navigation": {
                        "categoryId": 21,
                        "attributes": [
                          {
                            "value": 5084,
                            "id": 48
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29810,
                          "parentId": 29809,
                          "title": "Вентиляторы",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5084,
                                "id": 48
                              },
                              {
                                "value": 5085,
                                "id": 489
                              }
                            ]
                          }
                        },
                        {
                          "id": 29811,
                          "parentId": 29809,
                          "title": "Кондиционеры",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5084,
                                "id": 48
                              },
                              {
                                "value": 5086,
                                "id": 489
                              }
                            ]
                          }
                        },
                        {
                          "id": 29812,
                          "parentId": 29809,
                          "title": "Обогреватели",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5084,
                                "id": 48
                              },
                              {
                                "value": 5087,
                                "id": 489
                              }
                            ]
                          }
                        },
                        {
                          "id": 29813,
                          "parentId": 29809,
                          "title": "Очистители воздуха",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5084,
                                "id": 48
                              },
                              {
                                "value": 5088,
                                "id": 489
                              }
                            ]
                          }
                        },
                        {
                          "id": 29814,
                          "parentId": 29809,
                          "title": "Термометры и метеостанции",
                          "navigation": {
                            "categoryId": 21,
                            "attributes": [
                              {
                                "value": 5084,
                                "id": 48
                              },
                              {
                                "value": 5089,
                                "id": 489
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29815,
                      "parentId": 29791,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 21,
                        "attributes": [
                          {
                            "value": 735,
                            "id": 48
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29816,
                  "parentId": 29790,
                  "title": "Мебель и интерьер",
                  "navigation": {
                    "categoryId": 20
                  },
                  "children": [
                    {
                      "id": 29817,
                      "parentId": 29816,
                      "title": "Компьютерные столы и кресла",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 5096,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29818,
                      "parentId": 29816,
                      "title": "Кровати, диваны и кресла",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 149,
                            "id": 45
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31544,
                          "parentId": 29818,
                          "title": "Диваны",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 437120,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31545,
                          "parentId": 29818,
                          "title": "Кресла",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 437126,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31546,
                          "parentId": 29818,
                          "title": "Кровати",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 437119,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31547,
                          "parentId": 29818,
                          "title": "Матрасы",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 437127,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31548,
                          "parentId": 29818,
                          "title": "Пуфы и банкетки",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 3024185,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31549,
                          "parentId": 29818,
                          "title": "Спальные гарнитуры",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 3024186,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31550,
                          "parentId": 29818,
                          "title": "Комплектующие",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 3024188,
                                "id": 110470
                              }
                            ]
                          }
                        },
                        {
                          "id": 31551,
                          "parentId": 29818,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 149,
                                "id": 45
                              },
                              {
                                "value": 437128,
                                "id": 110470
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29819,
                      "parentId": 29816,
                      "title": "Кухонные гарнитуры",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 5095,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29820,
                      "parentId": 29816,
                      "title": "Освещение",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 150,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29821,
                      "parentId": 29816,
                      "title": "Подставки и тумбы",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 151,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29822,
                      "parentId": 29816,
                      "title": "Предметы интерьера, искусство",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 146,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29823,
                      "parentId": 29816,
                      "title": "Столы и стулья",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 152,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29824,
                      "parentId": 29816,
                      "title": "Текстиль и ковры",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 153,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29826,
                      "parentId": 29816,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 155,
                            "id": 45
                          }
                        ]
                      }
                    },
                    {
                      "id": 29825,
                      "parentId": 29816,
                      "title": "Шкафы, комоды и стеллажи",
                      "navigation": {
                        "categoryId": 20,
                        "attributes": [
                          {
                            "value": 148,
                            "id": 45
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 33714,
                          "parentId": 29825,
                          "title": "Шкафы",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 505887,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33715,
                          "parentId": 29825,
                          "title": "Комоды",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 505889,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33716,
                          "parentId": 29825,
                          "title": "Стеллажи и этажерки",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 505891,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33717,
                          "parentId": 29825,
                          "title": "Полки",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 3128043,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33718,
                          "parentId": 29825,
                          "title": "Прихожие и обувницы",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 505894,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33719,
                          "parentId": 29825,
                          "title": "Гардеробные системы и вешалки",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 3128044,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33720,
                          "parentId": 29825,
                          "title": "Гарнитуры и комплекты",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 3128047,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33721,
                          "parentId": 29825,
                          "title": "Комплектующие",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 3128046,
                                "id": 111003
                              }
                            ]
                          }
                        },
                        {
                          "id": 33722,
                          "parentId": 29825,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 20,
                            "attributes": [
                              {
                                "value": 148,
                                "id": 45
                              },
                              {
                                "value": 505893,
                                "id": 111003
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29827,
                  "parentId": 29790,
                  "title": "Посуда и товары для кухни",
                  "navigation": {
                    "categoryId": 87
                  },
                  "children": [
                    {
                      "id": 29828,
                      "parentId": 29827,
                      "title": "Посуда",
                      "navigation": {
                        "categoryId": 87,
                        "attributes": [
                          {
                            "value": 166,
                            "id": 51
                          }
                        ]
                      }
                    },
                    {
                      "id": 29829,
                      "parentId": 29827,
                      "title": "Товары для кухни",
                      "navigation": {
                        "categoryId": 87,
                        "attributes": [
                          {
                            "value": 167,
                            "id": 51
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29830,
                  "parentId": 29790,
                  "title": "Продукты питания",
                  "navigation": {
                    "categoryId": 82
                  }
                },
                {
                  "id": 29831,
                  "parentId": 29790,
                  "title": "Ремонт и строительство",
                  "navigation": {
                    "categoryId": 19
                  },
                  "children": [
                    {
                      "id": 29832,
                      "parentId": 29831,
                      "title": "Двери",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 4814,
                            "id": 44
                          }
                        ]
                      }
                    },
                    {
                      "id": 29833,
                      "parentId": 29831,
                      "title": "Инструменты",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 4817,
                            "id": 44
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 31847,
                          "parentId": 29833,
                          "title": "Бензопилы",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473085,
                                "id": 110821
                              }
                            ]
                          }
                        },
                        {
                          "id": 31842,
                          "parentId": 29833,
                          "title": "Газовое и сварочное оборудование",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473080,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31952,
                              "parentId": 31842,
                              "title": "Аксессуары и комплектующие для сварки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473036,
                                    "id": 110812
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31953,
                              "parentId": 31842,
                              "title": "Газовые горелки и паяльные лампы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473037,
                                    "id": 110812
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31955,
                              "parentId": 31842,
                              "title": "Маски и перчатки для сварки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026047,
                                    "id": 110812
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31956,
                              "parentId": 31842,
                              "title": "Паяльники и аксессуары",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026048,
                                    "id": 110812
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31951,
                              "parentId": 31842,
                              "title": "Сварочные аппараты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473035,
                                    "id": 110812
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31954,
                              "parentId": 31842,
                              "title": "Электроды, проволока, прутки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473080,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473038,
                                    "id": 110812
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31844,
                          "parentId": 29833,
                          "title": "Другие инструменты",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473082,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31970,
                              "parentId": 31844,
                              "title": "Аппараты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473053,
                                    "id": 110814
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31971,
                              "parentId": 31844,
                              "title": "Верстаки и оборудование для мастерской",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473048,
                                    "id": 110814
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31966,
                              "parentId": 31844,
                              "title": "Компрессоры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473049,
                                    "id": 110814
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31968,
                              "parentId": 31844,
                              "title": "Лестницы, стремянки, вышки-тур",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473051,
                                    "id": 110814
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31967,
                              "parentId": 31844,
                              "title": "Насосы и комплектующие",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473050,
                                    "id": 110814
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31969,
                              "parentId": 31844,
                              "title": "Такелаж",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473082,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473052,
                                    "id": 110814
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31841,
                          "parentId": 29833,
                          "title": "Измерительные инструменты",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473079,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31942,
                              "parentId": 31841,
                              "title": "Лазерные рулетки и дальномеры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473031,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31941,
                              "parentId": 31841,
                              "title": "Лазерные уровни и нивелиры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473032,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31949,
                              "parentId": 31841,
                              "title": "Пирометры и прочие детекторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025520,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31946,
                              "parentId": 31841,
                              "title": "Разметочные инструменты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025517,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31943,
                              "parentId": 31841,
                              "title": "Рулетки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025515,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31947,
                              "parentId": 31841,
                              "title": "Ручные измерительные инструменты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025518,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31944,
                              "parentId": 31841,
                              "title": "Строительные уровни",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025516,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31948,
                              "parentId": 31841,
                              "title": "Штативы, рейки, держатели",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025519,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31945,
                              "parentId": 31841,
                              "title": "Электроизмерительные приборы и тестеры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473033,
                                    "id": 110811
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31950,
                              "parentId": 31841,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473079,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473034,
                                    "id": 110811
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31843,
                          "parentId": 29833,
                          "title": "Расходные материалы и оснастка",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473081,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31958,
                              "parentId": 31843,
                              "title": "Алмазные диски",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473040,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31960,
                              "parentId": 31843,
                              "title": "Буры, долота, пики",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473042,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31957,
                              "parentId": 31843,
                              "title": "Зарядные устройства и аккумуляторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473039,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31964,
                              "parentId": 31843,
                              "title": "Коронки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473046,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31962,
                              "parentId": 31843,
                              "title": "Отрезные круги и пильные диски",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473044,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31961,
                              "parentId": 31843,
                              "title": "Патроны и переходники",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473043,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31959,
                              "parentId": 31843,
                              "title": "Свёрла",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473041,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31963,
                              "parentId": 31843,
                              "title": "Шлифовальные круги и насадки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473045,
                                    "id": 110813
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31965,
                              "parentId": 31843,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473081,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473047,
                                    "id": 110813
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31840,
                          "parentId": 29833,
                          "title": "Ручные инструменты",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473078,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31935,
                              "parentId": 31840,
                              "title": "Домкраты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473024,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31928,
                              "parentId": 31840,
                              "title": "Ключи",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473018,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31936,
                              "parentId": 31840,
                              "title": "Малярные инструменты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473025,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31930,
                              "parentId": 31840,
                              "title": "Наборы инструментов",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473020,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31934,
                              "parentId": 31840,
                              "title": "Ножницы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473026,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31929,
                              "parentId": 31840,
                              "title": "Отвёртки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473027,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31932,
                              "parentId": 31840,
                              "title": "Пилы и лобзики",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473017,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31933,
                              "parentId": 31840,
                              "title": "Пистолеты для пены и герметика",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473019,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31939,
                              "parentId": 31840,
                              "title": "Плиткорезы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473023,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31938,
                              "parentId": 31840,
                              "title": "Столярные инструменты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473028,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31931,
                              "parentId": 31840,
                              "title": "Тиски и струбцины",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473021,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31937,
                              "parentId": 31840,
                              "title": "Ударно-рычажные инструменты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473029,
                                    "id": 110810
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31940,
                              "parentId": 31840,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473078,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473030,
                                    "id": 110810
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31848,
                          "parentId": 29833,
                          "title": "Садовая техника",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473086,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31983,
                              "parentId": 31848,
                              "title": "Газонокосилки и триммеры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473086,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473067,
                                    "id": 110818
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31985,
                              "parentId": 31848,
                              "title": "Канистры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473086,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473069,
                                    "id": 110818
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31986,
                              "parentId": 31848,
                              "title": "Лопаты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473086,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473070,
                                    "id": 110818
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31984,
                              "parentId": 31848,
                              "title": "Тачки и тележки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473086,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473068,
                                    "id": 110818
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31845,
                          "parentId": 29833,
                          "title": "Силовая, строительная техника и комплектующие",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473083,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31973,
                              "parentId": 31845,
                              "title": "Бетономешалки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473083,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473055,
                                    "id": 110815
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31975,
                              "parentId": 31845,
                              "title": "Вибраторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473083,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473057,
                                    "id": 110815
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31974,
                              "parentId": 31845,
                              "title": "Виброплиты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473083,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473056,
                                    "id": 110815
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31972,
                              "parentId": 31845,
                              "title": "Станки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473083,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473054,
                                    "id": 110815
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31976,
                              "parentId": 31845,
                              "title": "Установки для бурения",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473083,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473058,
                                    "id": 110815
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31849,
                          "parentId": 29833,
                          "title": "Спецодежда и средства защиты",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473087,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31993,
                              "parentId": 31849,
                              "title": "Каски строительные",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026464,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31987,
                              "parentId": 31849,
                              "title": "Маски, очки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473071,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31992,
                              "parentId": 31849,
                              "title": "Наушники и беруши",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026463,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31995,
                              "parentId": 31849,
                              "title": "Неодимовые магниты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473075,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31994,
                              "parentId": 31849,
                              "title": "Огнетушители",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026465,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31989,
                              "parentId": 31849,
                              "title": "Перчатки, рукавицы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473073,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31990,
                              "parentId": 31849,
                              "title": "Пояса, ремни, сумки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473074,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31988,
                              "parentId": 31849,
                              "title": "Респираторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473072,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31991,
                              "parentId": 31849,
                              "title": "Спецодежда, обувь и наколенники",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3026462,
                                    "id": 110819
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31996,
                              "parentId": 31849,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473087,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473076,
                                    "id": 110819
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31846,
                          "parentId": 29833,
                          "title": "Электрика",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473084,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31978,
                              "parentId": 31846,
                              "title": "Генераторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473060,
                                    "id": 110816
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31977,
                              "parentId": 31846,
                              "title": "Двигатели",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473059,
                                    "id": 110816
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31979,
                              "parentId": 31846,
                              "title": "Кабели и провода",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473061,
                                    "id": 110816
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31980,
                              "parentId": 31846,
                              "title": "Стабилизаторы напряжения",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473062,
                                    "id": 110816
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31981,
                              "parentId": 31846,
                              "title": "Трансформаторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473063,
                                    "id": 110816
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31982,
                              "parentId": 31846,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473084,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473064,
                                    "id": 110816
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31839,
                          "parentId": 29833,
                          "title": "Электроинструменты",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473077,
                                "id": 110821
                              }
                            ]
                          },
                          "children": [
                            {
                              "id": 31863,
                              "parentId": 31839,
                              "title": "Болгарки (УШМ)",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473010,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31861,
                              "parentId": 31839,
                              "title": "Дрели и шуруповерты",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473009,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31924,
                              "parentId": 31839,
                              "title": "Миксеры строительные",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025512,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31868,
                              "parentId": 31839,
                              "title": "Отбойные молотки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473014,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31862,
                              "parentId": 31839,
                              "title": "Перфораторы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473011,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31866,
                              "parentId": 31839,
                              "title": "Пилы электрические",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025508,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31926,
                              "parentId": 31839,
                              "title": "Пистолеты монтажные",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025514,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31925,
                              "parentId": 31839,
                              "title": "Плиткорезы",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025513,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 32346,
                              "parentId": 31839,
                              "title": "Пылесосы строительные",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025509,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 32347,
                              "parentId": 31839,
                              "title": "Фены строительные",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025510,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31867,
                              "parentId": 31839,
                              "title": "Фрезеры",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473013,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31864,
                              "parentId": 31839,
                              "title": "Шлифовальные машины",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473012,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31869,
                              "parentId": 31839,
                              "title": "Электролобзики",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473015,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 32348,
                              "parentId": 31839,
                              "title": "Электрорубанки",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 3025511,
                                    "id": 110809
                                  }
                                ]
                              }
                            },
                            {
                              "id": 31927,
                              "parentId": 31839,
                              "title": "Другое",
                              "navigation": {
                                "categoryId": 19,
                                "attributes": [
                                  {
                                    "value": 4817,
                                    "id": 44
                                  },
                                  {
                                    "value": 473077,
                                    "id": 110821
                                  },
                                  {
                                    "value": 473016,
                                    "id": 110809
                                  }
                                ]
                              }
                            }
                          ]
                        },
                        {
                          "id": 31850,
                          "parentId": 29833,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 4817,
                                "id": 44
                              },
                              {
                                "value": 473088,
                                "id": 110821
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29834,
                      "parentId": 29831,
                      "title": "Камины и обогреватели",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 139,
                            "id": 44
                          }
                        ]
                      }
                    },
                    {
                      "id": 29835,
                      "parentId": 29831,
                      "title": "Окна и балконы",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 4816,
                            "id": 44
                          }
                        ]
                      }
                    },
                    {
                      "id": 29836,
                      "parentId": 29831,
                      "title": "Потолки",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 4815,
                            "id": 44
                          }
                        ]
                      }
                    },
                    {
                      "id": 29837,
                      "parentId": 29831,
                      "title": "Садовая техника",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 142,
                            "id": 44
                          }
                        ]
                      }
                    },
                    {
                      "id": 29839,
                      "parentId": 29831,
                      "title": "Стройматериалы",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 144,
                            "id": 44
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 30758,
                          "parentId": 29839,
                          "title": "Ворота, заборы и ограждения",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 2308386,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 30818,
                          "parentId": 29839,
                          "title": "Железобетонные изделия",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 2308918,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29840,
                          "parentId": 29839,
                          "title": "Изоляция",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438539,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29841,
                          "parentId": 29839,
                          "title": "Крепёж",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438543,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29842,
                          "parentId": 29839,
                          "title": "Кровля и водосток",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438541,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29843,
                          "parentId": 29839,
                          "title": "Лаки и краски",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438542,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 30743,
                          "parentId": 29839,
                          "title": "Лестницы и комплектующие",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 1711578,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29844,
                          "parentId": 29839,
                          "title": "Листовые материалы",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438538,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29845,
                          "parentId": 29839,
                          "title": "Металлопрокат",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438537,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29847,
                          "parentId": 29839,
                          "title": "Отделка",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438545,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29848,
                          "parentId": 29839,
                          "title": "Пиломатериалы",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438536,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 30763,
                          "parentId": 29839,
                          "title": "Сваи",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 2308919,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29849,
                          "parentId": 29839,
                          "title": "Строительные смеси",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438540,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29850,
                          "parentId": 29839,
                          "title": "Строительство стен",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438535,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 30768,
                          "parentId": 29839,
                          "title": "Сыпучие материалы",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 2308917,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29851,
                          "parentId": 29839,
                          "title": "Электрика",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438544,
                                "id": 110483
                              }
                            ]
                          }
                        },
                        {
                          "id": 29852,
                          "parentId": 29839,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 144,
                                "id": 44
                              },
                              {
                                "value": 438547,
                                "id": 110483
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29838,
                      "parentId": 29831,
                      "title": "Сантехника, водоснабжение и сауна",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 143,
                            "id": 44
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 35311,
                          "parentId": 29838,
                          "title": "Аксессуары для ванной",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157782,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35312,
                          "parentId": 29838,
                          "title": "Бассейны",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157784,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35313,
                          "parentId": 29838,
                          "title": "Ванны",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157775,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35314,
                          "parentId": 29838,
                          "title": "Водоснабжение и канализация",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157780,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35315,
                          "parentId": 29838,
                          "title": "Душевые кабины и ограждения",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157777,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35316,
                          "parentId": 29838,
                          "title": "Душевые системы и лейки",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157776,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35317,
                          "parentId": 29838,
                          "title": "Кухонные мойки",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157773,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35318,
                          "parentId": 29838,
                          "title": "Мебель для ванной",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157781,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35319,
                          "parentId": 29838,
                          "title": "Полотенцесушители",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157779,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35320,
                          "parentId": 29838,
                          "title": "Раковины, умывальники, пьедесталы",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157774,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35321,
                          "parentId": 29838,
                          "title": "Смесители",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157772,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35322,
                          "parentId": 29838,
                          "title": "Товары для бани и сауны",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157783,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35323,
                          "parentId": 29838,
                          "title": "Унитазы, писсуары, биде, инсталляции",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157778,
                                "id": 139135
                              }
                            ]
                          }
                        },
                        {
                          "id": 35324,
                          "parentId": 29838,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 19,
                            "attributes": [
                              {
                                "value": 143,
                                "id": 44
                              },
                              {
                                "value": 3157785,
                                "id": 139135
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 30074,
                      "parentId": 29831,
                      "title": "Готовые строения и срубы",
                      "navigation": {
                        "categoryId": 19,
                        "attributes": [
                          {
                            "value": 478347,
                            "id": 44
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29854,
                  "parentId": 29790,
                  "title": "Растения",
                  "navigation": {
                    "categoryId": 106
                  }
                }
              ]
            },
            {
              "id": 29855,
              "parentId": 29369,
              "title": "Электроника",
              "navigation": {
                "categoryId": 6
              },
              "children": [
                {
                  "id": 29856,
                  "parentId": 29855,
                  "title": "Аудио и видео",
                  "navigation": {
                    "categoryId": 32
                  },
                  "children": [
                    {
                      "id": 29857,
                      "parentId": 29856,
                      "title": "MP3-плееры",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 601,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29858,
                      "parentId": 29856,
                      "title": "Акустика, колонки, сабвуферы",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 5030,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29859,
                      "parentId": 29856,
                      "title": "Видео, DVD и Blu-ray плееры",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 600,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29860,
                      "parentId": 29856,
                      "title": "Видеокамеры",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 605,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29861,
                      "parentId": 29856,
                      "title": "Кабели и адаптеры",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 5031,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29862,
                      "parentId": 29856,
                      "title": "Микрофоны",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 5032,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29863,
                      "parentId": 29856,
                      "title": "Музыка и фильмы",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 602,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29864,
                      "parentId": 29856,
                      "title": "Музыкальные центры, магнитолы",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 5033,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29865,
                      "parentId": 29856,
                      "title": "Наушники",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 5034,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29866,
                      "parentId": 29856,
                      "title": "Телевизоры и проекторы",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 604,
                            "id": 132
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 30610,
                          "parentId": 29866,
                          "title": "Телевизоры",
                          "navigation": {
                            "categoryId": 32,
                            "attributes": [
                              {
                                "value": 604,
                                "id": 132
                              },
                              {
                                "value": 470024,
                                "id": 110697
                              }
                            ]
                          }
                        },
                        {
                          "id": 30611,
                          "parentId": 29866,
                          "title": "Проекторы",
                          "navigation": {
                            "categoryId": 32,
                            "attributes": [
                              {
                                "value": 604,
                                "id": 132
                              },
                              {
                                "value": 470025,
                                "id": 110697
                              }
                            ]
                          }
                        },
                        {
                          "id": 30612,
                          "parentId": 29866,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 32,
                            "attributes": [
                              {
                                "value": 604,
                                "id": 132
                              },
                              {
                                "value": 470026,
                                "id": 110697
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29867,
                      "parentId": 29856,
                      "title": "Усилители и ресиверы",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 603,
                            "id": 132
                          }
                        ]
                      }
                    },
                    {
                      "id": 29868,
                      "parentId": 29856,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 32,
                        "attributes": [
                          {
                            "value": 606,
                            "id": 132
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29869,
                  "parentId": 29855,
                  "title": "Игры, приставки и программы",
                  "navigation": {
                    "categoryId": 97
                  },
                  "children": [
                    {
                      "id": 29870,
                      "parentId": 29869,
                      "title": "Игры для приставок",
                      "navigation": {
                        "categoryId": 97,
                        "attributes": [
                          {
                            "value": 611,
                            "id": 137
                          }
                        ]
                      }
                    },
                    {
                      "id": 29871,
                      "parentId": 29869,
                      "title": "Игровые приставки",
                      "navigation": {
                        "categoryId": 97,
                        "attributes": [
                          {
                            "value": 613,
                            "id": 137
                          }
                        ]
                      }
                    },
                    {
                      "id": 29872,
                      "parentId": 29869,
                      "title": "Компьютерные игры",
                      "navigation": {
                        "categoryId": 97,
                        "attributes": [
                          {
                            "value": 612,
                            "id": 137
                          }
                        ]
                      }
                    },
                    {
                      "id": 29873,
                      "parentId": 29869,
                      "title": "Программы",
                      "navigation": {
                        "categoryId": 97,
                        "attributes": [
                          {
                            "value": 615,
                            "id": 137
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29874,
                  "parentId": 29855,
                  "title": "Настольные компьютеры",
                  "navigation": {
                    "categoryId": 31
                  }
                },
                {
                  "id": 29875,
                  "parentId": 29855,
                  "title": "Ноутбуки",
                  "navigation": {
                    "categoryId": 98
                  }
                },
                {
                  "id": 29876,
                  "parentId": 29855,
                  "title": "Оргтехника и расходники",
                  "navigation": {
                    "categoryId": 99
                  },
                  "children": [
                    {
                      "id": 29877,
                      "parentId": 29876,
                      "title": "МФУ, копиры и сканеры",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 5053,
                            "id": 148
                          }
                        ]
                      }
                    },
                    {
                      "id": 29878,
                      "parentId": 29876,
                      "title": "Принтеры",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 642,
                            "id": 148
                          }
                        ]
                      }
                    },
                    {
                      "id": 29879,
                      "parentId": 29876,
                      "title": "Телефония",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 5054,
                            "id": 148
                          }
                        ]
                      }
                    },
                    {
                      "id": 29880,
                      "parentId": 29876,
                      "title": "ИБП, сетевые фильтры",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 5055,
                            "id": 148
                          }
                        ]
                      }
                    },
                    {
                      "id": 29881,
                      "parentId": 29876,
                      "title": "Уничтожители бумаг",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 5056,
                            "id": 148
                          }
                        ]
                      }
                    },
                    {
                      "id": 29882,
                      "parentId": 29876,
                      "title": "Расходные материалы",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 643,
                            "id": 148
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29883,
                          "parentId": 29882,
                          "title": "Блоки питания и батареи",
                          "navigation": {
                            "categoryId": 99,
                            "attributes": [
                              {
                                "value": 643,
                                "id": 148
                              },
                              {
                                "value": 5044,
                                "id": 485
                              }
                            ]
                          }
                        },
                        {
                          "id": 29884,
                          "parentId": 29882,
                          "title": "Болванки",
                          "navigation": {
                            "categoryId": 99,
                            "attributes": [
                              {
                                "value": 643,
                                "id": 148
                              },
                              {
                                "value": 5045,
                                "id": 485
                              }
                            ]
                          }
                        },
                        {
                          "id": 29885,
                          "parentId": 29882,
                          "title": "Бумага",
                          "navigation": {
                            "categoryId": 99,
                            "attributes": [
                              {
                                "value": 643,
                                "id": 148
                              },
                              {
                                "value": 5046,
                                "id": 485
                              }
                            ]
                          }
                        },
                        {
                          "id": 29886,
                          "parentId": 29882,
                          "title": "Кабели и адаптеры",
                          "navigation": {
                            "categoryId": 99,
                            "attributes": [
                              {
                                "value": 643,
                                "id": 148
                              },
                              {
                                "value": 5047,
                                "id": 485
                              }
                            ]
                          }
                        },
                        {
                          "id": 29887,
                          "parentId": 29882,
                          "title": "Картриджи",
                          "navigation": {
                            "categoryId": 99,
                            "attributes": [
                              {
                                "value": 643,
                                "id": 148
                              },
                              {
                                "value": 5048,
                                "id": 485
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29888,
                      "parentId": 29876,
                      "title": "Канцелярия",
                      "navigation": {
                        "categoryId": 99,
                        "attributes": [
                          {
                            "value": 644,
                            "id": 148
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29889,
                  "parentId": 29855,
                  "title": "Планшеты и электронные книги",
                  "navigation": {
                    "categoryId": 96
                  },
                  "children": [
                    {
                      "id": 29890,
                      "parentId": 29889,
                      "title": "Планшеты",
                      "navigation": {
                        "categoryId": 96,
                        "attributes": [
                          {
                            "value": 4995,
                            "id": 140
                          }
                        ]
                      }
                    },
                    {
                      "id": 29891,
                      "parentId": 29889,
                      "title": "Электронные книги",
                      "navigation": {
                        "categoryId": 96,
                        "attributes": [
                          {
                            "value": 4996,
                            "id": 140
                          }
                        ]
                      }
                    },
                    {
                      "id": 29892,
                      "parentId": 29889,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 96,
                        "attributes": [
                          {
                            "value": 4997,
                            "id": 140
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29893,
                          "parentId": 29892,
                          "title": "Аккумуляторы",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 4998,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29894,
                          "parentId": 29892,
                          "title": "Гарнитуры и наушники",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 4999,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29895,
                          "parentId": 29892,
                          "title": "Док-станции",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5000,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29896,
                          "parentId": 29892,
                          "title": "Зарядные устройства",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5001,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29897,
                          "parentId": 29892,
                          "title": "Кабели и адаптеры",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5002,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29898,
                          "parentId": 29892,
                          "title": "Модемы и роутеры",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5003,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29899,
                          "parentId": 29892,
                          "title": "Стилусы",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5004,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29900,
                          "parentId": 29892,
                          "title": "Чехлы и плёнки",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5005,
                                "id": 481
                              }
                            ]
                          }
                        },
                        {
                          "id": 29901,
                          "parentId": 29892,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 96,
                            "attributes": [
                              {
                                "value": 4997,
                                "id": 140
                              },
                              {
                                "value": 5006,
                                "id": 481
                              }
                            ]
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": 29902,
                  "parentId": 29855,
                  "title": "Телефоны",
                  "navigation": {
                    "categoryId": 84
                  },
                  "children": [
                    {
                      "id": 30094,
                      "parentId": 29902,
                      "title": "Мобильные телефоны",
                      "navigation": {
                        "categoryId": 84,
                        "attributes": [
                          {
                            "value": 458500,
                            "id": 110680
                          }
                        ]
                      }
                    },
                    {
                      "id": 29935,
                      "parentId": 29902,
                      "title": "Рации",
                      "navigation": {
                        "categoryId": 84,
                        "attributes": [
                          {
                            "value": 458501,
                            "id": 110680
                          }
                        ]
                      }
                    },
                    {
                      "id": 29936,
                      "parentId": 29902,
                      "title": "Стационарные телефоны",
                      "navigation": {
                        "categoryId": 84,
                        "attributes": [
                          {
                            "value": 458502,
                            "id": 110680
                          }
                        ]
                      }
                    },
                    {
                      "id": 29937,
                      "parentId": 29902,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 84,
                        "attributes": [
                          {
                            "value": 458503,
                            "id": 110680
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29938,
                  "parentId": 29855,
                  "title": "Товары для компьютера",
                  "navigation": {
                    "categoryId": 101
                  },
                  "children": [
                    {
                      "id": 29939,
                      "parentId": 29938,
                      "title": "Акустика",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5018,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29940,
                      "parentId": 29938,
                      "title": "Веб-камеры",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5020,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29941,
                      "parentId": 29938,
                      "title": "Джойстики и рули",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5019,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29942,
                      "parentId": 29938,
                      "title": "Клавиатуры и мыши",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5022,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29943,
                      "parentId": 29938,
                      "title": "Комплектующие",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 6581,
                            "id": 483
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 29944,
                          "parentId": 29943,
                          "title": "CD, DVD и Blu-ray приводы",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6601,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29945,
                          "parentId": 29943,
                          "title": "Блоки питания",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6606,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29946,
                          "parentId": 29943,
                          "title": "Видеокарты",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6611,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29947,
                          "parentId": 29943,
                          "title": "Жёсткие диски",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6616,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29948,
                          "parentId": 29943,
                          "title": "Звуковые карты",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6621,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29949,
                          "parentId": 29943,
                          "title": "Контроллеры",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6646,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29950,
                          "parentId": 29943,
                          "title": "Корпуса",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6626,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29951,
                          "parentId": 29943,
                          "title": "Материнские платы",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6631,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29952,
                          "parentId": 29943,
                          "title": "Оперативная память",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6636,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29953,
                          "parentId": 29943,
                          "title": "Процессоры",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6641,
                                "id": 631
                              }
                            ]
                          }
                        },
                        {
                          "id": 29954,
                          "parentId": 29943,
                          "title": "Системы охлаждения",
                          "navigation": {
                            "categoryId": 101,
                            "attributes": [
                              {
                                "value": 6581,
                                "id": 483
                              },
                              {
                                "value": 6651,
                                "id": 631
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 29955,
                      "parentId": 29938,
                      "title": "Мониторы",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 6656,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29956,
                      "parentId": 29938,
                      "title": "Переносные жёсткие диски",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5025,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29957,
                      "parentId": 29938,
                      "title": "Сетевое оборудование",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5023,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29958,
                      "parentId": 29938,
                      "title": "ТВ-тюнеры",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5026,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29959,
                      "parentId": 29938,
                      "title": "Флэшки и карты памяти",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 5027,
                            "id": 483
                          }
                        ]
                      }
                    },
                    {
                      "id": 29960,
                      "parentId": 29938,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 101,
                        "attributes": [
                          {
                            "value": 6666,
                            "id": 483
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29961,
                  "parentId": 29855,
                  "title": "Фототехника",
                  "navigation": {
                    "categoryId": 105
                  },
                  "children": [
                    {
                      "id": 29962,
                      "parentId": 29961,
                      "title": "Компактные фотоаппараты",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1497,
                            "id": 223
                          }
                        ]
                      }
                    },
                    {
                      "id": 29963,
                      "parentId": 29961,
                      "title": "Зеркальные фотоаппараты",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1496,
                            "id": 223
                          }
                        ]
                      }
                    },
                    {
                      "id": 29964,
                      "parentId": 29961,
                      "title": "Плёночные фотоаппараты",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1492,
                            "id": 223
                          }
                        ]
                      }
                    },
                    {
                      "id": 29965,
                      "parentId": 29961,
                      "title": "Бинокли и телескопы",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1489,
                            "id": 223
                          }
                        ]
                      }
                    },
                    {
                      "id": 29966,
                      "parentId": 29961,
                      "title": "Объективы",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1491,
                            "id": 223
                          }
                        ]
                      }
                    },
                    {
                      "id": 29967,
                      "parentId": 29961,
                      "title": "Оборудование и аксессуары",
                      "navigation": {
                        "categoryId": 105,
                        "attributes": [
                          {
                            "value": 1495,
                            "id": 223
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 29968,
              "parentId": 29369,
              "title": "Хобби и отдых",
              "navigation": {
                "categoryId": 7
              },
              "children": [
                {
                  "id": 29969,
                  "parentId": 29968,
                  "title": "Билеты и путешествия",
                  "navigation": {
                    "categoryId": 33
                  },
                  "children": [
                    {
                      "id": 29970,
                      "parentId": 29969,
                      "title": "Карты, купоны",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 8849,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29971,
                      "parentId": 29969,
                      "title": "Концерты",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 651,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29972,
                      "parentId": 29969,
                      "title": "Путешествия",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 652,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29973,
                      "parentId": 29969,
                      "title": "Спорт",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 653,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29974,
                      "parentId": 29969,
                      "title": "Театр, опера, балет",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 654,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29975,
                      "parentId": 29969,
                      "title": "Цирк, кино",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 8850,
                            "id": 154
                          }
                        ]
                      }
                    },
                    {
                      "id": 29976,
                      "parentId": 29969,
                      "title": "Шоу, мюзикл",
                      "navigation": {
                        "categoryId": 33,
                        "attributes": [
                          {
                            "value": 8848,
                            "id": 154
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29977,
                  "parentId": 29968,
                  "title": "Велосипеды",
                  "navigation": {
                    "categoryId": 34
                  },
                  "children": [
                    {
                      "id": 29978,
                      "parentId": 29977,
                      "title": "Горные",
                      "navigation": {
                        "categoryId": 34,
                        "attributes": [
                          {
                            "value": 660,
                            "id": 156
                          }
                        ]
                      }
                    },
                    {
                      "id": 29979,
                      "parentId": 29977,
                      "title": "Дорожные",
                      "navigation": {
                        "categoryId": 34,
                        "attributes": [
                          {
                            "value": 663,
                            "id": 156
                          }
                        ]
                      }
                    },
                    {
                      "id": 29980,
                      "parentId": 29977,
                      "title": "ВМХ",
                      "navigation": {
                        "categoryId": 34,
                        "attributes": [
                          {
                            "value": 659,
                            "id": 156
                          }
                        ]
                      }
                    },
                    {
                      "id": 29981,
                      "parentId": 29977,
                      "title": "Детские",
                      "navigation": {
                        "categoryId": 34,
                        "attributes": [
                          {
                            "value": 661,
                            "id": 156
                          }
                        ]
                      }
                    },
                    {
                      "id": 29982,
                      "parentId": 29977,
                      "title": "Запчасти и аксессуары",
                      "navigation": {
                        "categoryId": 34,
                        "attributes": [
                          {
                            "value": 658,
                            "id": 156
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29983,
                  "parentId": 29968,
                  "title": "Книги и журналы",
                  "navigation": {
                    "categoryId": 83
                  },
                  "children": [
                    {
                      "id": 29984,
                      "parentId": 29983,
                      "title": "Журналы, газеты, брошюры",
                      "navigation": {
                        "categoryId": 83,
                        "attributes": [
                          {
                            "value": 692,
                            "id": 167
                          }
                        ]
                      }
                    },
                    {
                      "id": 29985,
                      "parentId": 29983,
                      "title": "Книги",
                      "navigation": {
                        "categoryId": 83,
                        "attributes": [
                          {
                            "value": 693,
                            "id": 167
                          }
                        ]
                      }
                    },
                    {
                      "id": 29986,
                      "parentId": 29983,
                      "title": "Учебная литература",
                      "navigation": {
                        "categoryId": 83,
                        "attributes": [
                          {
                            "value": 4874,
                            "id": 167
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 29987,
                  "parentId": 29968,
                  "title": "Коллекционирование",
                  "navigation": {
                    "categoryId": 36
                  },
                  "children": [
                    {
                      "id": 29988,
                      "parentId": 29987,
                      "title": "Банкноты",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 64,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29989,
                      "parentId": 29987,
                      "title": "Билеты",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 65,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29990,
                      "parentId": 29987,
                      "title": "Вещи знаменитостей, автографы",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 66,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29991,
                      "parentId": 29987,
                      "title": "Военные вещи",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 67,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29992,
                      "parentId": 29987,
                      "title": "Грампластинки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 4871,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29993,
                      "parentId": 29987,
                      "title": "Документы",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 68,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29994,
                      "parentId": 29987,
                      "title": "Жетоны, медали, значки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 69,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29995,
                      "parentId": 29987,
                      "title": "Игры",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 70,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29996,
                      "parentId": 29987,
                      "title": "Календари",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 71,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29997,
                      "parentId": 29987,
                      "title": "Картины",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 1488,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29998,
                      "parentId": 29987,
                      "title": "Киндер-сюрприз",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 72,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 29999,
                      "parentId": 29987,
                      "title": "Конверты и почтовые карточки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 74,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30001,
                      "parentId": 29987,
                      "title": "Марки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 75,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30002,
                      "parentId": 29987,
                      "title": "Модели",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 76,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30003,
                      "parentId": 29987,
                      "title": "Монеты",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 77,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30004,
                      "parentId": 29987,
                      "title": "Открытки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 78,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30005,
                      "parentId": 29987,
                      "title": "Пепельницы, зажигалки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 80,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30006,
                      "parentId": 29987,
                      "title": "Пластиковые карточки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 79,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30007,
                      "parentId": 29987,
                      "title": "Спортивные карточки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 81,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30008,
                      "parentId": 29987,
                      "title": "Фотографии, письма",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 82,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30009,
                      "parentId": 29987,
                      "title": "Этикетки, бутылки, пробки",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 83,
                            "id": 14
                          }
                        ]
                      }
                    },
                    {
                      "id": 30010,
                      "parentId": 29987,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 36,
                        "attributes": [
                          {
                            "value": 4872,
                            "id": 14
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 30011,
                  "parentId": 29968,
                  "title": "Музыкальные инструменты",
                  "navigation": {
                    "categoryId": 38
                  },
                  "children": [
                    {
                      "id": 30012,
                      "parentId": 30011,
                      "title": "Аккордеоны, гармони, баяны",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 674,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30013,
                      "parentId": 30011,
                      "title": "Гитары и другие струнные",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 675,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30014,
                      "parentId": 30011,
                      "title": "Духовые",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 677,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30015,
                      "parentId": 30011,
                      "title": "Пианино и другие клавишные",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 678,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30016,
                      "parentId": 30011,
                      "title": "Скрипки и другие смычковые",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 5050,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30017,
                      "parentId": 30011,
                      "title": "Ударные",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 679,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30018,
                      "parentId": 30011,
                      "title": "Для студии и концертов",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 676,
                            "id": 162
                          }
                        ]
                      }
                    },
                    {
                      "id": 30019,
                      "parentId": 30011,
                      "title": "Аксессуары",
                      "navigation": {
                        "categoryId": 38,
                        "attributes": [
                          {
                            "value": 680,
                            "id": 162
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 30020,
                  "parentId": 29968,
                  "title": "Охота и рыбалка",
                  "navigation": {
                    "categoryId": 102
                  }
                },
                {
                  "id": 30021,
                  "parentId": 29968,
                  "title": "Спорт и отдых",
                  "navigation": {
                    "categoryId": 39
                  },
                  "children": [
                    {
                      "id": 30022,
                      "parentId": 30021,
                      "title": "Бильярд и боулинг",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5057,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30023,
                      "parentId": 30021,
                      "title": "Дайвинг и водный спорт",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 684,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30024,
                      "parentId": 30021,
                      "title": "Единоборства",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5058,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30025,
                      "parentId": 30021,
                      "title": "Зимние виды спорта",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 685,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30026,
                      "parentId": 30021,
                      "title": "Игры с мячом",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 686,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30027,
                      "parentId": 30021,
                      "title": "Настольные игры",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5059,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30028,
                      "parentId": 30021,
                      "title": "Пейнтбол и страйкбол",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5060,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30029,
                      "parentId": 30021,
                      "title": "Ролики и скейтбординг",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5061,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30030,
                      "parentId": 30021,
                      "title": "Теннис, бадминтон, пинг-понг",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 5062,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30031,
                      "parentId": 30021,
                      "title": "Туризм",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 687,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30032,
                      "parentId": 30021,
                      "title": "Фитнес и тренажёры",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 688,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30033,
                      "parentId": 30021,
                      "title": "Спортивное питание",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 20345,
                            "id": 165
                          }
                        ]
                      }
                    },
                    {
                      "id": 30034,
                      "parentId": 30021,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 39,
                        "attributes": [
                          {
                            "value": 689,
                            "id": 165
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            },
            {
              "id": 30035,
              "parentId": 29369,
              "title": "Животные",
              "navigation": {
                "categoryId": 35
              },
              "children": [
                {
                  "id": 30036,
                  "parentId": 30035,
                  "title": "Собаки",
                  "navigation": {
                    "categoryId": 89
                  }
                },
                {
                  "id": 30037,
                  "parentId": 30035,
                  "title": "Кошки",
                  "navigation": {
                    "categoryId": 90
                  }
                },
                {
                  "id": 30038,
                  "parentId": 30035,
                  "title": "Птицы",
                  "navigation": {
                    "categoryId": 91
                  }
                },
                {
                  "id": 30039,
                  "parentId": 30035,
                  "title": "Аквариум",
                  "navigation": {
                    "categoryId": 92
                  }
                },
                {
                  "id": 30040,
                  "parentId": 30035,
                  "title": "Другие животные",
                  "navigation": {
                    "categoryId": 93
                  },
                  "children": [
                    {
                      "id": 30041,
                      "parentId": 30040,
                      "title": "Амфибии",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 1381,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30042,
                      "parentId": 30040,
                      "title": "Грызуны",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 1382,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30043,
                      "parentId": 30040,
                      "title": "Кролики",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 4824,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30044,
                      "parentId": 30040,
                      "title": "Лошади",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 1383,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30045,
                      "parentId": 30040,
                      "title": "Рептилии",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 1384,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30046,
                      "parentId": 30040,
                      "title": "С/х животные",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 4825,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30047,
                      "parentId": 30040,
                      "title": "Хорьки",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 4823,
                            "id": 217
                          }
                        ]
                      }
                    },
                    {
                      "id": 30048,
                      "parentId": 30040,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 93,
                        "attributes": [
                          {
                            "value": 1385,
                            "id": 217
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 30049,
                  "parentId": 30035,
                  "title": "Товары для животных",
                  "navigation": {
                    "categoryId": 94
                  }
                }
              ]
            },
            {
              "id": 30050,
              "parentId": 29369,
              "title": "Готовый бизнес и оборудование",
              "navigation": {
                "categoryId": 8
              },
              "children": [
                {
                  "id": 30051,
                  "parentId": 30050,
                  "title": "Готовый бизнес",
                  "navigation": {
                    "categoryId": 116
                  },
                  "children": [
                    {
                      "id": 30052,
                      "parentId": 30051,
                      "title": "Интернет-магазины и IT",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11663,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30053,
                      "parentId": 30051,
                      "title": "Общественное питание",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11664,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30054,
                      "parentId": 30051,
                      "title": "Производство",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11665,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30055,
                      "parentId": 30051,
                      "title": "Развлечения",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11666,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30056,
                      "parentId": 30051,
                      "title": "Сельское хозяйство",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11667,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30057,
                      "parentId": 30051,
                      "title": "Строительство",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11668,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30058,
                      "parentId": 30051,
                      "title": "Сфера услуг",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11669,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30059,
                      "parentId": 30051,
                      "title": "Магазины и пункты выдачи заказов",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11670,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 31742,
                      "parentId": 30051,
                      "title": "Автобизнес",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 3026726,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 30060,
                      "parentId": 30051,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 11671,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 31743,
                      "parentId": 30051,
                      "title": "Красота и уход",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 3026727,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 31744,
                      "parentId": 30051,
                      "title": "Стоматология и медицина",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 3026728,
                            "id": 820
                          }
                        ]
                      }
                    },
                    {
                      "id": 31745,
                      "parentId": 30051,
                      "title": "Туризм",
                      "navigation": {
                        "categoryId": 116,
                        "attributes": [
                          {
                            "value": 3026729,
                            "id": 820
                          }
                        ]
                      }
                    }
                  ]
                },
                {
                  "id": 30061,
                  "parentId": 30050,
                  "title": "Оборудование для бизнеса",
                  "navigation": {
                    "categoryId": 40
                  },
                  "children": [
                    {
                      "id": 30066,
                      "parentId": 30061,
                      "title": "Промышленное",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 5119,
                            "id": 181
                          }
                        ]
                      },
                      "children": [
                        {
                          "id": 33947,
                          "parentId": 30066,
                          "title": "Металлообрабатывающее",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3128838,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 33948,
                          "parentId": 30066,
                          "title": "Деревообрабатывающее",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3128839,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34956,
                          "parentId": 30066,
                          "title": "Насосы и компрессоры",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213111,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 33949,
                          "parentId": 30066,
                          "title": "Производство мебели",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3128840,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34957,
                          "parentId": 30066,
                          "title": "Электрическое",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213120,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 33946,
                          "parentId": 30066,
                          "title": "Холодильное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3128837,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34958,
                          "parentId": 30066,
                          "title": "Строительное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213118,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34959,
                          "parentId": 30066,
                          "title": "Паяльное и сварочное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213112,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34960,
                          "parentId": 30066,
                          "title": "Климатическое",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213109,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34961,
                          "parentId": 30066,
                          "title": "Сельскохозяйственное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213117,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34962,
                          "parentId": 30066,
                          "title": "Конвейерное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213110,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34963,
                          "parentId": 30066,
                          "title": "Пескоструйное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213114,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34964,
                          "parentId": 30066,
                          "title": "Газовое",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213106,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34965,
                          "parentId": 30066,
                          "title": "Камнеобрабатывающее",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213108,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34966,
                          "parentId": 30066,
                          "title": "Полимерное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213116,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34967,
                          "parentId": 30066,
                          "title": "Добывающее",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213107,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34968,
                          "parentId": 30066,
                          "title": "Перерабатывающее",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213113,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34969,
                          "parentId": 30066,
                          "title": "Покрасочное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213115,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 34970,
                          "parentId": 30066,
                          "title": "Текстильное",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3213119,
                                "id": 135467
                              }
                            ]
                          }
                        },
                        {
                          "id": 33950,
                          "parentId": 30066,
                          "title": "Другое",
                          "navigation": {
                            "categoryId": 40,
                            "attributes": [
                              {
                                "value": 5119,
                                "id": 181
                              },
                              {
                                "value": 3128841,
                                "id": 135467
                              }
                            ]
                          }
                        }
                      ]
                    },
                    {
                      "id": 30062,
                      "parentId": 30061,
                      "title": "Для магазина",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 5115,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 30063,
                      "parentId": 30061,
                      "title": "Ресепшены и офисная мебель",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 5116,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 30064,
                      "parentId": 30061,
                      "title": "Для ресторана",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 5117,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 30065,
                      "parentId": 30061,
                      "title": "Для салона красоты",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 5118,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34227,
                      "parentId": 30061,
                      "title": "Майнинг",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105386,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34228,
                      "parentId": 30061,
                      "title": "Расчётно-кассовое",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105387,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34229,
                      "parentId": 30061,
                      "title": "Киоски и передвижные сооружения",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105388,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34230,
                      "parentId": 30061,
                      "title": "Лабораторное",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105389,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34231,
                      "parentId": 30061,
                      "title": "Медицинское",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105390,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 34232,
                      "parentId": 30061,
                      "title": "Телекоммуникационное",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 3105391,
                            "id": 181
                          }
                        ]
                      }
                    },
                    {
                      "id": 30067,
                      "parentId": 30061,
                      "title": "Другое",
                      "navigation": {
                        "categoryId": 40,
                        "attributes": [
                          {
                            "value": 795,
                            "id": 181
                          }
                        ]
                      }
                    }
                  ]
                }
              ]
            }
          ]
        }}', true);

        $categories = $this->buildTree($text);
        //$avito = new AvitoApiComponent(ProjectModel::find($request->id));
        //$categories = $avito->loadCategory();
        //$categories = CategoryModel::all();
        return response()->json([
            "success" => true,
            "message" => "Категории успешно загружены.",
            "data" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, categoryRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $category = new CategoryModel($input);
        $category->save();
        return response()->json([
            "success" => true,
            "message" => "Категория добавлена успешно."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, categoryRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $category = CategoryModel::find($input['id']);
        return response()->json([
            "success" => true,
            "message" => "Категория успешно найдена.",
            "data" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, categoryRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $category = CategoryModel::find($input['id']);
        $category->fill(request()->all())->save();
        return response()->json([
            "success" => true,
            "message" => "Категория обновлена успешно."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, categoryRequest $req): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $category = CategoryModel::find($input['id']);
        $category->delete();
        return response()->json([
            "success" => true,
            "message" => "Категория успешно удалена."
        ]);
    }
}
