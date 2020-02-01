@extends('layouts.app')
@section('title', '[CP] Add new song')

<?php
    $route = 'chinese-playlist';
?>
@section('content')
    <div class="card">
        <div class="card-body">
            @include('layouts.msg')
            <form method="POST" action="{{ route('chinese-playlist.store') }}">
                @csrf
                <div class="form-group">
                    <label for="cn_name">Chinese name:</label>
                    <input type="text" class="form-control" id="cn_name" name="cn_name"
                           value="{{ old('cn_name') }}">
                </div>
                <div class="form-group">
                    <label for="vn_name">Vietnamese name:</label>
                    <input type="text" class="form-control" id="vn_name" name="vn_name"
                           value="{{ old('vn_name') }}">
                </div>
                <div class="form-group">
                    <label for="artist">Artist:</label>
                    <input type="text" class="form-control" id="artist" name="artist"
                           value="{{ old('artist') }}">
                </div>
                <div class="form-group">
                    <label for="mp3_url">Mp3 URL:</label>
                    <input type="text" class="form-control" id="mp3_url" name="mp3_url"
                           value="{{ old('mp3_url') }}">
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label>
                    <input type="text" class="form-control" id="image_url" name="image_url"
                           value="{{ old('image_url') }}">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color"
                           value="{{ old('color') }}">
                </div>

                <div class="row">
                    <div class="col">
                        <a href="{{ route('chinese-playlist.') }}" class="btn btn-secondary"><i
                                class="fas fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Save <i
                                class="fas fa-upload"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
