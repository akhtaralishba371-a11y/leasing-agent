@extends('layouts.website')

@section('title', 'Tower Realty Austin')

@push('head')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Lustria&display=swap" rel="stylesheet">

<style>
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
   HEADER
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
.twr-nav__sub::before {
  content: '';
  position: absolute;
  top: -14px; left: 0; right: 0; height: 14px;
}
.twr-nav__item:hover .twr-nav__sub,
.twr-nav__item:focus-within .twr-nav__sub {
  opacity: 1;
  pointer-events: auto;
  transform: translateX(-50%) translateY(0);
}
.twr-nav__sub a {
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: var(--twr-ink);
  text-decoration: none;
  padding: 9px 12px;
  border-radius: 9px;
  white-space: nowrap;
  transition: background .15s ease;
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
.twr-mobile-dropdown { display: flex; flex-direction: column; }
.twr-mobile-dropdown__toggle {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 11px 12px;
  border: 0;
  border-radius: 12px;
  background: transparent;
  color: var(--twr-ink);
  font: inherit;
  font-size: 16px;
  font-weight: 500;
  text-align: left;
  cursor: pointer;
}
.twr-mobile-dropdown__toggle:hover { background: #f4f4f4; }
.twr-mobile-dropdown__toggle svg { width: 12px; height: 12px; transition: transform .25s ease; }
.twr-mobile-dropdown.is-open .twr-mobile-dropdown__toggle svg { transform: rotate(180deg); }
.twr-mobile-dropdown__panel { display: grid; grid-template-rows: 0fr; transition: grid-template-rows .3s ease; }
.twr-mobile-dropdown.is-open .twr-mobile-dropdown__panel { grid-template-rows: 1fr; }
.twr-mobile-dropdown__inner { min-height: 0; overflow: hidden; display: flex; flex-direction: column; }
.twr-header__mobile .twr-mobile-dropdown__inner a { margin-left: 12px; padding-left: 18px; font-size: 14px; color: var(--twr-muted); border-left: 2px solid #ececec; border-radius: 0 10px 10px 0; }
.twr-header__mobile .twr-mobile-btn {
  margin-top: 8px; text-align: center; background: var(--twr-pill);
  color: #fff; font-weight: 600;
}
.twr-header__mobile .twr-mobile-btn:hover { background: #000; }

/* ============================================================
   HERO — video background with white top fade + orange tint
============================================================ */
.twr-hero {
  position: relative;
  margin: 0 clamp(10px, 1.4vw, 18px);
  min-height: 92vh;
  min-height: 92svh;
  border-radius: 0 0 32px 32px;
  overflow: hidden;
  background: #fff;
}

/* Full-bleed video */
.twr-hero__video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

/* White fade from top — keeps header text readable */
.twr-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg,
    rgba(0,0,0,.58) 0%,
    rgba(0,0,0,.48) 45%,
    rgba(0,0,0,.58) 100%);
  pointer-events: none;
  z-index: 1;
}

/* Additional neutral shade for consistent contrast across the video */
.twr-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.08);
  pointer-events: none;
  z-index: 1;
}

.twr-hero__inner {
  position: relative;
  z-index: 2;
  max-width: var(--twr-max);
  margin: 0 auto;
  padding: clamp(120px, 15vh, 172px) clamp(28px, 3vw, 56px) 64px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 40px;
}
.twr-hero__title { max-width: 880px; min-width: 0; }
.twr-hero__title h1 {
  font-family: 'Lustria', Georgia, serif;
  font-weight: 400;
  font-size: clamp(34px, 5vw, 54px);
  line-height: 1.4;
  letter-spacing: 0;
  color: #fff;
  text-shadow: 0 3px 24px rgba(0,0,0,.45);
  overflow-wrap: break-word;
}
.twr-hero__lead {
  max-width: 380px;
  min-width: 0;
  text-align: right;
  font-family: 'Inter Tight', sans-serif;
  font-weight: 400;
  font-size: clamp(17px, 1.5vw, 24px);
  line-height: 1.42;
  color: rgba(255,255,255,.92);
  text-shadow: 0 2px 18px rgba(0,0,0,.45);
  padding-top: 10px;
  flex: none;
}

/* ============================================================
   ABOUT US
============================================================ */
.twr-about {
  padding: clamp(64px, 8vw, 112px) clamp(24px, 4vw, 72px);
  max-width: var(--twr-max);
  margin: 0 auto;
}
.twr-about__inner {
  display: grid;
  grid-template-columns: 0.62fr 1fr;
  gap: 0;
  align-items: start;
}
.twr-about__eyebrow {
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(16px, 1.2vw, 20px);
  color: var(--twr-muted);
  letter-spacing: .04em;
  padding-top: 6px;
  text-transform: uppercase;
}
.twr-about__content { display: flex; flex-direction: column; gap: 20px; }
.twr-about__statement {
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(26px, 3vw, 40px);
  line-height: 1.3;
  color: var(--twr-ink);
}
.twr-about__text {
  font-family: 'Inter Tight', sans-serif;
  font-size: clamp(16px, 1.3vw, 20px);
  line-height: 1.65;
  color: var(--twr-muted);
  max-width: 680px;
}
.twr-about__stats {
  display: flex;
  gap: clamp(32px, 5vw, 72px);
  padding-top: 32px;
  border-top: 1px solid #e6e6e6;
  margin-top: 8px;
}
.twr-about__stat-label {
  font-family: 'Inter Tight', sans-serif;
  font-size: 12px;
  font-weight: 500;
  color: var(--twr-muted);
  letter-spacing: .06em;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.twr-about__stat-num {
  font-family: 'Lustria', Georgia, serif;
  font-size: clamp(52px, 7vw, 96px);
  line-height: 1;
  color: var(--twr-ink);
  display: flex;
  align-items: flex-end;
  gap: 6px;
}
.twr-about__stat-unit {
  font-family: 'Inter Tight', sans-serif;
  font-size: clamp(14px, 1.1vw, 18px);
  font-weight: 400;
  color: var(--twr-muted);
  padding-bottom: 10px;
}

/* ============================================================
   SERVICES
============================================================ */
.twr-services {
  padding: clamp(32px, 4vw, 56px) clamp(10px, 1.4vw, 18px);
}
.twr-services__card {
  border-radius: 24px;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1fr 1fr;
  height: 560px;
}
.twr-services__images {
  position: relative;
  overflow: hidden;
  height: 100%;
}
.twr-services__img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  opacity: 0;
  transition: opacity 0.7s ease;
  will-change: opacity;
}
.twr-services__img.is-visible { opacity: 1; }
.twr-services__overlay {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  padding: 24px 28px;
  background: linear-gradient(0deg, rgba(0,0,0,.78) 0%, rgba(0,0,0,0) 100%);
  color: #fff;
  z-index: 2;
}
.twr-services__overlay-fact {
  font-family: 'Inter Tight', sans-serif;
  font-size: 13px;
  line-height: 1.5;
  color: rgba(255,255,255,.82);
  margin-bottom: 16px;
  max-width: 340px;
}
.twr-services__overlay-stats { display: flex; gap: 32px; }
.twr-services__overlay-num {
  font-family: 'Lustria', Georgia, serif;
  font-size: 32px;
  line-height: 1;
  color: #fff;
}
.twr-services__overlay-lbl {
  font-size: 11px;
  font-weight: 500;
  color: rgba(255,255,255,.65);
  margin-top: 3px;
  text-transform: uppercase;
  letter-spacing: .05em;
}
.twr-services__list {
  background: #D05F28;
  padding: 32px 36px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}
.twr-services__item {
  flex: 1;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  -webkit-appearance: none;
  appearance: none;
  border: 0;
  border-bottom: 1px solid rgba(255,255,255,.15);
  background: transparent;
  color: inherit;
  text-align: left;
  font: inherit;
  cursor: pointer;
  touch-action: manipulation;
  transition: background 0.35s ease, border-radius 0.35s ease,
              padding 0.35s ease, margin 0.35s ease;
}
.twr-services__item:last-child { border-bottom: none; }
.twr-services__item.is-active {
  background: #fff;
  border-radius: 14px;
  border-bottom: none;
  padding: 0 18px;
  margin: 3px 0;
}
.twr-services__item.is-active + .twr-services__item { border-top: none; }
.twr-services__title {
  display: block;
  font-family: 'Lustria', Georgia, serif;
  font-size: 22px;
  font-weight: 400;
  line-height: 1.2;
  color: rgba(255,255,255,.90);
  transition: color 0.3s ease;
}
.twr-services__item.is-active .twr-services__title { color: #121212; }
.twr-services__desc {
  display: block;
  font-family: 'Inter Tight', sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.5;
  color: #5b5b5b;
  max-height: 0;
  margin-top: 0;
  opacity: 0;
  overflow: hidden;
  transition: max-height 0.35s ease, margin-top 0.35s ease, opacity 0.35s ease;
  pointer-events: none;
}
.twr-services__item.is-active .twr-services__desc { max-height: 140px; margin-top: 6px; opacity: 1; pointer-events: auto; }
.twr-services__item:focus-visible { outline: 3px solid rgba(255,255,255,.75); outline-offset: 3px; }
.twr-services__item.is-active:focus-visible { outline-color: #121212; }

/* ============================================================
   ENTRANCE ANIMATION
============================================================ */
.twr-wrap--anim .twr-anim {
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s ease, transform .7s ease;
  transition-delay: var(--d, 0s);
}
.twr-wrap--anim .twr-anim.is-in { opacity: 1; transform: none; }
@media (prefers-reduced-motion: reduce) {
  .twr-wrap--anim .twr-anim { opacity: 1 !important; transform: none !important; transition: none !important; }
}

/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 1024px) {
  .twr-nav, .twr-agent { display: none; }
  .twr-header__toggle { display: inline-flex; margin-left: auto; }
  .twr-header__mobile { display: flex; }
  .twr-about__inner { grid-template-columns: 1fr; gap: 16px; }
}
@media (max-width: 860px) {
  .twr-hero__inner { flex-direction: column; align-items: flex-start; padding-top: clamp(108px, 16vh, 150px); }
  .twr-hero__title h1 { color: #fff; text-shadow: 0 3px 24px rgba(0,0,0,.5); }
  .twr-hero__lead { text-align: left; max-width: 540px; padding-top: 4px; color: #fff; text-shadow: 0 2px 18px rgba(0,0,0,.55); }
  .twr-about__stats { flex-wrap: wrap; gap: 24px; }
  .twr-services__card { grid-template-columns: 1fr; height: auto; }
  .twr-services__images { height: 300px; position: relative; }
  .twr-services__list { height: auto; justify-content: flex-start; gap: 0; padding: 24px 20px; }
  .twr-services__item { flex: none; padding: 16px 0; }
  .twr-services__item.is-active { padding: 14px 14px; }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
@endpush

@section('content')

<div class="twr-wrap">

  <!-- HEADER -->
  <header class="twr-header" id="twrHeader">
    <div class="twr-header__bar">
      <a class="twr-header__logo" href="{{ route('home') }}" aria-label="Tower Realty Austin home">
        <img src="https://tower-leasing.com/wp-content/uploads/2025/01/cropped-Tower-Leasing-1.png" alt="Tower Realty Austin">
      </a>
      <nav class="twr-nav" aria-label="Primary">
        <a class="twr-nav__link is-current" href="{{ route('home') }}">Home</a>
        <a class="twr-nav__link" href="{{ route('website.about') }}">About</a>
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
      <button class="twr-header__toggle" aria-label="Open menu" aria-expanded="false" aria-controls="twrMobile">
        <span></span><span></span><span></span>
      </button>
    </div>
    <div class="twr-header__mobile" id="twrMobile">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('website.about') }}">About</a>
      <a href="{{ route('website.properties') }}">Properties</a>
      <a href="{{ route('website.agents') }}">Agents</a>
      <div class="twr-mobile-dropdown">
        <button class="twr-mobile-dropdown__toggle" type="button" aria-expanded="false" aria-controls="twrMobileMore">
          More
          <svg viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="twr-mobile-dropdown__panel" id="twrMobileMore">
          <div class="twr-mobile-dropdown__inner">
            <a href="{{ route('website.become-agent') }}">Become a Leasing Agent</a>
            <a href="https://www.instagram.com/towerleasing/?igshid=NzZhOTFlYzFmZQ%3D%3D" target="_blank" rel="noopener">Instagram</a>
          </div>
        </div>
      </div>
      <a href="{{ route('website.contact') }}">Contact Us</a>
      <a href="{{ route('website.contact') }}" class="twr-mobile-btn">Book a call</a>
    </div>
  </header>

</div>
<div data-scroll-container>
<div class="twr-wrap">

  <!-- HERO — video background -->
  <section class="twr-hero">
    <video class="twr-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
      <source src="https://framerusercontent.com/assets/rs44TuJAYUuddUoUTCFk4Yr0ig.mp4" type="video/mp4">
    </video>
    <div class="twr-hero__inner">
      <div class="twr-hero__title twr-anim" style="--d:.05s">
        <h1>@content('home.hero.title', 'Find your perfect fit!<br>Rentals for UT Austin students')</h1>
      </div>
      <p class="twr-hero__lead twr-anim" style="--d:.2s">
        @content('home.hero.lead', 'Work with knowledgeable agents who make leasing simple. Browse exclusive Tower Realty listings — always free for our clients.')
      </p>
    </div>
  </section>

  <!-- ABOUT US -->
  <section class="twr-about">
    <div class="twr-about__inner">
      <p class="twr-about__eyebrow twr-anim" style="--d:.05s">@content('home.about.eyebrow', 'About Us')</p>
      <div class="twr-about__content">
        <h2 class="twr-about__statement twr-anim" style="--d:.1s">
          @content('home.about.statement', 'At Tower Leasing, we specialize in connecting UT Austin students with the perfect place to call home.')
        </h2>
        <p class="twr-about__text twr-anim" style="--d:.18s">
          @content('home.about.text', "We know that finding an apartment on or near campus can be overwhelming, but we're here to take that burden off your shoulders and turn the process into an exciting and easy experience. Our services are always free for students.")
        </p>
        <div class="twr-about__stats twr-anim" style="--d:.26s">
          <div class="twr-about__stat">
            <p class="twr-about__stat-label">@content('home.about.stat1_label', 'Helping students since')</p>
            <div class="twr-about__stat-num">
              <span class="twr-count" data-target="10">10</span>
              <span class="twr-about__stat-unit">Yrs</span>
            </div>
          </div>
          <div class="twr-about__stat">
            <p class="twr-about__stat-label">@content('home.about.stat2_label', 'Browse over')</p>
            <div class="twr-about__stat-num">
              <span class="twr-count" data-target="500">500</span>
              <span class="twr-about__stat-unit">Listings</span>
            </div>
          </div>
          <div class="twr-about__stat">
            <p class="twr-about__stat-label">@content('home.about.stat3_label', 'Trusted by')</p>
            <div class="twr-about__stat-num">
              <span class="twr-count" data-target="1200">1,200</span>
              <span class="twr-about__stat-unit">Students</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="twr-services">
    <div class="twr-services__card">
      <div class="twr-services__images">
        <img class="twr-services__img is-visible" data-service="0"
             src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=900&q=80"
             alt="Modern apartment building in Austin">
        <img class="twr-services__img" data-service="1"
             src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=900&q=80"
             alt="Bright living room in a student lease property">
        <img class="twr-services__img" data-service="2"
             src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=900&q=80"
             alt="Contemporary home exterior">
        <img class="twr-services__img" data-service="3"
             src="https://images.unsplash.com/photo-1494526585095-c41746248156?w=900&q=80"
             alt="Quality apartment at reduced deposit near UT Austin">
        <div class="twr-services__overlay">
          <p class="twr-services__overlay-fact">
            @content('home.services.overlay_fact', 'Exclusive Tower Leasing listings — hundreds of near-campus options, always free for students.')
          </p>
          <div class="twr-services__overlay-stats">
            <div class="twr-services__overlay-stat">
              <div class="twr-services__overlay-num">500+</div>
              <div class="twr-services__overlay-lbl">Exclusive listings</div>
            </div>
            <div class="twr-services__overlay-stat">
              <div class="twr-services__overlay-num">$0</div>
              <div class="twr-services__overlay-lbl">Student fee</div>
            </div>
          </div>
        </div>
      </div>
      <div class="twr-services__list">
        <button class="twr-services__item is-active" type="button" data-index="0" aria-expanded="true">
          <span class="twr-services__title">@content('home.services.item1_title', '1. Get access to exclusive Tower Leasing listings')</span>
          <span class="twr-services__desc">@content('home.services.item1_desc', "Hundreds of curated near-campus apartments available only through Tower Leasing — properties you won't find on any public rental site.")</span>
        </button>
        <button class="twr-services__item" type="button" data-index="1" aria-expanded="false">
          <span class="twr-services__title">@content('home.services.item2_title', '2. Sign a lease at the best property for your needs')</span>
          <span class="twr-services__desc">@content('home.services.item2_desc', 'Our agents walk you through every step, matching you to the right property and making sure the terms work for your budget and lifestyle.')</span>
        </button>
        <button class="twr-services__item" type="button" data-index="2" aria-expanded="false">
          <span class="twr-services__title">@content('home.services.item3_title', '3. Find the best deals and special offers')</span>
          <span class="twr-services__desc">@content('home.services.item3_desc', "We track move-in specials, reduced deposits, and limited-time promotions so you never miss a saving before it's gone.")</span>
        </button>
        <button class="twr-services__item" type="button" data-index="3" aria-expanded="false">
          <span class="twr-services__title">@content('home.services.item4_title', '4. Save money on property fees and deposits')</span>
          <span class="twr-services__desc">@content('home.services.item4_desc', 'Leverage our property manager relationships to negotiate lower deposits and waived fees — keeping more cash in your pocket from day one.')</span>
        </button>
      </div>
    </div>
  </section>

  <script>
  (function () {
    var services = document.querySelector('.twr-services');
    if (!services) return;

    var items = services.querySelectorAll('.twr-services__item');
    var images = services.querySelectorAll('.twr-services__img');

    function activate(item) {
      var index = item.getAttribute('data-index');

      Array.prototype.forEach.call(items, function (current) {
        var isActive = current === item;
        current.classList.toggle('is-active', isActive);
        current.setAttribute('aria-expanded', isActive ? 'true' : 'false');
      });

      Array.prototype.forEach.call(images, function (image) {
        image.classList.toggle('is-visible', image.getAttribute('data-service') === index);
      });
    }

    Array.prototype.forEach.call(items, function (item) {
      item.addEventListener('click', function () { activate(item); });
    });
  })();
  </script>

</div><!-- /.twr-wrap -->

<script>
(function () {
  var wrap   = document.querySelector('.twr-wrap');
  var header = document.getElementById('twrHeader');
  if (!header || !wrap) return;
  var toggle = header.querySelector('.twr-header__toggle');

  function onScroll() { header.classList.toggle('is-scrolled', window.scrollY > 24); }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  if (toggle) {
    var mobileDropdown = header.querySelector('.twr-mobile-dropdown');
    var mobileDropdownToggle = header.querySelector('.twr-mobile-dropdown__toggle');
    toggle.addEventListener('click', function () {
      var open = header.classList.toggle('is-menu-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (!open && mobileDropdown && mobileDropdownToggle) {
        mobileDropdown.classList.remove('is-open');
        mobileDropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
    if (mobileDropdown && mobileDropdownToggle) {
      mobileDropdownToggle.addEventListener('click', function () {
        var open = mobileDropdown.classList.toggle('is-open');
        mobileDropdownToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    }
    header.querySelectorAll('.twr-header__mobile a').forEach(function (a) {
      a.addEventListener('click', function () {
        header.classList.remove('is-menu-open');
        toggle.setAttribute('aria-expanded', 'false');
        if (mobileDropdown && mobileDropdownToggle) {
          mobileDropdown.classList.remove('is-open');
          mobileDropdownToggle.setAttribute('aria-expanded', 'false');
        }
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

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reducedMotion && 'IntersectionObserver' in window) {
    wrap.classList.add('twr-wrap--anim');
    var animObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add('is-in'); animObs.unobserve(entry.target); }
      });
    }, { threshold: 0.12 });
    wrap.querySelectorAll('.twr-hero .twr-anim').forEach(function (el) {
      requestAnimationFrame(function () { requestAnimationFrame(function () { el.classList.add('is-in'); }); });
    });
    wrap.querySelectorAll('.twr-anim:not(.twr-hero .twr-anim)').forEach(function (el) { animObs.observe(el); });
  }

  var counted = false;
  function runCountUp() {
    if (counted) return;
    counted = true;
    wrap.querySelectorAll('.twr-count').forEach(function (el) {
      var target = parseInt(el.getAttribute('data-target'), 10);
      var duration = 1400;
      var start = null;
      function step(ts) {
        if (!start) start = ts;
        var progress = Math.min((ts - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        var current = Math.round(eased * target);
        el.textContent = current >= 1000 ? current.toLocaleString() : current.toString();
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target >= 1000 ? target.toLocaleString() : target;
      }
      requestAnimationFrame(step);
    });
  }
  if ('IntersectionObserver' in window) {
    var statsEl = wrap.querySelector('.twr-about__stats');
    if (statsEl) {
      var statsObs = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting) { runCountUp(); statsObs.disconnect(); }
      }, { threshold: 0.3 });
      statsObs.observe(statsEl);
    }
  }

})();
</script>

<!-- ============================================================
     LISTINGS
============================================================ -->
<style>
.twr-listings, .twr-listings *, .twr-listings *::before, .twr-listings *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-listings { font-family: 'Inter Tight', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; color: #121212; margin: 0 clamp(10px, 1.4vw, 18px); padding: clamp(40px, 5vw, 72px) clamp(24px, 4vw, 56px); }
.twr-listings__header { display: flex; align-items: end; justify-content: space-between; gap: 28px; margin-bottom: clamp(32px, 4vw, 52px); }
.twr-listings__eyebrow { font-family: 'Inter Tight', sans-serif; font-size: 12px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: #9a9a9a; margin-bottom: 14px; }
.twr-listings__headline { font-family: 'Lustria', Georgia, serif; font-size: clamp(28px, 3.4vw, 48px); font-weight: 400; letter-spacing: -.025em; line-height: 1.14; color: #121212; max-width: 650px; }
.twr-listings__all { display: inline-flex; align-items: center; gap: 10px; flex: none; color: #121212; text-decoration: none; font-size: 13px; font-weight: 600; padding: 12px 18px; border: 1px solid #dcd7d0; border-radius: 999px; transition: color .25s ease, background .25s ease, border-color .25s ease; }
.twr-listings__all svg { width: 17px; height: 17px; transition: transform .25s ease; }
.twr-listings__all:hover { color: #fff; background: #121212; border-color: #121212; }
.twr-listings__all:hover svg { transform: translateX(3px); }
.twr-listings__stack { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: clamp(18px, 2vw, 28px); align-items: stretch; }
.twr-listing-card { position: relative; border: 1px solid #e7e2dc; border-radius: 26px; background: #fff; overflow: hidden; display: flex; flex-direction: column; min-width: 0; opacity: 0; transform: translateY(22px); box-shadow: 0 14px 44px -34px rgba(25,20,16,.42); transition: opacity .8s cubic-bezier(.22,1,.36,1), transform .8s cubic-bezier(.22,1,.36,1), box-shadow .8s cubic-bezier(.22,1,.36,1), border-color .8s ease; }
.twr-listing-card.is-visible { opacity: 1; transform: translateY(0); }
.twr-listing-card.is-visible:hover { transform: translateY(-4px); border-color: #d9d0c6; box-shadow: 0 26px 64px -34px rgba(25,20,16,.3); }
.twr-listing-card__img-wrap { position: relative; overflow: hidden; aspect-ratio: 4 / 3; background: #ddd; }
.twr-listing-card__img-wrap::before { position: absolute; z-index: 2; top: 18px; left: 18px; padding: 8px 12px; border-radius: 999px; color: #17130f; background: rgba(255,255,255,.9); backdrop-filter: blur(10px); font-family: 'Inter Tight', sans-serif; font-size: 10px; font-weight: 700; letter-spacing: .11em; text-transform: uppercase; box-shadow: 0 8px 28px -16px rgba(0,0,0,.5); transition: transform .7s cubic-bezier(.22,1,.36,1), box-shadow .7s ease; }
.twr-listing-card:nth-child(1) .twr-listing-card__img-wrap::before { content: 'Featured'; }
.twr-listing-card:nth-child(2) .twr-listing-card__img-wrap::before { content: 'Exclusive'; color: #fff; background: rgba(208,95,40,.92); }
.twr-listing-card:nth-child(3) .twr-listing-card__img-wrap::before { content: 'Best value'; }
.twr-listing-card__img-wrap::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 48%, rgba(8,7,6,.25) 100%); opacity: 1; pointer-events: none; transition: opacity .8s ease; }
.twr-listing-card__img-wrap img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform 1.25s cubic-bezier(.22,1,.36,1), filter .8s ease; }
.twr-listing-card:hover .twr-listing-card__img-wrap img { transform: scale(1.04); filter: saturate(1.04); }
.twr-listing-card:hover .twr-listing-card__img-wrap::before { transform: translateY(-2px); box-shadow: 0 12px 28px -16px rgba(0,0,0,.5); }
.twr-listing-card:hover .twr-listing-card__img-wrap::after { opacity: .72; }
.twr-listing-card__body { flex: 1; min-width: 0; padding: clamp(22px, 2.2vw, 30px); display: flex; flex-direction: column; }
.twr-listing-card__body > div:first-child { flex: 1; }
.twr-listing-card__name { font-family: 'Lustria', Georgia, serif; font-size: clamp(23px, 2vw, 30px); font-weight: 400; letter-spacing: -.02em; line-height: 1.16; color: #17130f; margin-bottom: 13px; transition: transform .7s cubic-bezier(.22,1,.36,1); }
.twr-listing-card__name-link { position: relative; display: block; padding-right: 42px; color: inherit; text-decoration: none; }
.twr-listing-card__name-link::after { content: ''; position: absolute; top: -2px; right: 0; display: block; width: 34px; height: 34px; border-radius: 50%; background-color: #17130f; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none'%3E%3Cpath d='M4.5 11.5 11.5 4.5M6 4.5h5.5V10' stroke='%23fff' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-position: center; background-size: 16px 16px; background-repeat: no-repeat; transition: transform .7s cubic-bezier(.22,1,.36,1), background-color .6s ease; }
.twr-listing-card:hover .twr-listing-card__name-link::after { transform: rotate(24deg); background-color: #d05f28; }
.twr-listing-card:hover .twr-listing-card__name { transform: translateX(1px); }
.twr-listing-card__desc { font-family: 'Inter Tight', sans-serif; font-size: 14px; line-height: 1.65; color: #706a64; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.twr-listing-card__tags { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 24px; }
.twr-listing-card__tag { display: inline-flex; align-items: center; gap: 6px; font-family: 'Inter Tight', sans-serif; font-size: 10.5px; font-weight: 600; color: #554d46; background: #f5f2ee; border-radius: 999px; padding: 7px 10px; white-space: nowrap; transition: transform .65s cubic-bezier(.22,1,.36,1), color .55s ease, background .55s ease; }
.twr-listing-card__tag:nth-child(2) { transition-delay: .035s; }
.twr-listing-card__tag:nth-child(3) { transition-delay: .07s; }
.twr-listing-card:hover .twr-listing-card__tag { transform: translateY(-1px); color: #312b26; background: #f0e9e2; }
.twr-listing-card__tag svg { width: 13px; height: 13px; color: #d05f28; flex: none; transition: transform .65s cubic-bezier(.22,1,.36,1); }
.twr-listing-card:hover .twr-listing-card__tag svg { transform: scale(1.12) rotate(-4deg); }
.twr-listing-card__stats { display: grid; grid-template-columns: 1.15fr .9fr .9fr; gap: 12px; padding-top: 20px; border-top: 1px solid #ebe7e2; }
.twr-listing-card__stats > div { min-width: 0; transition: transform .65s cubic-bezier(.22,1,.36,1); }
.twr-listing-card__stats > div:nth-child(2) { transition-delay: .04s; }
.twr-listing-card__stats > div:nth-child(3) { transition-delay: .08s; }
.twr-listing-card:hover .twr-listing-card__stats > div { transform: translateY(-1px); }
.twr-listing-card__stat-lbl { font-family: 'Inter Tight', sans-serif; font-size: 9px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #aaa19a; margin-bottom: 6px; }
.twr-listing-card__stat-val { font-family: 'Lustria', Georgia, serif; font-size: clamp(15px, 1.3vw, 20px); font-weight: 400; color: #17130f; line-height: 1.15; transition: color .3s ease; }
.twr-listing-card:hover .twr-listing-card__stats > div:first-child .twr-listing-card__stat-val { color: #d05f28; }
@media (max-width: 1100px) { .twr-listings__stack { grid-template-columns: repeat(2, minmax(0, 1fr)); } .twr-listing-card:last-child { grid-column: 1 / -1; display: grid; grid-template-columns: 1fr 1fr; } .twr-listing-card:last-child .twr-listing-card__img-wrap { aspect-ratio: auto; min-height: 360px; } }
@media (max-width: 720px) { .twr-listings { padding-left: 16px; padding-right: 16px; } .twr-listings__header { align-items: flex-start; flex-direction: column; } .twr-listings__stack { grid-template-columns: 1fr; } .twr-listing-card:last-child { grid-column: auto; display: flex; } .twr-listing-card:last-child .twr-listing-card__img-wrap { aspect-ratio: 4 / 3; min-height: 0; } }
@media (max-width: 430px) { .twr-listing-card { border-radius: 20px; } .twr-listing-card__stats { gap: 8px; } .twr-listing-card__stat-val { font-size: 14px; } .twr-listing-card__tag { font-size: 10px; } }

/* Cinematic bento treatment */
.twr-listings { color: #121212; padding: clamp(28px, 4vh, 48px) clamp(20px, 4vw, 60px); border-radius: 34px; background: #fff; overflow: hidden; }
.twr-listings .twr-listings__header { margin-bottom: clamp(22px, 3vh, 34px); }
.twr-listings__eyebrow { color: #d78050; }
.twr-listings__headline { color: #121212; max-width: 720px; }
.twr-listings__all { color: #121212; border-color: #dcd7d0; background: #fff; }
.twr-listings__all:hover { color: #fff; border-color: #121212; background: #121212; }
.twr-listings__stack { grid-template-columns: minmax(0, 1.18fr) minmax(360px, .82fr); grid-template-rows: repeat(2, clamp(205px, calc((100vh - 285px) / 2), 270px)); gap: 16px; }
.twr-listing-card { min-height: 0; border: none; border-radius: 26px; background: #24211e; box-shadow: none; }
.twr-listing-card:first-child { grid-row: 1 / 3; }
.twr-listing-card:last-child { grid-column: auto; display: flex; grid-template-columns: none; }
.twr-listing-card:last-child .twr-listing-card__img-wrap { min-height: 0; }
.twr-listing-card.is-visible:hover { border-color: transparent; box-shadow: 0 30px 70px -28px rgba(0,0,0,.7); }
.twr-listing-card__img-wrap { position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%; aspect-ratio: auto; }
.twr-listing-card__img-wrap::after { z-index: 1; background: linear-gradient(180deg, rgba(9,8,7,.02) 12%, rgba(9,8,7,.18) 43%, rgba(9,8,7,.94) 100%); opacity: 1; }
.twr-listing-card:first-child .twr-listing-card__img-wrap::after { background: linear-gradient(180deg, rgba(9,8,7,.02) 20%, rgba(9,8,7,.12) 48%, rgba(9,8,7,.96) 100%); }
.twr-listing-card:hover .twr-listing-card__img-wrap::after { opacity: .9; }
.twr-listing-card__body { position: relative; z-index: 3; justify-content: flex-end; width: 100%; height: 100%; padding: 26px; color: #fff; pointer-events: none; }
.twr-listing-card:first-child .twr-listing-card__body { padding: clamp(28px, 3.2vw, 48px); }
.twr-listing-card__body > div:first-child { flex: 0; }
.twr-listing-card__name { color: #fff; font-size: clamp(23px, 2vw, 31px); margin-bottom: 9px; }
.twr-listing-card:first-child .twr-listing-card__name { font-size: clamp(31px, 3.5vw, 52px); max-width: 760px; }
.twr-listing-card__name-link { pointer-events: auto; }
.twr-listing-card__name-link::after { background-color: #121212; }
.twr-listing-card__desc { color: rgba(255,255,255,.72); margin-bottom: 15px; -webkit-line-clamp: 2; }
.twr-listing-card:not(:first-child) .twr-listing-card__desc { display: none; }
.twr-listing-card:first-child .twr-listing-card__desc { max-width: 700px; font-size: 15px; }
.twr-listing-card__tags { margin-bottom: 16px; }
.twr-listing-card__tag { color: rgba(255,255,255,.88); background: rgba(255,255,255,.11); border: 1px solid rgba(255,255,255,.13); backdrop-filter: blur(12px); }
.twr-listing-card:hover .twr-listing-card__tag { color: #fff; background: rgba(255,255,255,.18); }
.twr-listing-card__tag svg { color: #ef8b50; }
.twr-listing-card__stats { grid-template-columns: 1.15fr .9fr .9fr; gap: 10px; padding: 13px 15px; border: 1px solid rgba(255,255,255,.13); border-radius: 16px; background: rgba(13,12,11,.44); backdrop-filter: blur(14px); }
.twr-listing-card:first-child .twr-listing-card__stats { max-width: 590px; padding: 16px 20px; }
.twr-listing-card__stat-lbl { color: rgba(255,255,255,.48); }
.twr-listing-card__stat-val { color: #fff; font-size: clamp(14px, 1.2vw, 19px); }
.twr-listing-card:hover .twr-listing-card__stats > div:first-child .twr-listing-card__stat-val { color: #f28a50; }
@media (max-width: 1050px) { .twr-listings__stack { grid-template-columns: repeat(2, minmax(0,1fr)); grid-template-rows: 410px 360px; } .twr-listing-card:first-child { grid-column: 1 / -1; grid-row: auto; } .twr-listing-card:last-child { grid-column: auto; display: flex; } .twr-listing-card:last-child .twr-listing-card__img-wrap { min-height: 0; } .twr-listing-card:not(:first-child) .twr-listing-card__desc { display: -webkit-box; } }
@media (min-width: 1051px) and (max-height: 760px) { .twr-listing-card:not(:first-child) .twr-listing-card__tags { display: none; } .twr-listing-card:not(:first-child) .twr-listing-card__body { padding: 20px; } .twr-listing-card:not(:first-child) .twr-listing-card__name { font-size: 22px; } }
@media (max-width: 700px) { .twr-listings { border-radius: 24px; } .twr-listings__stack { grid-template-columns: 1fr; grid-template-rows: none; } .twr-listing-card, .twr-listing-card:first-child { grid-column: auto; grid-row: auto; min-height: 520px; } .twr-listing-card:first-child .twr-listing-card__name { font-size: clamp(28px, 8vw, 38px); } .twr-listing-card__body, .twr-listing-card:first-child .twr-listing-card__body { padding: 22px; } }
@media (max-width: 440px) { .twr-listing-card, .twr-listing-card:first-child { min-height: 500px; } .twr-listing-card__tags .twr-listing-card__tag:nth-child(3) { display: none; } .twr-listing-card__stats { padding: 12px; } }
@media (prefers-reduced-motion: reduce) { .twr-listing-card, .twr-listing-card *, .twr-listing-card *::before, .twr-listing-card *::after { transition: none !important; transform: none !important; } }
</style>

<section class="twr-listings" id="twrListings">
  <div class="twr-listings__header">
    <div>
      <p class="twr-listings__eyebrow">@content('home.listings.eyebrow', 'Latest Listings')</p>
      <h2 class="twr-listings__headline">@content('home.listings.headline', 'Newest properties near UT Austin, ready to explore.')</h2>
    </div>
    <a class="twr-listings__all" href="{{ route('website.properties') }}">
      View all properties
      <svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
  <div class="twr-listings__stack">
    @forelse ($featured as $property)
      @php
        $bedLabel = $property->min_bedrooms == $property->max_bedrooms
            ? ($property->min_bedrooms == 0 ? 'Studio' : $property->min_bedrooms.'BR')
            : ($property->min_bedrooms == 0 ? 'Studio' : $property->min_bedrooms.'BR').' – '.$property->max_bedrooms.'BR';
        $available = optional($property->units->first()?->available_on)->format('M, Y') ?? 'Now';
      @endphp
      <article class="twr-listing-card">
        <div class="twr-listing-card__img-wrap">
          <img src="{{ $property->image_url ?: 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&q=80' }}" alt="{{ $property->name }}" loading="lazy">
        </div>
        <div class="twr-listing-card__body">
          <div>
            <h3 class="twr-listing-card__name">
              <a class="twr-listing-card__name-link" href="{{ route('website.properties.show', $property) }}">{{ $property->name }}</a>
            </h3>
            @if ($loop->first)
              <p class="twr-listing-card__desc">{{ $property->description }}</p>
            @endif
            @if ($property->amenities->isNotEmpty())
              <div class="twr-listing-card__tags">
                @foreach ($property->amenities->take(3) as $amenity)
                  <span class="twr-listing-card__tag">{{ $amenity->name }}</span>
                @endforeach
              </div>
            @endif
          </div>
          <div class="twr-listing-card__stats">
            <div><p class="twr-listing-card__stat-lbl">Starting from</p><p class="twr-listing-card__stat-val">${{ number_format($property->min_rent ?? 0) }} / mo</p></div>
            <div><p class="twr-listing-card__stat-lbl">Unit types</p><p class="twr-listing-card__stat-val">{{ $bedLabel }}</p></div>
            <div><p class="twr-listing-card__stat-lbl">Available</p><p class="twr-listing-card__stat-val">{{ $available }}</p></div>
          </div>
        </div>
      </article>
    @empty
      <p style="grid-column:1/-1;padding:24px;color:#666">Latest listings will appear here once properties are added in admin.</p>
    @endforelse
  </div>
</section>

<script>
(function () {
  var cards = document.querySelectorAll('.twr-listing-card');
  if (!cards.length) return;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reduce && 'IntersectionObserver' in window) {
    var entryObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-visible'); entryObs.unobserve(e.target); } });
    }, { threshold: 0.08 });
    cards.forEach(function (card) { entryObs.observe(card); });
  } else {
    cards.forEach(function (card) { card.classList.add('is-visible'); });
  }
})();
</script>

<!-- ============================================================
     TESTIMONIALS
============================================================ -->
<style>
.twr-testi, .twr-testi *, .twr-testi *::before, .twr-testi *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-testi { font-family: 'Inter Tight', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; color: #121212; margin: 0 clamp(10px, 1.4vw, 18px); padding: clamp(32px, 4vw, 56px) clamp(24px, 4vw, 56px) clamp(56px, 7vw, 96px); }
.twr-testi__header { text-align: center; max-width: 620px; margin: 0 auto clamp(36px, 5vw, 56px); }
.twr-testi__eyebrow { font-family: 'Lustria', Georgia, serif; font-size: 15px; font-weight: 400; color: #9a9a9a; letter-spacing: .04em; text-transform: uppercase; margin-bottom: 12px; }
.twr-testi__headline { font-family: 'Lustria', Georgia, serif; font-size: clamp(22px, 2.6vw, 32px); font-weight: 400; line-height: 1.3; color: #121212; }
.twr-testi__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: start; }
.twr-testi-card { position: relative; background: #f5f5f5; border-radius: 18px; padding: 24px 24px 22px; display: flex; flex-direction: column; cursor: default; opacity: 0; transform: translateY(20px); transition: opacity .6s ease, transform .6s ease, background .45s ease, box-shadow .45s ease; }
.twr-testi-card.is-visible { opacity: 1; transform: translateY(0); }
.twr-testi-card:hover { background: #121212; box-shadow: 0 32px 70px -30px rgba(18,18,18,.45); }
.twr-testi-card__media { height: 0; border-radius: 14px; overflow: hidden; margin-bottom: 0; transition: height .5s ease, margin-bottom .5s ease; }
.twr-testi-card:hover .twr-testi-card__media { height: 190px; margin-bottom: 20px; }
.twr-testi-card__media img { width: 100%; height: 100%; object-fit: cover; object-position: center top; display: block; }
.twr-testi-card__text { font-family: 'Inter Tight', sans-serif; font-size: 14.5px; font-weight: 400; line-height: 1.65; color: #4a4a4a; transition: color .45s ease; }
.twr-testi-card:hover .twr-testi-card__text { color: #fff; }
.twr-testi-card__byline { font-family: 'Inter Tight', sans-serif; font-size: 13px; font-weight: 400; color: #9a9a9a; margin-top: 18px; transition: color .45s ease; }
.twr-testi-card:hover .twr-testi-card__byline { color: rgba(255,255,255,.65); }
@media (max-width: 980px) { .twr-testi__grid { grid-template-columns: 1fr; gap: 16px; } }
@media (max-width: 860px) { .twr-testi { padding: clamp(40px, 8vw, 64px) 16px; } }
</style>

<section class="twr-testi" id="twrTestimonials">
  <div class="twr-testi__header">
    <p class="twr-testi__eyebrow">@content('home.testi.eyebrow', 'Testimonials')</p>
    <h2 class="twr-testi__headline">@content('home.testi.headline', 'What students and owners say about Tower Leasing')</h2>
  </div>
  <div class="twr-testi__grid">
    <article class="twr-testi-card">
      <div class="twr-testi-card__media"><img src="https://cdn.prod.website-files.com/689161a0ec1f462be1dbfd7e/6892dcfd38e072c05d101329_pexels-brynna-spencer-63356-227294%201.png" alt="Mikayla R." loading="lazy"></div>
      <p class="twr-testi-card__text">Anna is absolutely amazing! We contacted Tower just two days before move-out when our previous lease fell through, and she got us approved and signed within that time — calm, fast, and the hardest-working agent we've worked with.</p>
      <p class="twr-testi-card__byline">— Mikayla R., Google My Business</p>
    </article>
    <article class="twr-testi-card">
      <div class="twr-testi-card__media"><img src="https://cdn.prod.website-files.com/689161a0ec1f462be1dbfd7e/6892dcfde9b592e0694ac6a1_pexels-kindelmedia-8550107%202.png" alt="Chris D." loading="lazy"></div>
      <p class="twr-testi-card__text">Great experience with the Tower team from the first property search through ongoing management. Anna handled contractor work fast when we had water damage from frozen pipes — and our place came with TX residency too.</p>
      <p class="twr-testi-card__byline">— Chris D., Google My Business</p>
    </article>
    <article class="twr-testi-card">
      <div class="twr-testi-card__media"><img src="https://cdn.prod.website-files.com/689161a0ec1f462be1dbfd7e/6892dcfdf8c74a3949e79b81_pexels-olly-712521%201.png" alt="William S." loading="lazy"></div>
      <p class="twr-testi-card__text">Leased a condo through Tower for two and a half years and found them to be excellent landlords — fast on service requests, with an online payment portal that was easier to use than any landlord I'd had before.</p>
      <p class="twr-testi-card__byline">— William S., Yelp.com</p>
    </article>
  </div>
</section>

<script>
(function () {
  var cards = document.querySelectorAll('.twr-testi-card');
  if (!cards.length) return;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) { cards.forEach(function (c) { c.classList.add('is-visible'); }); return; }
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var i = Array.prototype.indexOf.call(cards, entry.target);
        setTimeout(function () { entry.target.classList.add('is-visible'); }, i * 90);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  cards.forEach(function (c) { obs.observe(c); });
})();
</script>

<!-- ============================================================
     WHY CHOOSE US
============================================================ -->
<style>
.twr-why, .twr-why *, .twr-why *::before, .twr-why *::after { box-sizing: border-box; margin: 0; padding: 0; }
.twr-why { font-family: 'Inter Tight', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; margin: 0 clamp(10px, 1.4vw, 18px); padding: clamp(24px, 3vw, 44px) 0 clamp(40px, 5vw, 64px); }
.twr-why__card { background: #D05F28; border-radius: 24px; overflow: hidden; }
.twr-why__top { display: grid; grid-template-columns: clamp(140px, 14vw, 190px) 1fr; gap: clamp(20px, 2.6vw, 40px); align-items: start; padding: clamp(28px, 3.6vw, 44px) clamp(24px, 3.4vw, 44px) clamp(24px, 3vw, 32px); }
.twr-why__eyebrow { font-family: 'Lustria', Georgia, serif; font-size: clamp(15px, 1.1vw, 18px); font-weight: 400; color: rgba(255,255,255,.6); letter-spacing: .04em; text-transform: uppercase; padding-top: 11px; }
.twr-why__list { display: flex; flex-direction: column; gap: 10px; }
.twr-why-item { background: rgba(0,0,0,.16); border-radius: 14px; overflow: hidden; opacity: 0; transform: translateY(16px); transition: opacity .55s ease, transform .55s ease, background .3s ease; }
.twr-why-item.is-visible { opacity: 1; transform: translateY(0); }
.twr-why-item:hover { background: rgba(0,0,0,.24); }
.twr-why-item__head { width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 16px; background: none; border: none; cursor: pointer; padding: clamp(13px, 1.5vw, 17px) clamp(16px, 2vw, 22px); text-align: left; }
.twr-why-item__title { font-family: 'Inter Tight', sans-serif; font-size: clamp(14px, 1.2vw, 16px); font-weight: 500; color: #fff; line-height: 1.4; }
.twr-why-item__icon { flex: none; width: 20px; height: 20px; position: relative; }
.twr-why-item__icon::before, .twr-why-item__icon::after { content: ''; position: absolute; top: 50%; left: 50%; background: #fff; border-radius: 2px; transition: transform .35s ease; }
.twr-why-item__icon::before { width: 12px; height: 2px; transform: translate(-50%,-50%); }
.twr-why-item__icon::after  { width: 2px; height: 12px; transform: translate(-50%,-50%); }
.twr-why-item.is-open .twr-why-item__icon::after { transform: translate(-50%,-50%) rotate(90deg); opacity: 0; }
.twr-why-item.is-open .twr-why-item__icon::before { transform: translate(-50%,-50%) rotate(180deg); }
.twr-why-item__panel { display: grid; grid-template-rows: 0fr; transition: grid-template-rows .45s ease; }
.twr-why-item.is-open .twr-why-item__panel { grid-template-rows: 1fr; }
.twr-why-item__panel-inner { overflow: hidden; }
.twr-why-item__text { font-family: 'Inter Tight', sans-serif; font-size: clamp(13px, 1vw, 14.5px); font-weight: 400; line-height: 1.6; color: rgba(255,255,255,.82); padding: 0 clamp(16px, 2vw, 22px) clamp(15px, 1.6vw, 19px); }
.twr-why__media { width: 100%; height: clamp(140px, 18vw, 240px); overflow: hidden; }
.twr-why__media img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
@media (max-width: 760px) { .twr-why__top { grid-template-columns: 1fr; gap: 14px; } .twr-why__eyebrow { padding-top: 0; } }
</style>

<section class="twr-why" id="twrWhyUs">
  <div class="twr-why__card">
    <div class="twr-why__top">
      <p class="twr-why__eyebrow">@content('home.why.eyebrow', 'Why Choose Us')</p>
      <div class="twr-why__list">
        <div class="twr-why-item">
          <button class="twr-why-item__head" type="button" aria-expanded="false">
            <span class="twr-why-item__title">Simplified Apartment Hunting</span>
            <span class="twr-why-item__icon" aria-hidden="true"></span>
          </button>
          <div class="twr-why-item__panel"><div class="twr-why-item__panel-inner">
            <p class="twr-why-item__text">When you partner with one of our experienced agents, you'll receive personalized guidance through every step of the leasing process. Our team knows the ins and outs of campus properties and will match you with the perfect home for your lifestyle. Whether you're looking for condos, apartments, or exclusive house listings you won't find elsewhere, Tower Leasing has you covered.</p>
          </div></div>
        </div>
        <div class="twr-why-item">
          <button class="twr-why-item__head" type="button" aria-expanded="false">
            <span class="twr-why-item__title">Perfectly Located for UT Austin Students</span>
            <span class="twr-why-item__icon" aria-hidden="true"></span>
          </button>
          <div class="twr-why-item__panel"><div class="twr-why-item__panel-inner">
            <p class="twr-why-item__text">Situated at 22nd and Rio Grande in the heart of West Campus, our office is perfectly positioned for UT Austin students. This central location makes it simple to connect with our agents — whether during a quick break between classes or a weekend outing.</p>
          </div></div>
        </div>
        <div class="twr-why-item">
          <button class="twr-why-item__head" type="button" aria-expanded="false">
            <span class="twr-why-item__title">Affordable Options for Every Budget</span>
            <span class="twr-why-item__icon" aria-hidden="true"></span>
          </button>
          <div class="twr-why-item__panel"><div class="twr-why-item__panel-inner">
            <p class="twr-why-item__text">We provide an array of housing choices tailored to fit every student's preferences and financial needs. From exclusive discounts to unbeatable deals on select properties, Tower Leasing ensures you'll find a comfortable and affordable space to call your own.</p>
          </div></div>
        </div>
        <div class="twr-why-item">
          <button class="twr-why-item__head" type="button" aria-expanded="false">
            <span class="twr-why-item__title">Our Service Is FREE To You</span>
            <span class="twr-why-item__icon" aria-hidden="true"></span>
          </button>
          <div class="twr-why-item__panel"><div class="twr-why-item__panel-inner">
            <p class="twr-why-item__text">Our services are completely free for students! Tower Leasing partners with top campus housing providers who cover our costs for helping students like you find their ideal homes. This means you'll receive expert assistance and personalized guidance without spending a dime.</p>
          </div></div>
        </div>
      </div>
    </div>
    <div class="twr-why__media">
      <img src="https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?w=1800&q=80&fit=crop&crop=entropy" alt="Modern student apartment complex near UT Austin" loading="lazy">
    </div>
  </div>
</section>

<script>
(function () {
  var items = document.querySelectorAll('.twr-why-item');
  if (!items.length) return;
  items.forEach(function (item) {
    var head = item.querySelector('.twr-why-item__head');
    head.addEventListener('click', function () {
      var wasOpen = item.classList.contains('is-open');
      items.forEach(function (i) { i.classList.remove('is-open'); i.querySelector('.twr-why-item__head').setAttribute('aria-expanded', 'false'); });
      if (!wasOpen) { item.classList.add('is-open'); head.setAttribute('aria-expanded', 'true'); }
    });
  });
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) { items.forEach(function (i) { i.classList.add('is-visible'); }); return; }
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var i = Array.prototype.indexOf.call(items, entry.target);
        setTimeout(function () { entry.target.classList.add('is-visible'); }, i * 80);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  items.forEach(function (i) { obs.observe(i); });
})();
</script>

<!-- ============================================================
     FOOTER
============================================================ -->
<style>
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
.twr-footer__social a { width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255,255,255,.18); display: grid; place-items: center; color: #fff; transition: background .25s ease, border-color .25s ease, transform .25s ease; }
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
@media (prefers-reduced-motion: reduce) { .twr-footer--anim .twr-foot-anim { opacity: 1!important; transform: none!important; transition: none!important; } .twr-footer__logo { animation: none!important; } }
@media (max-width: 1024px) { .twr-footer__cta { grid-template-columns: 1fr; gap: 24px; } .twr-footer__cta-actions { justify-content: flex-start; } .twr-footer__main { grid-template-columns: 1fr 1fr; gap: 36px 28px; } .twr-footer__brand { grid-column: 1 / -1; } }
@media (max-width: 620px) { .twr-footer__main { grid-template-columns: 1fr; } .twr-footer__bottom { flex-direction: column; justify-content: center; text-align: center; gap: 14px; } .twr-footer__ghost { font-size: 22vw; } }
</style>

<footer class="twr-footer" id="twrFooter">
  <div class="twr-footer__card">
    <span class="twr-footer__ghost" aria-hidden="true">Tower Leasing</span>
    <div class="twr-footer__cta">
      <h2 class="twr-footer__cta-title twr-foot-anim" style="--d:0s">@content('global.footer.cta_title', 'Ready to find your place near UT Austin?')</h2>
      <div class="twr-footer__cta-actions twr-foot-anim" style="--d:.1s">
        <a class="twr-footer__btn" href="{{ route('website.properties') }}">Browse listings <svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="twr-footer__calllink" href="tel:512-982-1560"><svg viewBox="0 0 20 20" width="16" height="16" fill="none"><path d="M5 3.5c0 6 5.5 11.5 11.5 11.5l.5-2.5-3-1-1.2 1.4A9 9 0 0 1 7.6 7.7L9 6.5l-1-3L5 3.5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>512-982-1560</a>
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
          <a href="https://www.trec.texas.gov/forms/information-about-brokerage-services" target="_blank" rel="noopener"><span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>TREC Information About Brokerage</a>
          <a href="https://www.trec.texas.gov/forms/consumer-protection-notice" target="_blank" rel="noopener"><span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>TREC Consumer Notice</a>
          <a href="https://tower-leasing.com/properties/"><span class="twr-footer__arrow" aria-hidden="true"><svg viewBox="0 0 20 20" fill="none"><path d="M4 10h11M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Online Leasing Application</a>
        </div>
      </div>
    </div>
    <div class="twr-footer__bottom twr-foot-anim" style="--d:.3s">
      <p class="twr-footer__copy">@content('global.footer.copyright', 'Copyright © 2026 Tower Realty Austin, all rights reserved')</p>
      <a class="twr-footer__totop" href="#twrHeader">Back to top <svg viewBox="0 0 20 20" fill="none"><path d="M10 16V4M5 9l5-5 5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
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
