@extends('layouts.website')
@section('title', $property->name . ' | Tower Realty Austin')
@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700;800&family=Lustria&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Inter Tight', system-ui, sans-serif; color: #121212; background: #f7f4ef; -webkit-font-smoothing: antialiased; }
a { color: inherit; }
.twr-detail { --ink:#121212; --muted:#69645f; --orange:#d05f28; --soft:#fffaf4; --line:rgba(18,18,18,.1); --max:1380px; }
.twr-top { position: fixed; inset: 18px clamp(14px, 2vw, 30px) auto; z-index: 20; }
.twr-top__bar { max-width: var(--max); margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 10px 12px 10px 24px; border-radius: 999px; background: rgba(255,255,255,.92); box-shadow: 0 18px 50px -24px rgba(0,0,0,.3); backdrop-filter: blur(18px); }
.twr-top__logo img { height: 46px; display: block; }
.twr-top__nav { display: flex; align-items: center; gap: clamp(14px, 2vw, 30px); font-size: 15px; font-weight: 600; }
.twr-top__nav a { text-decoration: none; }
.twr-top__cta { background: #111; color: #fff; text-decoration: none; border-radius: 999px; padding: 12px 18px; font-weight: 700; }
.twr-top { animation: twrDrop .75s cubic-bezier(.2,.75,.2,1) both; }
.twr-hero { padding: 112px clamp(10px, 1.4vw, 18px) 0; }
.twr-gallery { display: grid; grid-template-columns: 1.35fr .82fr .82fr; height: min(62vh, 620px); min-height: 420px; border-radius: 0 0 32px 32px; overflow: hidden; background: #111; }
.twr-gallery__tile { position: relative; overflow: hidden; min-width: 0; }
.twr-gallery__tile:first-child { grid-row: span 2; }
.twr-gallery__tile { opacity: 0; transform: translateY(18px) scale(.985); animation: twrGalleryIn .9s cubic-bezier(.2,.75,.2,1) both; animation-delay: calc(var(--i, 0) * .08s); }
.twr-gallery img { width: 100%; height: 100%; object-fit: cover; display: block; transform: scale(1.08); transition: transform .8s ease; animation: twrImageSettle 1.4s cubic-bezier(.2,.75,.2,1) both; animation-delay: calc(.12s + var(--i, 0) * .08s); }
.twr-gallery__tile:hover img { transform: scale(1.07); }
.twr-gallery__shade { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.58) 0%, rgba(0,0,0,.48) 45%, rgba(0,0,0,.58) 100%); pointer-events: none; }
.twr-hero-meta { max-width: var(--max); margin: -86px auto 0; padding: 0 clamp(20px, 3vw, 52px); position: relative; z-index: 3; }
.twr-title-card { max-width: 840px; background: rgba(0,0,0,.56); color: #fff; border: 1px solid rgba(255,255,255,.22); border-radius: 24px; padding: clamp(24px, 3vw, 42px); box-shadow: 0 28px 80px -38px rgba(0,0,0,.42); backdrop-filter: blur(18px); }
.twr-title-card, .twr-back { animation: twrRise .9s cubic-bezier(.2,.75,.2,1) both; }
.twr-title-card { animation-delay: .18s; }
.twr-back { animation-delay: .08s; }
.twr-kicker { display: inline-flex; align-items: center; gap: 8px; color: #fff; font-size: 12px; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; margin-bottom: 12px; }
.twr-title { font-family: 'Lustria', Georgia, serif; font-size: clamp(42px, 6vw, 82px); font-weight: 400; line-height: .98; letter-spacing: 0; }
.twr-address { margin-top: 16px; color: #fff; font-size: clamp(16px, 1.5vw, 20px); }
.twr-main { max-width: var(--max); margin: 44px auto 0; padding: 0 clamp(20px, 3vw, 52px) 80px; display: grid; grid-template-columns: minmax(0, 1fr) 400px; gap: clamp(28px, 4vw, 58px); align-items: start; }
.twr-panel { position: relative; background: rgba(255,255,255,.88); border: 1px solid rgba(18,18,18,.08); border-radius: 28px; box-shadow: 0 28px 90px -52px rgba(47,35,25,.45); overflow: hidden; backdrop-filter: blur(16px); }
.twr-panel::before { content: ''; position: absolute; inset: 0 0 auto; height: 6px; background: linear-gradient(90deg, var(--orange), #f2b07c 42%, rgba(255,255,255,0)); pointer-events: none; }
.twr-section { position: relative; padding: clamp(26px, 3.2vw, 42px); }
.twr-section + .twr-section { border-top: 1px solid var(--line); }
.twr-section h2 { font-family: 'Lustria', Georgia, serif; font-size: clamp(28px, 3vw, 42px); font-weight: 400; margin-bottom: 14px; display: flex; align-items: center; gap: 12px; }
.twr-section h2::before { content: ''; width: 9px; height: 9px; border-radius: 50%; background: var(--orange); box-shadow: 0 0 0 7px rgba(208,95,40,.1); flex: none; }
.twr-copy { color: var(--muted); font-size: 17px; line-height: 1.75; max-width: 820px; }
.twr-stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; margin-top: 22px; }
.twr-stat { background: linear-gradient(180deg, #fffaf4, #fff); border: 1px solid rgba(208,95,40,.18); border-radius: 20px; padding: 18px; transition: transform .25s ease, box-shadow .25s ease; box-shadow: inset 0 1px 0 rgba(255,255,255,.9); }
.twr-stat:hover { transform: translateY(-4px); box-shadow: 0 18px 38px -28px rgba(208,95,40,.55); }
.twr-stat span { display: block; color: var(--muted); font-size: 12px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 8px; }
.twr-stat strong { font-size: 20px; font-weight: 800; }
.twr-amenities { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 10px; margin-top: 20px; }
.twr-amenity { display: flex; align-items: center; gap: 10px; padding: 12px 13px; border: 1px solid var(--line); border-radius: 999px; color: #2b2927; background: #fff; font-weight: 600; transition: transform .22s ease, border-color .22s ease, background .22s ease; }
.twr-amenity:hover { transform: translateY(-3px); border-color: rgba(208,95,40,.35); background: #fffaf4; }
.twr-dot { width: 8px; height: 8px; border-radius: 999px; background: var(--orange); flex: none; }
.twr-units { display: grid; gap: 12px; margin-top: 18px; }
.twr-unit { display: grid; grid-template-columns: 1fr repeat(4, auto); gap: 16px; align-items: center; padding: 16px; border: 1px solid var(--line); border-radius: 18px; background: #fff; transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease; }
.twr-unit:hover { transform: translateX(4px); border-color: rgba(208,95,40,.28); box-shadow: 0 16px 38px -32px rgba(0,0,0,.38); }
.twr-unit strong { font-size: 16px; }
.twr-unit span { color: var(--muted); font-size: 14px; white-space: nowrap; }
.twr-side { position: sticky; top: 96px; display: grid; gap: 18px; }
.twr-book { padding: 28px; background: linear-gradient(180deg, rgba(255,255,255,.94), rgba(255,250,244,.9)); }
.twr-book::after { content: ''; position: absolute; right: -70px; top: -70px; width: 190px; height: 190px; border-radius: 50%; background: rgba(208,95,40,.09); pointer-events: none; }
.twr-book__label { display: inline-flex; align-items: center; gap: 8px; padding: 8px 11px; border-radius: 999px; background: rgba(208,95,40,.1); color: var(--orange); font-size: 12px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 16px; }
.twr-book__label::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--orange); }
.twr-book__price { font-family: 'Lustria', Georgia, serif; font-size: 44px; line-height: 1; position: relative; z-index: 1; }
.twr-book__price span { font-family: 'Inter Tight'; color: var(--muted); font-size: 15px; }
.twr-book__text { color: var(--muted); line-height: 1.6; margin: 12px 0 20px; position: relative; z-index: 1; }
.twr-actions { display: grid; gap: 10px; }
.twr-btn { display: inline-flex; justify-content: center; align-items: center; gap: 9px; min-height: 50px; border-radius: 999px; padding: 12px 18px; text-decoration: none; font-weight: 800; border: 1px solid #111; background: #111; color: #fff; transition: transform .2s ease, background .2s ease, box-shadow .2s ease; box-shadow: 0 18px 34px -24px rgba(0,0,0,.55); }
.twr-btn:hover { transform: translateY(-2px); background: var(--orange); border-color: var(--orange); }
.twr-btn--light { background: #fff; color: #111; border-color: var(--line); }
.twr-book__mini { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 18px 0 2px; position: relative; z-index: 1; }
.twr-book__mini div { border: 1px solid rgba(18,18,18,.08); border-radius: 16px; padding: 12px; background: rgba(255,255,255,.62); }
.twr-book__mini span { display: block; color: var(--muted); font-size: 11px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 5px; }
.twr-book__mini strong { font-size: 15px; }
.twr-form { display: grid; gap: 10px; margin-top: 18px; padding-top: 18px; border-top: 1px solid rgba(18,18,18,.08); position: relative; z-index: 1; }
.twr-form input, .twr-form textarea { width: 100%; border: 1px solid rgba(18,18,18,.1); border-radius: 16px; padding: 14px 15px; font: inherit; outline: none; background: rgba(255,255,255,.78); transition: border-color .2s ease, box-shadow .2s ease, background .2s ease; }
.twr-form input:focus, .twr-form textarea:focus { border-color: rgba(208,95,40,.45); box-shadow: 0 0 0 4px rgba(208,95,40,.1); background: #fff; }
.twr-form textarea { min-height: 100px; resize: vertical; }
.twr-form__notice { border-radius: 14px; padding: 12px 14px; font-size: 14px; line-height: 1.45; }
.twr-form__notice--success { color: #166534; background: #ecfdf5; border: 1px solid #bbf7d0; }
.twr-form__notice--error { color: #991b1b; background: #fef2f2; border: 1px solid #fecaca; }
.twr-review { display: grid; gap: 18px; margin-top: 4px; }
.twr-review__intro { color: var(--muted); font-size: 16px; line-height: 1.55; }
.twr-review__field { width: 100%; border: 1px solid rgba(35,55,255,.16); border-radius: 4px; padding: 17px 14px; font: inherit; font-size: 18px; outline: none; background: #fff; transition: border-color .2s ease, box-shadow .2s ease; }
.twr-review__field:focus { border-color: rgba(208,95,40,.75); box-shadow: 0 0 0 4px rgba(208,95,40,.1); }
.twr-review textarea.twr-review__field { min-height: 126px; resize: vertical; }
.twr-review__rating { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.twr-review__rating strong { font-size: 18px; }
.twr-review__rating strong span { color: var(--orange); }
.twr-stars { display: inline-flex; flex-direction: row-reverse; justify-content: flex-end; line-height: 1; }
.twr-stars input { position: absolute; opacity: 0; pointer-events: none; }
.twr-stars label { color: #8f8f8f; cursor: pointer; font-size: 28px; padding: 0 1px; transition: color .15s ease, transform .15s ease; }
.twr-stars label:hover, .twr-stars label:hover ~ label, .twr-stars input:checked ~ label { color: var(--orange); }
.twr-stars label:hover { transform: translateY(-1px); }
.twr-review__submit { justify-self: start; min-width: 212px; border-radius: 4px; border: 2px solid var(--orange); background: #fff; color: var(--orange); box-shadow: none; }
.twr-review__submit:hover { color: #fff; }
.twr-related { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 16px; margin-top: 20px; }
.twr-related a { text-decoration: none; display: block; overflow: hidden; border-radius: 18px; background: #fff; border: 1px solid var(--line); transition: transform .25s ease, box-shadow .25s ease; }
.twr-related a:hover { transform: translateY(-5px); box-shadow: 0 22px 46px -34px rgba(0,0,0,.42); }
.twr-related img { width: 100%; height: 150px; object-fit: cover; display: block; transition: transform .7s ease; }
.twr-related a:hover img { transform: scale(1.06); }
.twr-related div { padding: 14px; }
.twr-related strong { display: block; font-family: 'Lustria', Georgia, serif; font-size: 20px; font-weight: 400; }
.twr-related span { display: block; color: var(--muted); font-size: 13px; margin-top: 5px; }
.twr-back { display: inline-flex; margin-bottom: 16px; color: #fff; text-decoration: none; font-weight: 800; text-shadow: 0 2px 14px rgba(0,0,0,.4); }
.twr-reveal { opacity: 0; transform: translateY(24px); transition: opacity .75s cubic-bezier(.2,.75,.2,1), transform .75s cubic-bezier(.2,.75,.2,1); transition-delay: var(--d, 0s); }
.twr-reveal.is-in { opacity: 1; transform: none; }
.twr-side.twr-reveal { transform: translateY(18px) scale(.985); }
.twr-side.twr-reveal.is-in { transform: none; }
@keyframes twrDrop { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: none; } }
@keyframes twrRise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }
@keyframes twrGalleryIn { from { opacity: 0; transform: translateY(18px) scale(.985); } to { opacity: 1; transform: none; } }
@keyframes twrImageSettle { from { transform: scale(1.12); filter: saturate(.85); } to { transform: scale(1.02); filter: saturate(1); } }
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; transition-duration: .01ms !important; }
  .twr-reveal { opacity: 1 !important; transform: none !important; }
}
@media (max-width: 980px) {
  .twr-top__nav { display: none; }
  .twr-gallery { grid-template-columns: 1fr 1fr; height: auto; min-height: 0; }
  .twr-gallery__tile { aspect-ratio: 1.45; }
  .twr-gallery__tile:first-child { grid-column: 1 / -1; grid-row: auto; aspect-ratio: 1.7; }
  .twr-main { grid-template-columns: 1fr; }
  .twr-side { position: static; }
  .twr-stats, .twr-amenities, .twr-related { grid-template-columns: repeat(2, minmax(0,1fr)); }
}
@media (max-width: 620px) {
  .twr-top__bar { padding-left: 16px; }
  .twr-top__logo img { height: 38px; }
  .twr-top__cta { padding: 10px 13px; font-size: 13px; }
  .twr-hero { padding-top: 92px; }
  .twr-gallery { border-radius: 0 0 22px 22px; }
  .twr-hero-meta { margin-top: -46px; }
  .twr-title-card { border-radius: 18px; }
  .twr-stats, .twr-amenities, .twr-related { grid-template-columns: 1fr; }
  .twr-unit { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush
@section('content')
@php
  $typeLabel = \App\Support\PropertyFilter::TYPES[$property->property_type] ?? 'Property';
  $image = $property->image_url ?: 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&q=85&fit=crop';
  $gallery = [
      $image,
      'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200&q=85&fit=crop',
      'https://images.unsplash.com/photo-1556911220-bff31c812dba?w=1200&q=85&fit=crop',
      'https://images.unsplash.com/photo-1560185008-b033106af5c3?w=1200&q=85&fit=crop',
      'https://images.unsplash.com/photo-1560184897-ae75f418493e?w=1200&q=85&fit=crop',
  ];
  $bedLabel = $property->min_bedrooms == $property->max_bedrooms
      ? ($property->min_bedrooms == 0 ? 'Studio' : ($property->min_bedrooms ?: 'Any').'BR')
      : ($property->min_bedrooms == 0 ? 'Studio' : $property->min_bedrooms.'BR').' - '.$property->max_bedrooms.'BR';
  $available = $property->min_available_on ? \Illuminate\Support\Carbon::parse($property->min_available_on)->format('M Y') : 'Now';
@endphp
<div class="twr-detail">
  <header class="twr-top">
    <div class="twr-top__bar">
      <a class="twr-top__logo" href="{{ route('home') }}"><img src="https://tower-leasing.com/wp-content/uploads/2025/01/cropped-Tower-Leasing-1.png" alt="Tower Realty Austin"></a>
      <nav class="twr-top__nav">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('website.properties') }}">Properties</a>
        <a href="{{ route('website.agents') }}">Agents</a>
        <a href="{{ route('website.contact') }}">Contact</a>
      </nav>
      <a class="twr-top__cta" href="{{ route('website.contact') }}">Book a tour</a>
    </div>
  </header>

  <section class="twr-hero">
    <div class="twr-gallery">
      @foreach ($gallery as $photo)
        <div class="twr-gallery__tile" style="--i:{{ $loop->index }}"><img src="{{ $photo }}" alt="{{ $property->name }} photo {{ $loop->iteration }}" style="--i:{{ $loop->index }}"><span class="twr-gallery__shade"></span></div>
      @endforeach
    </div>
    <div class="twr-hero-meta">
      <a class="twr-back" href="{{ route('website.properties') }}">Back to properties</a>
      <div class="twr-title-card">
        <p class="twr-kicker">{{ $typeLabel }} in {{ $property->neighborhood ?: $property->city }}</p>
        <h1 class="twr-title">{{ $property->name }}</h1>
        <p class="twr-address">{{ $property->address }}, {{ $property->city }}, {{ $property->state }} {{ $property->zip }}</p>
      </div>
    </div>
  </section>

  <main class="twr-main">
    <div class="twr-panel twr-reveal">
      <section class="twr-section twr-reveal" style="--d:.04s">
        <h2>Property Overview</h2>
        <p class="twr-copy">{{ $property->description ?: 'A polished Austin property close to campus, daily essentials, coffee shops, and the neighborhoods students ask for most. Share your move-in timing and budget, and our leasing team will help you match the right unit.' }}</p>
        <div class="twr-stats">
          <div class="twr-stat twr-reveal" style="--d:.06s"><span>Starting From</span><strong>${{ number_format($property->min_rent ?? 0) }}</strong></div>
          <div class="twr-stat twr-reveal" style="--d:.1s"><span>Unit Types</span><strong>{{ $bedLabel }}</strong></div>
          <div class="twr-stat twr-reveal" style="--d:.14s"><span>Available</span><strong>{{ $available }}</strong></div>
          <div class="twr-stat twr-reveal" style="--d:.18s"><span>Location</span><strong>{{ $property->neighborhood ?: $property->city }}</strong></div>
        </div>
      </section>

      @if ($property->amenities->isNotEmpty())
        <section class="twr-section twr-reveal">
          <h2>Amenities</h2>
          <div class="twr-amenities">
            @foreach ($property->amenities as $amenity)
              <div class="twr-amenity twr-reveal" style="--d:{{ min($loop->index * 0.035, 0.28) }}s"><span class="twr-dot"></span>{{ $amenity->name }}</div>
            @endforeach
          </div>
        </section>
      @endif

      <section class="twr-section twr-reveal">
        <h2>Available Units</h2>
        @if ($property->units->isNotEmpty())
          <div class="twr-units">
            @foreach ($property->units as $unit)
              <div class="twr-unit twr-reveal" style="--d:{{ min($loop->index * 0.06, 0.3) }}s">
                <strong>Unit {{ $unit->unit_number }}</strong>
                <span>{{ $unit->bedrooms == 0 ? 'Studio' : $unit->bedrooms.' bed' }}</span>
                <span>{{ $unit->bathrooms }} bath</span>
                <span>{{ $unit->square_feet ? number_format($unit->square_feet).' sqft' : 'Sqft TBD' }}</span>
                <span>${{ number_format($unit->rent) }}/mo</span>
              </div>
            @endforeach
          </div>
        @else
          <p class="twr-copy">No currently available units are listed, but availability changes quickly. Contact us and we will check the newest options for this property.</p>
        @endif
      </section>

      <section class="twr-section twr-reveal">
        <h2>Leave a review for {{ $property->name }}</h2>
        <form class="twr-review" action="{{ route('website.properties.review', $property) }}" method="POST">
          @csrf
          <p class="twr-review__intro">Your email address will not be published. Required fields are marked *</p>
          @if (session('review_status'))
            <div class="twr-form__notice twr-form__notice--success">{{ session('review_status') }}</div>
          @endif
          @if ($errors->review->any())
            <div class="twr-form__notice twr-form__notice--error">Please complete your name, email, rating, and review.</div>
          @endif
          <input class="twr-review__field" type="text" name="name" value="{{ old('name') }}" placeholder="Name *" required>
          <input class="twr-review__field" type="email" name="email" value="{{ old('email') }}" placeholder="Email *" required>
          <div class="twr-review__rating">
            <strong>Rating<span>*</span></strong>
            <div class="twr-stars" aria-label="Rating">
              @for ($rating = 5; $rating >= 1; $rating--)
                <input type="radio" id="property-rating-{{ $rating }}" name="rating" value="{{ $rating }}" {{ (string) old('rating') === (string) $rating ? 'checked' : '' }} required>
                <label for="property-rating-{{ $rating }}" title="{{ $rating }} star{{ $rating === 1 ? '' : 's' }}">&#9733;</label>
              @endfor
            </div>
          </div>
          <textarea class="twr-review__field" name="review" placeholder="Write a Review" required>{{ old('review') }}</textarea>
          <button class="twr-btn twr-review__submit" type="submit">Submit Review</button>
        </form>
      </section>

      @if ($related->isNotEmpty())
        <section class="twr-section twr-reveal">
          <h2>More Nearby Listings</h2>
          <div class="twr-related">
            @foreach ($related as $item)
              <a class="twr-reveal" style="--d:{{ $loop->index * 0.08 }}s" href="{{ route('website.properties.show', $item) }}">
                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&q=80' }}" alt="{{ $item->name }}">
                <div><strong>{{ $item->name }}</strong><span>${{ number_format($item->min_rent ?? 0) }}/mo</span></div>
              </a>
            @endforeach
          </div>
        </section>
      @endif
    </div>

    <aside class="twr-side twr-reveal" style="--d:.12s">
      <div class="twr-panel twr-book">
        <div class="twr-book__label">Leasing concierge</div>
        <div class="twr-book__price">${{ number_format($property->min_rent ?? 0) }} <span>/ mo</span></div>
        <p class="twr-book__text">Want this one? Send your details and Tower Leasing will help you confirm pricing, availability, and the best tour time.</p>
        <div class="twr-actions">
          <a class="twr-btn" href="{{ route('website.contact') }}">Schedule a tour</a>
          <a class="twr-btn twr-btn--light" href="tel:512-982-1560">Call 512-982-1560</a>
        </div>
        <div class="twr-book__mini">
          <div><span>Available</span><strong>{{ $available }}</strong></div>
          <div><span>Unit Types</span><strong>{{ $bedLabel }}</strong></div>
        </div>
        <form class="twr-form" action="{{ route('website.properties.inquiry', $property) }}" method="POST">
          @csrf
          @if (session('inquiry_status'))
            <div class="twr-form__notice twr-form__notice--success">{{ session('inquiry_status') }}</div>
          @endif
          @if ($errors->inquiry->any())
            <div class="twr-form__notice twr-form__notice--error">Please add your name and a valid email if provided.</div>
          @endif
          <input type="text" name="property" value="{{ $property->name }}" readonly>
          <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address">
          <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
          <textarea name="message" placeholder="Move-in date, budget, and questions">{{ old('message') }}</textarea>
          <button class="twr-btn" type="submit">Send inquiry</button>
        </form>
      </div>
    </aside>
  </main>
</div>
<script>
(function () {
  var items = document.querySelectorAll('.twr-reveal');
  if (!items.length) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion || !('IntersectionObserver' in window)) {
    items.forEach(function (item) { item.classList.add('is-in'); });
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-in');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });

  items.forEach(function (item) { observer.observe(item); });
})();
</script>
@endsection
