@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ $post->title }}</h1>
    
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid mb-4">
    @endif
    
    <p>{{ $post->description }}</p>

    @if ($post->location)
        <p><strong>場所:</strong> {{ $post->location }}</p>
        
        <!-- Google Mapsを表示 -->
        <div id="map" style="height: 400px;"></div>
        <script>
            function initMap() {
                var location = "{{ $post->location }}";
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': location }, function(results, status) {
                    if (status === 'OK') {
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 14,
                            center: results[0].geometry.location
                        });
                        new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map
                        });
                    } else {
                        console.error('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    @endif

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection
