<x-guest-layout>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('reservations.store') }}" method="POST" class="m-5">
                @csrf
                @method('POST')

                <!-- -->

                <x-label name="start_time">Start</x-label>
                <x-input type="time" name="start_time"></x-input>

                <x-label name="end_time">End</x-label>
                <x-input type="time" name="end_time"></x-input>

                <x-label name="person_count">Guests count</x-label>
                <x-input type="number" name="person_count"></x-input>

                <x-label name="reserver">Reserver name</x-label>
                <x-input type="text" name="reserver"></x-input>

                <x-label name="phone_number">Phone</x-label>
                <x-input type="text" name="phone_number"></x-input>

                <x-label name="description">Notes</x-label>
                <textarea name="description" class="block"></textarea>

                <x-input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}"></x-input>
                <x-button type="submit" class="mt-5">Reserve</x-button>

                <!-- -->

                {{-- <div class="form-group">
                    <label for="start_time">Sākums</label>
                    <input type="time" class="form-control" id="start_time" name="start_time">
                </div>
                <div class="form-group">
                    <label for="end_time">Beigas</label>
                    <input type="time" class="form-control" id="end_time" name="end_time">
                </div>
                <div class="form-group">
                    <label for="person_count">Cilvēku skaits</label>
                    <input type="number" class="form-control" id="person_count" name="person_count">
                </div>

                <div class="form-group">
                    <label for="description">Piezīmes</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="reserver">Rezervētāja vārds (pēc noklusējuma jūsu vārds)</label>
                    <input type="text" class="form-control" id="reserver" name="reserver">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Rezervēt</button>
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}"> --}}

                {{-- <div class="form-group">
                    <label for="content">Galda nr.</label>
                    <input type="number" class="form-control" id="tablenum" name="tablenum">
                </div> --}}
            </form>
        </div>
    </div>
</x-guest-layout>
