@csrf
<div class="grid">
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', $property->name ?? '') }}" required>
    </div>
    <div>
        <label>Address</label>
        <input name="address" value="{{ old('address', $property->address ?? '') }}" required>
    </div>
    <div>
        <label>City</label>
        <input name="city" value="{{ old('city', $property->city ?? '') }}" required>
    </div>
    <div>
        <label>Neighborhood / Area</label>
        <input name="neighborhood" value="{{ old('neighborhood', $property->neighborhood ?? '') }}" placeholder="e.g. West Campus">
    </div>
    <div>
        <label>Property Type</label>
        <select name="property_type">
            <option value="">Select type</option>
            @foreach (\App\Support\PropertyFilter::TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('property_type', $property->property_type ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>State</label>
        <input name="state" value="{{ old('state', $property->state ?? '') }}" required>
    </div>
    <div>
        <label>ZIP</label>
        <input name="zip" value="{{ old('zip', $property->zip ?? '') }}" required>
    </div>
    <div>
        <label>Price ($/month)</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $property->price ?? '') }}" placeholder="e.g. 1200">
    </div>
    <div>
        <label>Property Image</label>
        <input name="image" type="file" accept="image/*">
        @if (isset($property) && $property->image_url)
            <div style="margin-top:8px">
                <img src="{{ $property->image_url }}" alt="{{ $property->name }} image" style="width:160px;height:100px;object-fit:cover;border-radius:8px;border:1px solid #ddd">
            </div>
        @endif
    </div>
</div>

<label>Description</label>
<textarea name="description" rows="3">{{ old('description', $property->description ?? '') }}</textarea>

@if (!empty($amenities))
    <label style="margin-top:14px">Amenities</label>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:8px 16px;margin-bottom:8px">
        @php $selected = old('amenities', isset($property) ? $property->amenities->pluck('id')->all() : []); @endphp
        @foreach ($amenities as $amenity)
            <label style="display:flex;align-items:center;gap:8px;font-weight:400;margin:0">
                <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}" @checked(in_array($amenity->id, $selected))>
                {{ $amenity->name }}
            </label>
        @endforeach
    </div>
@endif

<fieldset style="margin-top:18px;border:1px solid var(--line);border-radius:8px;padding:14px 16px">
    <legend style="font-weight:700;font-size:13px;padding:0 6px;color:#374151">Visibility</legend>
    <div style="display:flex;flex-wrap:wrap;gap:18px 28px">
        <label style="display:flex;align-items:center;gap:8px;font-weight:400;margin:0;cursor:pointer">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $property->is_published ?? true))>
            Published on website
        </label>
        <label style="display:flex;align-items:center;gap:8px;font-weight:400;margin:0;cursor:pointer">
            <input type="checkbox" name="featured" value="1" @checked(old('featured', $property->featured ?? false))>
            Featured on homepage
        </label>
    </div>
</fieldset>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('properties.index') }}" class="btn secondary">Cancel</a>
</div>
