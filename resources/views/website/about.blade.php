@extends('layouts.website')
@section('title', 'About — Tower Realty Austin')
@push('head')

<!-- ============================================================
     FONTS
============================================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Lustria&display=swap" rel="stylesheet">

<!-- ============================================================
     ===================  ALL CSS — ONE BLOCK  ==================
     Order: HEADER (.twr-wrap) -> ABOUT PAGE (.twr-ab) -> FOOTER
     Header + footer are identical to the homepage. The About
     sections are namespaced under .twr-ab with their own reset.
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
.twr-header__bar {
  position: relative; display: flex; align-items: center; gap: 24px;
  max-width: var(--twr-max); margin: 0 auto; padding: 9px 12px 9px 28px;
  border-radius: 999px; background: #fff; box-shadow: 0 0 0 rgba(0,0,0,0); transition: box-shadow .35s ease;
}
.twr-header.is-scrolled .twr-header__bar { box-shadow: 0 18px 50px -20px rgba(20,20,20,.28); }
.twr-header__logo { display: inline-flex; align-items: center; flex: none; }
.twr-header__logo img { height: 48px; width: auto; display: block; }
.twr-nav { flex: 1; display: flex; justify-content: center; align-items: center; gap: clamp(12px, 1.7vw, 28px); }
.twr-nav__link {
  font-family: 'Inter Tight', sans-serif; font-size: 15px; font-weight: 500; color: var(--twr-ink);
  text-decoration: none; white-space: nowrap; background: none; border: none; cursor: pointer;
  display: inline-flex; align-items: center; gap: 5px; transition: color .2s ease;
}
.twr-nav__link:hover { color: var(--twr-muted); }
.twr-nav__link.is-current { color: var(--twr-accent); }
.twr-nav__chev { width: 10px; height: 10px; transition: transform .25s ease; }
.twr-nav__item:hover .twr-nav__chev,
.twr-nav__item:focus-within .twr-nav__chev { transform: rotate(180deg); }
.twr-nav__sub {
  position: absolute; top: calc(100% + 14px); left: 50%; transform: translateX(-50%) translateY(6px);
  background: #fff; border-radius: 14px; box-shadow: 0 20px 50px -20px rgba(0,0,0,.3); padding: 8px;
  min-width: 214px; display: flex; flex-direction: column; gap: 2px;
  opacity: 0; pointer-events: none; transition: opacity .2s ease, transform .2s ease;
}
.twr-nav__sub::before { content: ''; position: absolute; top: -14px; left: 0; right: 0; height: 14px; }
.twr-nav__item:hover .twr-nav__sub,
.twr-nav__item:focus-within .twr-nav__sub { opacity: 1; pointer-events: auto; transform: translateX(-50%) translateY(0); }
.twr-nav__sub a {
  font-family: 'Inter Tight', sans-serif; font-size: 14px; font-weight: 500; color: var(--twr-ink);
  text-decoration: none; padding: 9px 12px; border-radius: 9px; white-space: nowrap; transition: background .15s ease;
}
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
.twr-header__mobile {
  display: none; position: absolute; top: 100%; left: clamp(14px,2.2vw,30px); right: clamp(14px,2.2vw,30px);
  margin-top: 10px; background: #fff; border-radius: 20px; box-shadow: 0 24px 60px -24px rgba(0,0,0,.3);
  padding: 14px; flex-direction: column; gap: 4px;
  opacity: 0; transform: translateY(-8px); pointer-events: none; transition: opacity .25s ease, transform .25s ease;
}
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
   ABOUT PAGE SCOPE (.twr-ab)
=========================================================== */
.twr-ab, .twr-ab *, .twr-ab *::before, .twr-ab *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-ab {
  --twr-ink: #121212; --twr-body: #333333; --twr-muted: #5b5b5b; --twr-accent: #D05F28; --twr-max: 1480px;
  font-family: 'Inter Tight', system-ui, -apple-system, Roboto, sans-serif;
  color: var(--twr-ink); -webkit-font-smoothing: antialiased; display: block;
}

/* shared button */
.twr-ab-btn { display: inline-flex; align-items: center; gap: 10px; background: #121212; color: #fff; text-decoration: none; font-weight: 600; font-size: 15px; padding: 14px 26px; border-radius: 999px; transition: transform .25s ease, background .25s ease; }
.twr-ab-btn:hover { transform: translateY(-2px); background: #000; }
.twr-ab-btn svg { width: 18px; height: 18px; }
.twr-ab-btn--ghost { background: transparent; color: #121212; border: 1px solid #d8d8d8; }
.twr-ab-btn--ghost:hover { background: #f4f4f4; border-color: #c8c8c8; }

/* ---- Hero (background video) ---- */
.twr-ab-hero {
  position: relative;
  margin: 0 clamp(10px, 1.4vw, 18px);
  min-height: clamp(600px, 90vh, 840px);   /* taller so the video fills the frame nicely */
  border-radius: 0 0 32px 32px;
  overflow: hidden;
  background: #0a0a0a;                       /* shows before the video loads */
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}
/* the looping background video */
.twr-ab-hero__video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}
/* dark veil over the video for text legibility */
.twr-ab-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  z-index: 1;
  background: linear-gradient(180deg, rgba(0,0,0,.58) 0%, rgba(0,0,0,.48) 45%, rgba(0,0,0,.58) 100%);
  pointer-events: none;
}
.twr-ab-hero__inner {
  position: relative;
  z-index: 2;
  max-width: 980px;
  padding: clamp(150px, 20vh, 220px) clamp(24px, 4vw, 56px) clamp(64px, 9vh, 110px);
}
.twr-ab-hero__eyebrow { font-family: 'Lustria', Georgia, serif; text-transform: uppercase; letter-spacing: .08em; font-size: clamp(14px, 1.2vw, 17px); color: #fff; margin-bottom: 18px; }
.twr-ab-hero__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(40px, 5.4vw, 70px); line-height: 1.1; color: #fff; margin-bottom: 26px; }
.twr-ab-hero__lead { font-family: 'Inter Tight', sans-serif; font-size: clamp(16px, 1.4vw, 20px); line-height: 1.7; color: #fff; max-width: 680px; margin: 0 auto 34px; }
.twr-ab-hero__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
/* buttons sit on the dark video -> light styling */
.twr-ab-hero .twr-ab-btn { background: #fff; color: #121212; }
.twr-ab-hero .twr-ab-btn:hover { background: #f0f0f0; }
.twr-ab-hero .twr-ab-btn--ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.5); }
.twr-ab-hero .twr-ab-btn--ghost:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.7); }

/* ---- Features (the 4 points) ---- */
.twr-ab-features { max-width: var(--twr-max); margin: 0 auto; padding: clamp(40px, 5vw, 72px) clamp(24px, 4vw, 56px); }
.twr-ab-features__head { margin-bottom: clamp(32px, 4vw, 52px); max-width: 620px; }
.twr-ab-features__eyebrow { font-size: 12px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: #9a9a9a; margin-bottom: 14px; }
.twr-ab-features__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(24px, 3vw, 40px); line-height: 1.3; color: var(--twr-ink); }
.twr-ab-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.twr-ab-card { background: #f7f7f7; border-radius: 20px; padding: clamp(26px, 3vw, 40px); display: flex; flex-direction: column; gap: 14px; transition: transform .35s ease, box-shadow .35s ease, background .35s ease; }
.twr-ab-card:hover { transform: translateY(-6px); box-shadow: 0 30px 60px -30px rgba(0,0,0,.18); background: #fff; }
.twr-ab-card__num { font-family: 'Lustria', Georgia, serif; font-size: clamp(28px, 3vw, 40px); color: var(--twr-accent); line-height: 1; }
.twr-ab-card__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(19px, 1.8vw, 24px); line-height: 1.3; color: var(--twr-ink); }
.twr-ab-card__desc { font-family: 'Inter Tight', sans-serif; font-size: clamp(14px, 1vw, 15.5px); line-height: 1.6; color: var(--twr-muted); }

/* ---- Split (image + text) ---- */
.twr-ab-split { max-width: var(--twr-max); margin: 0 auto; padding: clamp(40px, 5vw, 72px) clamp(24px, 4vw, 56px); display: grid; grid-template-columns: 1fr 1fr; gap: clamp(28px, 4vw, 64px); align-items: center; }
.twr-ab-split__media { border-radius: 24px; overflow: hidden; aspect-ratio: 5 / 4; box-shadow: 0 30px 70px -30px rgba(0,0,0,.25); }
.twr-ab-split__media img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform .8s ease; }
.twr-ab-split__media:hover img { transform: scale(1.05); }
.twr-ab-split__eyebrow { font-size: 12px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: #9a9a9a; margin-bottom: 14px; }
.twr-ab-split__title { font-family: 'Lustria', Georgia, serif; font-weight: 400; font-size: clamp(24px, 3vw, 40px); line-height: 1.25; color: #121212; margin-bottom: 18px; }
.twr-ab-split__text { font-family: 'Inter Tight', sans-serif; font-size: clamp(15px, 1.2vw, 18px); line-height: 1.7; color: var(--twr-muted); }

/* ---- Stats (count-up) ---- */
.twr-ab-stats { max-width: var(--twr-max); margin: 0 auto; padding: clamp(40px, 5vw, 72px) clamp(24px, 4vw, 56px); }
.twr-ab-stats__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: clamp(24px, 4vw, 56px); border-top: 1px solid #e6e6e6; padding-top: clamp(32px, 4vw, 52px); }
.twr-ab-stat__num { font-family: 'Lustria', Georgia, serif; font-size: clamp(48px, 7vw, 92px); line-height: 1; color: #121212; display: flex; align-items: flex-end; gap: 6px; }
.twr-ab-stat__unit { font-family: 'Inter Tight', sans-serif; font-size: clamp(14px, 1.1vw, 18px); color: var(--twr-muted); padding-bottom: 10px; }
.twr-ab-stat__label { font-family: 'Inter Tight', sans-serif; font-size: 13px; letter-spacing: .03em; color: var(--twr-muted); margin-top: 12px; }

/* ---- CTA band (orange) ---- */
.twr-ab-cta { margin: clamp(20px, 3vw, 40px) clamp(10px, 1.4vw, 18px) 0; }
.twr-ab-cta__card { background: var(--twr-accent); border-radius: 28px; padding: clamp(48px, 6vw, 92px) clamp(28px, 4vw, 64px); text-align: center; }
.twr-ab-cta__title { font-family: 'Lustria', Georgia, serif; color: #fff; font-weight: 400; font-size: clamp(28px, 3.6vw, 52px); line-height: 1.15; margin: 0 auto 28px; max-width: 18ch; }
.twr-ab-cta__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.twr-ab-cta__btn { display: inline-flex; align-items: center; gap: 10px; background: #fff; color: var(--twr-accent); text-decoration: none; font-weight: 600; font-size: 15px; padding: 14px 28px; border-radius: 999px; transition: transform .25s ease, background .25s ease; }
.twr-ab-cta__btn:hover { transform: translateY(-2px); background: #f3f3f3; }
.twr-ab-cta__btn svg { width: 18px; height: 18px; }
.twr-ab-cta__btn--ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.55); }
.twr-ab-cta__btn--ghost:hover { background: rgba(255,255,255,.12); }

/* ---- Entrance animation (opt-in, fails safe) ---- */
.twr-ab--anim .twr-ab-anim { opacity: 0; transform: translateY(22px); transition: opacity .7s ease, transform .7s ease; transition-delay: var(--d, 0s); }
.twr-ab--anim .twr-ab-anim.is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .twr-ab--anim .twr-ab-anim { opacity: 1 !important; transform: none !important; transition: none !important; }
}

/* ---- About responsive ---- */
@media (max-width: 900px) {
  .twr-ab-grid { grid-template-columns: 1fr; }
  .twr-ab-split { grid-template-columns: 1fr; gap: 28px; }
  .twr-ab-split__media { aspect-ratio: 16 / 10; order: -1; }
  .twr-ab-stats__grid { grid-template-columns: 1fr; gap: 28px; }
}
@media (max-width: 600px) {
  .twr-ab-hero { min-height: clamp(480px, 80vh, 640px); border-radius: 0 0 24px 24px; }
}

/* ===========================================================
   FOOTER — identical to the homepage footer
=========================================================== */
.twr-footer, .twr-footer *, .twr-footer *::before, .twr-footer *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-footer {
  --twr-orange: #D05F28;
  font-family: 'Inter Tight', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  -webkit-font-smoothing: antialiased;
  margin: 0 clamp(10px, 1.4vw, 18px);
  padding: clamp(24px, 3vw, 44px) 0 clamp(14px, 2vw, 22px);
}
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
        <a class="twr-nav__link is-current" href="{{ route('website.about') }}">About</a>
        <a class="twr-nav__link" href="{{ route('website.properties') }}">Properties</a>
        <a class="twr-nav__link" href="{{ route('website.agents') }}">Agents</a>
        <a class="twr-nav__link" href="{{ route('website.contact') }}">Contact Us</a>
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
<!-- =====================  ABOUT PAGE  ===================== -->
<main class="twr-ab">

  <!-- HERO (background video) -->
  <section class="twr-ab-hero">
    <video class="twr-ab-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
      <source src="https://framerusercontent.com/assets/rs44TuJAYUuddUoUTCFk4Yr0ig.mp4" type="video/mp4">
    </video>
    <div class="twr-ab-hero__inner">
      <p class="twr-ab-hero__eyebrow twr-ab-anim" style="--d:0s">@content('about.hero.eyebrow', 'About Us')</p>
      <h1 class="twr-ab-hero__title twr-ab-anim" style="--d:.06s">@content('about.hero.title', 'About Tower Leasing')</h1>
      <p class="twr-ab-hero__lead twr-ab-anim" style="--d:.14s">
        @content('about.hero.lead', "At Tower Leasing, we specialize in connecting UT Austin students with the perfect place to call home. We know that finding an apartment on or near campus can be overwhelming, but we're here to take that burden off your shoulders and turn the process into an exciting and easy experience.")
      </p>
      <div class="twr-ab-hero__actions twr-ab-anim" style="--d:.22s">
        <a class="twr-ab-btn" href="https://tower-leasing.com/properties/">
          Browse listings
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a class="twr-ab-btn twr-ab-btn--ghost" href="tel:512-982-1560">Book a call</a>
      </div>
    </div>
  </section>

  <!-- FEATURES — the 4 points -->
  <section class="twr-ab-features">
    <div class="twr-ab-features__head">
      <p class="twr-ab-features__eyebrow twr-ab-anim" style="--d:0s">@content('about.features.eyebrow', 'What we do for you')</p>
      <h2 class="twr-ab-features__title twr-ab-anim" style="--d:.06s">@content('about.features.title', 'Everything you need to land the right place — handled.')</h2>
    </div>
    <div class="twr-ab-grid">
      <article class="twr-ab-card twr-ab-anim" style="--d:.04s">
        <span class="twr-ab-card__num">01</span>
        <h3 class="twr-ab-card__title">@content('about.features.item1_title', 'Get access to exclusive Tower Leasing listings')</h3>
        <p class="twr-ab-card__desc">@content('about.features.item1_desc', "Tap into hundreds of curated near-campus apartments you won't find on any public rental site.")</p>
      </article>
      <article class="twr-ab-card twr-ab-anim" style="--d:.12s">
        <span class="twr-ab-card__num">02</span>
        <h3 class="twr-ab-card__title">@content('about.features.item2_title', 'Sign a lease at the best property for your needs')</h3>
        <p class="twr-ab-card__desc">@content('about.features.item2_desc', 'Our agents match you to the right property and make sure the lease terms fit your budget and lifestyle.')</p>
      </article>
      <article class="twr-ab-card twr-ab-anim" style="--d:.2s">
        <span class="twr-ab-card__num">03</span>
        <h3 class="twr-ab-card__title">@content('about.features.item3_title', 'Find the best deals and special offers')</h3>
        <p class="twr-ab-card__desc">@content('about.features.item3_desc', 'We track move-in specials, reduced deposits, and limited-time promotions so you never miss a saving.')</p>
      </article>
      <article class="twr-ab-card twr-ab-anim" style="--d:.28s">
        <span class="twr-ab-card__num">04</span>
        <h3 class="twr-ab-card__title">@content('about.features.item4_title', 'Save money on property fees and deposits')</h3>
        <p class="twr-ab-card__desc">@content('about.features.item4_desc', 'Leverage our property-manager relationships to negotiate lower deposits and waived fees from day one.')</p>
      </article>
    </div>
  </section>

  <!-- SPLIT — provided image + supporting copy -->
  <section class="twr-ab-split">
    <div class="twr-ab-split__media twr-ab-anim" style="--d:0s">
      <img src="https://tower-leasing.com/wp-content/uploads/2025/01/texas-students-now-need-top-5-rank-for-automatic-admission-v0-v9F-ckLubFnTqq_q6ZTnAAL99m6l9a3eqhklngFr8Tg-1.webp"
           alt="UT Austin students near campus" loading="lazy">
    </div>
    <div class="twr-ab-split__body">
      <p class="twr-ab-split__eyebrow twr-ab-anim" style="--d:.06s">@content('about.split.eyebrow', 'On campus, in your corner')</p>
      <h2 class="twr-ab-split__title twr-ab-anim" style="--d:.12s">@content('about.split.title', 'Right in the heart of West Campus')</h2>
      <p class="twr-ab-split__text twr-ab-anim" style="--d:.18s">
        @content('about.split.text', "Our office sits at 22nd and Rio Grande — minutes from class. Pop in between lectures and we'll walk you through multiple tours in a single visit, then handle the paperwork so you can focus on school. From your first search to move-in day, you'll have a local team that knows the neighborhood inside out — and our help is always completely free for students.")
      </p>
    </div>
  </section>

  <!-- STATS -->
  <section class="twr-ab-stats">
    <div class="twr-ab-stats__grid">
      <div class="twr-ab-stat twr-ab-anim" style="--d:0s">
        <div class="twr-ab-stat__num"><span class="twr-count" data-target="10">10</span><span class="twr-ab-stat__unit">Yrs</span></div>
        <p class="twr-ab-stat__label">@content('about.stats.stat1_label', 'Helping students since')</p>
      </div>
      <div class="twr-ab-stat twr-ab-anim" style="--d:.1s">
        <div class="twr-ab-stat__num"><span class="twr-count" data-target="500">500</span><span class="twr-ab-stat__unit">Listings</span></div>
        <p class="twr-ab-stat__label">@content('about.stats.stat2_label', 'Exclusive near-campus options')</p>
      </div>
      <div class="twr-ab-stat twr-ab-anim" style="--d:.2s">
        <div class="twr-ab-stat__num"><span class="twr-count" data-target="1200">1,200</span><span class="twr-ab-stat__unit">Students</span></div>
        <p class="twr-ab-stat__label">@content('about.stats.stat3_label', 'Helped into the right home')</p>
      </div>
    </div>
  </section>

  <!-- CTA band -->
  <section class="twr-ab-cta">
    <div class="twr-ab-cta__card twr-ab-anim" style="--d:0s">
      <h2 class="twr-ab-cta__title">@content('global.footer.cta_title', 'Ready to find your place near UT Austin?')</h2>
      <div class="twr-ab-cta__actions">
        <a class="twr-ab-cta__btn" href="https://tower-leasing.com/properties/">
          Browse listings
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a class="twr-ab-cta__btn twr-ab-cta__btn--ghost" href="tel:512-982-1560">Book a call</a>
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
        <a class="twr-footer__calllink" href="tel:512-982-1560">
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
      a.addEventListener('click', function () {
        header.classList.remove('is-menu-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  var moreItem = header.querySelector('.twr-nav__item');
  var moreBtn  = header.querySelector('.twr-nav__more');
  if (moreItem && moreBtn) {
    var syncMore = function () {
      moreBtn.setAttribute('aria-expanded', moreItem.matches(':hover, :focus-within') ? 'true' : 'false');
    };
    ['mouseenter','mouseleave','focusin','focusout'].forEach(function (ev) { moreItem.addEventListener(ev, syncMore); });
  }
})();

/* ---------- 2) ABOUT PAGE: entrance reveal + count-up ---------- */
(function () {
  var page = document.querySelector('.twr-ab');
  if (!page) return;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function runCountUp() {
    page.querySelectorAll('.twr-count').forEach(function (el) {
      var target = parseInt(el.getAttribute('data-target'), 10), duration = 1400, start = null;
      function step(ts) {
        if (!start) start = ts;
        var p = Math.min((ts - start) / duration, 1);
        var eased = 1 - Math.pow(1 - p, 3);
        var cur = Math.round(eased * target);
        el.textContent = cur >= 1000 ? cur.toLocaleString() : cur.toString();
        if (p < 1) requestAnimationFrame(step);
        else el.textContent = target >= 1000 ? target.toLocaleString() : target;
      }
      requestAnimationFrame(step);
    });
  }

  if (reduce || !('IntersectionObserver' in window)) { return; }

  page.classList.add('twr-ab--anim');

  /* reveal observer */
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
    });
  }, { threshold: 0.12 });

  /* hero reveals immediately on load */
  page.querySelectorAll('.twr-ab-hero .twr-ab-anim').forEach(function (el) {
    requestAnimationFrame(function () { requestAnimationFrame(function () { el.classList.add('is-in'); }); });
  });
  /* everything else reveals on scroll */
  page.querySelectorAll('.twr-ab-anim:not(.twr-ab-hero .twr-ab-anim)').forEach(function (el) { io.observe(el); });

  /* count-up when the stats row enters view */
  var statsEl = page.querySelector('.twr-ab-stats__grid');
  if (statsEl) {
    var so = new IntersectionObserver(function (en) {
      if (en[0].isIntersecting) { runCountUp(); so.disconnect(); }
    }, { threshold: 0.3 });
    so.observe(statsEl);
  }
})();

/* ---------- 3) FOOTER: year, back-to-top, entrance ---------- */
(function () {
  var footer = document.querySelector('.twr-footer');
  if (!footer) return;

  var yearEl = document.getElementById('twrYear');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  var toTop = footer.querySelector('.twr-footer__totop');
  if (toTop) {
    toTop.addEventListener('click', function (e) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) return;

  footer.classList.add('twr-footer--anim');
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) {
        footer.querySelectorAll('.twr-foot-anim').forEach(function (el) { el.classList.add('is-in'); });
        io.disconnect();
      }
    });
  }, { threshold: 0.12 });
  io.observe(footer);
})();
</script>

</div>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script>
<script src="assets/locomotive-init.js"></script>
@endsection
