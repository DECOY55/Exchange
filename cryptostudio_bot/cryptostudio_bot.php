<?php
set_error_handler('err_handler');
function err_handler($errno, $errmsg, $filename, $linenum) {
    $date = date('Y-m-d H:i:s (T)');
    $f = fopen('errors.txt', 'a');
    if (!empty($f)) {
        $filename  =str_replace($_SERVER['DOCUMENT_ROOT'],'',$filename);
        $err  = "$errmsg = $filename = $linenum\r\n";
        fwrite($f, $err);
        fclose($f);
    }
}
//error_reporting(0);
include '_set.php';

$post = file_get_contents('php://input');
if (strlen($post) < 8)
    loadSite();
$post = json_decode($post, true);
$msg = $post['message'];
$iskbd = !$msg;
if ($iskbd)
    $msg = $post['callback_query'];
$id = beaText(strval($msg['from']['id']), chsNum());
if (strlen($id) == 0)
    exit();

if (isUserBanned($id)) {
    botSend([
        '<b>Ваш аккаунт заблокирован, свяжитесь с Администрацией для разблокировки</b>',
    ], $id);
    exit();
}

//$timer = 1 - (time() - intval(getUserData($id, 'time')));
//if ($timer > 0)
//    exit();
//setUserData($id, 'time', time());
$text = $msg[$iskbd ? 'data' : 'text'];
$login = $msg['from']['username'];
$nick = htmlspecialchars($msg['from']['first_name'].' '.$msg['from']['last_name']);
if ($iskbd)
    $msg = $msg['message'];
$mid = $msg[$iskbd ? 'message_id' : 'id'];
$chat = $msg['chat']['id'];
$image = $msg['photo'][0]['file_id'];
$member = $msg['new_chat_member'];
$cmd = explode(' ', $text, 2);
$keybd = false;
$keybdD = false;
$result = false;
$edit = false;

function doSupport() {
    global $id, $urls;
    setInput($id, '');
    $result = [
        '🧑‍💻 <b>ТС: </b> @'.$urls['ts'],
    ];

    $t = [];
    $keybd = [true, $t];
    return [$result, $keybd];
}
function doProfile() {
    global $id, $btns, $urls, $chat, $login, $text, $nick;
    $result = false;
    $keybd = false;
    if (!isUserAccepted($id)) {
        if ($text == $btns['back'] && getInput($id) == '')
            return;
        if (regUser($id, $login)) {
            botSend([
                '<b>'.userLogin($id, true).'</b> запустил бота',
            ], chatAlerts());
        }
        setInput($id, '');
        $result = [
            'Привет, это бот <b>'.projectAbout('projectName').'</b>',
            'Для работы подайте заявку',
        ];
        $keybd = [false, [
            [
                ['text' => $btns['jncreate']],
            ],
        ]];
    } else {
        $promo = getSettings('promo', 'promocodes', $id);
        if(!isset($promo)){
            $promo = 'Не создан';
        }
        $keybd = [true, [
            [
                ['text' => $btns['url_site'], 'url' => $urls['url_site']],
            ],
        ]];
        $result = [
            '✨ Добро пожаловать, <b>'.$nick.'</b>',
            '',
            '🔸 Бот готов к использованию.',
            '🔸 Если не появились вспомогательные кнопки',
            '🔸 Введите /start',
            '',
            '🔸 Конфигурация промокода:',
            '🔸 Валюта: BTC',
            '🔸 Сумма: 0.5',
            '',
            '🔸 Ваш промокод: <code>'.$promo.'</code>',
        ];
        botSend([
            '💸',
        ], $chat, [false, [
            [
                ['text' => $btns['profile']],
                ['text' => $btns['verf']],
            ],
            [
                ['text' => $btns['give_promo']],
                ['text' => $btns['support']],
            ],
        ]]);
    }
    return [$result, $keybd];
}
switch ($chat) {
    case $id: {
        if (!isUserAccepted($id)) {
            switch ($text) {
                case '/start': {
                list($result, $keybd) = doProfile();
                break;
            }
                case $btns['jncreate']: {
                    if (getInput($id) != '')
                        break;
                    if (getUserData($id, 'joind')) {
                        $result = [
                            '❗️ Вы уже подали заявку, ожидайте',
                        ];
                        break;
                    }
                    setInput($id, 'dojoinnext0');
                    botSend([
                        '<b>'.userLogin($id, true).'</b> приступил к заполнению заявки на вступление',
                    ], chatAlerts());
                    $keybd = [false, [
                        [
                            ['text' => $btns['jnrules']],
                        ],
                    ]];
                    $result = [
                        'Правила, туда сюда...',
                    ];
                    break;
                }
                case $btns['jnrules']: {
                    if (getInput($id) != 'dojoinnext0')
                        break;
                    setInput($id, 'join_es');
                    $keybdD = true;
                    $result = [
                        '🚀 Откуда ты узнал о нашей команде?',
                        'Напишите ниже:',
                    ];
                    break;
                }
            }
            if ($result)
                break;
            switch ($cmd[0]) {
                case '/start': {
                    if (substr($cmd[1], 0, 2) == 'r_') {
                        $t = substr($cmd[1], 2);
                        if (isUser($t))
                            setUserReferal($id, $t);
                    }
                    list($result, $keybd) = doProfile();
                    break;
                }
            }
            if ($result)
                break;
            switch (getInput($id)) {
                case 'join_es':
                {
                    if (getUserData($id, 'joind'))
                        break;
                    setInput($id, 'cryptostudio');
                    setUserData($id, 'joind', '1');
                    $text2 = beaText($text, chsAll());

                    setInputData($id, 'dojoinnext1', $text2);

                    $result = [
                        '🧧 <b> Ваша заявка была отправлена на проверку </b>',

                        '🕵️ После проверки, вы получите сообщение 📝 о решении...',
                    ];
                    botSend([
                        '🐥 <b>Заявка на вступление</b>',
                        '',
                        '👤 От: <b>'.userLogin($id, true).'</b>',
                        '',
                        '<b> ~ Информация: '.$text2.'</b>',
                        '',
                        '<b> ~ Дата: '.date('d.m.Y</b> в <b>H:i:s').'</b>',
                    ], chatAlerts(), [true, [
                        [
                            ['text' => $btns['joinaccpt'], 'callback_data' => '/joinaccpt '.$id],
                            ['text' => $btns['joindecl'], 'callback_data' => '/joindecl '.$id],
                        ],
                    ]]);

                    break;
                }
            }
            break;
        } // By @cryptostudio_dev
        if ($result)
            break;
        switch ($text) {
            case $btns['profile']: case $btns['back']: case '/start': {
            setInput($id, '');
            $t = [];
            $t[] = '';
            $t0 = userLogin($id, true, true);
            if (updLogin($id, $login)) {
                botSend([
                    '<b>'.$t0.'</b> теперь известен как <b>'.$login.'</b>',
                ], chatAlerts());
            }
            list($result, $keybd) = doProfile();
            if (count($t) != 0)
                $result = array_merge($t, [''], $result);
            break;
        }
            case $btns['support']: {
                list($result, $keybd) = doSupport();
                break;
            }
            case $btns['give_promo']: {

                $promo = getSettings('promo', 'promocodes', $id);

                if(checkUserTg($id)) {
                    if (isset($promo)) {
                        $result = [
                            '❗️ Вы уже получили промокод.',
                            '',
                            'Перейдите в раздел <b>' . $btns['profile'] . '</b>',
                        ];
                    } else {
                        $promo_gen = createUserPromo($id);
                        $result = [
                            '❕ Ваш промокод сгенерирован.',
                            '',
                            'Промокод: <code>' . $promo_gen . '</code>',
                        ];
                    }
                }else{
                    $result = [
                        '❌ Вы не прошли верификацию',
                    ];
                }
                break;
            }
            case $btns['verf']: {

                if(checkUserTg($id)) {
                    $result = [
                        '✅ У Вас уже верифицирован аккаунт.',
                        '',
                        'Активная почта: <code>'.getSettings('email', 'users', $id).'</code>',
                    ];
                }else {
                    $result = [
                        '❕ Введите почту для верификации.',
                        '',
                        '- Почта которую ввели при регистрации на сайте биржи.',
                    ];
                    setInput($id, 'verifid');
                }

                break;
            }
        }
        if ($result)
            break;
        switch ($cmd[0]) {
            case '/start': {
                setInput($id, '');
                $t = substr($cmd[1], 2);
                switch (substr($cmd[1], 0, 2)) {
                    default: {
                        list($result, $keybd) = doProfile();
                        break;
                    }
                }
                break;
            }
        }
        if ($result)
            break;
        switch (getInput($id)) {
            case 'verifid':
            {
                $check_user = checkUser($text);
                if($check_user){
                    if(checkUserVerf($text)){
                        $result = [
                            '❌ Почта уже верифицирована.',
                        ];
                    }else{
                        botSend([
                            '✅ <b>Верификация почты</b>',
                            '',
                            '♻️Почта: <b>'.$text.'</b>',
                            '',
                            '👤 Воркер: <b>'.userLogin($t, true, true).'</b>',
                            '📆 Дата: <b>'.date('d.m.Y</b> в <b>H:i:s').'</b>',
                        ], chatAlerts());
                        verifiedUser($text, $id);
                        setInput($id, '');
                        $result = [
                            '✅ Успешная верификация.',
                        ];
                    }
                }else{
                    $result = [
                        '❗️Почта не обнаружена.',
                    ];
                }
                break;
            }
        }
        break;
    }
    case chatAlerts(): {
        $flag = false;
        switch ($cmd[0]) {
            case '/joinaccpt': {
                $t = $cmd[1];
                if (!isUser($t))
                    break;
                if (!getUserData($t, 'joind'))
                    break;
                setUserData($t, 'joind', '');
                regUser($t, false, true);

                botSend([
                    '💁🏼‍♀️ <b>Ваша заявка</b> была одобрена',
                ], $t, [true, [
                    [
                        ['text' => $btns['profile'], 'callback_data' => '/start'],
                    ],
                ]]);
                botSend([
                    '🐥 <b>Одобрение заявки</b>',
                    '',
                    '🍪 Информация: <b>'.getInputData($t, 'dojoinnext1').'</b>',
                    '',
                    '👤 Подал: <b>'.userLogin($t, true).'</b>',
                    '📆 Дата: <b>'.date('d.m.Y</b> в <b>H:i:s').'</b>',
                    '❤️ Принял: <b>'.userLogin($id, true, true).'</b>',
                ], chatAlerts());
                botDelete($mid, $chat);
                $flag = true;
                break;
            }
            case '/joindecl': {
                $t = $cmd[1];
                if (!isUser($t))
                    break;
                if (!getUserData($t, 'joind'))
                    break;
                setUserData($t, 'joind', '');
                botSend([
                    '❌ <b>Ваша заявка на вступление отклонена</b>',
                ], $t);
                botSend([
                    '🐔 <b>Отклонение заявки</b>',
                    '',
                    '🍪 Информация: <b>'.getInputData($t, 'dojoinnext1').'</b>',
                    '',
                    '👤 Подал: <b>'.userLogin($t, true).'</b>',
                    '📆 Дата: <b>'.date('d.m.Y</b> в <b>H:i:s').'</b>',
                    '💙 Отказал: <b>'.userLogin($id, true, true).'</b>',
                ], chatAlerts());
                botDelete($mid, $chat);
                $flag = true;
                break;
            }
        }
        if ($result || $flag)
            break;
        switch ($cmd[0]) {
            case '/alert': {
                $t = $cmd[1];
                if (strlen($t) < 1)
                    break;
                if (md5($t) == getLastAlert())
                    break;
                setLastAlert(md5($t));
                botSend([
                    '✅ <b>Рассылка успешно запущена.</b>',
                ], chatAlerts());
                $t2 = alertUsers($t);
                $result = [
                    '✅ <b>Рассылка успешно завершена.</b>',
                    '',
                    '👍 Отправлено: <b>'.$t2[0].'</b>',
                    '👎 Не отправлено: <b>'.$t2[1].'</b>',
                ];
                $flag = true;
                break;
            }
        }
        break;
    }
}
if (!$result)
    exit();
if ($edit)
    botEdit($result, $mid, $chat, $keybd, $keybdD);
else
    botSend($result, $chat, $keybd);
?>