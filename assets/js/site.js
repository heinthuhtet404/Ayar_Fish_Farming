document.addEventListener('DOMContentLoaded', () => {
    const $ = (s, r = document) => r.querySelector(s), $$ = (s, r = document) => [...r.querySelectorAll(s)];
    const mb = $('#mb'), nav = $('#nav');
    if (mb) mb.onclick = () => { const o = nav.classList.toggle('open'); mb.setAttribute('aria-expanded', o) };
    $$('.dd>button').forEach(b => b.onclick = e => { e.stopPropagation(); b.parentElement.classList.toggle('open') });
    document.onclick = e => { $$('.dd.open').forEach(d => { if (!d.contains(e.target)) d.classList.remove('open') }) };
    const prose = $('.prose'), toc = $('#toc');
    if (prose && toc) {
        const hs = $$('h2,h3', prose);
        if (hs.length > 2) {
            toc.innerHTML = '<b>ဤစာမျက်နှာတွင်</b>'; hs.forEach((h, i) => { h.id = h.id || 's' + i; const a = document.createElement('a'); a.href = '#' + h.id; a.textContent = h.textContent; if (h.tagName == 'H3') a.className = 'l3'; toc.appendChild(a) });
            const b = $('b', toc); if (b) b.onclick = () => toc.classList.toggle('open');
            const io = new IntersectionObserver(es => es.forEach(en => { if (en.isIntersecting) { $$('a', toc).forEach(a => a.classList.toggle('cur', a.hash == '#' + en.target.id)) } }), { rootMargin: '-80px 0px -70% 0px' }); hs.forEach(h => io.observe(h));
        }
        else { toc.remove(); $('.layout')?.classList.add('solo') }
        const m = $('#rt'); if (m) { const n = prose.textContent.length; m.textContent = 'ဖတ်ချိန် ခန့်မှန်း ' + Math.max(1, Math.round(n / 900)) + ' မိနစ်' }
    }
    const pg = $('#prog'), tp = $('#top');
    addEventListener('scroll', () => { const h = document.documentElement, p = h.scrollTop / (h.scrollHeight - h.clientHeight || 1); if (pg) pg.style.width = (p * 100) + '%'; if (tp) tp.style.display = h.scrollTop > 700 ? 'block' : 'none' }, { passive: true });
    if (tp) tp.onclick = () => scrollTo({ top: 0 });
    let fs = +localStorage.getItem('fs') || 18; const set = v => { fs = Math.min(24, Math.max(16, v)); document.documentElement.style.setProperty('--fs', fs + 'px'); try { localStorage.setItem('fs', fs) } catch (e) { } }; set(fs);
    $$('[data-fs]').forEach(b => b.onclick = () => set(fs + (+b.dataset.fs)));
});
document.addEventListener('DOMContentLoaded', () => {
    const q = document.getElementById('q'); if (!q) return; const f = q.closest('form'); if (f) f.onsubmit = e => { e.preventDefault(); document.getElementById('library')?.scrollIntoView() };
    q.oninput = () => { const v = q.value.trim().toLowerCase(); document.querySelectorAll('.cat').forEach(c => { let n = 0; c.querySelectorAll('li').forEach(li => { const ok = !v || li.textContent.toLowerCase().includes(v); li.style.display = ok ? '' : 'none'; if (ok) n++ }); c.style.display = n || !v ? '' : 'none' }) }
});
document.addEventListener('DOMContentLoaded', () => {
    const nav3 = document.getElementById('nav'); if (nav3) nav3.addEventListener('click', e => { if (e.target.closest('a')) nav3.classList.remove('open') });
    if ('IntersectionObserver' in window) {
        const io2 = new IntersectionObserver(es => es.forEach(en => { if (en.isIntersecting) { en.target.classList.add('in'); io2.unobserve(en.target) } }), { threshold: .06, rootMargin: '0px 0px -6% 0px' });
        document.querySelectorAll('.cat,.path a,.sp a,.card,.gal figure,.rel a,.person,.stats div,.facts div').forEach(el => { el.classList.add('rv'); io2.observe(el) });
    }
});
