@extends('layouts.website')
@section('title', 'Agents — Tower Leasing Austin')
@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Lustria&display=swap" rel="stylesheet">
<style>
/* ============================================================
   HEADER (.twr-wrap) — identical across all pages
============================================================ */
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
.twr-nav__item { position: relative; }
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

/* ============================================================
   AGENTS PAGE (.twr-ag)
============================================================ */
.twr-ag,.twr-ag *,.twr-ag *::before,.twr-ag *::after{box-sizing:border-box;margin:0;padding:0}
.twr-ag{--twr-ink:#121212;--twr-body:#333;--twr-muted:#5b5b5b;--twr-accent:#D05F28;--twr-max:1480px;font-family:'Inter Tight',system-ui,-apple-system,Roboto,sans-serif;color:var(--twr-ink);-webkit-font-smoothing:antialiased;display:block}

/* ---- Hero (same background video as other pages) ---- */
.twr-ag-hero{position:relative;margin:0 clamp(10px,1.4vw,18px);min-height:clamp(600px,90vh,840px);border-radius:0 0 32px 32px;overflow:hidden;background:#0a0a0a;display:flex;align-items:center;justify-content:center;text-align:center}
.twr-ag-hero__video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;z-index:0}
.twr-ag-hero::after{content:'';position:absolute;inset:0;z-index:1;background:linear-gradient(180deg,rgba(0,0,0,.58) 0%,rgba(0,0,0,.48) 45%,rgba(0,0,0,.58) 100%);pointer-events:none}
.twr-ag-hero__inner{position:relative;z-index:2;max-width:980px;padding:clamp(150px,20vh,220px) clamp(24px,4vw,56px) clamp(64px,9vh,110px)}
.twr-ag-hero__eyebrow{font-family:'Lustria',Georgia,serif;text-transform:uppercase;letter-spacing:.08em;font-size:clamp(14px,1.2vw,17px);color:#fff;margin-bottom:18px}
.twr-ag-hero__title{font-family:'Lustria',Georgia,serif;font-weight:400;font-size:clamp(38px,5.2vw,68px);line-height:1.1;color:#fff;margin-bottom:26px}
.twr-ag-hero__lead{font-family:'Inter Tight',sans-serif;font-size:clamp(16px,1.4vw,20px);line-height:1.7;color:#fff;max-width:700px;margin:0 auto 34px}
.twr-ag-hero__actions{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}
.twr-ag-hero .twr-ag-btn{background:#fff;color:#121212}.twr-ag-hero .twr-ag-btn:hover{background:#f0f0f0}
.twr-ag-hero .twr-ag-btn--ghost{background:transparent;color:#fff;border:1px solid rgba(255,255,255,.5)}.twr-ag-hero .twr-ag-btn--ghost:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.7)}
.twr-ag-btn{display:inline-flex;align-items:center;gap:10px;background:#121212;color:#fff;text-decoration:none;font-weight:600;font-size:15px;padding:14px 26px;border-radius:999px;transition:transform .25s ease,background .25s ease}
.twr-ag-btn:hover{transform:translateY(-2px);background:#000}
.twr-ag-btn--ghost{background:transparent;color:#121212;border:1px solid #d8d8d8}
.twr-ag-btn--ghost:hover{background:#f4f4f4;border-color:#c8c8c8}
.twr-ag-btn svg{width:18px;height:18px}

/* ---- Intro band ---- */
.twr-ag-intro{max-width:var(--twr-max);margin:0 auto;padding:clamp(56px,7vw,96px) clamp(24px,4vw,56px) clamp(28px,3.5vw,48px);display:grid;grid-template-columns:1fr 1.6fr;gap:clamp(32px,4vw,72px);align-items:center}
.twr-ag-intro__eyebrow{font-size:12px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:#9a9a9a;margin-bottom:14px}
.twr-ag-intro__title{font-family:'Lustria',Georgia,serif;font-weight:400;font-size:clamp(28px,3.4vw,50px);line-height:1.15;color:var(--twr-ink)}
.twr-ag-intro__body{font-family:'Inter Tight',sans-serif;font-size:clamp(15px,1.15vw,17px);line-height:1.75;color:var(--twr-muted)}
.twr-ag-intro__body p+p{margin-top:16px}
@media(max-width:860px){.twr-ag-intro{grid-template-columns:1fr}}

/* ---- Agent grid ---- */
.twr-ag-section{max-width:var(--twr-max);margin:0 auto;padding:0 clamp(24px,4vw,56px) clamp(56px,7vw,96px)}
.twr-ag-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:clamp(16px,2vw,28px)}

/* ---- Agent card ---- */
.twr-ag-card{background:#fff;border-radius:20px;overflow:hidden;border:1px solid #f0f0f0;transition:transform .3s ease,box-shadow .3s ease;position:relative}
.twr-ag-card:hover{transform:translateY(-6px);box-shadow:0 28px 60px -24px rgba(0,0,0,.18)}
.twr-ag-card__photo-wrap{position:relative;aspect-ratio:4/5;overflow:hidden;background:#f4f4f4}
.twr-ag-card__photo{width:100%;height:100%;object-fit:cover;object-position:top center;display:block;transition:transform .5s ease}
.twr-ag-card:hover .twr-ag-card__photo{transform:scale(1.04)}
.twr-ag-card__overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(208,95,40,.85) 0%,transparent 55%);opacity:0;transition:opacity .3s ease;display:flex;align-items:flex-end;padding:20px}
.twr-ag-card:hover .twr-ag-card__overlay{opacity:1}
.twr-ag-card__email-link{display:inline-flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:13px;font-weight:600;background:rgba(255,255,255,.18);backdrop-filter:blur(6px);padding:8px 14px;border-radius:999px;border:1px solid rgba(255,255,255,.35);transition:background .2s ease}
.twr-ag-card__email-link:hover{background:rgba(255,255,255,.3)}
.twr-ag-card__email-link svg{width:14px;height:14px;flex:none}
.twr-ag-card__info{padding:18px 20px 20px}
.twr-ag-card__name{font-family:'Lustria',Georgia,serif;font-size:18px;color:var(--twr-ink);margin-bottom:4px;line-height:1.2}
.twr-ag-card__role{font-size:12px;text-transform:uppercase;letter-spacing:.07em;color:var(--twr-accent);font-weight:600;margin-bottom:10px}
.twr-ag-card__email{font-size:13px;color:var(--twr-muted);text-decoration:none;display:flex;align-items:center;gap:6px;transition:color .2s ease}
.twr-ag-card__email:hover{color:var(--twr-accent)}
.twr-ag-card__email svg{width:13px;height:13px;flex:none;opacity:.7}

/* ---- Scarlett highlight card ---- */
.twr-ag-chief{max-width:var(--twr-max);margin:0 auto;padding:0 clamp(24px,4vw,56px) clamp(32px,4vw,56px)}
.twr-ag-chief__card{background:linear-gradient(135deg,#0a0a0a 0%,#1a1a1a 100%);border-radius:28px;overflow:hidden;display:grid;grid-template-columns:340px 1fr;align-items:stretch;position:relative}
.twr-ag-chief__card::before{content:'';position:absolute;top:-30%;right:-5%;width:55%;height:90%;background:radial-gradient(circle,rgba(208,95,40,.2),transparent 62%);pointer-events:none}
.twr-ag-chief__photo-side{position:relative;overflow:hidden}
.twr-ag-chief__photo{width:100%;height:100%;object-fit:cover;object-position:top center;display:block;min-height:400px}
.twr-ag-chief__content{position:relative;z-index:1;padding:clamp(40px,5vw,64px) clamp(36px,4vw,56px);color:#fff;display:flex;flex-direction:column;justify-content:center}
.twr-ag-chief__tag{display:inline-flex;align-items:center;gap:8px;background:rgba(208,95,40,.25);border:1px solid rgba(208,95,40,.4);color:#f0934f;font-size:11px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;padding:6px 14px;border-radius:999px;margin-bottom:22px;width:fit-content}
.twr-ag-chief__tag svg{width:14px;height:14px}
.twr-ag-chief__name{font-family:'Lustria',Georgia,serif;font-size:clamp(28px,3.2vw,46px);line-height:1.1;margin-bottom:16px}
.twr-ag-chief__title{font-size:14px;text-transform:uppercase;letter-spacing:.1em;color:#f0934f;font-weight:600;margin-bottom:20px}
.twr-ag-chief__desc{font-size:clamp(14px,1.1vw,16px);line-height:1.75;color:rgba(255,255,255,.72);max-width:480px;margin-bottom:30px}
.twr-ag-chief__email{display:inline-flex;align-items:center;gap:10px;color:#fff;text-decoration:none;font-weight:600;font-size:15px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.25);padding:12px 22px;border-radius:999px;transition:background .2s ease}
.twr-ag-chief__email:hover{background:rgba(255,255,255,.18)}
.twr-ag-chief__email svg{width:16px;height:16px}
@media(max-width:860px){.twr-ag-chief__card{grid-template-columns:1fr}.twr-ag-chief__photo{min-height:280px;max-height:360px}}

/* ---- Join banner ---- */
.twr-ag-join{margin:0 clamp(10px,1.4vw,18px) clamp(32px,4vw,56px)}
.twr-ag-join__card{background:var(--twr-accent);border-radius:24px;padding:clamp(40px,5vw,60px);display:flex;align-items:center;justify-content:space-between;gap:28px;flex-wrap:wrap}
.twr-ag-join__title{font-family:'Lustria',Georgia,serif;font-size:clamp(22px,2.8vw,38px);color:#fff;line-height:1.2;max-width:18ch}
.twr-ag-join__actions{display:flex;gap:14px;flex-wrap:wrap}
.twr-ag-join__btn{display:inline-flex;align-items:center;gap:10px;background:#fff;color:#121212;text-decoration:none;font-weight:700;font-size:15px;padding:14px 26px;border-radius:999px;transition:transform .25s ease,background .25s ease}
.twr-ag-join__btn:hover{transform:translateY(-2px);background:#f0f0f0}
.twr-ag-join__btn--outline{background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.55)}
.twr-ag-join__btn--outline:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.8)}
.twr-ag-join__btn svg{width:18px;height:18px}

/* ---- Entrance animation ---- */
.twr-ag--anim .twr-ag-anim{opacity:0;transform:translateY(22px);transition:opacity .7s ease,transform .7s ease;transition-delay:var(--d,0s)}
.twr-ag--anim .twr-ag-anim.is-in{opacity:1;transform:none}
@media(prefers-reduced-motion:reduce){.twr-ag--anim .twr-ag-anim{opacity:1!important;transform:none!important;transition:none!important}}

/* ---- Responsive ---- */
@media(max-width:600px){
  .twr-ag-hero{min-height:clamp(480px,80vh,640px);border-radius:0 0 24px 24px}
  .twr-ag-grid{grid-template-columns:repeat(2,1fr);gap:12px}
  .twr-ag-card__info{padding:14px 14px 16px}
  .twr-ag-card__name{font-size:15px}
}
@media(max-width:380px){.twr-ag-grid{grid-template-columns:1fr}}

/* ============================================================
   FOOTER — identical to all pages
============================================================ */
.twr-footer,.twr-footer *,.twr-footer *::before,.twr-footer *::after{box-sizing:border-box;margin:0;padding:0}
.twr-footer{--twr-orange:#D05F28;font-family:'Inter Tight',system-ui,-apple-system,Segoe UI,Roboto,sans-serif;-webkit-font-smoothing:antialiased;margin:0 clamp(10px,1.4vw,18px);padding:clamp(24px,3vw,44px) 0 clamp(14px,2vw,22px)}
.twr-footer__card{position:relative;overflow:hidden;background:#0a0a0a;color:#fff;border-radius:28px;isolation:isolate}
.twr-footer__card::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 88% 8%,rgba(208,95,40,.16),transparent 48%);z-index:0;pointer-events:none}
.twr-footer__ghost{position:absolute;left:clamp(16px,3vw,48px);bottom:-0.16em;font-family:'Lustria',Georgia,serif;font-size:clamp(64px,15vw,280px);line-height:.8;letter-spacing:-0.02em;color:rgba(255,255,255,.035);white-space:nowrap;pointer-events:none;z-index:0}
.twr-footer__cta{position:relative;z-index:1;display:grid;grid-template-columns:1.45fr 1fr;gap:32px;align-items:center;padding:clamp(44px,5.5vw,82px) clamp(28px,3.6vw,60px) clamp(36px,4vw,52px);border-bottom:1px solid rgba(255,255,255,.1)}
.twr-footer__cta-title{font-family:'Lustria',Georgia,serif;font-weight:400;font-size:clamp(28px,3.4vw,50px);line-height:1.15;color:#fff;max-width:15ch}
.twr-footer__cta-actions{display:flex;align-items:center;justify-content:flex-end;gap:22px;flex-wrap:wrap}
.twr-footer__btn{display:inline-flex;align-items:center;gap:10px;background:var(--twr-orange);color:#fff;text-decoration:none;font-weight:600;font-size:15px;padding:14px 26px;border-radius:999px;transition:transform .25s ease,background .25s ease}
.twr-footer__btn:hover{transform:translateY(-2px);background:#e06c34}
.twr-footer__btn svg{width:18px;height:18px}
.twr-footer__calllink{display:inline-flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-weight:500;font-size:15px;opacity:.85;transition:opacity .2s ease}
.twr-footer__calllink:hover{opacity:1}
.twr-footer__main{position:relative;z-index:1;display:grid;grid-template-columns:1.6fr 1fr 1.1fr 1.2fr;gap:clamp(28px,3vw,52px);padding:clamp(40px,4.5vw,64px) clamp(28px,3.6vw,60px)}
.twr-footer__brand{max-width:320px}
.twr-footer__logo{display:inline-block;will-change:transform;animation:twr-foot-float 4.5s ease-in-out infinite}
.twr-footer__logo img{width:clamp(150px,15vw,196px);height:auto;display:block}
@keyframes twr-foot-float{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
.twr-footer__blurb{margin-top:22px;font-size:14.5px;line-height:1.7;color:rgba(255,255,255,.58);max-width:300px}
.twr-footer__social{display:flex;gap:10px;margin-top:26px}
.twr-footer__social a{width:40px;height:40px;border-radius:50%;border:1px solid rgba(255,255,255,.18);display:grid;place-items:center;color:#fff;transition:background .25s ease,border-color .25s ease,transform .25s ease,color .25s ease}
.twr-footer__social a:hover{background:var(--twr-orange);border-color:var(--twr-orange);transform:translateY(-3px)}
.twr-footer__social svg{width:15px;height:15px;fill:currentColor;display:block}
.twr-footer__h{font-size:12px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:20px}
.twr-footer__links{list-style:none;display:flex;flex-direction:column;gap:13px}
.twr-footer__links a{width:fit-content;display:inline-flex;align-items:center;color:rgba(255,255,255,.82);text-decoration:none;font-size:15px;transition:color .2s ease}
.twr-footer__links a::after{content:'→';color:var(--twr-orange);opacity:0;transform:translateX(-6px);margin-left:6px;transition:opacity .2s ease,transform .2s ease}
.twr-footer__links a:hover{color:#fff}
.twr-footer__links a:hover::after{opacity:1;transform:translateX(0)}
.twr-footer__addr{font-style:normal;font-size:14.5px;line-height:1.7;color:rgba(255,255,255,.62)}
.twr-footer__addr strong{color:rgba(255,255,255,.9);font-weight:500}
.twr-footer__sub{margin-top:20px}
.twr-footer__trec{display:flex;flex-direction:column;gap:14px}
.twr-footer__trec a{display:inline-flex;align-items:flex-start;gap:10px;color:rgba(255,255,255,.82);text-decoration:none;font-size:14.5px;line-height:1.4;transition:color .2s ease}
.twr-footer__trec a:hover{color:#fff}
.twr-footer__trec .twr-footer__arrow{color:var(--twr-orange);margin-top:1px;flex:none;transition:transform .25s ease}
.twr-footer__trec a:hover .twr-footer__arrow{transform:translateX(4px)}
.twr-footer__trec svg{width:16px;height:16px;display:block}
.twr-footer__bottom{position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:clamp(18px,2vw,22px) clamp(28px,3.6vw,60px);border-top:1px solid rgba(255,255,255,.1)}
.twr-footer__copy{font-size:13.5px;color:rgba(255,255,255,.5)}
.twr-footer__totop{display:inline-flex;align-items:center;gap:8px;color:rgba(255,255,255,.7);text-decoration:none;font-size:13.5px;transition:color .2s ease}
.twr-footer__totop:hover{color:#fff}
.twr-footer__totop svg{width:14px;height:14px;transition:transform .25s ease}
.twr-footer__totop:hover svg{transform:translateY(-3px)}
.twr-footer--anim .twr-foot-anim{opacity:0;transform:translateY(22px);transition:opacity .7s ease,transform .7s ease;transition-delay:var(--d,0s)}
.twr-footer--anim .twr-foot-anim.is-in{opacity:1;transform:none}
@media(prefers-reduced-motion:reduce){.twr-footer--anim .twr-foot-anim{opacity:1!important;transform:none!important;transition:none!important}.twr-footer__logo{animation:none!important}}
@media(max-width:1024px){.twr-footer__cta{grid-template-columns:1fr;gap:24px}.twr-footer__cta-actions{justify-content:flex-start}.twr-footer__main{grid-template-columns:1fr 1fr;gap:36px 28px}.twr-footer__brand{grid-column:1/-1}}
@media(max-width:620px){.twr-footer__main{grid-template-columns:1fr}.twr-footer__bottom{flex-direction:column;justify-content:center;text-align:center;gap:14px}.twr-footer__ghost{font-size:22vw}}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
@endpush
@section('content')

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
        <a class="twr-nav__link is-current" href="{{ route('website.agents') }}">Agents</a>
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
<!-- =====================  AGENTS PAGE  ===================== -->
<main class="twr-ag">

  <!-- HERO -->
  <section class="twr-ag-hero">
    <video class="twr-ag-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
      <source src="https://framerusercontent.com/assets/rs44TuJAYUuddUoUTCFk4Yr0ig.mp4" type="video/mp4">
    </video>
    <div class="twr-ag-hero__inner">
      <p class="twr-ag-hero__eyebrow twr-ag-anim" style="--d:0s">@content('agents.hero.eyebrow', 'Our Team')</p>
      <h1 class="twr-ag-hero__title twr-ag-anim" style="--d:.06s">@content('agents.hero.title', 'Experienced agents<br>you can trust')</h1>
      <p class="twr-ag-hero__lead twr-ag-anim" style="--d:.14s">
        @content('agents.hero.lead', 'Meet the Tower Team — licensed real estate agents with street-level knowledge of UT Austin housing, guiding thousands of students from search to signed lease, completely free.')
      </p>
      <div class="twr-ag-hero__actions twr-ag-anim" style="--d:.22s">
        <a class="twr-ag-btn" href="https://tower-leasing.com/properties/">
          Browse listings
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a class="twr-ag-btn twr-ag-btn--ghost" href="tel:+15129821560">Call 512-982-1560</a>
      </div>
    </div>
  </section>

  <!-- INTRO -->
  <section class="twr-ag-intro">
    <div>
      <p class="twr-ag-intro__eyebrow twr-ag-anim" style="--d:0s">@content('agents.intro.eyebrow', 'Who we are')</p>
      <h2 class="twr-ag-intro__title twr-ag-anim" style="--d:.06s">@content('agents.intro.title', 'Meet the Tower Team')</h2>
    </div>
    <div class="twr-ag-intro__body twr-ag-anim" style="--d:.1s">
      <p>@content('agents.intro.para1', 'The Tower Leasing team is a group of licensed real estate agents who help thousands of clients find housing around The University of Texas at Austin every year. Not only do we have "street level" knowledge — expert knowledge of every block near campus — but we know our properties inside and out.')</p>
      <p>@content('agents.intro.para2', "Our sister company, Tower Management Austin, manages all of the properties listed on our site, so you're in good hands not only during the leasing process but after, when you actually live in the property. When you set up a tour, one of our agents will assist you from start to finish — and our help is always completely free for students.")</p>
    </div>
  </section>

  <!-- SCARLETT — Chief Happiness Officer highlight -->
  <section class="twr-ag-chief">
    <div class="twr-ag-chief__card twr-ag-anim" style="--d:0s">
      <div class="twr-ag-chief__photo-side">
        <img class="twr-ag-chief__photo" src="https://tower-leasing.com/wp-content/uploads/2025/02/Scarlett.png" alt="Scarlett Coker" loading="lazy">
      </div>
      <div class="twr-ag-chief__content">
        <span class="twr-ag-chief__tag">
          <svg viewBox="0 0 20 20" fill="none"><path d="M10 2l2.4 4.8L18 7.6l-4 3.9 1 5.5L10 14.4l-5 2.6 1-5.5L2 7.6l5.6-.8L10 2z" fill="currentColor"/></svg>
          Chief Happiness Officer
        </span>
        <h2 class="twr-ag-chief__name">Scarlett Coker</h2>
        <p class="twr-ag-chief__title">Tower Leasing — Head of Student Experience</p>
        <p class="twr-ag-chief__desc">Scarlett leads the charge in making every student's housing journey feel effortless and exciting. With boundless energy and encyclopedic knowledge of West Campus life, she ensures every client feels at home before they even sign the lease.</p>
        <a class="twr-ag-chief__email" href="mailto:info@tower-leasing.com">
          <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
          info@tower-leasing.com
        </a>
      </div>
    </div>
  </section>

  <!-- AGENT GRID -->
  <section class="twr-ag-section">
    <div class="twr-ag-grid">

      <!-- J.T. Froese -->
      <div class="twr-ag-card twr-ag-anim" style="--d:0s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/01/JT-Frose.webp" alt="J.T. Froese" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:jt@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">J.T. Froese</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:jt@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            jt@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Anna Battles -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.04s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/07/Anna-Battles.jpg" alt="Anna Battles" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:anna@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Anna Battles</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:anna@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            anna@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- David Longoria -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.08s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/02/David-Longoria.png" alt="David Longoria" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:david@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">David Longoria</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:david@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            david@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Tessa Hurd -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.12s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/02/Tessa-Hurd.png" alt="Tessa Hurd" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:tessa@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Tessa Hurd</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:tessa@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            tessa@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Katie Greenman -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.04s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/01/Katie-Greenman.webp" alt="Katie Greenman" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:katie@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Katie Greenman</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:katie@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            katie@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Jeffrey Platt -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.08s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/02/Jeffrey-Platt.png" alt="Jeffrey Platt" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:jeffrey@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Jeffrey Platt</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:jeffrey@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            jeffrey@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Nick Winkley -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.12s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/02/Nick-Winkley.png" alt="Nick Winkley" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:nick@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Nick Winkley</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:nick@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            nick@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Gabriel Kadoori -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.16s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/01/Gabriel-Kadoori.webp" alt="Gabriel Kadoori" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:gabriel@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Gabriel Kadoori</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:gabriel@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            gabriel@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Hannah Holliday -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.04s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/04/Hannah-Holliday-.png" alt="Hannah Holliday" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:hannah@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Hannah Holliday</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:hannah@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            hannah@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Max Meizlik -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.08s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/04/Max-Meizlik.jpg" alt="Max Meizlik" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:max@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Max Meizlik</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:max@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            max@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Gabrielle Kaplan -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.12s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/04/Gabrielle-Kaplan.png" alt="Gabrielle Kaplan" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:gabrielle@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Gabrielle Kaplan</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:gabrielle@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            gabrielle@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Evan O'Neil -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.16s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/04/Evan-ONeil.jpg" alt="Evan O'Neil" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:evan@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Evan O'Neil</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:evan@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            evan@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Jack Howard -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.04s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/04/Jack-Howard.jpg" alt="Jack Howard" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:jack@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Jack Howard</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:jack@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            jack@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- David Velasquez -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.08s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/05/David-Velasquez.jpg" alt="David Velasquez" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:david@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">David Velasquez</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:david@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            david@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Caleb Popelka -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.12s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/07/Caleb.jpg" alt="Caleb Popelka" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:caleb@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Caleb Popelka</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:caleb@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            caleb@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Trey Carillo -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.16s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/07/Trey-Carillo.jpg" alt="Trey Carillo" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:trey@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Trey Carillo</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:trey@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            trey@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Sania Gupta -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.04s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/09/Sania-Gupta.jpg" alt="Sania Gupta" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:sania@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Sania Gupta</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:sania@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            sania@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Landon Von Minden -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.08s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/09/Landon-Von-Minden.jpg" alt="Landon Von Minden" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:landon@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Landon Von Minden</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:landon@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            landon@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Benjamin Levine -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.12s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/10/Benjamin-Levine.jpg" alt="Benjamin Levine" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:benjamin@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Benjamin Levine</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:benjamin@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            benjamin@tower-leasing.com
          </a>
        </div>
      </div>

      <!-- Rachel Harris -->
      <div class="twr-ag-card twr-ag-anim" style="--d:.16s">
        <div class="twr-ag-card__photo-wrap">
          <img class="twr-ag-card__photo" src="https://tower-leasing.com/wp-content/uploads/2025/10/Rachel-Harris.jpg" alt="Rachel Harris" loading="lazy">
          <div class="twr-ag-card__overlay">
            <a class="twr-ag-card__email-link" href="mailto:rachel@tower-leasing.com">
              <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
              Send email
            </a>
          </div>
        </div>
        <div class="twr-ag-card__info">
          <p class="twr-ag-card__name">Rachel Harris</p>
          <p class="twr-ag-card__role">Leasing Agent</p>
          <a class="twr-ag-card__email" href="mailto:rachel@tower-leasing.com">
            <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="4" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m2 7 8 5 8-5" stroke="currentColor" stroke-width="1.5"/></svg>
            rachel@tower-leasing.com
          </a>
        </div>
      </div>

    </div><!-- /grid -->
  </section>

  <!-- JOIN BANNER -->
  <section class="twr-ag-join">
    <div class="twr-ag-join__card twr-ag-anim" style="--d:0s">
      <h2 class="twr-ag-join__title">Want to join the Tower Team?</h2>
      <div class="twr-ag-join__actions">
        <a class="twr-ag-join__btn" href="{{ route('website.become-agent') }}">
          Become an agent
          <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <a class="twr-ag-join__btn twr-ag-join__btn--outline" href="mailto:info@tower-leasing.com">Contact us</a>
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

<script>
/* 1) HEADER */
(function(){
  var h=document.getElementById('twrHeader');if(!h)return;
  var t=h.querySelector('.twr-header__toggle');
  function sc(){h.classList.toggle('is-scrolled',window.scrollY>24)}sc();
  window.addEventListener('scroll',sc,{passive:true});
  if(t){
    t.addEventListener('click',function(){var o=h.classList.toggle('is-menu-open');t.setAttribute('aria-expanded',o?'true':'false')});
    h.querySelectorAll('.twr-header__mobile a').forEach(function(a){a.addEventListener('click',function(){h.classList.remove('is-menu-open');t.setAttribute('aria-expanded','false')})});
  }
  var mi=h.querySelector('.twr-nav__item'),mb=h.querySelector('.twr-nav__more');
  if(mi&&mb){['mouseenter','mouseleave','focusin','focusout'].forEach(function(ev){mi.addEventListener(ev,function(){mb.setAttribute('aria-expanded',mi.matches(':hover,:focus-within')?'true':'false')})})}
})();

/* 2) AGENTS PAGE entrance reveal */
(function(){
  var page=document.querySelector('.twr-ag');if(!page)return;
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches;
  if(reduce||!('IntersectionObserver' in window))return;
  page.classList.add('twr-ag--anim');
  var io=new IntersectionObserver(function(entries){entries.forEach(function(en){if(en.isIntersecting){en.target.classList.add('is-in');io.unobserve(en.target)}})},{threshold:0.1});
  page.querySelectorAll('.twr-ag-hero .twr-ag-anim').forEach(function(el){requestAnimationFrame(function(){requestAnimationFrame(function(){el.classList.add('is-in')})})});
  page.querySelectorAll('.twr-ag-anim:not(.twr-ag-hero .twr-ag-anim)').forEach(function(el){io.observe(el)});
})();

/* 3) FOOTER */
(function(){
  var f=document.querySelector('.twr-footer');if(!f)return;
  var y=document.getElementById('twrYear');if(y)y.textContent=new Date().getFullYear();
  var tt=f.querySelector('.twr-footer__totop');
  if(tt)tt.addEventListener('click',function(e){e.preventDefault();window.scrollTo({top:0,behavior:'smooth'})});
  var reduce=window.matchMedia('(prefers-reduced-motion:reduce)').matches;
  if(reduce||!('IntersectionObserver' in window))return;
  f.classList.add('twr-footer--anim');
  var io=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){f.querySelectorAll('.twr-foot-anim').forEach(function(el){el.classList.add('is-in')});io.disconnect()}})},{threshold:0.12});
  io.observe(f);
})();
</script>
</div>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script>
<script src="assets/locomotive-init.js"></script>
@endsection
