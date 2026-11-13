
<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Airline Name *</label>
        <input type="text" name="airline" class="form-control"
               value="{{ old('airline', $flight->airline ?? '') }}" required>
        @error('airline') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Flight Number *</label>
        <input type="text" name="flight_number" class="form-control"
               value="{{ old('flight_number', $flight->flight_number ?? '') }}" required>
        @error('flight_number') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Departure City *</label>
        <input type="text" name="departure_city" class="form-control"
               value="{{ old('departure_city', $flight->departure_city ?? '') }}" required>
        @error('departure_city') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Arrival City *</label>
        <input type="text" name="arrival_city" class="form-control"
               value="{{ old('arrival_city', $flight->arrival_city ?? '') }}" required>
        @error('arrival_city') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Departure Airport</label>
        <input type="text" name="departure_airport" class="form-control"
               value="{{ old('departure_airport', $flight->departure_airport ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Arrival Airport</label>
        <input type="text" name="arrival_airport" class="form-control"
               value="{{ old('arrival_airport', $flight->arrival_airport ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Departure Date & Time *</label>
        <input type="datetime-local" name="departure_time" class="form-control"
               value="{{ old('departure_time', isset($flight) ? $flight->departure_time->format('Y-m-d\TH:i') : '') }}" required>
        @error('departure_time') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Arrival Date & Time *</label>
        <input type="datetime-local" name="arrival_time" class="form-control"
               value="{{ old('arrival_time', isset($flight) ? $flight->arrival_time->format('Y-m-d\TH:i') : '') }}" required>
        @error('arrival_time') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Price Per Passenger (₹) *</label>
        <input type="number" name="price" class="form-control" min="0" step="0.01"
               value="{{ old('price', $flight->price ?? '') }}" required>
        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Total Seats *</label>
        <input type="number" name="total_seats" class="form-control" min="1"
               value="{{ old('total_seats', $flight->total_seats ?? 100) }}" required>
        @error('total_seats') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Travel Class *</label>
        <select name="travel_class" class="form-select" required>
            @foreach(['Economy', 'Business', 'First Class'] as $class)
                <option value="{{ $class }}"
                    {{ old('travel_class', $flight->travel_class ?? 'Economy') == $class ? 'selected' : '' }}>
                    {{ $class }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Flight Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror

        @if(isset($flight) && $flight->image)
            <img src="{{ travely_image_url($flight->image) }}"
                 width="130" class="mt-3 rounded" alt="Flight image">
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select" required>
            <option value="1" {{ old('status', $flight->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $flight->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

</div>

@foreach($errors->all() as $error)
    <div class="text-danger small mt-2">{{ $error }}</div>
@endforeach
