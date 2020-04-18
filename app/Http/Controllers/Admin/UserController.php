<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class UserController extends Controller
{
    private $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function get2fa()
    {
        $data = null;

        $user = auth()->user();
        $secret = $user->google2fa_secret ?? null;
        if ($secret) {
            $data = [
                'qrcode' => $this->getQrCode($user, $secret),
                'secret' => $secret
            ];
        }

        return view('users.2fa', compact('data'));
    }

    private function getQrCode($user, $secretKey)
    {
        $g2faUrl = $this->google2fa->getQRCodeUrl(
            $user->name,
            $user->email,
            $secretKey
        );

        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            )
        );

        return $writer->writeString($g2faUrl);
    }

    public function get2faNew()
    {
        $secret = $this->google2fa->generateSecretKey();
        auth()->user()->update([
            'google2fa_secret' => $secret
        ]);

        return redirect()->route('users.2fa');
    }
}
