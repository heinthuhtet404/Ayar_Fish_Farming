<?php
require __DIR__.'/../includes/admin.php';sess();
if(is_admin()){header('Location: ../index.php');exit;}
$setup=!admin_exists();$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 if(!hash_equals($_SESSION['lt']??'x',(string)($_POST['t']??''))){$err='Session မှားနေသည်။ ထပ်ကြိုးစားပါ။';}
 else{$u=trim((string)($_POST['u']??''));$p=(string)($_POST['p']??'');
  if($setup){
   if(strlen($u)<3||strlen($p)<8||$p!==(string)($_POST['p2']??''))$err='အမည် (အနည်းဆုံး ၃ လုံး)၊ စကားဝှက် (အနည်းဆုံး ၈ လုံး) ကို တူညီစွာ ဖြည့်ပါ။';
   elseif(!jsave(ADMIN_FILE,['user'=>$u,'hash'=>password_hash($p,PASSWORD_DEFAULT)]))$err='သိမ်းဆည်း၍မရပါ။ data folder ကို write ခွင့်ပေးပါ။';
   else{session_regenerate_id(true);$_SESSION['adm']=1;header('Location: ../index.php');exit;}
  }else{
   $ip=$_SERVER['REMOTE_ADDR']??'x';$at=jload('login_attempts.json',[]);$now=time();$rec=array_values(array_filter($at[$ip]??[],fn($t)=>$t>$now-600));
   if(count($rec)>=5)$err='မှားယွင်းမှု များနေပါသည်။ ၁၀ မိနစ်ခန့် စောင့်ပြီး ထပ်ကြိုးစားပါ။';
   else{$ad=jload(ADMIN_FILE,[]);
    if(hash_equals((string)($ad['user']??''),$u)&&password_verify($p,(string)($ad['hash']??''))){unset($at[$ip]);jsave('login_attempts.json',$at);session_regenerate_id(true);$_SESSION['adm']=1;header('Location: ../index.php');exit;}
    $rec[]=$now;$at[$ip]=$rec;jsave('login_attempts.json',$at);$err='အမည် သို့မဟုတ် စကားဝှက် မှားနေသည်။';}
  }}}
$_SESSION['lt']=bin2hex(random_bytes(8));
?><!doctype html><html lang="my"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex">
<title>Admin Login | Ayar Fish Farming</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;500;600;700&family=Noto+Serif+Myanmar:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/site.css"><link rel="stylesheet" href="../assets/css/admin.css"></head>
<body class="lg"><main class="lgbox"><img src="../assets/img/fish-logo.svg" alt="" height="64"><h1><?=$setup?'Admin အကောင့် ဖန်တီးရန်':'Admin Login'?></h1>
<p><?=$setup?'ပထမဆုံးအကြိမ် ဖြစ်သည့်အတွက် Admin အမည်နှင့် စကားဝှက် သတ်မှတ်ပါ။':'Website ကို စီမံခန့်ခွဲရန် ဝင်ရောက်ပါ။'?></p>
<?php if($err):?><div class="note err"><?=h($err)?></div><?php endif;?>
<form class="form" method="post" autocomplete="off"><input type="hidden" name="t" value="<?=h($_SESSION['lt'])?>">
<label for="u">အမည် (Username)</label><input id="u" name="u" required autofocus autocomplete="username">
<label for="p">စကားဝှက်</label><input id="p" name="p" type="password" required autocomplete="<?=$setup?'new-password':'current-password'?>">
<?php if($setup):?><label for="p2">စကားဝှက် ထပ်ရိုက်ပါ</label><input id="p2" name="p2" type="password" required autocomplete="new-password"><?php endif;?>
<button class="btn" type="submit"><?=$setup?'အကောင့်ဖန်တီးမည်':'ဝင်မည်'?></button></form>
<p class="back"><a href="../index.php">← Website သို့ ပြန်သွားရန်</a></p></main></body></html>
