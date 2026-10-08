<?php
require __DIR__.'/../includes/admin.php';
header('Content-Type: application/json; charset=utf-8');
function out($a,$c=200){http_response_code($c);echo json_encode($a,JSON_UNESCAPED_UNICODE);exit;}
function bad($m){out(['ok'=>false,'error'=>$m]);}
if(!is_admin())out(['ok'=>false,'error'=>'Login ဝင်ရန် လိုအပ်ပါသည်'],401);
if($_SERVER['REQUEST_METHOD']!=='POST'||!hash_equals(admin_csrf(),$_SERVER['HTTP_X_CSRF']??''))out(['ok'=>false,'error'=>'Session ကုန်သွားပါပြီ။ စာမျက်နှာကို refresh လုပ်ပါ'],403);
$a=$_GET['a']??'';$in=json_decode((string)file_get_contents('php://input'),true)?:[];
$txt=fn($k,$max=300)=>mb_substr(trim(strip_tags((string)($in[$k]??''))),0,$max);
$slugv=fn($s)=>preg_replace('/[^a-z0-9-]/','',strtolower((string)$s));
$catids=array_column(cats_all(),'id');
function move(&$list,$id,$d,$key='id'){$i=array_search($id,array_column($list,$key));if($i===false)return;$j=$i+($d<0?-1:1);if($j<0||$j>=count($list))return;[$list[$i],$list[$j]]=[$list[$j],$list[$i]];}
switch($a){
case 'page_save':
 $s=$slugv($in['slug']??'');$pg=pages_all()[$s]??null;if(!$pg)bad('စာမျက်နှာ မတွေ့ပါ');
 if($txt('title')!=='')$pg['title']=$txt('title');
 foreach(['label','desc'] as $k)if(isset($in[$k]))$pg[$k]=$txt($k,200);
 if(isset($in['cat'])){$c=(string)$in['cat'];$c=in_array($c,$catids,true)?$c:'';if($c!==($pg['cat']??'')){$mx=-1;foreach(pages_all() as $q)if(($q['cat']??'')===$c)$mx=max($mx,$q['order']??0);$pg['order']=$mx+1;$pg['cat']=$c;}}
 if(isset($in['body'])&&($pg['body']??null)!==null)$pg['body']=clean_html((string)$in['body']);
 $pg['updated']=time();jsave("pages/$s.json",$pg)?out(['ok'=>true]):bad('သိမ်းဆည်း၍မရပါ (data folder ကို write ခွင့်ပေးပါ)');
case 'page_create':
 $t=$txt('title');if($t==='')bad('ခေါင်းစဉ် ထည့်ပါ');$c=(string)($in['cat']??'');$c=in_array($c,$catids,true)?$c:'';
 $s=new_id('p-');$mx=-1;foreach(pages_all() as $q)if(($q['cat']??'')===$c)$mx=max($mx,$q['order']??0);
 $pg=['slug'=>$s,'title'=>$t,'label'=>$t,'desc'=>'','cat'=>$c,'order'=>$mx+1,'body'=>'<p>ဒီနေရာတွင် စာသား ရေးပါ။</p>','updated'=>time()];
 jsave("pages/$s.json",$pg)?out(['ok'=>true,'url'=>'page.php?p='.$s]):bad('သိမ်းဆည်း၍မရပါ');
case 'page_delete':
 $s=$slugv($in['slug']??'');$pg=pages_all()[$s]??null;if(!$pg)bad('မတွေ့ပါ');if(!empty($pg['url']))bad('ဤစာမျက်နှာသည် အထူးစာမျက်နှာဖြစ်၍ ဖျက်၍မရပါ');
 @unlink(DATA."/pages/$s.json");out(['ok'=>true]);
case 'page_move':
 $s=$slugv($in['slug']??'');$pg=pages_all()[$s]??null;if(!$pg)bad('မတွေ့ပါ');$c=$pg['cat']??'';$g=[];
 foreach(pages_all() as $q)if(($q['cat']??'')===$c)$g[]=$q;usort($g,fn($x,$y)=>($x['order']??0)<=>($y['order']??0));
 move($g,$s,(int)($in['dir']??0),'slug');foreach($g as $i=>$q){$q['order']=$i;jsave('pages/'.$q['slug'].'.json',$q);}out(['ok'=>true]);
case 'cat_save':
 $l=cats_all();$id=$slugv($in['id']??'');$r=['icon'=>$txt('icon',8)?:'📁','title'=>$txt('title',120),'desc'=>$txt('desc',250)];if($r['title']==='')bad('အမည် ထည့်ပါ');
 $f=false;foreach($l as &$c)if($c['id']===$id){$c=array_merge($c,$r);$f=true;}unset($c);
 if(!$f){$r['id']=new_id('c');$l[]=$r;}jsave('categories.json',$l);out(['ok'=>true]);
case 'cat_delete':
 $id=$slugv($in['id']??'');foreach(pages_all() as $q)if(($q['cat']??'')===$id)bad('ဤအမျိုးအစားထဲတွင် စာမျက်နှာများ ရှိနေသေးသည်။ အရင်ရွှေ့ သို့မဟုတ် ဖျက်ပါ');
 jsave('categories.json',array_values(array_filter(cats_all(),fn($c)=>$c['id']!==$id)));out(['ok'=>true]);
case 'cat_move':$l=cats_all();move($l,$slugv($in['id']??''),(int)($in['dir']??0));jsave('categories.json',$l);out(['ok'=>true]);
case 'species_save':
 $l=species_all();$id=$slugv($in['id']??'');$pgv=(string)($in['page']??'');if(!preg_match('~^[\w./?=-]*$~',$pgv))$pgv='';
 $im=(string)($in['img']??'');if(!preg_match('~^(assets/[\w./-]+|https?://[^\s"\'<>]+)?$~',$im))$im='';
 $r=['name'=>$txt('name',100),'en'=>$txt('en',100),'sci'=>$txt('sci',120),'img'=>$im,'page'=>$pgv?:null];if($r['name']==='')bad('ငါးအမည် ထည့်ပါ');
 $f=false;foreach($l as &$c)if(($c['id']??'')===$id){$c=array_merge($c,$r);$f=true;}unset($c);
 if(!$f){$r['id']=new_id('s');$l[]=$r;}jsave('species.json',$l);out(['ok'=>true]);
case 'species_delete':$id=$slugv($in['id']??'');jsave('species.json',array_values(array_filter(species_all(),fn($c)=>($c['id']??'')!==$id)));out(['ok'=>true]);
case 'species_move':$l=species_all();move($l,$slugv($in['id']??''),(int)($in['dir']??0));jsave('species.json',$l);out(['ok'=>true]);
case 'setting_save':
 $allow=array_unique(array_merge(array_keys($GLOBALS['DEF']),array_keys($GLOBALS['DEF_IMG']),['email','phone','address','notify_email']));$s=jload('settings.json',[]);
 foreach((array)($in['values']??[]) as $k=>$v)if(in_array($k,$allow,true))$s[$k]=mb_substr(trim(strip_tags((string)$v)),0,2000);
 jsave('settings.json',$s)?out(['ok'=>true]):bad('သိမ်းဆည်း၍မရပါ');
case 'upload':[$ok,$r]=save_upload($_FILES['file']??[]);$ok?out(['ok'=>true,'url'=>$r]):bad($r);
case 'media_delete':$n=basename((string)($in['name']??''));$p=ROOT.'/assets/uploads/'.$n;if($n!==''&&is_file($p))unlink($p);out(['ok'=>true]);
case 'msg_delete':
 $n=($in['file']??'')==='members'?'members':'messages';$rows=read_jsonl($n);$i=(int)($in['idx']??-1);if(isset($rows[$i])){array_splice($rows,$i,1);write_jsonl($n,$rows);}out(['ok'=>true]);
case 'password_change':
 $ad=jload(ADMIN_FILE,[]);if(!password_verify((string)($in['cur']??''),$ad['hash']??''))bad('လက်ရှိ စကားဝှက် မှားနေသည်');
 if(strlen((string)($in['new']??''))<8)bad('စကားဝှက်အသစ်သည် အနည်းဆုံး ၈ လုံး ရှိရမည်');
 $ad['hash']=password_hash($in['new'],PASSWORD_DEFAULT);jsave(ADMIN_FILE,$ad);out(['ok'=>true]);
default:bad('မသိသော လုပ်ဆောင်ချက်');}
