<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChinesePlaylistRequest;
use App\Repositories\ChinesePlaylistRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Helper;

class ChinesePlaylistController extends Controller
{
    /**
     * @var ChinesePlaylistRepositoryInterface
     */
    protected $repository;

    /**
     * ChinesePlaylistController constructor.
     * @param ChinesePlaylistRepositoryInterface $repository
     */
    public function __construct(ChinesePlaylistRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $data = $this->repository->getAll();

        return view('chinese-playlist.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('chinese-playlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ChinesePlaylistRequest $request)
    {
        $validated = $request->validated();

        $validated['color'] = $validated['color'] ?? Helper::randomHexColor();
        $result = $this->repository->create($validated);

        return back()->with('status', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $item = $this->repository->findById($id);

        return view('chinese-playlist.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChinesePlaylistRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChinesePlaylistRequest $request, $id)
    {
        $item = $this->repository->findById($id);

        $validated = $request->validated();
        $item->update($validated);

        return back()->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return boolean
     */
    public function destroy($id)
    {
        $item = $this->repository->findById($id);
        $item->delete();
    }
}
