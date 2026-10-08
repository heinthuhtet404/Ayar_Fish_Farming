<?php require_once __DIR__.'/lib.php';
$slug=preg_replace('/[^a-z0-9-]/','',(string)($slug??''));$pg=pages_all()[$slug]??null;
if(!$pg||($pg['body']??null)===null){http_response_code(404);$page=['t'=>'စာမျက်နှာ မတွေ့ပါ','raw'=>true];require __DIR__.'/header.php';
 echo '<div class="wrap pg"><h1>'.h(T('nf_h1')).'</h1><p class="sub">'.h(T('nf_sub')).'</p><a class="btn" href="index.php">'.h(T('nf_btn')).'</a></div>';require __DIR__.'/footer.php';exit;}
$page=['t'=>$pg['title'],'h1'=>h($pg['title']),'d'=>$pg['desc']??'','slug'=>$slug,'pb'=>1,'pg'=>$pg];
require __DIR__.'/header.php';echo $pg['body']."\n";require __DIR__.'/footer.php';
