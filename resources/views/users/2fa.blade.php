@extends('layouts.app')
@section('title', 'Two Factor Authentication')

@section('content')
    <div class="card">
            <div class="card-header">
                <strong>Two Factor Authentication</strong>
            </div>

            <div class="card-body text-center">
                @isset($data)
                    <?php echo $data['qrcode']; ?>
                    <br/>
                    <code>{{ $data['secret'] }}</code>
                    <div class="my-3"></div>
                    <button class="btn btn-warning" onclick="window.location='{{ route("users.2fa.new") }}'">Regenerate</button>
                @else
                    <button class="btn btn-info btn-lg" onclick="window.location='{{ route("users.2fa.new") }}'">Enable 2FA</button>
                @endisset
            </div>
    </div>
@endsection
