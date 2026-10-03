@php
    $filters = $filters ?? [];
    $action = $action ?? url()->current();
    $minPrice = old('min_price', $filters['min_price'] ?? 0);
    $maxPrice = old('max_price', $filters['max_price'] ?? ($options['max_price'] ?? 2000));
    $selectedAmenities = array_map('intval', (array) old('amenities', $filters['amenities'] ?? []));
@endphp
<form method="GET" action="{{ $action }}" class="property-filters">
    <select name="city" class="property-filters__select">
        <option value="">Select City</option>
        @foreach ($options['cities'] as $city)
            <option value="{{ $city }}" @selected(($filters['city'] ?? '') === $city)>{{ $city }}</option>
        @endforeach
    </select>

    <select name="property_type" class="property-filters__select">
        <option value="">Select Property Type</option>
        @foreach ($options['types'] as $value => $label)
            <option value="{{ $value }}" @selected(($filters['property_type'] ?? '') === $value)>{{ $label }}</option>
        @endforeach
    </select>

    <select name="beds" class="property-filters__select">
        <option value="">Select Beds</option>
        @foreach ($options['beds'] as $bed)
            <option value="{{ $bed }}" @selected((string) ($filters['beds'] ?? '') === (string) $bed)>
                {{ $bed === 0 ? 'Studio' : $bed.' Bed'.($bed > 1 ? 's' : '') }}
            </option>
        @endforeach
    </select>

    <select name="baths" class="property-filters__select">
        <option value="">Select Baths</option>
        @foreach ($options['baths'] as $bath)
            <option value="{{ $bath }}" @selected((string) ($filters['baths'] ?? '') === (string) $bath)>
                {{ $bath }} Bath{{ $bath > 1 ? 's' : '' }}
            </option>
        @endforeach
    </select>

    <div class="property-filters__range">
        <div class="property-filters__range-head">
            <span class="property-filters__range-label">Price Range:</span>
            <span class="property-filters__range-value" id="priceRangeLabel">
                ${{ number_format((float) $minPrice) }} – ${{ number_format((float) $maxPrice) }}
            </span>
        </div>
        <div class="property-filters__slider">
            <input type="range" name="min_price" min="0" max="{{ $options['max_price'] }}" step="25"
                   value="{{ $minPrice }}" id="minPrice" class="property-filters__range-input">
            <input type="range" name="max_price" min="0" max="{{ $options['max_price'] }}" step="25"
                   value="{{ $maxPrice }}" id="maxPrice" class="property-filters__range-input">
        </div>
    </div>

    @if ($amenities->isNotEmpty())
        <div class="property-filters__amenities">
            <strong class="property-filters__amenities-title">Amenities:</strong>
            @foreach ($amenities as $amenity)
                <label class="property-filters__check">
                    <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                           @checked(in_array($amenity->id, $selectedAmenities))>
                    <span>{{ $amenity->name }}</span>
                </label>
            @endforeach
        </div>
    @endif

    @if (!empty($filters['search']))
        <input type="hidden" name="search" value="{{ $filters['search'] }}">
    @endif

    <div class="property-filters__actions">
        <button type="submit" class="property-filters__btn">Apply Filters</button>
        <a href="{{ $action }}" class="property-filters__clear">Clear</a>
    </div>
</form>

<script>
(function () {
    var minEl = document.getElementById('minPrice');
    var maxEl = document.getElementById('maxPrice');
    var label = document.getElementById('priceRangeLabel');
    if (!minEl || !maxEl || !label) return;

    function sync() {
        var min = parseInt(minEl.value, 10);
        var max = parseInt(maxEl.value, 10);
        if (min > max) {
            if (document.activeElement === minEl) maxEl.value = min;
            else minEl.value = max;
            min = parseInt(minEl.value, 10);
            max = parseInt(maxEl.value, 10);
        }
        label.textContent = '$' + min.toLocaleString() + ' – $' + max.toLocaleString();
    }

    minEl.addEventListener('input', sync);
    maxEl.addEventListener('input', sync);
    sync();
})();
</script>
