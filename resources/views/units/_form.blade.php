@csrf
@php $statuses = ['available', 'leased', 'unavailable']; @endphp
<div class="grid">
    <div>
        <label>Property</label>
        <select name="property_id" required>
            <option value="">— Select property —</option>
            @foreach ($properties as $p)
                <option value="{{ $p->id }}" @selected(old('property_id', $unit->property_id ?? '') == $p->id)>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Unit Number</label>
        <input name="unit_number" value="{{ old('unit_number', $unit->unit_number ?? '') }}" required>
    </div>
    <div>
        <label>Bedrooms</label>
        <input type="number" name="bedrooms" min="0" value="{{ old('bedrooms', $unit->bedrooms ?? 1) }}" required>
    </div>
    <div>
        <label>Bathrooms</label>
        <input type="number" step="0.5" name="bathrooms" min="0" value="{{ old('bathrooms', $unit->bathrooms ?? 1) }}" required>
    </div>
    <div>
        <label>Square Feet</label>
        <input type="number" name="square_feet" min="0" value="{{ old('square_feet', $unit->square_feet ?? '') }}">
    </div>
    <div>
        <label>Rent ($/month)</label>
        <input type="number" step="0.01" name="rent" min="0" value="{{ old('rent', $unit->rent ?? '') }}" required>
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $unit->status ?? 'available') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Available On</label>
        <input type="date" name="available_on" value="{{ old('available_on', isset($unit->available_on) ? $unit->available_on->format('Y-m-d') : '') }}">
    </div>
</div>
<label>Description</label>
<textarea name="description" rows="3">{{ old('description', $unit->description ?? '') }}</textarea>

<div style="margin-top:18px" class="actions">
    <button class="btn">{{ $submit ?? 'Save' }}</button>
    <a href="{{ route('units.index') }}" class="btn secondary">Cancel</a>
</div>
