<x-guest-layout>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('reservations.store') }}" method="post">
                <div class="form-group">
                    <label for="title">Sākums</label>
                    <input type="time" class="form-control" id="starttime" name="starttime">
                </div>
                <div class="form-group">
                    <label for="content">Beigas</label>
                    <input type="time" class="form-control" id="endtime" name="endtime">
                </div>
                <div class="form-group">
                    <label for="content">Cilvēku skaits</label>
                    <input type="number" class="form-control" id="personcount" name="personcount">
                </div>
                {{-- <div class="form-group">
                    <label for="content">Galda nr.</label>
                    <input type="number" class="form-control" id="tablenum" name="tablenum">
                </div> --}}
                <div class="form-group">
                    <label for="content">Piezīmes</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="content">Rezervētāja vārds (pēc noklusējuma jūsu vārds)</label>
                    <input type="text" class="form-control" id="reserver" name="reserver">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Rezervēt</button>
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            </form>
        </div>
    </div>
</x-guest-layout>
