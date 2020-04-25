@extends('layouts.app')
@section('title', 'Settings / LarOptions')

@section('content')
    <div class="card">
        <form method="POST">
            @csrf
            <div class="card-header d-flex justify-content-between align-items-center bg-danger">
                <strong class="text-white">Settings</strong>
                <button type="submit" class="btn btn-outline-light">Apply</button>
            </div>

            <div class="card-body">
                <x-setting>
                    <x-slot name="title">Facebook Access Token</x-slot>
                    <x-slot name="description">1. Facebook Bussiness: <a href="https://business.facebook.com/" target="_blank">link</a> >> 2. Tab Network, filter <code>access_token</code></x-slot>
                    <x-text :value="$data" key="fb_access_token"></x-text>
                </x-setting>

                <x-setting>
                    <x-slot name="title">Tumblr API Key</x-slot>
                    <x-slot name="description">Document: <a href="https://www.tumblr.com/docs/en/api/v2" target="_blank">https://www.tumblr.com/docs/en/api/v2</a></x-slot>
                    <x-text :value="$data" key="tumblr_api_key"></x-text>
                </x-setting>

                <x-setting>
                    <x-slot name="title">Google API Key</x-slot>
                    <x-text :value="$data" key="google_api_key"></x-text>
                </x-setting>

                <x-setting>
                    <x-slot name="title">Slack Webhook (#general)</x-slot>
                    <x-text :value="$data" key="slack_general_webhook"></x-text>
                </x-setting>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-outline-danger">Apply</button>
            </div>
        </form>
    </div>
@endsection
