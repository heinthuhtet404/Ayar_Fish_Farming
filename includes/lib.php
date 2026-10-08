<?php
const SITE_NAME = 'Ayar Fish Farming';
define('ROOT', dirname(__DIR__));
define('DATA', ROOT . '/data');
function h($s)
{
  return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
function jload($f, $def = [])
{
  $p = DATA . '/' . $f;
  if (!is_file($p)) return $def;
  $d = json_decode((string)file_get_contents($p), true);
  return $d === null ? $def : $d;
}
function jsave($f, $d)
{
  $p = DATA . '/' . $f;
  @mkdir(dirname($p), 0755, true);
  $t = $p . '.tmp';
  if (file_put_contents($t, json_encode($d, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX) === false) return false;
  return rename($t, $p);
}
function sess()
{
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('ayar_sid');
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'path' => '/']);
    session_start();
  }
}
function is_admin()
{
  if (!isset($_COOKIE['ayar_sid'])) return false;
  sess();
  return !empty($_SESSION['adm']);
}
function csrf()
{
  sess();
  if (empty($_SESSION['t'])) $_SESSION['t'] = bin2hex(random_bytes(16));
  return $_SESSION['t'];
}
function csrf_ok()
{
  sess();
  return !empty($_POST['t']) && hash_equals($_SESSION['t'] ?? '', $_POST['t']);
}
// ---- editable site texts (admin can change them in place; defaults below)
$DEF = [
  'hero_title' => 'ငါးမွေးမြူရေးကို မှန်ကန်စွာ စတင်ပါ',
  'hero_text' => 'ငါးကန်နေရာရွေးချယ်ခြင်းမှ စတင်ပြီး အစာ၊ အာဟာရ၊ ရောဂါကာကွယ်ရေး၊ သားဖောက်ခြင်းနှင့် ဈေးကွက်အထိ လက်တွေ့အသုံးချနိုင်တဲ့ အချက်အလက်တွေကို တစ်နေရာတည်းမှာ ရှာဖွေလေ့လာနိုင်ပါတယ်။',
  'path_title' => 'စတင်မယ့်သူများအတွက် လမ်းကြောင်း',
  'lib_title' => 'လိုအပ်တာကို ရှာပြီး လေ့လာပါ',
  'lib_sub' => 'အကြောင်းအရာအလိုက် စနစ်တကျခွဲထားလို့ ဖုန်းကနေဖြစ်စေ၊ Laptop ကနေဖြစ်စေ လွယ်လွယ်ကူကူအသုံးပြုနိုင်ပါတယ်။',
  'species_title' => 'မြန်မာနိုင်ငံတွင်မွေးမြူသော ငါးအမျိုးအစားများ',
  'intro_title' => 'ကျွန်ုပ်တို့၏ website အကြောင်း',
  'intro_text' => 'သင်ဟာငါးမွေးမြူရေးလုပ်ငန်းကိုလုပ်ကိုင်ဖို့စိတ်ဝင်စားသူတစ်ယောက်ဖြစ်ပါသလား?(သို့မဟုတ်)ငါးမွေးမြူရေးလုပ်ငန်းအကြောင်းလေ့လာနေသူတစ်ဦးဖြစ်ပါသလား?ဒါဆိုရင်တော့ကျွန်တော်တို့ရဲ့websiteလေးကိုအသုံးပြုဖို့အကြံပေးချင်ပါတယ်',
  'path_sub' => 'အဆင့်လိုက် ဖတ်သွားလျှင် ငါးမွေးမြူရေး လုပ်ငန်းတစ်ခုလုံးကို နားလည်နိုင်ပါတယ်။',
  'brand_name' => 'Ayar',
  'brand_sub' => 'FISH FARMING',
  'nav_home' => 'ပင်မ',
  'nav_learn' => 'လေ့လာရန် ▾',
  'nav_species' => 'ငါးမျိုးစိတ်',
  'nav_gallery' => 'ပုံများ',
  'nav_about' => 'ကျွန်ုပ်တို့အကြောင်း',
  'nav_contact' => 'ဆက်သွယ်ရန်',
  'hero_btn1' => 'လေ့လာရန် စတင်မည်',
  'hero_btn2' => 'ငါးမျိုးစိတ်ကြည့်မည်',
  'hero_search_btn' => 'ရှာမည်',
  'hero_search_ph' => 'အကြောင်းအရာရှာရန်… (ဥပမာ - အစာ၊ ရောဂါ)',
  'species_more' => 'အားလုံးကြည့်ရန်',
  'intro_btn' => 'ပိုမိုသိရှိရန်',
  'skip_link' => 'အကြောင်းအရာသို့ ကျော်ရန်',
  'footer_desc' => 'ငါးမွေးမြူရေးဆိုင်ရာ ဗဟုသုတများကို စနစ်တကျ လေ့လာနိုင်ရန် တည်ဆောက်ထားသော knowledge website။',
  'footer_col1' => 'လေ့လာရန်',
  'footer_col2' => 'စီမံခန့်ခွဲမှု',
  'footer_col3' => 'Quick Access',
  'footer_species' => 'ငါးမျိုးစိတ်',
  'footer_gallery' => 'ပုံများ',
  'footer_about' => 'ကျွန်ုပ်တို့အကြောင်း',
  'footer_contact' => 'ဆက်သွယ်ရန်',
  'footer_signin' => 'စာရင်းသွင်းရန်',
  'contact_h1' => 'ဆက်သွယ်ရန်',
  'contact_sub' => 'မေးခွန်း သို့မဟုတ် အကြံပြုချက်ရှိလျှင် အောက်ပါပုံစံဖြင့် ပေးပို့ပါ။',
  'contact_btn' => 'ပေးပို့မည်',
  'contact_ok' => 'ပေးပို့မှု အောင်မြင်ပါသည်။ ကျေးဇူးတင်ပါသည်။',
  'signin_h1' => 'စာရင်းသွင်းရန် (Sign in)',
  'signin_sub' => 'အချက်အလက်များကို ဖြည့်ပြီး ပေးပို့ပါ။',
  'signin_btn' => 'ပေးပို့မည်',
  'signin_ok' => 'ပေးပို့မှု အောင်မြင်ပါသည်။ ကျေးဇူးတင်ပါသည်။',
  'nf_h1' => 'စာမျက်နှာ မတွေ့ပါ',
  'nf_sub' => 'ရှာနေသော စာမျက်နှာ မရှိတော့ပါ သို့မဟုတ် လိပ်စာ မှားနေပါသည်။',
  'nf_btn' => 'ပင်မစာမျက်နှာသို့',
  'species_h1' => 'အများဆုံးမွေးမြူသော ငါးအမျိုးအစားများ',
  'species_sub' => 'ငါးမျိုးစိတ်တစ်ခုချင်းစီ၏ အမည်၊ အင်္ဂလိပ်အမည်နှင့် သိပ္ပံအမည်များ။ အသေးစိတ်စာမျက်နှာရှိသော မျိုးစိတ်များကို နှိပ်၍ ဖတ်နိုင်ပါသည်။',
  'gallery_h1' => 'ပုံများ',
  'rel_suffix' => ' ဆက်စပ်အကြောင်းအရာများ',
  'prev_lbl' => 'ရှေ့စာမျက်နှာ',
  'next_lbl' => 'နောက်စာမျက်နှာ',
  'crumb_home' => 'ပင်မ',
  'copy_name' => 'Ayar Fish Farming',
  'contact_l_name' => 'အမည်',
  'contact_l_phone' => 'ဖုန်းနံပါတ်',
  'contact_l_email' => 'အီးမေးလ်',
  'contact_l_msg' => 'စာသား',
  'si_l_name' => 'Name',
  'si_l_phone' => 'Phone',
  'si_l_email' => 'Email',
  'si_l_addr' => 'Address',
  'si_l_dob' => 'Date of Birth',
  'si_l_gender' => 'Gender',
  'si_l_pw' => 'Password',
  'si_l_comment' => 'Comment',
  'st0_t' => 'ကန်မြေနေရာရွေးချယ်ခြင်း',
  'st0_d' => 'ရေရရှိမှုနှင့် မြေအမျိုးအစားကို အရင်စစ်ပါ',
  'st1_t' => 'ငါးကန်တူးဖော်နည်း',
  'st1_d' => 'တူးဖော်ခြင်းနှင့် တည်ဆောက်ခြင်း',
  'st2_t' => 'မြေဩဇာထည့်သွင်းခြင်း',
  'st2_d' => 'ကန်ရေအရည်အသွေးနှင့် သဘာဝအစာ ပေါများစေရန်',
  'st3_t' => 'ငါးမျိုးစိတ်ရွေးချယ်ခြင်း',
  'st3_d' => 'မွေးမြူနိုင်သော ငါးမျိုးများ',
  'st4_t' => 'ငါးအစာကျွေးခြင်း',
  'st4_d' => 'အစာအမျိုးအစားနှင့် အာဟာရလိုအပ်ချက်',
  'st5_t' => 'ကျန်းမာရေးနှင့် သားဖောက်ခြင်း',
  'st5_d' => 'ရောဂါကာကွယ်ရေးနှင့် ဆေးထိုးသားဖောက်နည်း',
  'st6_t' => 'ဈေးကွက်တင်ပို့ခြင်း',
  'st6_d' => 'ပြည်တွင်း/ပြည်ပ ဈေးကွက်',
];
$DEF_IMG = ['logo' => 'assets/img/fish-logo.svg', 'intro_img' => 'assets/img/fishland.jpg'];
$LABELS = [
  'hero_title' => 'ပင်မ ခေါင်းစဉ်ကြီး',
  'hero_text' => 'ပင်မ ခေါင်းစဉ်အောက် စာသား',
  'path_title' => 'လမ်းကြောင်း ခေါင်းစဉ်',
  'path_sub' => 'လမ်းကြောင်း ဖော်ပြချက်',
  'lib_title' => 'စာကြည့်တိုက် ခေါင်းစဉ်',
  'lib_sub' => 'စာကြည့်တိုက် ဖော်ပြချက်',
  'species_title' => 'ငါးမျိုးစိတ် ခေါင်းစဉ်',
  'intro_title' => 'အကြောင်းအရာ ခေါင်းစဉ်',
  'intro_text' => 'အကြောင်းအရာ စာသား',
  'brand_name' => 'ဘရန်း အမည် (ငယ်)',
  'brand_sub' => 'ဘရန်း အမည် (ကြီး)',
  'nav_home' => 'မီနူး - ပင်မ',
  'nav_learn' => 'မီနူး - လေ့လာရန်',
  'nav_species' => 'မီနူး - ငါးမျိုးစိတ်',
  'nav_gallery' => 'မီနူး - ပုံများ',
  'nav_about' => 'မီနူး - ကျွန်ုပ်တို့အကြောင်း',
  'nav_contact' => 'မီနူး - ဆက်သွယ်ရန် ခလုတ်',
  'hero_btn1' => 'ပင်မ ခလုတ် ၁',
  'hero_btn2' => 'ပင်မ ခလုတ် ၂',
  'hero_search_btn' => 'ရှာခလုတ်',
  'hero_search_ph' => 'ရှာဖွေမှု placeholder',
  'species_more' => 'ပင်မ - အားလုံးကြည့်ရန်',
  'intro_btn' => 'အကြောင်းအရာ ခလုတ်',
  'skip_link' => 'ကျော်သွားရန် လင့်ခ်',
  'footer_desc' => 'Footer ဖော်ပြချက်',
  'footer_col1' => 'Footer ကော်လံ ၁',
  'footer_col2' => 'Footer ကော်လံ ၂',
  'footer_col3' => 'Footer ကော်လံ ၃',
  'footer_species' => 'Footer - ငါးမျိုးစိတ်',
  'footer_gallery' => 'Footer - ပုံများ',
  'footer_about' => 'Footer - ကျွန်ုပ်တို့',
  'footer_contact' => 'Footer - ဆက်သွယ်ရန်',
  'footer_signin' => 'Footer - စာရင်းသွင်းရန်',
  'contact_h1' => 'ဆက်သွယ်ရန် ခေါင်းစဉ်',
  'contact_sub' => 'ဆက်သွယ်ရန် ဖော်ပြချက်',
  'contact_btn' => 'ဆက်သွယ်ရန် ခလုတ်',
  'contact_ok' => 'ဆက်သွယ်ရန် အောင်မြင်စာ',
  'signin_h1' => 'စာရင်းသွင်းရန် ခေါင်းစဉ်',
  'signin_sub' => 'စာရင်းသွင်းရန် ဖော်ပြချက်',
  'signin_btn' => 'စာရင်းသွင်းရန် ခလုတ်',
  'signin_ok' => 'စာရင်းသွင်းရန် အောင်မြင်စာ',
  'nf_h1' => '404 ခေါင်းစဉ်',
  'nf_sub' => '404 ဖော်ပြချက်',
  'nf_btn' => '404 ခလုတ်',
  'species_h1' => 'ငါးမျိုးစိတ် စာမျက်နှာ ခေါင်းစဉ်',
  'species_sub' => 'ငါးမျိုးစိတ် စာမျက်နှာ ဖော်ပြချက်',
  'gallery_h1' => 'ပုံများ စာမျက်နှာ ခေါင်းစဉ်',
  'logo' => 'Logo ပုံ',
  'intro_img' => 'အကြောင်းအရာ ပုံ',
  'email' => 'အီးမေးလ်',
  'phone' => 'ဖုန်း',
  'address' => 'လိပ်စာ',
  'notify_email' => 'အကြောင်းကြားမည့် အီးမေးလ်',
  'rel_suffix' => 'ဆက်စပ် ခေါင်းစဉ် နောက်ဆက်',
  'prev_lbl' => 'ရှေ့စာမျက်နှာ စာသား',
  'next_lbl' => 'နောက်စာမျက်နှာ စာသား',
  'crumb_home' => 'Breadcrumb ပင်မ',
  'copy_name' => 'Footer ကော်ပီရိုက် အမည်',
  'contact_l_name' => 'ဆက်သွယ်ရန် - အမည် label',
  'contact_l_phone' => 'ဆက်သွယ်ရန် - ဖုန်း label',
  'contact_l_email' => 'ဆက်သွယ်ရန် - အီးမေးလ် label',
  'contact_l_msg' => 'ဆက်သွယ်ရန် - စာသား label',
  'si_l_name' => 'Sign-in - Name label',
  'si_l_phone' => 'Sign-in - Phone label',
  'si_l_email' => 'Sign-in - Email label',
  'si_l_addr' => 'Sign-in - Address label',
  'si_l_dob' => 'Sign-in - DOB label',
  'si_l_gender' => 'Sign-in - Gender label',
  'si_l_pw' => 'Sign-in - Password label',
  'si_l_comment' => 'Sign-in - Comment label',
];
for ($i = 0; $i < 7; $i++) {
  $LABELS["st{$i}_t"] = 'လမ်းကြောင်း ' . ($i + 1) . ' ခေါင်းစဉ်';
  $LABELS["st{$i}_d"] = 'လမ်းကြောင်း ' . ($i + 1) . ' ဖော်ပြချက်';
}
function IMG($k, $d = '')
{
  global $DEF_IMG;
  return S($k, $d ?: ($DEF_IMG[$k] ?? ''));
}
function edimg($k)
{
  return is_admin() ? ' data-img="' . h($k) . '"' : '';
}
function S($k, $d = '')
{
  static $s = null;
  if ($s === null) $s = jload('settings.json', []);
  return (isset($s[$k]) && $s[$k] !== '') ? $s[$k] : $d;
}
function T($k)
{
  global $DEF;
  return S($k, $DEF[$k] ?? '');
}
function ed($k)
{
  return is_admin() ? ' data-set="' . h($k) . '"' : '';
}
$CFG = ['email' => S('email'), 'phone' => S('phone'), 'address' => S('address'), 'notify_email' => S('notify_email')];
// ---- pages / categories / species (stored as JSON in /data)
function pages_all()
{
  static $p = null;
  if ($p !== null) return $p;
  $p = [];
  foreach (glob(DATA . '/pages/*.json') ?: [] as $f) {
    $d = json_decode((string)file_get_contents($f), true);
    if ($d && !empty($d['slug'])) $p[$d['slug']] = $d;
  }
  return $p;
}
function page_url($d)
{
  if (!empty($d['url'])) return $d['url'];
  return is_file(ROOT . '/' . $d['slug'] . '.php') ? $d['slug'] . '.php' : 'page.php?p=' . $d['slug'];
}
function cats_all()
{
  return jload('categories.json', []);
}
function species_all()
{
  return jload('species.json', []);
}
function registry()
{
  static $r = null;
  if ($r !== null) return $r;
  $pg = pages_all();
  $r = [];
  foreach (cats_all() as $c) {
    $items = [];
    foreach ($pg as $d) if (($d['cat'] ?? '') === $c['id']) $items[] = [(($d['label'] ?? '') ?: $d['title']), page_url($d), $d['slug'], $d['order'] ?? 0];
    usort($items, fn($a, $b) => $a[3] <=> $b[3]);
    $c['items'] = $items;
    $r[] = $c;
  }
  return $r;
}
function find_page($slug)
{
  foreach (registry() as $ci => $c) foreach ($c['items'] as $ii => $it) if ($it[2] === $slug) return ['ci' => $ci, 'ii' => $ii, 'title' => $it[0]];
  return null;
}
$CATS = registry();
function save_submission($name, $row)
{
  global $CFG;
  $row['time'] = date('c');
  @mkdir(DATA, 0755, true);
  $ok = @file_put_contents(DATA . "/$name.jsonl", json_encode($row, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND | LOCK_EX) !== false;
  if ($ok && !empty($CFG['notify_email']) && $name === 'messages') @mail($CFG['notify_email'], 'Ayar Fish Farming: new message', json_encode($row, JSON_UNESCAPED_UNICODE), 'Content-Type: text/plain; charset=UTF-8');
  return $ok;
}
