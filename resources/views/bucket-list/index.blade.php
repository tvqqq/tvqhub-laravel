@extends('layouts.app')
@section('title', 'Bucket List')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Bucket List</strong>
        </div>

        <div class="card-body">
            <div id="app">
                <app></app>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    const app = new Vue({
        el: '#app',
    });
</script>
@endpush
