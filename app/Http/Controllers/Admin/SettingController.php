<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LarOptionRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Opt;

class SettingController extends Controller
{
    /**
     * @var LarOptionRepositoryInterface
     */
    protected $repository;

    /**
     * SettingController constructor.
     * @param LarOptionRepositoryInterface $repository
     */
    public function __construct(LarOptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = $this->repository->getLatest()->mapWithKeys(function ($item) {
            return [$item['key'] => $item['value']];
        })->all();
        return view('settings.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        foreach ($data as $key => $value) {
            Opt::set($key, $value);
        }

        return back();
    }
}
