<?php $page = ['t' => 'ဆက်သွယ်ရန်', 'd' => 'မေးမြန်းလိုသည်များ၊ အကြံပြုချက်များကို ပေးပို့နိုင်ပါသည်။', 'raw' => true];
require_once __DIR__ . '/includes/lib.php';
$msg = '';
$ok = false;
$tok = csrf();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $v = fn($k) => trim((string)($_POST[$k] ?? ''));
    if (!csrf_ok() || !empty($_POST['website'])) {
        $msg = 'ပေးပို့၍မရပါ။ စာမျက်နှာကို refresh လုပ်ပြီး ထပ်ကြိုးစားပါ။';
    } elseif ($v('name') === '' || $v('message') === '' || ($v('email') === '' && $v('phone') === '')) {
        $msg = 'အမည်၊ ဖုန်း သို့မဟုတ် အီးမေးလ်၊ စာသား တို့ကို ဖြည့်ပေးပါ။';
    } elseif ($v('email') !== '' && !filter_var($v('email'), FILTER_VALIDATE_EMAIL)) {
        $msg = 'အီးမေးလ်ပုံစံ မမှန်ပါ။';
    } else {
        $ok = save_submission('messages', ['name' => $v('name'), 'phone' => $v('phone'), 'email' => $v('email'), 'message' => $v('message')]);
        if (!$ok) $msg = 'သိမ်းဆည်း၍မရပါ။ data ဖိုလ်ဒါကို write ခွင့်ပြုထားပါ။';
    }
}
require __DIR__ . '/includes/header.php'; ?>
<div class="wrap pg">
    <h1<?= ed('contact_h1') ?>><?= h(T('contact_h1')) ?></h1>
        <p class="sub" <?= ed('contact_sub') ?>><?= h(T('contact_sub')) ?></p>
        <?php if ($ok): ?><div class="note ok" <?= ed('contact_ok') ?>><?= h(T('contact_ok')) ?></div><?php else: ?><?php if ($msg): ?><div class="note err"><?= h($msg) ?></div><?php endif; ?>
        <form class="form" method="post"><input type="hidden" name="t" value="<?= h($tok) ?>"><input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"><label for="n" <?= ed('contact_l_name') ?>><?= h(T('contact_l_name')) ?></label><input id="n" name="name" required maxlength="100" value="<?= h($_POST['name'] ?? '') ?>">
            <div class="row">
                <div><label for="p" <?= ed('contact_l_phone') ?>><?= h(T('contact_l_phone')) ?></label><input id="p" name="phone" type="tel" maxlength="30" value="<?= h($_POST['phone'] ?? '') ?>"></div>
                <div><label for="e" <?= ed('contact_l_email') ?>><?= h(T('contact_l_email')) ?></label><input id="e" name="email" type="email" maxlength="120" value="<?= h($_POST['email'] ?? '') ?>"></div>
            </div><label for="m" <?= ed('contact_l_msg') ?>><?= h(T('contact_l_msg')) ?></label><textarea id="m" name="message" rows="5" required maxlength="3000"><?= h($_POST['message'] ?? '') ?></textarea><button class="btn" type="submit" <?= ed('contact_btn') ?>><?= h(T('contact_btn')) ?></button>
        </form><?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>