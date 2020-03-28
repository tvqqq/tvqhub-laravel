@extends('layouts.app')
@section('title', 'Facebooker')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Facebooker</strong>
        </div>

        <div class="card-body">
            <div id="app-facebooker">
                <app :backend="{{ json_encode($backend) }}"></app>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/facebooker.js') }}"></script>
@endpush
