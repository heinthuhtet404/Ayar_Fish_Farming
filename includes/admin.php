<?php
require_once __DIR__.'/lib.php';
const ADMIN_FILE='admin.json';
function admin_exists(){return is_file(DATA.'/'.ADMIN_FILE);}
function admin_csrf(){sess();if(empty($_SESSION['ct']))$_SESSION['ct']=bin2hex(random_bytes(16));return $_SESSION['ct'];}
function require_admin(){if(!is_admin()){header('Location: login.php');exit;}}
function new_id($p){return $p.substr(bin2hex(random_bytes(4)),0,6);}
function clean_html($html){
 $ok=['p'=>[],'br'=>[],'h2'=>[],'h3'=>[],'h4'=>[],'ul'=>[],'ol'=>[],'li'=>[],'strong'=>[],'b'=>[],'em'=>[],'i'=>[],'u'=>[],'a'=>['href'],
  'img'=>['src','alt','width','height','loading'],'figure'=>['class','style'],'figcaption'=>[],'div'=>['class'],'dl'=>['class'],'dt'=>[],'dd'=>[],
  'blockquote'=>[],'table'=>[],'tr'=>[],'td'=>[],'th'=>[],'span'=>[],'small'=>[]];
 libxml_use_internal_errors(true);$d=new DOMDocument('1.0','UTF-8');
 $d->loadHTML('<?xml encoding="utf-8"?><div>'.$html.'</div>',LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);
 $root=$d->getElementsByTagName('div')->item(0);if(!$root)return '';
 $walk=function($n)use(&$walk,$ok){
  foreach(iterator_to_array($n->childNodes) as $c){
   if($c->nodeType!==XML_ELEMENT_NODE){if($c->nodeType!==XML_TEXT_NODE)$n->removeChild($c);continue;}
   $t=strtolower($c->nodeName);
   if(in_array($t,['script','style','iframe','object','embed','form','input','button','textarea','select','link','meta'])){$n->removeChild($c);continue;}
   $walk($c);
   if(!isset($ok[$t])){while($c->firstChild)$n->insertBefore($c->firstChild,$c);$n->removeChild($c);continue;}
   foreach(iterator_to_array($c->attributes) as $a){
    $k=strtolower($a->name);$v=trim($a->value);
    $keep=in_array($k,$ok[$t],true);
    if($keep&&$k==='href'&&!preg_match('~^(https?:|mailto:|tel:|#|[\w./?=&%-]+$)~i',$v))$keep=false;
    if($keep&&$k==='src'&&!preg_match('~^(https?://|assets/|\.\./assets/)[^\s"\'<>]*$~i',$v))$keep=false;
    if($keep&&$k==='class'&&!preg_match('~^[\w\s-]+$~',$v))$keep=false;
    if($keep&&$k==='style'&&!preg_match('~^max-width:\d+px;margin-inline:auto;?$~',$v))$keep=false;
    if(!$keep)$c->removeAttribute($a->name);
   }
   if($t==='a'&&$c->hasAttribute('href')&&preg_match('~^https?:~i',$c->getAttribute('href'))){$c->setAttribute('rel','noopener');}
  }};
 $walk($root);$o='';foreach($root->childNodes as $c)$o.=$d->saveHTML($c);return trim($o);}
function save_upload($f){
 if(!isset($f['tmp_name'])||($f['error']??1)!==UPLOAD_ERR_OK)return [false,'upload မအောင်မြင်ပါ'];
 if($f['size']>6*1024*1024)return [false,'ဖိုင်အရွယ်အစား 6MB ထက် မကျော်ရပါ'];
 $i=@getimagesize($f['tmp_name']);$ext=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp','image/gif'=>'gif'][$i['mime']??'']??null;
 if(!$ext)return [false,'jpg, png, webp, gif ပုံများသာ ရပါသည်'];
 $dir=ROOT.'/assets/uploads';@mkdir($dir,0755,true);$n=date('ymd').'-'.bin2hex(random_bytes(4)).'.'.$ext;
 if(!move_uploaded_file($f['tmp_name'],"$dir/$n"))return [false,'သိမ်းဆည်း၍မရပါ (assets/uploads ကို write ခွင့်ပေးပါ)'];
 return [true,'assets/uploads/'.$n];}
function read_jsonl($name){$p=DATA."/$name.jsonl";if(!is_file($p))return [];$o=[];foreach(file($p,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $l){$r=json_decode($l,true);if($r)$o[]=$r;}return $o;}
function write_jsonl($name,$rows){$s='';foreach($rows as $r)$s.=json_encode($r,JSON_UNESCAPED_UNICODE)."\n";return file_put_contents(DATA."/$name.jsonl",$s,LOCK_EX)!==false;}
