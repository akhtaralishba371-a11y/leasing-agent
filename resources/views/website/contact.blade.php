@extends('layouts.website')
@section('title', 'Contact — Tower Realty Austin')
@push('head')

<!-- ============================================================
     FONTS — identical to the homepage / about page
============================================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Lustria&display=swap" rel="stylesheet">

<!-- ============================================================
     ===================  ALL CSS — ONE BLOCK  ==================
     HEADER (.twr-wrap) -> CONTACT PAGE (.twr-co) -> FOOTER
============================================================ -->
<style>
/* ===========================================================
   HEADER SCOPE (.twr-wrap) — identical to the homepage header
=========================================================== */
.twr-wrap,
.twr-wrap *,
.twr-wrap *::before,
.twr-wrap *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-wrap {
  --twr-ink: #121212; --twr-body: #333333; --twr-muted: #5b5b5b;
  --twr-accent: #D05F28; --twr-pill: #101010; --twr-dot: #34c759; --twr-max: 1480px;
  font-family: 'Inter Tight', system-ui, -apple-system, Roboto, sans-serif;
  color: var(--twr-ink); -webkit-font-smoothing: antialiased;
}
.twr-header { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 20px clamp(14px, 2.2vw, 30px); }
.twr-header__bar { position: relative; display: flex; align-items: center; gap: 24px; max-width: var(--twr-max); margin: 0 auto; padding: 9px 12px 9px 28px; border-radius: 999px; background: #fff; box-shadow: 0 0 0 rgba(0,0,0,0); transition: box-shadow .35s ease; }
.twr-header.is-scrolled .twr-header__bar { box-shadow: 0 18px 50px -20px rgba(20,20,20,.28); }
.twr-header__logo { display: inline-flex; align-items: center; flex: none; }
.twr-header__logo img { height: 48px; width: auto; display: block; }
.twr-nav { flex: 1; display: flex; justify-content: center; align-items: center; gap: clamp(12px, 1.7vw, 28px); }
.twr-nav__link { font-family: 'Inter Tight', sans-serif; font-size: 15px; font-weight: 500; color: var(--twr-ink); text-decoration: none; white-space: nowrap; background: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: color .2s ease; }
.twr-nav__link:hover { color: var(--twr-muted); }
.twr-nav__link.is-current { color: var(--twr-accent); }
.twr-nav__chev { width: 10px; height: 10px; transition: transform .25s ease; }
.twr-nav__item:hover .twr-nav__chev, .twr-nav__item:focus-within .twr-nav__chev { transform: rotate(180deg); }
.twr-nav__sub { position: absolute; top: calc(100% + 14px); left: 50%; transform: translateX(-50%) translateY(6px); background: #fff; border-radius: 14px; box-shadow: 0 20px 50px -20px rgba(0,0,0,.3); padding: 8px; min-width: 214px; display: flex; flex-direction: column; gap: 2px; opacity: 0; pointer-events: none; transition: opacity .2s ease, transform .2s ease; }
.twr-nav__sub::before { content: ''; position: absolute; top: -14px; left: 0; right: 0; height: 14px; }
.twr-nav__item:hover .twr-nav__sub, .twr-nav__item:focus-within .twr-nav__sub { opacity: 1; pointer-events: auto; transform: translateX(-50%) translateY(0); }
.twr-nav__sub a { font-family: 'Inter Tight', sans-serif; font-size: 14px; font-weight: 500; color: var(--twr-ink); text-decoration: none; padding: 9px 12px; border-radius: 9px; white-space: nowrap; transition: background .15s ease; }
.twr-nav__sub a:hover { background: #f4f4f4; }
.twr-agent { display: flex; align-items: center; gap: 12px; background: var(--twr-pill); color: #fff; border-radius: 999px; padding: 6px 6px 6px 10px; flex: none; }
.twr-agent__avatar { position: relative; width: 38px; height: 38px; border-radius: 50%; overflow: hidden; flex: none; background: #d9dde1; }
.twr-agent__avatar img { width: 100%; height: 100%; object-fit: cover; object-position: center 28%; display: block; }
.twr-agent__dot { position: absolute; top: 1px; left: 1px; width: 9px; height: 9px; border-radius: 50%; background: var(--twr-dot); box-shadow: 0 0 0 2px var(--twr-pill); }
.twr-agent__meta { display: flex; flex-direction: column; line-height: 1.15; padding-right: 4px; }
.twr-agent__name { font-size: 13.5px; font-weight: 600; }
.twr-agent__role { font-size: 11.5px; color: #b9b9b9; }
.twr-agent__btn { background: #fff; color: #111; text-decoration: none; font-size: 13.5px; font-weight: 600; padding: 9px 16px; border-radius: 999px; white-space: nowrap; transition: background .2s ease, transform .2s ease; }
.twr-agent__btn:hover { background: #efefef; transform: translateY(-1px); }
.twr-header__toggle { display: none; width: 44px; height: 44px; border: none; background: transparent; flex-direction: column; justify-content: center; align-items: center; gap: 5px; cursor: pointer; border-radius: 12px; flex: none; }
.twr-header__toggle span { width: 22px; height: 2px; background: var(--twr-ink); border-radius: 2px; transition: transform .3s ease, opacity .25s ease; }
.twr-header.is-menu-open .twr-header__toggle span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.twr-header.is-menu-open .twr-header__toggle span:nth-child(2) { opacity: 0; }
.twr-header.is-menu-open .twr-header__toggle span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.twr-header__mobile { display: none; position: absolute; top: 100%; left: clamp(14px,2.2vw,30px); right: clamp(14px,2.2vw,30px); margin-top: 10px; background: #fff; border-radius: 20px; box-shadow: 0 24px 60px -24px rgba(0,0,0,.3); padding: 14px; flex-direction: column; gap: 4px; opacity: 0; transform: translateY(-8px); pointer-events: none; transition: opacity .25s ease, transform .25s ease; }
.twr-header.is-menu-open .twr-header__mobile { opacity: 1; transform: none; pointer-events: auto; }
.twr-header__mobile a { font-size: 16px; font-weight: 500; color: var(--twr-ink); text-decoration: none; padding: 11px 12px; border-radius: 12px; transition: background .15s ease; }
.twr-header__mobile a:hover { background: #f4f4f4; }
.twr-mobile-dropdown{display:flex;flex-direction:column}.twr-mobile-dropdown__toggle{width:100%;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:11px 12px;border:0;border-radius:12px;background:transparent;color:var(--twr-ink);font:inherit;font-size:16px;font-weight:500;text-align:left;cursor:pointer}.twr-mobile-dropdown__toggle:hover{background:#f4f4f4}.twr-mobile-dropdown__toggle svg{width:12px;height:12px;transition:transform .25s ease}.twr-mobile-dropdown.is-open .twr-mobile-dropdown__toggle svg{transform:rotate(180deg)}.twr-mobile-dropdown__panel{display:grid;grid-template-rows:0fr;transition:grid-template-rows .3s ease}.twr-mobile-dropdown.is-open .twr-mobile-dropdown__panel{grid-template-rows:1fr}.twr-mobile-dropdown__inner{min-height:0;overflow:hidden;display:flex;flex-direction:column}.twr-header__mobile .twr-mobile-dropdown__inner a{margin-left:12px;padding-left:18px;font-size:14px;color:var(--twr-muted);border-left:2px solid #ececec;border-radius:0 10px 10px 0}
.twr-header__mobile .twr-mobile-btn { margin-top: 8px; text-align: center; background: var(--twr-pill); color: #fff; font-weight: 600; }
.twr-header__mobile .twr-mobile-btn:hover { background: #000; }
@media (max-width: 1024px) {
  .twr-nav, .twr-agent { display: none; }
  .twr-header__toggle { display: inline-flex; margin-left: auto; }
  .twr-header__mobile { display: flex; }
}

/* ===========================================================
   CONTACT PAGE SCOPE (.twr-co)
=========================================================== */
.twr-co, .twr-co *, .twr-co *::before, .twr-co *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-co {
  --twr-ink: #121212; --twr-body: #333333; --twr-muted: #5b5b5b; --twr-accent: #D05F28; --twr-max: 1480px;
  font-family: 'Inter Tight', system-ui, -apple-system, Roboto, sans-serif;
  color: var(--twr-ink); -webkit-font-smoothing: antialiased; display: block;
}
.twr-co-btn { display: inline-flex; align-items: center; gap: 10px; background: #121212; color: #fff; text-decoration: none; font-weight: 600; font-size: 15px; padding: 14px 26px; border-radius: 999px; transition: transform .25s ease, background .25s ease; }
.twr-co-btn:hover { transform: translateY(-2px); background: #000; }
.twr-co-btn svg { width: 18px; height: 18px; }
.twr-co-btn--ghost { background: transparent; color: #121212; border: 1px solid #d8d8d8; }
.twr-co-btn--ghost:hover { background: #f4f4f4; border-color: #c8c8c8; }

/* ---- Hero (same background video as the About page) ---- */
.twr-co-hero { position: relative; margin: 0 clamp(10px, 1.4vw, 18px); min-height: clamp(600px, 90vh, 840px); border-radius: 0 0 32px 32px; overflow: hidden; background: #0a0a0a; display: flex; align-items: center; justify-content: center; text-align: center; }
.twr-co-hero__video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; z-index: 0; }
.twr-co-hero::after { content: ''; position: absolute; inset: 0; z-index: 1; background: linear-gradient(180deg, rgba(0,0,0,.58) 0%, rgba(0,0,0,.48) 45%, rgba(0,0,0,.58) 100%); pointer-events: none; }
.twr-co-hero__inner { position: relative; z-index: 2; max-width: 980px; padding: clamp(150px, 20vh, 220px) clamp(24px, 4vw, 56px) clamp(64px, 9vh, 110px); }
.twr-co-hero__eyebrow { font-family: 'Lustria', Georgia, serif; text-transform: uppercase; letter-spacing: .08em; font-size: clamp(14px, 1.2vw, 17px); color: #fff; margin-bottom: 18px; }
.twr-co-hero__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(40px, 5.4vw, 70px); line-height: 1.1; color: #fff; margin-bottom: 26px; }
.twr-co-hero__lead { font-family: 'Inter Tight', sans-serif; font-size: clamp(16px, 1.4vw, 20px); line-height: 1.7; color: #fff; max-width: 680px; margin: 0 auto 34px; }
.twr-co-hero__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.twr-co-hero .twr-co-btn { background: #fff; color: #121212; }
.twr-co-hero .twr-co-btn:hover { background: #f0f0f0; }
.twr-co-hero .twr-co-btn--ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.5); }
.twr-co-hero .twr-co-btn--ghost:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.7); }

/* ---- Contact main: info + form ---- */
.twr-co-main { max-width: var(--twr-max); margin: 0 auto; padding: clamp(56px, 7vw, 100px) clamp(24px, 4vw, 56px); display: grid; grid-template-columns: 0.85fr 1.15fr; gap: clamp(36px, 5vw, 80px); align-items: start; }

/* info column */
.twr-co-info__eyebrow { font-size: 12px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: #9a9a9a; margin-bottom: 14px; }
.twr-co-info__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(28px, 3.2vw, 46px); line-height: 1.15; color: var(--twr-ink); margin-bottom: 18px; }
.twr-co-info__lead { font-family: 'Inter Tight', sans-serif; font-size: clamp(15px, 1.2vw, 17px); line-height: 1.7; color: var(--twr-muted); max-width: 440px; }
.twr-co-rows { display: flex; flex-direction: column; gap: 22px; margin-top: clamp(28px, 3.5vw, 40px); }
.twr-co-row { display: flex; gap: 16px; align-items: flex-start; }
.twr-co-row__icon { width: 46px; height: 46px; border-radius: 50%; background: #f4f4f4; display: grid; place-items: center; color: var(--twr-accent); flex: none; }
.twr-co-row__icon svg { width: 20px; height: 20px; }
.twr-co-row__label { font-size: 12px; text-transform: uppercase; letter-spacing: .08em; color: #9a9a9a; margin-bottom: 5px; }
.twr-co-row__value { font-family: 'Inter Tight', sans-serif; font-size: 16px; color: var(--twr-ink); line-height: 1.55; }
.twr-co-row__value a { color: inherit; text-decoration: none; transition: color .2s ease; }
.twr-co-row__value a:hover { color: var(--twr-accent); }
.twr-co-call { margin-top: clamp(28px, 3.5vw, 36px); display: inline-flex; align-items: center; gap: 12px; background: var(--twr-accent); color: #fff; text-decoration: none; font-weight: 600; font-size: 16px; padding: 16px 28px; border-radius: 999px; transition: transform .25s ease, background .25s ease, box-shadow .25s ease; box-shadow: 0 16px 40px -18px rgba(208,95,40,.6); }
.twr-co-call:hover { transform: translateY(-2px); background: #e06c34; }
.twr-co-call svg { width: 20px; height: 20px; }

/* form column */
.twr-co-form { background: #f7f7f7; border-radius: 24px; padding: clamp(28px, 3.5vw, 48px); }
.twr-co-form__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(22px, 2.4vw, 30px); color: var(--twr-ink); margin-bottom: 8px; }
.twr-co-form__sub { font-family: 'Inter Tight', sans-serif; font-size: 15px; color: var(--twr-muted); margin-bottom: 26px; }
.twr-co-field { margin-bottom: 18px; }
.twr-co-field label { display: block; font-size: 13px; font-weight: 500; color: #444; margin-bottom: 8px; }
.twr-co-field input, .twr-co-field textarea { width: 100%; font-family: 'Inter Tight', sans-serif; font-size: 15px; color: var(--twr-ink); background: #fff; border: 1px solid #e2e2e2; border-radius: 12px; padding: 13px 16px; transition: border-color .2s ease, box-shadow .2s ease; }
.twr-co-field input::placeholder, .twr-co-field textarea::placeholder { color: #b0b0b0; }
.twr-co-field input:focus, .twr-co-field textarea:focus { outline: none; border-color: var(--twr-accent); box-shadow: 0 0 0 3px rgba(208,95,40,.12); }
.twr-co-field textarea { resize: vertical; min-height: 130px; }
.twr-co-form__row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.twr-co-submit { width: 100%; margin-top: 6px; background: #121212; color: #fff; border: none; cursor: pointer; font-family: 'Inter Tight', sans-serif; font-weight: 600; font-size: 15px; padding: 15px; border-radius: 12px; transition: background .25s ease, transform .25s ease; display: inline-flex; align-items: center; justify-content: center; gap: 10px; }
.twr-co-submit:hover { background: #000; transform: translateY(-1px); }
.twr-co-submit svg { width: 17px; height: 17px; }
.twr-co-note { font-size: 13px; color: #9a9a9a; margin-top: 14px; text-align: center; }

/* ---- Map band ---- */
.twr-co-map { margin: 0 clamp(10px, 1.4vw, 18px); padding-bottom: clamp(32px, 4vw, 56px); }
.twr-co-map__card { position: relative; border-radius: 28px; overflow: hidden; }
.twr-co-map__frame { width: 100%; height: clamp(360px, 50vh, 520px); border: 0; display: block; }
.twr-co-map__badge { position: absolute; top: 22px; left: 22px; background: #fff; border-radius: 18px; padding: 20px 22px; max-width: 300px; box-shadow: 0 24px 60px -24px rgba(0,0,0,.35); }
.twr-co-map__badge h3 { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: 19px; color: var(--twr-ink); margin-bottom: 6px; }
.twr-co-map__badge p { font-family: 'Inter Tight', sans-serif; font-size: 14px; color: var(--twr-muted); line-height: 1.55; margin-bottom: 12px; }
.twr-co-map__dir { display: inline-flex; align-items: center; gap: 8px; color: var(--twr-accent); text-decoration: none; font-weight: 600; font-size: 14px; }
.twr-co-map__dir svg { width: 16px; height: 16px; transition: transform .25s ease; }
.twr-co-map__dir:hover svg { transform: translateX(4px); }

/* ---- Entrance animation (opt-in, fails safe) ---- */
.twr-co--anim .twr-co-anim { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; transition-delay: var(--d, 0s); }
.twr-co--anim .twr-co-anim.is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .twr-co--anim .twr-co-anim { opacity: 1 !important; transform: none !important; transition: none !important; }
}

/* ---- Contact responsive ---- */
@media (max-width: 900px) {
  .twr-co-main { grid-template-columns: 1fr; gap: 40px; }
}
@media (max-width: 600px) {
  .twr-co-hero { min-height: clamp(480px, 80vh, 640px); border-radius: 0 0 24px 24px; }
  .twr-co-form__row { grid-template-columns: 1fr; }
  .twr-co-map__badge { position: static; max-width: none; margin: 14px; box-shadow: none; border: 1px solid #eee; }
}

/* ===========================================================
   FOOTER — identical to the homepage footer
=========================================================== */
.twr-footer, .twr-footer *, .twr-footer *::before, .twr-footer *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-footer { --twr-orange: #D05F28; font-family: 'Inter Tight', system-ui, -apple-system, Segoe UI, Roboto, sans-serif; -webkit-font-smoothing: antialiased; margin: 0 clamp(10px, 1.4vw, 18px); padding: clamp(24px, 3vw, 44px) 0 clamp(14px, 2vw, 22px); }
.twr-footer__card { position: relative; overflow: hidden; background: #0a0a0a; color: #fff; border-radius: 28px; isolation: isolate; }
.twr-footer__card::before { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 88% 8%, rgba(208,95,40,.16), transparent 48%); z-index: 0; pointer-events: none; }
.twr-footer__ghost { position: absolute; left: clamp(16px, 3vw, 48px); bottom: -0.16em; font-family: 'Lustria', Georgia, serif; font-size: clamp(64px, 15vw, 280px); line-height: .8; letter-spacing: -0.02em; color: rgba(255,255,255,.035); white-space: nowrap; pointer-events: none; z-index: 0; }
.twr-footer__cta { position: relative; z-index: 1; display: grid; grid-template-columns: 1.45fr 1fr; gap: 32px; align-items: center; padding: clamp(44px, 5.5vw, 82px) clamp(28px, 3.6vw, 60px) clamp(36px, 4vw, 52px); border-bottom: 1px solid rgba(255,255,255,.1); }
.twr-footer__cta-title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(28px, 3.4vw, 50px); line-height: 1.15; color: #fff; max-width: 15ch; }
.twr-footer__cta-actions { display: flex; align-items: center; justify-content: flex-end; gap: 22px; flex-wrap: wrap; }
.twr-footer__btn { display: inline-flex; align-items: center; gap: 10px; background: var(--twr-orange); color: #fff; text-decoration: none; font-weight: 600; font-size: 15px; padding: 14px 26px; border-radius: 999px; transition: transform .25s ease, background .25s ease; }
.twr-footer__btn:hover { transform: translateY(-2px); background: #e06c34; }
.twr-footer__btn svg { width: 18px; height: 18px; }
.twr-footer__calllink { display: inline-flex; align-items: center; gap: 8px; color: #fff; text-decoration: none; font-weight: 500; font-size: 15px; opacity: .85; transition: opacity .2s ease; }
.twr-footer__calllink:hover { opacity: 1; }
.twr-footer__main { position: relative; z-index: 1; display: grid; grid-template-columns: 1.6fr 1fr 1.1fr 1.2fr; gap: clamp(28px, 3vw, 52px); padding: clamp(40px, 4.5vw, 64px) clamp(28px, 3.6vw, 60px); }
.twr-footer__brand { max-width: 320px; }
.twr-footer__logo { display: inline-block; will-change: transform; animation: twr-foot-float 4.5s ease-in-out infinite; }
.twr-footer__logo img { width: clamp(150px, 15vw, 196px); height: auto; display: block; }
@keyframes twr-foot-float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
.twr-footer__blurb { margin-top: 22px; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.58); max-width: 300px; }
.twr-footer__social { display: flex; gap: 10px; margin-top: 26px; }
.twr-footer__social a { width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255,255,255,.18); display: grid; place-items: center; color: #fff; transition: background .25s ease, border-color .25s ease, transform .25s ease, color .25s ease; }
.twr-footer__social a:hover { background: var(--twr-orange); border-color: var(--twr-orange); transform: translateY(-3px); }
.twr-footer__social svg { width: 15px; height: 15px; fill: currentColor; display: block; }
.twr-footer__h { font-size: 12px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.45); margin-bottom: 20px; }
.twr-footer__links { list-style: none; display: flex; flex-direction: column; gap: 13px; }
.twr-footer__links a { width: fit-content; display: inline-flex; align-items: center; color: rgba(255,255,255,.82); text-decoration: none; font-size: 15px; transition: color .2s ease; }
.twr-footer__links a::after { content: '→'; color: var(--twr-orange); opacity: 0; transform: translateX(-6px); margin-left: 6px; transition: opacity .2s ease, transform .2s ease; }
.twr-footer__links a:hover { color: #fff; }
.twr-footer__links a:hover::after { opacity: 1; transform: translateX(0); }
.twr-footer__addr { font-style: normal; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.62); }
.twr-footer__addr strong { color: rgba(255,255,255,.9); font-weight: 500; }
.twr-footer__sub { margin-top: 20px; }
.twr-footer__trec { display: flex; flex-direction: column; gap: 14px; }
.twr-footer__trec a { display: inline-flex; align-items: flex-start; gap: 10px; color: rgba(255,255,255,.82); text-decoration: none; font-size: 14.5px; line-height: 1.4; transition: color .2s ease; }
.twr-footer__trec a:hover { color: #fff; }
.twr-footer__trec .twr-footer__arrow { color: var(--twr-orange); margin-top: 1px; flex: none; transition: transform .25s ease; }
.twr-footer__trec a:hover .twr-footer__arrow { transform: translateX(4px); }
.twr-footer__trec svg { width: 16px; height: 16px; display: block; }
.twr-footer__bottom { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding: clamp(18px, 2vw, 22px) clamp(28px, 3.6vw, 60px); border-top: 1px solid rgba(255,255,255,.1); }
.twr-footer__copy { font-size: 13.5px; color: rgba(255,255,255,.5); }
.twr-footer__totop { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,.7); text-decoration: none; font-size: 13.5px; transition: color .2s ease; }
.twr-footer__totop:hover { color: #fff; }
.twr-footer__totop svg { width: 14px; height: 14px; transition: transform .25s ease; }
.twr-footer__totop:hover svg { transform: translateY(-3px); }
.twr-footer--anim .twr-foot-anim { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; transition-delay: var(--d, 0s); }
.twr-footer--anim .twr-foot-anim.is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .twr-footer--anim .twr-foot-anim { opacity: 1!important; transform: none!important; transition: none!important; }
  .twr-footer__logo { animation: none!important; }
}
@media (max-width: 1024px) {
  .twr-footer__cta { grid-template-columns: 1fr; gap: 24px; }
  .twr-footer__cta-actions { justify-content: flex-start; }
  .twr-footer__main { grid-template-columns: 1fr 1fr; gap: 36px 28px; }
  .twr-footer__brand { grid-column: 1 / -1; }
}
@media (max-width: 620px) {
  .twr-footer__main { grid-template-columns: 1fr; }
  .twr-footer__bottom { flex-direction: column; justify-content: center; text-align: center; gap: 14px; }
  .twr-footer__ghost { font-size: 22vw; }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
@endpush
@section('content')

<!-- ============================================================
     ===================  ALL HTML  =============================
============================================================ -->

<!-- =====================  HEADER  ===================== -->
<div class="twr-wrap">
  <header class="twr-header" id="twrHeader">
    <div class="twr-header__bar">

      <a class="twr-header__logo" href="{{ route('home') }}" aria-label="Tower Realty Austin home">
        <img src="https://tower-leasing.com/wp-content/uploads/2025/01/cropped-Tower-Leasing-1.png"
             alt="Tower Realty Austin">
      </a>

      <nav class="twr-nav" aria-label="Primary">
        <a class="twr-nav__link" href="{{ route('home') }}">Home</a>
        <a class="twr-nav__link" href="{{ route('website.about') }}">About</a>
        <a class="twr-nav__link" href="{{ route('website.properties') }}">Properties</a>
        <a class="twr-nav__link" href="{{ route('website.agents') }}">Agents</a>
        <a class="twr-nav__link is-current" href="{{ route('website.contact') }}">Contact Us</a>
        <div class="twr-nav__item">
          <button class="twr-nav__link twr-nav__more" type="button" aria-haspopup="true" aria-expanded="false">
            More
            <svg class="twr-nav__chev" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="twr-nav__sub">
            <a href="{{ route('website.become-agent') }}">Become a Leasing Agent</a>
            <a href="https://www.instagram.com/towerleasing/?igshid=NzZhOTFlYzFmZQ%3D%3D" target="_blank" rel="noopener">Instagram</a>
          </div>
        </div>
      </nav>

      <div class="twr-agent">
        <div class="twr-agent__avatar">
          <img src="assets/anna-leasing-agent.png" alt="Anna, Leasing Agent">
          <span class="twr-agent__dot"></span>
        </div>
        <div class="twr-agent__meta">
          <span class="twr-agent__name">Anna</span>
          <span class="twr-agent__role">Leasing Agent</span>
        </div>
        <a class="twr-agent__btn" href="{{ route('website.contact') }}">Book a call</a>
      </div>

      <button class="twr-header__toggle" aria-label="Open menu"
              aria-expanded="false" aria-controls="twrMobile">
        <span></span><span></span><span></span>
      </button>
    </div>

    <div class="twr-header__mobile" id="twrMobile">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('website.about') }}">About</a>
      <a href="{{ route('website.properties') }}">Properties</a>
      <a href="{{ route('website.agents') }}">Agents</a>
      <div class="twr-mobile-dropdown"><button class="twr-mobile-dropdown__toggle" type="button" aria-expanded="false" aria-controls="twrMobileMore">More <svg viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button><div class="twr-mobile-dropdown__panel" id="twrMobileMore"><div class="twr-mobile-dropdown__inner"><a href="{{ route('website.become-agent') }}">Become a Leasing Agent</a><a href="https://www.instagram.com/towerleasing/?igshid=NzZhOTFlYzFmZQ%3D%3D" target="_blank" rel="noopener">Instagram</a></div></div></div>
      <a href="{{ route('website.contact') }}">Contact Us</a>
      <a href="{{ route('website.contact') }}" class="twr-mobile-btn">Book a call</a>
    </div>
  </header>
  <script>(function(){var h=document.getElementById('twrHeader'),d=h&&h.querySelector('.twr-mobile-dropdown'),b=h&&h.querySelector('.twr-mobile-dropdown__toggle'),m=h&&h.querySelector('.twr-header__toggle');if(!d||!b)return;function c(){d.classList.remove('is-open');b.setAttribute('aria-expanded','false')}b.addEventListener('click',function(){var o=d.classList.toggle('is-open');b.setAttribute('aria-expanded',o?'true':'false')});d.querySelectorAll('a').forEach(function(a){a.addEventListener('click',c)});if(m)m.addEventListener('click',function(){setTimeout(function(){if(!h.classList.contains('is-menu-open'))c()},0)})})();</script>
</div>

<div data-scroll-container>
<!-- =====================  CONTACT PAGE  ===================== -->
<main class="twr-co">

  <!-- HERO (background video) -->
  <section class="twr-co-hero">
    <video class="twr-co-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
      <source src="https://framerusercontent.com/assets/rs44TuJAYUuddUoUTCFk4Yr0ig.mp4" type="video/mp4">
    </video>
    <div class="twr-co-hero__inner">
      <p class="twr-co-hero__eyebrow twr-co-anim" style="--d:0s">@content('contact.hero.eyebrow', 'Contact')</p>
      <h1 class="twr-co-hero__title twr-co-anim" style="--d:.06s">@content('contact.hero.title', "Let's get you home")</h1>
      <p class="twr-co-hero__lead twr-co-anim" style="--d:.14s">
        @content('contact.hero.lead', 'Booking a tour, asking about a listing, or ready to sign? Our West Campus team is a quick call or message away — and our help is always completely free for students.')
      </p>
      <div class="twr-co-hero__actions twr-co-anim" style="--d:.22s">
        <a class="twr-co-btn" href="tel:+15129821560">
          <svg viewBox="0 0 20 20" fill="none"><path d="M5 3.5c0 6 5.5 11.5 11.5 11.5l.5-2.5-3-1-1.2 1.4A9 9 0 0 1 7.6 7.7L9 6.5l-1-3L5 3.5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
          Call 512-982-1560
        </a>
        <a class="twr-co-btn twr-co-btn--ghost" href="#twrContactForm">Send a message</a>
      </div>
    </div>
  </section>

  <!-- CONTACT MAIN: info + form -->
  <section class="twr-co-main">

    <!-- Left: details -->
    <div class="twr-co-info">
      <p class="twr-co-info__eyebrow twr-co-anim" style="--d:0s">@content('contact.info.eyebrow', 'Reach us')</p>
      <h2 class="twr-co-info__title twr-co-anim" style="--d:.06s">@content('contact.info.title', 'Get in touch')</h2>
      <p class="twr-co-info__lead twr-co-anim" style="--d:.12s">
        @content('contact.info.lead', "Drop by the office between classes, give us a ring, or send a note below — whichever's easiest. We'll line up tours and walk you through every step.")
      </p>

      <div class="twr-co-rows">
        <!-- Office -->
        <div class="twr-co-row twr-co-anim" style="--d:.16s">
          <span class="twr-co-row__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
          </span>
          <div>
            <p class="twr-co-row__label">Austin Office</p>
            <p class="twr-co-row__value">611 W 22nd St – second floor<br>(above Starbucks), Austin, TX 78705</p>
          </div>
        </div>

        <!-- Hours -->
        <div class="twr-co-row twr-co-anim" style="--d:.22s">
          <span class="twr-co-row__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
          </span>
          <div>
            <p class="twr-co-row__label">Hours</p>
            <p class="twr-co-row__value">Monday – Friday • 10 am – 6 pm<br>Saturday • by appointment<br>Sunday • by appointment</p>
          </div>
        </div>

        <!-- Phone -->
        <div class="twr-co-row twr-co-anim" style="--d:.28s">
          <span class="twr-co-row__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
          </span>
          <div>
            <p class="twr-co-row__label">Phone</p>
            <p class="twr-co-row__value"><a href="tel:+15129821560">512-982-1560</a></p>
          </div>
        </div>

        <!-- Email -->
        <div class="twr-co-row twr-co-anim" style="--d:.34s">
          <span class="twr-co-row__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          </span>
          <div>
            <p class="twr-co-row__label">Email</p>
            <p class="twr-co-row__value"><a href="mailto:info@tower-leasing.com">info@tower-leasing.com</a></p>
          </div>
        </div>
      </div>

      <!-- Direct call button -->
      <a class="twr-co-call twr-co-anim" style="--d:.4s" href="tel:+15129821560">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
        Book a call now
      </a>
    </div>

    <!-- Right: form -->
    <div class="twr-co-form twr-co-anim" style="--d:.1s">
      <h2 class="twr-co-form__title">Send us a message</h2>
      <p class="twr-co-form__sub">Tell us what you're looking for and we'll get right back to you.</p>

      <!-- Submitting opens the visitor's email app pre-filled to info@tower-leasing.com.
           To wire this to a WordPress form plugin instead, set the form's action/method
           and remove the JS handler at the bottom of this file. -->
      <form id="twrContactForm" novalidate>
        <div class="twr-co-form__row">
          <div class="twr-co-field">
            <label for="twrName">Name</label>
            <input id="twrName" name="name" type="text" placeholder="Your name" required>
          </div>
          <div class="twr-co-field">
            <label for="twrPhone">Phone</label>
            <input id="twrPhone" name="phone" type="tel" placeholder="(optional)">
          </div>
        </div>
        <div class="twr-co-field">
          <label for="twrEmail">Email</label>
          <input id="twrEmail" name="email" type="email" placeholder="you@email.com" required>
        </div>
        <div class="twr-co-field">
          <label for="twrMsg">Message</label>
          <textarea id="twrMsg" name="message" placeholder="Which property or area are you interested in? When do you need to move in?" required></textarea>
        </div>
        <button class="twr-co-submit" type="submit">
          Send message
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <p class="twr-co-note">We usually reply within one business day.</p>
      </form>
    </div>
  </section>

  <!-- MAP BAND -->
  <section class="twr-co-map">
    <div class="twr-co-map__card twr-co-anim" style="--d:0s">
      <iframe class="twr-co-map__frame"
              src="https://www.google.com/maps?q=611%20W%2022nd%20St%2C%20Austin%2C%20TX%2078705&output=embed"
              title="Tower Realty Austin office location" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
      <div class="twr-co-map__badge">
        <h3>Tower Realty Austin</h3>
        <p>611 W 22nd St – second floor (above Starbucks), Austin, TX 78705</p>
        <a class="twr-co-map__dir" href="https://www.google.com/maps/dir/?api=1&destination=611+W+22nd+St,+Austin,+TX+78705" target="_blank" rel="noopener">
          Get directions
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>
  </section>

</main>

<!-- =====================  FOOTER  ===================== -->
<footer class="twr-footer" id="twrFooter">
  <div class="twr-footer__card">
    <span class="twr-footer__ghost" aria-hidden="true">Tower Leasing</span>

    <div class="twr-footer__cta">
      <h2 class="twr-footer__cta-title twr-foot-anim" style="--d:0s">@content('global.footer.cta_title', 'Ready to find your place near UT Austin?')</h2>
      <div class="twr-footer__cta-actions twr-foot-anim" style="--d:.1s">
        <a class="twr-footer__btn" href="{{ route('website.properties') }}">
          Browse listings
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a class="twr-footer__calllink" href="tel:+15129821560">
          <svg viewBox="0 0 20 20" width="16" height="16" fill="none"><path d="M5 3.5c0 6 5.5 11.5 11.5 11.5l.5-2.5-3-1-1.2 1.4A9 9 0 0 1 7.6 7.7L9 6.5l-1-3L5 3.5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
          512-982-1560
        </a>
      </div>
    </div>

    <div class="twr-footer__main">
      <div class="twr-footer__brand twr-foot-anim" style="--d:0s">
        <a class="twr-footer__logo" href="https://tower-leasing.com/" aria-label="Tower Leasing Austin home">
          <img src="assets/tower-leasing-footer.png" alt="Tower Leasing Austin">
        </a>
        <p class="twr-footer__blurb">@content('global.footer.blurb', 'Helping UT Austin students find the perfect place to call home — exclusive listings, expert agents, always free for our clients.')</p>
        <div class="twr-footer__social">
          <a href="https://www.facebook.com/tower.realty.austin.texas/" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 320 512" aria-hidden="true"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
          </a>
          <a href="https://www.instagram.com/towerleasing/" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 448 512" aria-hidden="true"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
          </a>
        </div>
      </div>

      <div class="twr-foot-anim" style="--d:.08s">
        <p class="twr-footer__h">Explore</p>
        <ul class="twr-footer__links">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('website.properties') }}">Properties</a></li>
          <li><a href="{{ route('website.properties') }}">Exclusive Listings</a></li>
          <li><a href="{{ route('website.agents') }}">Agents</a></li>
          <li><a href="{{ route('website.become-agent') }}">Become a Leasing Agent</a></li>
        </ul>
      </div>

      <div class="twr-foot-anim" style="--d:.16s">
        <p class="twr-footer__h">Austin Office</p>
        <address class="twr-footer__addr">@content('global.footer.address', '611 W 22nd St – second floor<br>(above Starbucks)<br>Austin, TX 78705')</address>
        <div class="twr-footer__sub">
          <p class="twr-footer__h">Hours</p>
          <p class="twr-footer__addr"><strong>Mon – Fri</strong> · 10 am – 6 pm<br>Sat · by appointment<br>Sun · by appointment</p>
        </div>
      </div>

      <div class="twr-foot-anim" style="--d:.24s">
        <p class="twr-footer__h">Consumer Information</p>
        <div class="twr-footer__trec">
          <a href="https://www.trec.texas.gov/forms/information-about-brokerage-services" target="_blank" rel="noopener">
            <span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            TREC Information About Brokerage
          </a>
          <a href="https://www.trec.texas.gov/forms/consumer-protection-notice" target="_blank" rel="noopener">
            <span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            TREC Consumer Notice
          </a>
          <a href="https://tower-leasing.com/properties/">
            <span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            Online Leasing Application
          </a>
        </div>
      </div>
    </div>

    <div class="twr-footer__bottom twr-foot-anim" style="--d:.3s">
      <p class="twr-footer__copy">@content('global.footer.copyright', 'Copyright © 2026 Tower Realty Austin, all rights reserved')</p>
      <a class="twr-footer__totop" href="#twrHeader">
        Back to top
        <svg viewBox="0 0 20 20" fill="none"><path d="M10 16V4M5 9l5-5 5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>
</footer>

<!-- ============================================================
     ===================  ALL JS — ONE BLOCK  ===================
============================================================ -->
<script>
/* ---------- 1) HEADER: scroll shadow, mobile menu, More dropdown ---------- */
(function () {
  var header = document.getElementById('twrHeader');
  if (!header) return;
  var toggle = header.querySelector('.twr-header__toggle');
  function onScroll() { header.classList.toggle('is-scrolled', window.scrollY > 24); }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
  if (toggle) {
    toggle.addEventListener('click', function () {
      var open = header.classList.toggle('is-menu-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    header.querySelectorAll('.twr-header__mobile a').forEach(function (a) {
      a.addEventListener('click', function () { header.classList.remove('is-menu-open'); toggle.setAttribute('aria-expanded', 'false'); });
    });
  }
  var moreItem = header.querySelector('.twr-nav__item');
  var moreBtn  = header.querySelector('.twr-nav__more');
  if (moreItem && moreBtn) {
    var syncMore = function () { moreBtn.setAttribute('aria-expanded', moreItem.matches(':hover, :focus-within') ? 'true' : 'false'); };
    ['mouseenter','mouseleave','focusin','focusout'].forEach(function (ev) { moreItem.addEventListener(ev, syncMore); });
  }
})();

/* ---------- 2) CONTACT PAGE: entrance reveal + form handler ---------- */
(function () {
  var page = document.querySelector('.twr-co');
  if (!page) return;

  /* Form -> open the visitor's email app pre-filled. Replace with a
     real endpoint / WP form plugin if you'd prefer server-side handling. */
  var form = document.getElementById('twrContactForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var name  = (form.name && form.name.value || '').trim();
      var email = (form.email && form.email.value || '').trim();
      var phone = (form.phone && form.phone.value || '').trim();
      var msg   = (form.message && form.message.value || '').trim();
      var subject = encodeURIComponent('Website enquiry from ' + (name || 'a student'));
      var body = encodeURIComponent(
        'Name: ' + name + '\n' +
        'Email: ' + email + '\n' +
        'Phone: ' + phone + '\n\n' +
        msg
      );
      window.location.href = 'mailto:info@tower-leasing.com?subject=' + subject + '&body=' + body;
    });
  }

  /* Smooth-scroll the hero "Send a message" button to the form */
  var jump = page.querySelector('a[href="#twrContactForm"]');
  if (jump && form) {
    jump.addEventListener('click', function (e) {
      e.preventDefault();
      form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }

  /* Entrance reveal */
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) return;
  page.classList.add('twr-co--anim');
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); } });
  }, { threshold: 0.12 });
  page.querySelectorAll('.twr-co-hero .twr-co-anim').forEach(function (el) {
    requestAnimationFrame(function () { requestAnimationFrame(function () { el.classList.add('is-in'); }); });
  });
  page.querySelectorAll('.twr-co-anim:not(.twr-co-hero .twr-co-anim)').forEach(function (el) { io.observe(el); });
})();

/* ---------- 3) FOOTER: year, back-to-top, entrance ---------- */
(function () {
  var footer = document.querySelector('.twr-footer');
  if (!footer) return;
  var yearEl = document.getElementById('twrYear');
  if (yearEl) yearEl.textContent = new Date().getFullYear();
  var toTop = footer.querySelector('.twr-footer__totop');
  if (toTop) { toTop.addEventListener('click', function (e) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); }); }
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) return;
  footer.classList.add('twr-footer--anim');
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { footer.querySelectorAll('.twr-foot-anim').forEach(function (el) { el.classList.add('is-in'); }); io.disconnect(); }
    });
  }, { threshold: 0.12 });
  io.observe(footer);
})();
</script>

</div>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script>
<script src="assets/locomotive-init.js"></script>
@endsection
