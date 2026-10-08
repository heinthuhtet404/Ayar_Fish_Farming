<?php
$pageTitle = 'Ayar Fish Farming | ငါးမွေးမြူရေးဗဟုသုတ';
$categories = [
 ['icon'=>'🐟','title'=>'ငါးမျိုးစိတ်များ','desc'=>'မွေးမြူနိုင်သော ငါးမျိုးစိတ်များ၏ အခြေခံအချက်အလက်များ','items'=>[
  ['Rohu (ငါးမြစ်ချင်း)','rohu.php'],['Catla (ငါးတန်)','catla.php'],['Silver Carp','silver-carp.php'],['Snakehead','snakehead.php'],['Tilapia','tilapia.php'],['Catfish','catfish.php'],['ငါးမျိုးစိတ် စုစည်းမှု','fish-species.php']]],
 ['icon'=>'🏞️','title'=>'ငါးကန်နှင့် မွေးမြူရေးစနစ်','desc'=>'နေရာရွေးချယ်ခြင်း၊ ကန်တည်ဆောက်ခြင်းနှင့် လှောင်အိမ်စနစ်','items'=>[
  ['ကန်မြေနေရာရွေးချယ်ခြင်း','pond-site-selection.php'],['မွေးမြူရေးနေရာရွေးချယ်ခြင်း','farm-site-selection.php'],['ငါးကန်တူးဖော်နည်း','pond-construction.php'],['လှောင်အိမ်ဖြင့်မွေးမြူခြင်း','cage-farming.php'],['ကန်သန့်ရှင်းရေး','pond-cleaning.php']]],
 ['icon'=>'🌾','title'=>'အစာနှင့် အာဟာရ','desc'=>'ငါးအစာ၊ အာဟာရဓာတ်နှင့် အစာကျွေးခြင်းဆိုင်ရာ လမ်းညွှန်များ','items'=>[
  ['ငါးအစာကျွေးခြင်း','feeding.php'],['ငါးစာအမျိုးအစားများ','feed-types.php'],['ပျှမ်းမျှအာဟာရဓာတ်','average-nutrients.php'],['လိုအပ်သောအာဟာရဓာတ်','required-nutrients.php']]],
 ['icon'=>'🩺','title'=>'ကျန်းမာရေးနှင့် ရောဂါ','desc'=>'ရောဂါလက္ခဏာ၊ ကာကွယ်ရေးနှင့် ကျန်းမာရေးစောင့်ရှောက်မှု','items'=>[
  ['ကျရောက်တတ်သောရောဂါများ','diseases.php'],['ကာကွယ်နိုင်သောနည်းလမ်းများ','prevention.php'],['ကျန်းမာရေးနှင့် သားဖောက်နည်း','fish-health-breeding.php'],['ဆေးထိုးသားဖောက်နည်း','induced-breeding.php']]],
 ['icon'=>'🌿','title'=>'ကန်စီမံခန့်ခွဲမှု','desc'=>'မြေဩဇာနှင့် ရေကန်စီမံခန့်ခွဲမှုကို အဆင့်လိုက်လေ့လာရန်','items'=>[
  ['မြေဩဇာ အခြေခံ','fertilizer.php'],['မြေဩဇာ နည်းလမ်း (၁)','fertilizer-1.php'],['မြေဩဇာ နည်းလမ်း (၂)','fertilizer-2.php'],['မြေဩဇာ နည်းလမ်း (၃)','fertilizer-3.php'],['မြေဩဇာ နည်းလမ်း (၄)','fertilizer-4.php'],['မြေဩဇာ နည်းလမ်း (၅)','fertilizer-5.php'],['မြေဩဇာ နည်းလမ်း (၆)','fertilizer-6.php']]],
 ['icon'=>'🚚','title'=>'ဈေးကွက်နှင့် တန်ဖိုးမြှင့်ခြင်း','desc'=>'ငါးထုတ်ကုန်များကို ဈေးကွက်တင်ပို့ခြင်းနှင့် ရောင်းချခြင်း','items'=>[
  ['ဈေးကွက်တင်ပို့မှု','market.php'],['ဈေးကွက်တင်ပို့မှု (၁)','market-1.php'],['ဈေးကွက်တင်ပို့မှု (၂)','market-2.php'],['အစားအသောက်နှင့် တန်ဖိုးမြှင့်ခြင်း','food-website.php']]],
];
$featured = [
 ['icon'=>'📍','title'=>'ပထမဆုံး စတင်မယ့်သူများ','text'=>'ငါးကန်နေရာရွေးချယ်ခြင်းကနေ စပြီး အဆင့်လိုက်လေ့လာပါ။','url'=>'pond-site-selection.php'],
 ['icon'=>'🍚','title'=>'အစာကျွေးခြင်း','text'=>'အစာအမျိုးအစားနှင့် အာဟာရလိုအပ်ချက်ကို လက်တွေ့အသုံးချနိုင်အောင် လေ့လာပါ။','url'=>'feeding.php'],
 ['icon'=>'🩺','title'=>'ရောဂါကာကွယ်ရေး','text'=>'ငါးကျန်းမာရေးအတွက် အဖြစ်များသောရောဂါများနှင့် ကာကွယ်နည်းများကို ကြည့်ပါ။','url'=>'diseases.php'],
 ['icon'=>'🐠','title'=>'ငါးမျိုးစိတ်များ','text'=>'မွေးမြူရေးအတွက် အသုံးများသော ငါးမျိုးစိတ်များကို တစ်နေရာတည်းမှာကြည့်ပါ။','url'=>'fish-species.php'],
];
?>
<!doctype html>
<html lang="my">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= htmlspecialchars($pageTitle) ?></title>
<meta name="description" content="Ayar Fish Farming — ငါးမွေးမြူရေးဆိုင်ရာ လက်တွေ့အသုံးချဗဟုသုတ၊ ငါးမျိုးစိတ်၊ အစာ၊ အာဟာရ၊ ရောဂါ၊ ကန်စီမံခန့်ခွဲမှုနှင့် ဈေးကွက်လမ်းညွှန်များ။">
<link rel="stylesheet" href="assets/responsive.css">
</head>
<body>
<a class="skip-link" href="#main-content">အကြောင်းအရာသို့ ကျော်ရန်</a>
<header class="site-header" id="siteHeader">
  <div class="topbar"><div class="shell topbar-inner"><span>🌊 Ayar Fish Farming Knowledge Hub</span><span class="topbar-note">လက်တွေ့အသုံးချ ငါးမွေးမြူရေးဗဟုသုတ</span></div></div>
  <nav class="navbar shell" aria-label="Main navigation">
    <a class="brand" href="index.php"><span class="brand-mark"><img src="fish logo.webp" alt="Ayar Fish Farming logo"></span><span><b>Ayar</b><small>FISH FARMING</small></span></a>
    <button class="menu-toggle" id="menuToggle" aria-label="Menu ဖွင့်ရန်" aria-expanded="false"><span></span><span></span><span></span></button>
    <div class="nav-panel" id="navPanel">
      <div class="nav-links">
        <a class="nav-link active" href="index.php">ပင်မစာမျက်နှာ</a>
        <div class="nav-dropdown">
          <button class="nav-link dropdown-trigger" type="button">လေ့လာရန် <span>⌄</span></button>
          <div class="dropdown-menu">
            <a href="#topics">📚 အကြောင်းအရာများ</a><a href="fish-species.php">🐟 ငါးမျိုးစိတ်</a><a href="feeding.php">🌾 အစာကျွေးခြင်း</a><a href="diseases.php">🩺 ရောဂါနှင့်ကာကွယ်ရေး</a><a href="pond-construction.php">🏞️ ကန်တည်ဆောက်ခြင်း</a><a href="market.php">🚚 ဈေးကွက်</a>
          </div>
        </div>
        <a class="nav-link" href="fish-gallery.php">ပုံများ</a>
        <a class="nav-link" href="fish-health-breeding.php">ကျန်းမာရေး</a>
        <a class="nav-link" href="market.php">ဈေးကွက်</a>
      </div>
      <a class="nav-cta" href="#topics">စတင်လေ့လာမည် <span>→</span></a>
    </div>
  </nav>
</header>

<main id="main-content">
<section class="hero shell-wide">
  <div class="hero-glow glow-one"></div><div class="hero-glow glow-two"></div>
  <div class="shell hero-grid">
    <div class="hero-copy">
      <div class="eyebrow"><span class="pulse-dot"></span> FISH FARMING • PRACTICAL KNOWLEDGE</div>
      <h1>ငါးမွေးမြူရေးကို<br><em>မှန်ကန်စွာ</em> စတင်ပါ</h1>
      <p>ငါးကန်နေရာရွေးချယ်ခြင်းမှ စတင်ပြီး အစာ၊ အာဟာရ၊ ရောဂါကာကွယ်ရေး၊ သားဖောက်ခြင်းနှင့် ဈေးကွက်အထိ လက်တွေ့အသုံးချနိုင်တဲ့ အချက်အလက်တွေကို တစ်နေရာတည်းမှာ ရှာဖွေလေ့လာနိုင်ပါတယ်။</p>
      <div class="hero-actions"><a class="btn btn-primary" href="#topics">📚 လေ့လာရန် စတင်မည်</a><a class="btn btn-glass" href="fish-species.php">🐟 ငါးမျိုးစိတ်ကြည့်မည်</a></div>
      <div class="hero-trust"><span>✓ Mobile Friendly</span><span>✓ Practical Guides</span><span>✓ Myanmar Language</span></div>
    </div>
    <div class="hero-visual">
      <div class="pond-card"><div class="pond-top"><span>AYAR AQUA</span><span>🐟</span></div><div class="fish-scene"><img src="FishFor1.1.jpg" alt="Fish farming illustration"></div><div class="pond-info"><div><small>KNOWLEDGE</small><strong>Fish Farming Hub</strong></div><div class="water-status"><i></i> Learning</div></div></div>
      <div class="float-card float-a">🌱 <span><b>စနစ်တကျ</b><small>Farm Management</small></span></div>
      <div class="float-card float-b">💧 <span><b>ရေအရည်အသွေး</b><small>Healthy Pond</small></span></div>
    </div>
  </div>
</section>

<section class="quick-strip shell" aria-label="Quick access">
  <?php foreach($featured as $f): ?><a class="quick-card" href="<?= $f['url'] ?>"><span class="quick-icon"><?= $f['icon'] ?></span><span><b><?= $f['title'] ?></b><small><?= $f['text'] ?></small></span><strong>→</strong></a><?php endforeach; ?>
</section>

<section class="section shell" id="topics">
  <div class="section-heading"><div><span class="kicker">KNOWLEDGE LIBRARY</span><h2>လိုအပ်တာကို ရှာပြီး လေ့လာပါ</h2><p>အကြောင်းအရာအလိုက် စနစ်တကျခွဲထားလို့ ဖုန်းကနေဖြစ်စေ၊ Laptop ကနေဖြစ်စေ လွယ်လွယ်ကူကူအသုံးပြုနိုင်ပါတယ်။</p></div><div class="search-box"><span>⌕</span><input id="topicSearch" type="search" placeholder="အကြောင်းအရာရှာရန်…" aria-label="Search topics"></div></div>
  <div class="category-grid" id="categoryGrid">
  <?php foreach($categories as $cat): ?>
    <article class="category-card" data-search="<?= htmlspecialchars($cat['title'].' '.$cat['desc'].' '.implode(' ',array_column($cat['items'],0))) ?>">
      <div class="category-head"><span class="category-icon"><?= $cat['icon'] ?></span><span class="category-arrow">↗</span></div><h3><?= $cat['title'] ?></h3><p><?= $cat['desc'] ?></p>
      <div class="topic-links"><?php foreach($cat['items'] as $item): ?><a href="<?= $item[1] ?>"><span><?= htmlspecialchars($item[0]) ?></span><b>→</b></a><?php endforeach; ?></div>
    </article>
  <?php endforeach; ?>
  </div><div id="noResults" class="no-results" hidden>ရှာဖွေထားသောအကြောင်းအရာ မတွေ့ပါ။ အခြား keyword တစ်ခုဖြင့် ထပ်ရှာကြည့်ပါ။</div>
</section>

<section class="feature-section shell-wide"><div class="shell feature-grid"><div><span class="kicker light">WHY AYAR FISH FARMING</span><h2>စာတွေဖတ်ရုံမက<br><em>လက်တွေ့အသုံးချနိုင်အောင်</em></h2><p>Website ကို ငါးမွေးမြူသူတွေ၊ ကျောင်းသားတွေ၊ စတင်လေ့လာသူတွေ အတွက် အသုံးပြုရလွယ်ကူတဲ့ reference hub အဖြစ် တည်ဆောက်ထားပါတယ်။</p></div><div class="benefit-list"><div><span>01</span><b>အဆင့်လိုက်လေ့လာနိုင်ခြင်း</b><small>Beginner ကနေ advanced topic အထိ ဆက်စပ်ပြီးသွားနိုင်ပါတယ်။</small></div><div><span>02</span><b>အကြောင်းအရာအလိုက် စုစည်းထားခြင်း</b><small>Fish, Feed, Health, Pond, Market စသဖြင့် ခွဲထားပါတယ်။</small></div><div><span>03</span><b>Device အားလုံးအတွက် Responsive</b><small>Phone, Tablet, Laptop, Desktop အားလုံးမှာ အသုံးပြုနိုင်ပါတယ်။</small></div></div></div></section>

<section class="section shell"><div class="section-heading compact"><div><span class="kicker">POPULAR STARTING POINTS</span><h2>ဒီနေရာကနေ စတင်ကြည့်ပါ</h2></div></div><div class="start-grid"><a href="pond-site-selection.php"><span>📍</span><b>ကန်နေရာရွေးချယ်ခြင်း</b><small>ပထမဆုံးစတင်သူများအတွက်</small></a><a href="pond-construction.php"><span>🏗️</span><b>ကန်တည်ဆောက်ခြင်း</b><small>ကန်တူးဖော်ခြင်းနှင့် စနစ်</small></a><a href="feeding.php"><span>🌾</span><b>အစာကျွေးခြင်း</b><small>အစာနှင့် feeding practice</small></a><a href="prevention.php"><span>🛡️</span><b>ရောဂါကာကွယ်ခြင်း</b><small>ငါးကျန်းမာရေးအတွက်</small></a><a href="market.php"><span>📦</span><b>ဈေးကွက်တင်ပို့ခြင်း</b><small>ရောင်းချခြင်းနှင့် တန်ဖိုးမြှင့်ခြင်း</small></a><a href="fish-gallery.php"><span>🖼️</span><b>Photo Gallery</b><small>ငါးမွေးမြူရေးပုံများ</small></a></div></section>
</main>

<footer class="site-footer"><div class="shell footer-grid"><div><a class="brand footer-brand" href="index.php"><span class="brand-mark"><img src="fish logo.webp" alt="Ayar logo"></span><span><b>Ayar</b><small>FISH FARMING</small></span></a><p>ငါးမွေးမြူရေးဆိုင်ရာ ဗဟုသုတများကို စနစ်တကျ လေ့လာနိုင်ရန် တည်ဆောက်ထားသော knowledge website။</p></div><div><h4>လေ့လာရန်</h4><a href="fish-species.php">ငါးမျိုးစိတ်</a><a href="feeding.php">အစာနှင့်အာဟာရ</a><a href="diseases.php">ကျန်းမာရေး</a></div><div><h4>စီမံခန့်ခွဲမှု</h4><a href="pond-construction.php">ငါးကန်</a><a href="fertilizer.php">မြေဩဇာ</a><a href="market.php">ဈေးကွက်</a></div><div><h4>Quick Access</h4><a href="#topics">အကြောင်းအရာများ</a><a href="fish-gallery.php">Gallery</a><a href="sign-in.php">Sign in</a></div></div><div class="shell footer-bottom"><span>© <?= date('Y') ?> Ayar Fish Farming</span><span>Built for practical learning • Responsive Web</span></div></footer>
<script src="assets/app.js"></script>
</body></html>
