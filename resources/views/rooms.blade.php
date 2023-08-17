@extends('layouts.front-layout')
@section('content')

    <div id="app">
        <room-component></room-component>
    </div>

@endsection
@push('scripts')
    <script>
        $(function() {
            $("#price-range").slider({
                step: 500,
                range: true,
                min: 0,
                max: 20000,
                values: [0, 20000],
                slide: function(event, ui)
                {$("#priceRangeMin").val(ui.values[0]);
                    $("#priceRangeMax").val(ui.values[1]);}
            });
            $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));

        });
    </script>
@endpush
