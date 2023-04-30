<?php

# Принимаем запрос
$data = json_decode(file_get_contents('php://input'), TRUE);
file_put_contents('file.txt', '$data: '.print_r($data, 1)."\n", FILE_APPEND);

# Обрабатываем ручной ввод или нажатие на кнопку
$data = $data['callback_query'] ? $data['callback_query'] : $data['message'];

# Важные константы
define('TOKEN', '***'); //вместо * вписывать токен

# Записываем сообщение пользователя
$message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']),'utf-8');

# Рандомные ответы
$arr = array( "a"=>"Ха ха, ладно", "b"=>"Не знаю что ответить...", "c"=>"Хмм 🤔", "d"=>"Ты точно это хотел спросить?" );
shuffle($arr);


# Обрабатываем сообщение
switch ($message)
{

    case '/start':
        $method = 'sendMessage';
        $send_data = [
            'text'   => 'Бот-инструктор активирован 🤖' . "\n" . 'О чём хочешь спросить?',
            'reply_markup' => [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        ['text' => 'Фотографии'],
                        ['text' => 'Расписание ШИ'],
                    ],
                    [
                        ['text' => 'Летние лагеря'],
                        ['text' => 'Ссылки'],
                    ],
                    [
                        ['text' => 'Летние смены 2023'],
                        ['text' => 'Материалы ШИ'],
                    ]
                ]             
            ]
        ];
        break;


    case 'фотографии':
        $method = 'sendMessage';
        $send_data = [
            'text'   => 'Какие фотографии хочешь посмотреть? 📷',
            'reply_markup' => [
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => 'С лагерей', 'url' => 'https://vk.com/albums-218902111'],
                        ['text' => 'С обучения ШИ', 'url' => 'https://vk.com/albums-138551511']
                    ]         
                ],
            ]
        ];
        break;

    case 'расписание ши':
        $method = 'sendPhoto';
        $send_data = [
            'photo' => 'https://persik-krsk.ru/photo/apr.jpg',
            'caption' => 'Внимательно смотрим и не пропускаем занятия 😉' . "\n\n" .
            'Ближайшие выезды: лагерь "Крепкий Орешек" 5 мая - 9 мая'
        ];
        break;

    case 'летние лагеря':
        $method = 'sendMessage';
        $send_data = [
            'text' => '«<b>Крепкий Орешек</b>» - проходит на территории Манского района, близи пещеры «Большая Орешная», где участники учатся основам жизни в походных условиях, бережному отношению к природе, ходят в походы и исследуют пещеры.' . "\n\n" .
            '«<b>Путешественник</b>» - проходит на территории Бирюсинского залива, и является уникальной современной туристической площадкой для подростков, предпочитающих активный и познавательный отдых.' . "\n\n" .            
            '«<b>Юный путешественник</b>» - проходит на базе отдыха «Чайка», Национальном парке «Красноярские Столбы», Торгашинском хребте. Отсюда ребята отправляются в однодневные и трехдневные походы.' . "\n" . 'В программе каждой смены: занятия по скалолазанию, туризму, спелеологии, краеведческие проекты, творческие мастерские, встречи с интересными людьми, спортивные игры и соревнования.'  . "\n\n" .
            '«<b>Роза Ветров</b>» - основное отличие профильного объединения «Роза ветров» - это ежегодная смена места проведения. В 2023 году смена пройдет в Национальном парке «Красноярские Столбы». Отделения профильного объединения делятся не по возраст, а по роду деятельности, которым ребята будут заниматься – фотограф, художники, экскурсоводы, краеведы и т.д. Ребёнок сам выбирает в каким направлением хочет заниматься, и выбирает, то, что ему интересно.' . "\n\n\n" ,
            'parse_mode' => 'HTML',
            'reply_markup' => [
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => 'Подробнее о лагерях 🌐', 'url' => 'https://vk.com/leto_cp']
                    ]         
                ],
            ]
        ];
        break;

    case 'ссылки':
        $method = 'sendMessage';
        $send_data = [
            'text'   => 'Школа Инструкторов: https://vk.com/shi_cp' . "\n" . 'Центр путешественников: https://vk.com/krascp' . "\n" . 'Красноярский Хайкинг: https://vk.com/krashiking' . "\n" . 'Летние лагеря: https://vk.com/leto_cp'
        ];
        break;

    case 'летние смены 2023':
        $method = 'sendPhoto';
        $send_data = [
            'photo' => 'https://persik-krsk.ru/photo/ls.jpg',
            'caption' => 'Подробно: https://vk.com/krascp?w=wall-9557103_18440'
        ];
        break;

    case 'материалы ши':
        $method = 'sendMessage';
        $send_data = [
            'text' => '<a href=\'https://drive.google.com/drive/folders/1W2GfH53X37Apr561EPHLJ0fBmV70RmD6?usp=share_link\'>💊 Аптечка</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1CsxMf9QzZKnHPDB99PMYDFdsjsXHm_gZ?usp=share_link\'>📢 Безопасность в походе.' . "\n" . 'Действия при ЧП</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1sCILugAHPnWP8vWAQyjgeSJaJSuOP8Yw?usp=share_link\'>🗺 Ориентирование</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1l0-CG_EX14f9MU2WJaX-YPzX_dWvVRN2?usp=share_link\'>⛑ ПМП</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1N27vY4SR5Wn2vt69tm9KnKd9chpxJTq4?usp=share_link\'>🤕 Десмургия</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1W_iB4TnQEfSJ1E3OnOltti8DUQTGnjoK?usp=share_link\'>🍽 Питание в походе</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/17eNrJqqCTzjELk7qn0zJ9BmC-0Eqzyf0?usp=share_link\'>🎲 Создание квестов</a>' . "\n\n" .
            '<a href=\'https://drive.google.com/drive/folders/1moYMQxOnkRgmpAa1NjIlNky6ndB6O_to?usp=share_link\'>🧳 Сбор рюкзака</a>',
            'parse_mode' => 'HTML',
            'reply_markup' => [
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => 'Все лекции 🌐', 'url' => 'https://drive.google.com/drive/folders/1ZzHQmL7PfT58u_wsm3zskMvpyKwP5e5F']
                    ]         
                ],
            ]
        ];
        break;


    default:
        $method = 'sendMessage';
        $send_data = [
            'text' => $arr[0]
        ];
}

# Добавляем данные пользователя
$send_data['chat_id'] = $data['chat']['id'];

$res = sendTelegram($method, $send_data);

function sendTelegram($method, $data, $headers = [])
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.telegram.org/bot' . TOKEN . '/' . $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array_merge(array("Content-Type: application/json"), $headers)
    ]);   
    
    $result = curl_exec($curl);
    curl_close($curl);
    return (json_decode($result, 1) ? json_decode($result, 1) : $result);
}

?>