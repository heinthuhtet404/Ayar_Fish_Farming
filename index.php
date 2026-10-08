<?php $page = ['t' => 'Ayar Fish Farming | ငါးမွေးမြူရေးဗဟုသုတ', 'd' => 'Ayar Fish Farming — ငါးမွေးမြူရေးဆိုင်ရာ လက်တွေ့အသုံးချဗဟုသုတ၊ ငါးမျိုးစိတ်၊ အစာ၊ အာဟာရ၊ ရောဂါ၊ ကန်စီမံခန့်ခွဲမှုနှင့် ဈေးကွက်လမ်းညွှန်များ။', 'raw' => true];
require __DIR__ . '/includes/header.php';
$species = species_all();
$steps_href = ['pond-site-selection.php', 'pond-construction.php', 'fertilizer.php', 'fish-species.php', 'feeding.php', 'fish-health-breeding.php', 'market.php']; ?>
<section class="hero">
    <div class="wrap">
        <h1<?= ed('hero_title') ?>><?= h(T('hero_title')) ?></h1>
        <p<?= ed('hero_text') ?>><?= nl2br(h(T('hero_text'))) ?></p>
        <div class="acts"><a class="btn" href="#path" <?= ed('hero_btn1') ?>><?= h(T('hero_btn1')) ?></a><a class="btn alt" href="fish-species.php" <?= ed('hero_btn2') ?>><?= h(T('hero_btn2')) ?></a></div>
        <form class="hsearch" role="search" id="pageSearchForm">
            <input id="q" type="search" placeholder="<?= h(T('hero_search_ph')) ?>" aria-label="<?= h(T('hero_search_ph')) ?>">
            <button class="btn" type="submit" <?= ed('hero_search_btn') ?>><?= h(T('hero_search_btn')) ?></button>
        </form>
    </div>
</section>
<section class="sec" id="path">
    <div class="wrap">
        <div class="sec-h">
            <div>
                <h2<?= ed('path_title') ?>><?= h(T('path_title')) ?></h2>
                <p<?= ed('path_sub') ?>><?= h(T('path_sub')) ?></p>
            </div>
        </div>
        <ol class="path"><?php foreach ($steps_href as $i => $href): ?><li><a href="<?= h($href) ?>">
                    <b<?= ed("st{$i}_t") ?>><?= h(T("st{$i}_t")) ?></b>
                    <span<?= ed("st{$i}_d") ?>><?= h(T("st{$i}_d")) ?></span>
                </a></li><?php endforeach; ?></ol>
    </div>
</section>
<section class="sec tint" id="library">
    <div class="wrap">
        <div class="sec-h">
            <div>
                <h2<?= ed('lib_title') ?>><?= h(T('lib_title')) ?></h2>
                <p<?= ed('lib_sub') ?>><?= h(T('lib_sub')) ?></p>
            </div><?php if ($adm): ?><a class="btn line" href="admin/index.php?s=cats">အမျိုးအစားများ စီမံရန်</a><?php endif; ?>
        </div>
        <div class="cats"><?php foreach ($CATS as $i => $c): ?><div class="cat" id="c<?= $i ?>">
                    <div class="ic"><?= h($c['icon']) ?></div>
                    <h3><?= h($c['title']) ?></h3>
                    <p><?= h($c['desc']) ?></p>
                    <ul><?php foreach ($c['items'] as $it): ?><li><a href="<?= h($it[1]) ?>"><?= h($it[0]) ?></a></li><?php endforeach; ?></ul>
                </div><?php endforeach; ?></div>
    </div>
</section>
<section class="sec">
    <div class="wrap">
        <div class="sec-h">
            <div>
                <h2<?= ed('species_title') ?>><?= h(T('species_title')) ?></h2>
            </div><a class="btn line" href="fish-species.php" <?= ed('species_more') ?>><?= h(T('species_more')) ?></a>
        </div>
        <div class="sp"><?php foreach (array_slice($species, 0, 6) as $s): ?><a href="<?= h($s['page'] ?: 'fish-species.php') ?>">
                    <div class="ph"><?php if (!empty($s['img'])): ?><img src="<?= h($s['img']) ?>" alt="<?= h($s['name']) ?>" loading="lazy"><?php else: ?><span style="font-size:48px">🐟</span><?php endif; ?></div>
                    <div class="tx"><b><?= h($s['name']) ?></b><small><?= h($s['en']) ?></small></div>
                </a><?php endforeach; ?></div>
    </div>
</section>
<section class="sec tint">
    <div class="wrap two">
        <div>
            <h2<?= ed('intro_title') ?>><?= h(T('intro_title')) ?></h2>
            <p<?= ed('intro_text') ?>><?= nl2br(h(T('intro_text'))) ?></p><a class="btn" href="about.php" <?= ed('intro_btn') ?>><?= h(T('intro_btn')) ?></a>
        </div><img src="<?= h(IMG('intro_img')) ?>" <?= edimg('intro_img') ?> alt="ငါးမွေးကန်များ၏ ကောင်းကင်ပေါ်မှ မြင်ကွင်း" loading="lazy">
    </div>
</section>

<script>
document.getElementById('pageSearchForm').addEventListener('submit', function (e) {
    e.preventDefault();
    var query = document.getElementById('q').value.trim().toLowerCase();
    if (!query) return;

    // ယခင် highlight လုပ်ထားသည်များကို ဖြုတ်ရန်
    document.querySelectorAll('.search-highlight').forEach(function (el) {
        el.style.outline = '';
        el.style.transition = '';
    });

    // ရှာဖွေရမည့် Element များ (လင့်ခ်များ၊ အမျိုးအစားများ၊ ငါးမျိုးစိတ်များနှင့် အဓိကစာသားများ)
    var targets = document.querySelectorAll('.path li, .cats .cat, .sp a, section h2, section p');
    var matchedElement = null;

    for (var i = 0; i < targets.length; i++) {
        var el = targets[i];
        if (el.textContent.toLowerCase().includes(query)) {
            matchedElement = el;
            break;
        }
    }

    if (matchedElement) {
        // ကိုက်ညီသည့်နေရာသို့ ချောမွေ့စွာ Scroll သွားမည်
        matchedElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // ကိုက်ညီသည့် Element ကို ခဏတာ အဝါရောင် Highlight ပြပေးမည်
        matchedElement.classList.add('search-highlight');
        matchedElement.style.transition = 'outline 0.3s ease';
        matchedElement.style.outline = '3px solid #f39c12';

        setTimeout(function () {
            matchedElement.style.outline = '';
        }, 3000);
    } else {
        alert('ရှာဖွေသော စာသားနှင့် ကိုက်ညီသည့် အကြောင်းအရာ လက်ရှိ စာမျက်နှာတွင် မရှိပါ။');
    }
});
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>