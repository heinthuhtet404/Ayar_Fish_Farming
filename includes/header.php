<?php require_once __DIR__ . '/lib.php';
$page = $page ?? [];
$cs = $page['slug'] ?? basename($_SERVER['SCRIPT_NAME'], '.php');
$cur = find_page($cs);
$file = basename($_SERVER['SCRIPT_NAME']);
$ttl = $page['t'] ?? ($cur['title'] ?? SITE_NAME);
$raw = !empty($page['raw']);
$adm = is_admin();
function on($f)
{
    global $file;
    return $file === $f ? ' class="on"' : '';
}
?>
<!doctype html>
<html lang="my">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <title><?= h($ttl) ?><?= $file === 'index.php' ? '' : ' | ' . SITE_NAME ?></title>
    <meta name="description" content="<?= h($page['d'] ?? 'ငါးမွေးမြူရေးဆိုင်ရာ လက်တွေ့အသုံးချ ဗဟုသုတများ - ငါးမျိုးစိတ်၊ ကန်တည်ဆောက်ခြင်း၊ အစာ၊ ရောဂါကာကွယ်ရေးနှင့် ဈေးကွက်') ?>">
    <meta property="og:title" content="<?= h($ttl) ?>">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#08363f">
    <link rel="icon" href="assets/img/fish-logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;500;600;700&family=Noto+Serif+Myanmar:wght@600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/site.css">
    <script src="assets/js/site.js" defer></script>
    <?php if ($adm): ?>
        <meta name="csrf" content="<?php require_once __DIR__ . '/admin.php';
                                    echo h(admin_csrf()); ?>">
        <meta name="base" content="">
        <link rel="stylesheet" href="assets/css/admin.css">
        <script src="assets/js/admin.js" defer></script>
        <script>
            window.APAGES = <?= json_encode(array_values(array_map(fn($d) => [($d['label'] ?? '') ?: $d['title'], page_url($d)], pages_all())), JSON_UNESCAPED_UNICODE) ?>;
            window.ACATS = <?= json_encode(array_map(fn($c) => [$c['id'], $c['icon'] . ' ' . $c['title']], cats_all()), JSON_UNESCAPED_UNICODE) ?>;
            window.SSPECIES = <?= json_encode(array_values(species_all()), JSON_UNESCAPED_UNICODE) ?>;
        </script><?php endif; ?>
</head>

<body class="<?= $adm ? 'admin' : '' ?>">
    <?php if ($adm): ?><div class="abar"><b>🛠 Admin</b><a href="admin/index.php">Dashboard</a><a href="admin/index.php?s=pages">စာမျက်နှာများ</a><span class="grow"></span><span id="a-msg"></span><span class="ahint">👆 ပြင်လိုသော စာသား/ပုံကို နှိပ်ပါ</span>
            <button type="button" id="a-edit">✏️ ဒီစာမျက်နှာကို ပြင်မည်</button><button type="button" id="a-save" hidden>💾 သိမ်းမည်</button><button type="button" id="a-cancel" hidden>မလုပ်တော့ပါ</button><a href="admin/logout.php">Logout</a>
        </div><?php endif; ?>
    <a class="skip" href="#main" <?= ed('skip_link') ?>><?= h(T('skip_link')) ?></a>
    <div id="prog"></div>
    <header class="hd">
        <div class="wrap"><a class="brand" href="index.php"><img src="<?= h(IMG('logo')) ?>" alt="" <?= edimg('logo') ?>><span>
                    <span<?= ed('brand_name') ?>><?= h(T('brand_name')) ?>
                </span>
                <small<?= ed('brand_sub') ?>><?= h(T('brand_sub')) ?></small></span>
            </a>
            <button class="menu-btn" id="mb" aria-label="မီနူး" aria-expanded="false">☰</button>
            <nav class="nav" id="nav" aria-label="Main"><a href="index.php" <?= on('index.php') ?><?= ed('nav_home') ?>><?= h(T('nav_home')) ?></a>
                <div class="dd"><button type="button" <?= ed('nav_learn') ?>><?= h(T('nav_learn')) ?></button>
                    <div class="dd-menu"><?php foreach ($CATS as $i => $c): ?><a href="index.php#c<?= $i ?>"><?= $c['icon'] ?> <?= h($c['title']) ?></a><?php endforeach; ?></div>
                </div>
                <a href="fish-species.php" <?= on('fish-species.php') ?><?= ed('nav_species') ?>><?= h(T('nav_species')) ?></a><a href="fish-gallery.php" <?= on('fish-gallery.php') ?><?= ed('nav_gallery') ?>><?= h(T('nav_gallery')) ?></a><a href="about.php" <?= on('about.php') ?><?= ed('nav_about') ?>><?= h(T('nav_about')) ?></a><a class="btn" href="contact.php" <?= ed('nav_contact') ?>><?= h(T('nav_contact')) ?></a>
            </nav>
        </div>
    </header>
    <main id="main">
        <?php if (!$raw): ?>
            <div class="ph-hero">
                <div class="wrap">
                    <nav class="crumb" aria-label="breadcrumb"><a href="index.php" <?= ed('crumb_home') ?>><?= h(T('crumb_home')) ?></a><?php if ($cur): ?> / <a href="index.php#c<?= $cur['ci'] ?>"><?= h($CATS[$cur['ci']]['title']) ?></a><?php endif; ?></nav>
                    <h1 id="ph1"><?= $page['h1'] ?? h($ttl) ?></h1>
                    <div class="meta"><span id="rt"></span><button type="button" data-fs="-1" aria-label="စာလုံးသေးရန်">A−</button><button type="button" data-fs="1" aria-label="စာလုံးကြီးရန်">A+</button><button type="button" onclick="print()">🖨 Print</button></div>
                    <?php if ($adm && !empty($page['pb'])): $pg = $page['pg']; ?><div id="a-panel"><label>မီနူးအမည်<input id="ap-label" value="<?= h($pg['label'] ?? '') ?>"></label><label>အမျိုးအစား<select id="ap-cat">
                                    <option value="">— မီနူးထဲ မထည့်ပါ —</option><?php foreach (cats_all() as $c): ?><option value="<?= h($c['id']) ?>" <?= ($pg['cat'] ?? '') === $c['id'] ? ' selected' : '' ?>><?= h($c['icon'] . ' ' . $c['title']) ?></option><?php endforeach; ?>
                                </select></label><label>အကျဉ်းချုပ် (Google ရှာဖွေရာတွင် ပေါ်မည်)<input id="ap-desc" value="<?= h($pg['desc'] ?? '') ?>"></label><?php if (empty($pg['url'])): ?><button type="button" id="ap-del" class="danger">🗑 ဤစာမျက်နှာကို ဖျက်မည်</button><?php endif; ?></div><?php endif; ?>
                </div>
            </div>
            <div class="wrap layout">
                <article class="prose" <?= !empty($page['pb']) ? ' id="pb" data-slug="' . h($page['slug']) . '"' : '' ?>>
                <?php endif; ?>