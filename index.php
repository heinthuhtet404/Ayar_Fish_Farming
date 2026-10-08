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
(function() {
    const form = document.getElementById('pageSearchForm');
    if (!form) return;
    
    const input = document.getElementById('q');
    if (!input) return;
    
    // Search result counter
    let currentMatch = 0;
    let matchedElements = [];
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const query = input.value.trim().toLowerCase();
        
        if (!query) {
            showMessage('ရှာဖွေလိုသော စာသားကို ရိုက်ထည့်ပါ။', 'info');
            return;
        }
        
        // Clear previous highlights
        clearHighlights();
        matchedElements = [];
        currentMatch = 0;
        
        // Search targets
        const targets = document.querySelectorAll(
            '.path li, .cats .cat, .sp a, section h2, section p, section h3'
        );
        
        // Find all matches
        targets.forEach(function(el) {
            if (el.textContent.toLowerCase().includes(query)) {
                matchedElements.push(el);
            }
        });
        
        // No results
        if (matchedElements.length === 0) {
            showMessage('"' + input.value.trim() + '" နှင့် ကိုက်ညီသည့် အကြောင်းအရာ မတွေ့ပါ။', 'error');
            return;
        }
        
        // Show count
        showMessage('ရလဒ် ' + matchedElements.length + ' ခု တွေ့ပါသည်။', 'success');
        
        // Highlight all matches
        matchedElements.forEach(function(el) {
            el.style.transition = 'outline 0.3s ease, background-color 0.3s ease';
            el.style.outline = '3px solid #f39c12';
            el.style.outlineOffset = '4px';
            el.style.backgroundColor = 'rgba(243, 156, 18, .08)';
            el.style.borderRadius = '8px';
            el.classList.add('search-highlight');
        });
        
        // Scroll to first match
        matchedElements[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Auto-clear highlight after 5s
        setTimeout(function() {
            clearHighlights();
        }, 5000);
    });
    
    function clearHighlights() {
        document.querySelectorAll('.search-highlight').forEach(function(el) {
            el.style.outline = '';
            el.style.outlineOffset = '';
            el.style.backgroundColor = '';
            el.style.borderRadius = '';
            el.classList.remove('search-highlight');
        });
    }
    
    function showMessage(text, type) {
        let msg = document.getElementById('search-message');
        if (!msg) {
            msg = document.createElement('div');
            msg.id = 'search-message';
            msg.style.cssText = 
                'position:fixed;top:90px;left:50%;transform:translateX(-50%);' +
                'padding:14px 24px;border-radius:12px;font-size:15px;font-weight:600;' +
                'z-index:9999;box-shadow:0 20px 40px rgba(10,31,46,.18);' +
                'transition:opacity .3s ease, transform .3s ease;' +
                'max-width:90vw;text-align:center;font-family:inherit;';
            document.body.appendChild(msg);
        }
        
        // Colors by type
        const styles = {
            success: 'background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;',
            error: 'background:#fef2f2;color:#991b1b;border:1px solid #fecaca;',
            info: 'background:#f0f9ff;color:#075985;border:1px solid #bae6fd;'
        };
        
        msg.style.cssText += styles[type] || styles.info;
        msg.textContent = text;
        msg.style.opacity = '1';
        msg.style.transform = 'translateX(-50%) translateY(0)';
        
        // Auto hide
        clearTimeout(window._searchMsgTimer);
        window._searchMsgTimer = setTimeout(function() {
            msg.style.opacity = '0';
            msg.style.transform = 'translateX(-50%) translateY(-10px)';
            setTimeout(function() {
                if (msg.parentNode) msg.parentNode.removeChild(msg);
            }, 300);
        }, 3000);
    }
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>