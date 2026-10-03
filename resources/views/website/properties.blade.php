@extends('layouts.website')
@section('title', 'Listings | Tower Realty Austin')
@push('head')

<!-- ============================================================
     FONTS — same as index.html
     Lustria     = serif headline
     Inter Tight = sans nav + body
============================================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Lustria&display=swap" rel="stylesheet">

<style>
/* ============================================================
   TOWER REALTY — GLOBAL SCOPE (reused from index.html)
============================================================ */
.twr-wrap,
.twr-wrap *,
.twr-wrap *::before,
.twr-wrap *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.twr-wrap {
  --twr-ink:       #121212;
  --twr-body:      #333333;
  --twr-muted:     #5b5b5b;
  --twr-accent:    #D05F28;
  --twr-pill:      #101010;
  --twr-dot:       #34c759;
  --twr-max:       1480px;

  font-family: 'Inter Tight', system-ui, -apple-system, Roboto, sans-serif;
  color: var(--twr-ink);
  -webkit-font-smoothing: antialiased;
}

/* ============================================================
   HEADER (identical to index.html)
============================================================ */
.twr-header {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  padding: 20px clamp(14px, 2.2vw, 30px);
}
.twr-header__bar {
  position: relative;
  display: flex;
  align-items: center;
  gap: 24px;
  max-width: var(--twr-max);
  margin: 0 auto;
  padding: 9px 12px 9px 28px;
  border-radius: 999px;
  background: #ffffff;
  box-shadow: 0 0 0 rgba(0,0,0,0);
  transition: box-shadow .35s ease;
}
.twr-header.is-scrolled .twr-header__bar {
  box-shadow: 0 18px 50px -20px rgba(20,20,20,.28);
}
.twr-header__logo { display: inline-flex; align-items: center; flex: none; }
.twr-header__logo img { height: 48px; width: auto; display: block; }
.twr-nav {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: clamp(12px, 1.7vw, 28px);
}
.twr-nav__link {
  font-family: 'Inter Tight', sans-serif;
  font-size: 15px;
  font-weight: 500;
  color: var(--twr-ink);
  text-decoration: none;
  white-space: nowrap;
  background: none;
  border: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: color .2s ease;
}
.twr-nav__link:hover { color: var(--twr-muted); }
.twr-nav__link.is-current { color: var(--twr-accent); }
.twr-nav__item { position: relative; }
.twr-nav__chev { width: 10px; height: 10px; transition: transform .25s ease; }
.twr-nav__item:hover .twr-nav__chev,
.twr-nav__item:focus-within .twr-nav__chev { transform: rotate(180deg); }
.twr-nav__sub {
  position: absolute;
  top: calc(100% + 14px);
  left: 50%;
  transform: translateX(-50%) translateY(6px);
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 20px 50px -20px rgba(0,0,0,.3);
  padding: 8px;
  min-width: 214px;
  display: flex;
  flex-direction: column;
  gap: 2px;
  opacity: 0;
  pointer-events: none;
  transition: opacity .2s ease, transform .2s ease;
}
.twr-nav__sub::before { content: ''; position: absolute; top: -14px; left: 0; right: 0; height: 14px; }
.twr-nav__item:hover .twr-nav__sub,
.twr-nav__item:focus-within .twr-nav__sub { opacity: 1; pointer-events: auto; transform: translateX(-50%) translateY(0); }
.twr-nav__sub a {
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px; font-weight: 500; color: var(--twr-ink);
  text-decoration: none; padding: 9px 12px; border-radius: 9px;
  white-space: nowrap; transition: background .15s ease;
}
.twr-nav__sub a:hover { background: #f4f4f4; }
.twr-agent {
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--twr-pill);
  color: #fff;
  border-radius: 999px;
  padding: 6px 6px 6px 10px;
  flex: none;
}
.twr-agent__avatar {
  position: relative;
  width: 38px; height: 38px;
  border-radius: 50%;
  overflow: hidden;
  flex: none;
  background: #d9dde1;
}
.twr-agent__avatar img { width: 100%; height: 100%; object-fit: cover; object-position: center 28%; display: block; }
.twr-agent__dot {
  position: absolute;
  top: 1px; left: 1px;
  width: 9px; height: 9px;
  border-radius: 50%;
  background: var(--twr-dot);
  box-shadow: 0 0 0 2px var(--twr-pill);
}
.twr-agent__meta { display: flex; flex-direction: column; line-height: 1.15; padding-right: 4px; }
.twr-agent__name { font-size: 13.5px; font-weight: 600; }
.twr-agent__role { font-size: 11.5px; color: #b9b9b9; }
.twr-agent__btn {
  background: #fff;
  color: #111;
  text-decoration: none;
  font-size: 13.5px;
  font-weight: 600;
  padding: 9px 16px;
  border-radius: 999px;
  white-space: nowrap;
  transition: background .2s ease, transform .2s ease;
}
.twr-agent__btn:hover { background: #efefef; transform: translateY(-1px); }
.twr-header__toggle {
  display: none;
  width: 44px; height: 44px;
  border: none; background: transparent;
  flex-direction: column; justify-content: center; align-items: center;
  gap: 5px; cursor: pointer; border-radius: 12px; flex: none;
}
.twr-header__toggle span {
  width: 22px; height: 2px; background: var(--twr-ink); border-radius: 2px;
  transition: transform .3s ease, opacity .25s ease;
}
.twr-header.is-menu-open .twr-header__toggle span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.twr-header.is-menu-open .twr-header__toggle span:nth-child(2) { opacity: 0; }
.twr-header.is-menu-open .twr-header__toggle span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.twr-header__mobile {
  display: none;
  position: absolute;
  top: 100%; left: clamp(14px,2.2vw,30px); right: clamp(14px,2.2vw,30px);
  margin-top: 10px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 24px 60px -24px rgba(0,0,0,.3);
  padding: 14px;
  flex-direction: column;
  gap: 4px;
  opacity: 0;
  transform: translateY(-8px);
  pointer-events: none;
  transition: opacity .25s ease, transform .25s ease;
}
.twr-header.is-menu-open .twr-header__mobile { opacity: 1; transform: none; pointer-events: auto; }
.twr-header__mobile a {
  font-size: 16px; font-weight: 500; color: var(--twr-ink);
  text-decoration: none; padding: 11px 12px; border-radius: 12px;
  transition: background .15s ease;
}
.twr-header__mobile a:hover { background: #f4f4f4; }
.twr-mobile-dropdown{display:flex;flex-direction:column}.twr-mobile-dropdown__toggle{width:100%;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:11px 12px;border:0;border-radius:12px;background:transparent;color:var(--twr-ink);font:inherit;font-size:16px;font-weight:500;text-align:left;cursor:pointer}.twr-mobile-dropdown__toggle:hover{background:#f4f4f4}.twr-mobile-dropdown__toggle svg{width:12px;height:12px;transition:transform .25s ease}.twr-mobile-dropdown.is-open .twr-mobile-dropdown__toggle svg{transform:rotate(180deg)}.twr-mobile-dropdown__panel{display:grid;grid-template-rows:0fr;transition:grid-template-rows .3s ease}.twr-mobile-dropdown.is-open .twr-mobile-dropdown__panel{grid-template-rows:1fr}.twr-mobile-dropdown__inner{min-height:0;overflow:hidden;display:flex;flex-direction:column}.twr-header__mobile .twr-mobile-dropdown__inner a{margin-left:12px;padding-left:18px;font-size:14px;color:var(--twr-muted);border-left:2px solid #ececec;border-radius:0 10px 10px 0}
.twr-header__mobile .twr-mobile-btn {
  margin-top: 8px; text-align: center; background: var(--twr-pill);
  color: #fff; font-weight: 600;
}
.twr-header__mobile .twr-mobile-btn:hover { background: #000; }

/* ============================================================
   PAGE HERO — background video variant (same clip as about.html)
============================================================ */
.twr-phero {
  position: relative;
  margin: 0 clamp(10px, 1.4vw, 18px);
  min-height: clamp(560px, 84vh, 780px);
  border-radius: 0 0 32px 32px;
  overflow: hidden;
  background: #0a0a0a;
  display: flex;
  align-items: center;
  justify-content: center;
}
.twr-phero__video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}
.twr-phero::after {
  content: '';
  position: absolute;
  inset: 0;
  z-index: 1;
  background: linear-gradient(180deg, rgba(0,0,0,.58) 0%, rgba(0,0,0,.48) 45%, rgba(0,0,0,.58) 100%);
  pointer-events: none;
}
.twr-phero__inner {
  position: relative;
  z-index: 2;
  max-width: 980px;
  margin: 0 auto;
  padding: clamp(140px, 19vh, 200px) clamp(28px, 3vw, 56px) clamp(60px, 8vh, 96px);
  display: flex;
  flex-direction: column;
  gap: 22px;
  text-align: center;
  align-items: center;
}
.twr-phero__eyebrow {
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(14px, 1.1vw, 17px);
  color: #fff;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.twr-phero__title {
  font-family: 'Lustria', Georgia, serif;
  font-weight: 400;
  font-size: clamp(34px, 5vw, 56px);
  line-height: 1.18;
  letter-spacing: 0;
  color: #fff;
  max-width: 780px;
}
.twr-phero__lead {
  max-width: 680px;
  font-family: 'Inter Tight', sans-serif;
  font-weight: 400;
  font-size: clamp(15.5px, 1.25vw, 19px);
  line-height: 1.75;
  color: #fff;
}
.twr-phero__lead + .twr-phero__lead { margin-top: -10px; }
.twr-phero__questions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
  margin-top: 6px;
}
.twr-phero__question {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.28);
  border-radius: 999px;
  padding: 9px 16px 9px 12px;
  backdrop-filter: blur(6px);
}
.twr-phero__question svg { width: 15px; height: 15px; color: #f0934f; flex: none; }

/* ============================================================
   PROPERTIES INTRO — image trio + statement
============================================================ */
.twr-pintro {
  padding: clamp(56px, 7vw, 96px) clamp(24px, 4vw, 72px);
  max-width: var(--twr-max);
  margin: 0 auto;
}
.twr-pintro__inner {
  display: grid;
  grid-template-columns: 1.05fr 1fr;
  gap: clamp(36px, 5vw, 64px);
  align-items: center;
}
.twr-pintro__gallery {
  position: relative;
  display: grid;
  grid-template-columns: 1.3fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 14px;
  height: clamp(360px, 42vw, 520px);
}
.twr-pintro__img {
  border-radius: 18px;
  overflow: hidden;
  background: #f1f1f1;
}
.twr-pintro__img img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.twr-pintro__img--main { grid-row: 1 / 3; }
.twr-pintro__badge {
  position: absolute;
  left: 18px; bottom: 18px;
  z-index: 3;
  background: #fff;
  border-radius: 16px;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: 0 24px 50px -20px rgba(0,0,0,.28);
}
.twr-pintro__badge-num { font-family: 'Lustria', Georgia, serif; font-size: 26px; color: var(--twr-ink); line-height: 1; }
.twr-pintro__badge-lbl { font-size: 11.5px; color: var(--twr-muted); text-transform: uppercase; letter-spacing: .04em; max-width: 90px; line-height: 1.3; }
.twr-pintro__content { display: flex; flex-direction: column; gap: 20px; }
.twr-pintro__eyebrow {
  font-family: 'Lustria', Georgia, serif;
  font-size: 15px;
  color: var(--twr-muted);
  letter-spacing: .04em;
  text-transform: uppercase;
}
.twr-pintro__heading {
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(26px, 3vw, 38px);
  line-height: 1.32;
  color: var(--twr-ink);
}
.twr-pintro__text {
  font-family: 'Inter Tight', sans-serif;
  font-size: clamp(15.5px, 1.2vw, 17px);
  line-height: 1.75;
  color: var(--twr-muted);
  max-width: 560px;
}
.twr-pintro__pills { display: flex; flex-wrap: wrap; gap: 10px; padding-top: 6px; }
.twr-pintro__pill {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 13.5px; font-weight: 500; color: var(--twr-ink);
  background: #f5f0ec; border-radius: 999px; padding: 9px 16px 9px 13px;
}
.twr-pintro__pill svg { width: 14px; height: 14px; color: var(--twr-accent); flex: none; }

/* ============================================================
   FILTER BAR — sticky-ish category + search filters
============================================================ */
.twr-filters {
  margin: 0 clamp(10px, 1.4vw, 18px);
  padding: 0 clamp(24px, 4vw, 56px) clamp(8px, 1vw, 14px);
  max-width: calc(var(--twr-max) + 48px);
  margin-left: auto; margin-right: auto;
}
.twr-filters__card {
  background: #f7f5f2;
  border-radius: 24px;
  padding: clamp(20px, 2.2vw, 28px) clamp(22px, 2.6vw, 32px);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 16px 22px;
  box-shadow: 0 30px 70px -36px rgba(18,18,18,.18);
}
.twr-filters__group { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.twr-filters__label {
  font-family: 'Inter Tight', sans-serif;
  font-size: 12px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;
  color: var(--twr-muted); margin-right: 4px; flex: none;
}
.twr-chip {
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px; font-weight: 500;
  color: var(--twr-ink);
  background: #fff;
  border: 1px solid rgba(18,18,18,.1);
  border-radius: 999px;
  padding: 9px 18px;
  cursor: pointer;
  transition: background .25s ease, color .25s ease, border-color .25s ease, transform .2s ease, box-shadow .25s ease;
  white-space: nowrap;
}
.twr-chip:hover { transform: translateY(-1px); border-color: rgba(18,18,18,.22); box-shadow: 0 10px 22px -14px rgba(0,0,0,.2); }
.twr-chip.is-active { background: var(--twr-accent); color: #fff; border-color: var(--twr-accent); box-shadow: 0 14px 28px -14px rgba(208,95,40,.5); }
.twr-filters__search {
  margin-left: auto;
  display: flex; align-items: center; gap: 10px;
  background: #fff; border: 1px solid rgba(18,18,18,.1);
  border-radius: 999px; padding: 10px 16px;
  min-width: 220px; flex: 1 1 220px; max-width: 320px;
}
.twr-filters__search svg { width: 16px; height: 16px; color: var(--twr-muted); flex: none; }
.twr-filters__search input {
  border: none; outline: none; background: none;
  font-family: 'Inter Tight', sans-serif; font-size: 14px; color: var(--twr-ink);
  width: 100%;
}
.twr-filters__search input::placeholder { color: #a3a3a3; }
.twr-filters__count {
  font-family: 'Inter Tight', sans-serif; font-size: 13.5px; color: var(--twr-muted);
  margin: clamp(10px, 2vw, 16px) clamp(24px, 4vw, 56px) 0;
  max-width: calc(var(--twr-max) + 48px); margin-left: auto; margin-right: auto;
  padding: 0 clamp(24px, 4vw, 56px);
}
.twr-filters__count strong { color: var(--twr-ink); font-weight: 600; }

/* Sidebar filter panel (matches reference design) */
.twr-listings-layout {
  display: grid;
  grid-template-columns: minmax(240px, 280px) 1fr;
  gap: clamp(24px, 3vw, 40px);
  padding: clamp(28px, 3.4vw, 44px) clamp(24px, 4vw, 56px) clamp(72px, 8vw, 112px);
  max-width: var(--twr-max);
  margin: 0 auto;
  align-items: start;
}
.twr-sidebar {
  background: #fff;
  border: 1px solid rgba(18,18,18,.08);
  border-radius: 20px;
  padding: 22px 20px;
  box-shadow: 0 24px 60px -32px rgba(18,18,18,.12);
  position: sticky;
  top: 100px;
}
.twr-sidebar .property-filters { display: flex; flex-direction: column; gap: 14px; margin: 0; padding: 0; background: none; border: 0; }
.twr-sidebar .property-filters__select {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid rgba(18,18,18,.12);
  border-radius: 10px;
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px;
  color: var(--twr-muted);
  background: #fff;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%235b5b5b' stroke-width='1.5'%3E%3Cpath d='M2.5 4.5 6 8l3.5-3.5'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
}
.twr-sidebar .property-filters__range-head { display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 10px; }
.twr-sidebar .property-filters__range-label { font-weight: 600; color: var(--twr-ink); }
.twr-sidebar .property-filters__range-value { color: var(--twr-accent); font-weight: 600; }
.twr-sidebar .property-filters__slider { position: relative; height: 28px; }
.twr-sidebar .property-filters__range-input {
  position: absolute; width: 100%; pointer-events: none; appearance: none; height: 4px;
  background: #ece7e2; border-radius: 4px; top: 12px;
}
.twr-sidebar .property-filters__range-input::-webkit-slider-thumb {
  pointer-events: auto; appearance: none; width: 18px; height: 18px; border-radius: 50%;
  background: var(--twr-accent); cursor: pointer; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(208,95,40,.35);
}
.twr-sidebar .property-filters__amenities { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }
.twr-sidebar .property-filters__amenities-title { font-family: 'Inter Tight', sans-serif; font-size: 14px; font-weight: 700; color: var(--twr-ink); }
.twr-sidebar .property-filters__check { display: flex; align-items: center; gap: 10px; font-size: 14px; color: var(--twr-body); cursor: pointer; }
.twr-sidebar .property-filters__check input { width: 16px; height: 16px; accent-color: var(--twr-accent); }
.twr-sidebar .property-filters__actions { display: flex; flex-direction: column; gap: 10px; margin-top: 6px; }
.twr-sidebar .property-filters__btn {
  width: 100%; padding: 12px; border: 0; border-radius: 10px; background: var(--twr-accent); color: #fff;
  font-family: 'Inter Tight', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer;
}
.twr-sidebar .property-filters__clear { text-align: center; font-size: 13px; color: var(--twr-muted); text-decoration: none; }
.twr-listings-main { min-width: 0; }
.twr-listings-main__count { font-size: 13.5px; color: var(--twr-muted); margin-bottom: 18px; }
.twr-listings-main__count strong { color: var(--twr-ink); }
.twr-pagination { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 32px; justify-content: center; }
.twr-pagination a, .twr-pagination span {
  padding: 8px 14px; border-radius: 8px; font-size: 14px; text-decoration: none;
  border: 1px solid rgba(18,18,18,.1); color: var(--twr-ink);
}
.twr-pagination span.current { background: var(--twr-accent); color: #fff; border-color: var(--twr-accent); }
@media (max-width: 900px) {
  .twr-listings-layout { grid-template-columns: 1fr; }
  .twr-sidebar { position: static; }
}

/* ============================================================
   LISTINGS GRID — enhanced cards (image + meta + tags + CTA)
============================================================ */
.twr-glisting {
  padding: 0;
  max-width: none;
  margin: 0;
}
.twr-glisting__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.twr-gcard {
  background: #fff;
  border: 1px solid #eee;
  border-radius: 22px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  opacity: 0;
  transform: translateY(26px);
  transition: opacity .6s ease, transform .6s ease, box-shadow .4s ease, border-color .4s ease;
}
.twr-gcard.is-visible { opacity: 1; transform: translateY(0); }
.twr-gcard:hover { box-shadow: 0 36px 80px -30px rgba(0,0,0,.22); border-color: #fff; transform: translateY(-4px); }
.twr-gcard.is-hidden { display: none; }
.twr-gcard__media { position: relative; height: 248px; overflow: hidden; }
.twr-gcard__media img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform .6s ease; }
.twr-gcard:hover .twr-gcard__media img { transform: scale(1.06); }
.twr-gcard__cat {
  position: absolute; top: 14px; left: 14px; z-index: 2;
  background: rgba(255,255,255,.92); color: var(--twr-ink);
  font-size: 12px; font-weight: 600; letter-spacing: .03em;
  padding: 7px 13px; border-radius: 999px;
}
.twr-gcard__fav {
  position: absolute; top: 14px; right: 14px; z-index: 2;
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(0,0,0,.32); backdrop-filter: blur(4px);
  display: grid; place-items: center; color: #fff;
}
.twr-gcard__fav svg { width: 16px; height: 16px; }
.twr-gcard__price {
  position: absolute; bottom: 14px; left: 14px; z-index: 2;
  background: var(--twr-ink); color: #fff;
  font-family: 'Lustria', Georgia, serif; font-size: 17px;
  padding: 8px 14px; border-radius: 12px;
}
.twr-gcard__price span { font-family: 'Inter Tight', sans-serif; font-size: 11.5px; color: rgba(255,255,255,.62); margin-left: 4px; }
.twr-gcard__body { padding: 20px 22px 22px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
.twr-gcard__name { font-family: 'Lustria', Georgia, serif; font-size: 21px; font-weight: 400; line-height: 1.25; color: var(--twr-ink); }
.twr-gcard__name a { color: inherit; text-decoration: none; }
.twr-gcard__name a:hover { color: var(--twr-accent); }
.twr-gcard__loc { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--twr-muted); }
.twr-gcard__loc svg { width: 13px; height: 13px; color: var(--twr-accent); flex: none; }
.twr-gcard__desc { font-size: 13.5px; line-height: 1.6; color: #6b6b6b; flex: 1; }
.twr-gcard__specs { display: flex; gap: 16px; padding-top: 10px; border-top: 1px solid #efefef; }
.twr-gcard__spec { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--twr-muted); }
.twr-gcard__spec svg { width: 14px; height: 14px; color: var(--twr-ink); opacity: .55; flex: none; }
.twr-gcard__cta {
  margin-top: 6px;
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  background: var(--twr-ink); color: #fff; text-decoration: none;
  font-size: 14px; font-weight: 600; padding: 12px 18px; border-radius: 999px;
  transition: background .2s ease, transform .2s ease;
}
.twr-gcard__cta:hover { background: var(--twr-accent); transform: translateY(-1px); }
.twr-gcard__cta svg { width: 15px; height: 15px; }

.twr-glisting__empty {
  display: none;
  text-align: center;
  padding: clamp(48px, 6vw, 80px) 20px;
  font-family: 'Lustria', Georgia, serif;
  font-size: 22px;
  color: var(--twr-muted);
}
.twr-glisting__empty.is-visible { display: block; }

/* ============================================================
   SHARED ENTRANCE ANIMATION
============================================================ */
.twr-wrap--anim .twr-anim {
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s ease, transform .7s ease;
  transition-delay: var(--d, 0s);
}
.twr-wrap--anim .twr-anim.is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .twr-wrap--anim .twr-anim {
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
  }
}

/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 1100px) {
  .twr-glisting__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 1024px) {
  .twr-nav, .twr-agent { display: none; }
  .twr-header__toggle { display: inline-flex; margin-left: auto; }
  .twr-header__mobile { display: flex; }
  .twr-pintro__inner { grid-template-columns: 1fr; gap: 32px; }
  .twr-pintro__gallery { order: 2; height: clamp(320px, 70vw, 420px); }
}
@media (max-width: 860px) {
  .twr-phero__inner { padding-top: clamp(110px, 17vh, 156px); }
  .twr-filters__card { padding: 16px; }
  .twr-filters__search { max-width: 100%; flex: 1 1 100%; order: 5; }
  .twr-glisting__grid { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  .twr-pintro__badge { padding: 10px 14px; }
  .twr-pintro__badge-num { font-size: 20px; }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
@endpush
@section('content')

<!-- ============================================================
     TOWER REALTY AUSTIN — LISTINGS PAGE
============================================================ -->
<div class="twr-wrap">

  <!-- ==========================================================
       HEADER (identical to index.html)
  ========================================================== -->
  <header class="twr-header" id="twrHeader">
    <div class="twr-header__bar">

      <a class="twr-header__logo" href="{{ route('home') }}" aria-label="Tower Realty Austin home">
        <img src="https://tower-leasing.com/wp-content/uploads/2025/01/cropped-Tower-Leasing-1.png"
             alt="Tower Realty Austin">
      </a>

      <nav class="twr-nav" aria-label="Primary">
        <a class="twr-nav__link" href="{{ route('home') }}">Home</a>
        <a class="twr-nav__link" href="{{ route('website.about') }}">About</a>
        <a class="twr-nav__link is-current" href="{{ route('website.properties') }}">Properties</a>
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
<div class="twr-wrap">

  <!-- ==========================================================
       PAGE HERO
  ========================================================== -->
  <section class="twr-phero">
    <video class="twr-phero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
      <source src="https://framerusercontent.com/assets/rs44TuJAYUuddUoUTCFk4Yr0ig.mp4" type="video/mp4">
    </video>
    <div class="twr-phero__inner">
      <p class="twr-phero__eyebrow twr-anim" style="--d:.02s">@content('properties.hero.eyebrow', 'Exclusive Listings')</p>
      <h1 class="twr-phero__title twr-anim" style="--d:.08s">@content('properties.hero.title', 'About Our Properties')</h1>
      <p class="twr-phero__lead twr-anim" style="--d:.16s">
        @content('properties.hero.lead1', "Tower Leasing's exclusive listings cater to students looking to save money while living in quality spaces. Our properties are individually owned and are managed by a small, dedicated team of UT alumni (hook 'em!) — all of whom are experienced and highly qualified property managers.")
      </p>
      <p class="twr-phero__lead twr-anim" style="--d:.22s">
        @content('properties.hero.lead2', "Whether you want to cozy up in a spacious one bedroom loft (fireplace &amp; parking included) or a larger house perfect for you and your friends to throw epic parties, Tower Leasing's exclusive listings has the perfect space for every student.")
      </p>
      <div class="twr-phero__questions twr-anim" style="--d:.3s">
        <span class="twr-phero__question">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6.3"/><path d="M8 11v.01M8 8.4c0-1.6 1.8-1.4 1.8-3a1.8 1.8 0 0 0-3.6 0"/></svg>
          Tired of overpriced high-rises?
        </span>
        <span class="twr-phero__question">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6.3"/><path d="M8 11v.01M8 8.4c0-1.6 1.8-1.4 1.8-3a1.8 1.8 0 0 0-3.6 0"/></svg>
          Sick of waiting on maintenance?
        </span>
        <span class="twr-phero__question">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6.3"/><path d="M8 11v.01M8 8.4c0-1.6 1.8-1.4 1.8-3a1.8 1.8 0 0 0-3.6 0"/></svg>
          Fed up with cramped rooms?
        </span>
      </div>
    </div>
  </section>

  <!-- ==========================================================
       PROPERTIES INTRO — gallery + statement
  ========================================================== -->
  <section class="twr-pintro">
    <div class="twr-pintro__inner">

      <div class="twr-pintro__gallery twr-anim" style="--d:.05s">
        <div class="twr-pintro__img twr-pintro__img--main">
          <img src="https://tower-leasing.com/wp-content/uploads/2025/02/GetMedia-3.ashx-2.jpeg"
               alt="Spacious one bedroom loft with fireplace, Tower Leasing exclusive" loading="lazy">
        </div>
        <div class="twr-pintro__img">
          <img src="https://tower-leasing.com/wp-content/uploads/2025/02/3879600_5.jpg"
               alt="Bright shared living space for student housemates" loading="lazy">
        </div>
        <div class="twr-pintro__img">
          <img src="https://tower-leasing.com/wp-content/uploads/2025/02/GetMedia-1.ashx-1.jpeg"
               alt="Larger student house, perfect for friends" loading="lazy">
        </div>
        <div class="twr-pintro__badge">
          <span class="twr-pintro__badge-num">100%</span>
          <span class="twr-pintro__badge-lbl">UT alumni managed</span>
        </div>
      </div>

      <div class="twr-pintro__content">
        <p class="twr-pintro__eyebrow twr-anim" style="--d:.05s">Quality, Not Compromise</p>
        <h2 class="twr-pintro__heading twr-anim" style="--d:.1s">
          Individually owned properties, managed by people who actually went here.
        </h2>
        <p class="twr-pintro__text twr-anim" style="--d:.16s">
          No corporate call centers, no cookie-cutter floor plans. Every Tower Leasing
          listing is hand-managed by a small team that knows West Campus, Hyde Park, and
          Riverside inside and out — because we lived there too.
        </p>
        <div class="twr-pintro__pills twr-anim" style="--d:.22s">
          <span class="twr-pintro__pill">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M2 6.5 8 2l6 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6.5Z"/></svg>
            Individually owned
          </span>
          <span class="twr-pintro__pill">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg>
            Fast maintenance response
          </span>
          <span class="twr-pintro__pill">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M1 11c1.5-2 3.5-2 5 0s3.5 2 5 0 3.5-2 5 0"/><rect x="5" y="2" width="6" height="7" rx="1"/></svg>
            Fireplace &amp; parking options
          </span>
          <span class="twr-pintro__pill">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M2 8a6 6 0 1 0 12 0A6 6 0 0 0 2 8Z"/><circle cx="8" cy="8" r="2.2"/></svg>
            Lofts to full houses
          </span>
        </div>
      </div>

    </div>
  </section>

  <!-- ==========================================================
       FILTERS + LISTINGS
  ========================================================== -->
  <section class="twr-listings-layout">
    <aside class="twr-sidebar twr-anim" style="--d:.05s">
      @include('partials.property-filters', [
          'action' => route('website.properties'),
          'options' => $options,
          'amenities' => $amenities,
          'filters' => request()->only(['city', 'property_type', 'beds', 'baths', 'min_price', 'max_price', 'amenities', 'search']),
      ])
    </aside>

    <div class="twr-listings-main">
      <p class="twr-listings-main__count">
        Showing <strong>{{ $properties->count() }}</strong> of <strong>{{ $properties->total() }}</strong> properties
      </p>

      <div class="twr-glisting__grid" id="twrListingsGrid">
        @forelse ($properties as $property)
          @php
            $typeLabel = \App\Support\PropertyFilter::TYPES[$property->property_type] ?? 'Property';
            $bedLabel = $property->min_bedrooms == $property->max_bedrooms
                ? ($property->min_bedrooms == 0 ? 'Studio' : $property->min_bedrooms.'BR')
                : ($property->min_bedrooms == 0 ? 'Studio' : $property->min_bedrooms.'BR').' – '.$property->max_bedrooms.'BR';
            $available = $property->min_available_on ? \Illuminate\Support\Carbon::parse($property->min_available_on)->format('M Y') : 'Now';
          @endphp
          <article class="twr-gcard is-visible">
            <div class="twr-gcard__media">
              <span class="twr-gcard__cat">{{ $typeLabel }}</span>
              <span class="twr-gcard__fav" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 20.5s-7.5-4.6-9.7-8.9C.6 8 2.3 4.5 5.7 3.8c2-.4 4 .5 5.1 2.1.5.7 1.3 1.9 1.2 1.9 0 0 .7-1.2 1.2-1.9 1.1-1.6 3.1-2.5 5.1-2.1 3.4.7 5.1 4.2 3.4 7.8-2.2 4.3-9.7 8.9-9.7 8.9Z"/></svg>
              </span>
              <img src="{{ $property->image_url ?: 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=900&q=80' }}" alt="{{ $property->name }}" loading="lazy">
              <span class="twr-gcard__price">${{ number_format($property->min_rent ?? 0) }}<span>/mo</span></span>
            </div>
            <div class="twr-gcard__body">
              <h3 class="twr-gcard__name"><a href="{{ route('website.properties.show', $property) }}">{{ $property->name }}</a></h3>
              <p class="twr-gcard__loc">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M8 14s5-4.4 5-8a5 5 0 1 0-10 0c0 3.6 5 8 5 8Z"/><circle cx="8" cy="6" r="1.6"/></svg>
                {{ $property->neighborhood ?: $property->city }}
              </p>
              <p class="twr-gcard__desc">{{ Str::limit($property->description, 140) }}</p>
              <div class="twr-gcard__specs">
                <span class="twr-gcard__spec">
                  <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M2 6.5 8 2l6 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6.5Z"/></svg>
                  {{ $bedLabel }}
                </span>
                <span class="twr-gcard__spec">
                  <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg>
                  {{ $available }}
                </span>
              </div>
              <a class="twr-gcard__cta" href="{{ route('website.properties.show', $property) }}">View details<svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </div>
          </article>
        @empty
          <p class="twr-glisting__empty is-visible" style="grid-column:1/-1">No properties match your filters — try adjusting your search.</p>
        @endforelse
      </div>

      @if ($properties->hasPages())
        <div class="twr-pagination">
          @if ($properties->onFirstPage())
            <span>&laquo;</span>
          @else
            <a href="{{ $properties->previousPageUrl() }}">&laquo;</a>
          @endif

          @foreach ($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
            @if ($page == $properties->currentPage())
              <span class="current">{{ $page }}</span>
            @else
              <a href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach

          @if ($properties->hasMorePages())
            <a href="{{ $properties->nextPageUrl() }}">&raquo;</a>
          @else
            <span>&raquo;</span>
          @endif
        </div>
      @endif
    </div>
  </section>

</div><!-- /.twr-wrap -->

<!-- ============================================================
     SCRIPTS — main IIFE (header behavior reused from index.html)
============================================================ -->
<script>
(function () {
  var wrap   = document.querySelector('.twr-wrap');
  var header = document.getElementById('twrHeader');
  if (!header || !wrap) return;

  var toggle = header.querySelector('.twr-header__toggle');

  /* Floating shadow on the pill header once scrolled */
  function onScroll() {
    header.classList.toggle('is-scrolled', window.scrollY > 24);
  }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  /* Mobile hamburger menu toggle */
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

  /* Entrance animations (IntersectionObserver, opt-in) */
  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reducedMotion && 'IntersectionObserver' in window) {
    wrap.classList.add('twr-wrap--anim');

    var animObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-in');
          animObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    wrap.querySelectorAll('.twr-phero .twr-anim').forEach(function (el) {
      requestAnimationFrame(function () {
        requestAnimationFrame(function () { el.classList.add('is-in'); });
      });
    });

    wrap.querySelectorAll('.twr-anim:not(.twr-phero .twr-anim)').forEach(function (el) {
      animObs.observe(el);
    });
  }
})();
</script>

<!-- ============================================================
     SCRIPTS — header behavior
============================================================ -->
<style>
.twr-footer,
.twr-footer *,
.twr-footer *::before,
.twr-footer *::after { box-sizing: border-box; margin: 0; padding: 0; }

.twr-footer {
  --twr-orange: #D05F28;
  font-family: 'Inter Tight', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  -webkit-font-smoothing: antialiased;
  margin: 0 clamp(10px, 1.4vw, 18px);
  padding: clamp(24px, 3vw, 44px) 0 clamp(14px, 2vw, 22px);
}
.twr-footer__card {
  position: relative;
  overflow: hidden;
  background: #0a0a0a;
  color: #fff;
  border-radius: 28px;
  isolation: isolate;
}
.twr-footer__card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 88% 8%, rgba(208,95,40,.16), transparent 48%);
  z-index: 0; pointer-events: none;
}
.twr-footer__ghost {
  position: absolute;
  left: clamp(16px, 3vw, 48px);
  bottom: -0.16em;
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(64px, 15vw, 280px);
  line-height: .8;
  letter-spacing: -0.02em;
  color: rgba(255,255,255,.035);
  white-space: nowrap;
  pointer-events: none;
  z-index: 0;
}
.twr-footer__cta {
  position: relative; z-index: 1;
  display: grid;
  grid-template-columns: 1.45fr 1fr;
  gap: 32px;
  align-items: center;
  padding: clamp(44px, 5.5vw, 82px) clamp(28px, 3.6vw, 60px) clamp(36px, 4vw, 52px);
  border-bottom: 1px solid rgba(255,255,255,.1);
}
.twr-footer__cta-title {
  font-family: 'Lustria', Georgia, serif;
  font-weight: 400;
  font-size: clamp(28px, 3.4vw, 50px);
  line-height: 1.15;
  color: #fff;
  max-width: 15ch;
}
.twr-footer__cta-actions {
  display: flex; align-items: center; justify-content: flex-end;
  gap: 22px; flex-wrap: wrap;
}
.twr-footer__btn {
  display: inline-flex; align-items: center; gap: 10px;
  background: var(--twr-orange); color: #fff; text-decoration: none;
  font-weight: 600; font-size: 15px;
  padding: 14px 26px; border-radius: 999px;
  transition: transform .25s ease, background .25s ease;
}
.twr-footer__btn:hover { transform: translateY(-2px); background: #e06c34; }
.twr-footer__btn svg { width: 18px; height: 18px; }
.twr-footer__calllink {
  display: inline-flex; align-items: center; gap: 8px;
  color: #fff; text-decoration: none; font-weight: 500; font-size: 15px;
  opacity: .85; transition: opacity .2s ease;
}
.twr-footer__calllink:hover { opacity: 1; }
.twr-footer__main {
  position: relative; z-index: 1;
  display: grid;
  grid-template-columns: 1.6fr 1fr 1.1fr 1.2fr;
  gap: clamp(28px, 3vw, 52px);
  padding: clamp(40px, 4.5vw, 64px) clamp(28px, 3.6vw, 60px);
}
.twr-footer__brand { max-width: 320px; }
.twr-footer__logo {
  display: inline-block; will-change: transform;
  animation: twr-foot-float 4.5s ease-in-out infinite;
}
.twr-footer__logo img { width: clamp(150px, 15vw, 196px); height: auto; display: block; }
@keyframes twr-foot-float {
  0%,100% { transform: translateY(0); }
  50%     { transform: translateY(-8px); }
}
.twr-footer__blurb {
  margin-top: 22px;
  font-size: 14.5px; line-height: 1.7;
  color: rgba(255,255,255,.58); max-width: 300px;
}
.twr-footer__social { display: flex; gap: 10px; margin-top: 26px; }
.twr-footer__social a {
  width: 40px; height: 40px; border-radius: 50%;
  border: 1px solid rgba(255,255,255,.18);
  display: grid; place-items: center; color: #fff;
  transition: background .25s ease, border-color .25s ease, transform .25s ease, color .25s ease;
}
.twr-footer__social a:hover { background: var(--twr-orange); border-color: var(--twr-orange); transform: translateY(-3px); }
.twr-footer__social svg { width: 15px; height: 15px; fill: currentColor; display: block; }
.twr-footer__h {
  font-size: 12px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase;
  color: rgba(255,255,255,.45); margin-bottom: 20px;
}
.twr-footer__links { list-style: none; display: flex; flex-direction: column; gap: 13px; }
.twr-footer__links a {
  width: fit-content;
  display: inline-flex; align-items: center;
  color: rgba(255,255,255,.82); text-decoration: none; font-size: 15px;
  transition: color .2s ease;
}
.twr-footer__links a::after {
  content: '→'; color: var(--twr-orange);
  opacity: 0; transform: translateX(-6px); margin-left: 6px;
  transition: opacity .2s ease, transform .2s ease;
}
.twr-footer__links a:hover { color: #fff; }
.twr-footer__links a:hover::after { opacity: 1; transform: translateX(0); }
.twr-footer__addr {
  font-style: normal; font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,.62);
}
.twr-footer__addr strong { color: rgba(255,255,255,.9); font-weight: 500; }
.twr-footer__sub { margin-top: 20px; }
.twr-footer__trec { display: flex; flex-direction: column; gap: 14px; }
.twr-footer__trec a {
  display: inline-flex; align-items: flex-start; gap: 10px;
  color: rgba(255,255,255,.82); text-decoration: none; font-size: 14.5px; line-height: 1.4;
  transition: color .2s ease;
}
.twr-footer__trec a:hover { color: #fff; }
.twr-footer__trec .twr-footer__arrow { color: var(--twr-orange); margin-top: 1px; flex: none; transition: transform .25s ease; }
.twr-footer__trec a:hover .twr-footer__arrow { transform: translateX(4px); }
.twr-footer__trec svg { width: 16px; height: 16px; display: block; }
.twr-footer__bottom {
  position: relative; z-index: 1;
  display: flex; align-items: center; justify-content: space-between;
  gap: 16px; flex-wrap: wrap;
  padding: clamp(18px, 2vw, 22px) clamp(28px, 3.6vw, 60px);
  border-top: 1px solid rgba(255,255,255,.1);
}
.twr-footer__copy { font-size: 13.5px; color: rgba(255,255,255,.5); }
.twr-footer__totop {
  display: inline-flex; align-items: center; gap: 8px;
  color: rgba(255,255,255,.7); text-decoration: none; font-size: 13.5px;
  transition: color .2s ease;
}
.twr-footer__totop:hover { color: #fff; }
.twr-footer__totop svg { width: 14px; height: 14px; transition: transform .25s ease; }
.twr-footer__totop:hover svg { transform: translateY(-3px); }
.twr-footer--anim .twr-foot-anim {
  opacity: 0; transform: translateY(22px);
  transition: opacity .7s ease, transform .7s ease;
  transition-delay: var(--d, 0s);
}
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
          <img src="assets/tower-leasing-footer.png"
               alt="Tower Leasing Austin">
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
          <p class="twr-footer__addr">
            <strong>Mon – Fri</strong> · 10 am – 6 pm<br>
            Sat · by appointment<br>
            Sun · by appointment
          </p>
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
          <a href="{{ route('website.properties') }}">
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
(function () {
  var footer = document.querySelector('.twr-footer');
  if (!footer) return;

  var yearEl = document.getElementById('twrYear');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  var toTop = footer.querySelector('.twr-footer__totop');
  if (toTop) {
    toTop.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
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
