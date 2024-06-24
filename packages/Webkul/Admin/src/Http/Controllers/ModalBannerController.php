<?php

namespace Webkul\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webkul\Admin\Models\ModalBanner;
use Webkul\Admin\Repositories\ModalBannerRepository;

class ModalBannerController extends Controller
{

    protected $bannerRepository;

    public function __construct(ModalBannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $banners = ModalBanner::all();
        return view('admin::banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin::banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            // 'translations' => 'required|array',
            // 'translations.*' => 'string|max:255',

        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $data['image'] = $imagePath;
        }


        $banner = $this->bannerRepository->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $data['image'],

        ]);

        // dd($request->all());

        return redirect()->route('admin.banner.index')->with('success', 'Banner successfully created!');
    }

    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        return view('admin::banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $data['image'] = $imagePath;
        }

        // dd($data);
        // $this->bannerRepository->update([
        //     'title' => $data['title'],
        //     'description' => $data['description'],
        //     'url' => $data['url'],
        //     'image' => $data['image'],
        // ], $id);

        $this->bannerRepository->update($data, $id);

        return redirect()->route('admin.banner.index')->with('success', 'Banner successfully updated!');
    }

    public function destroy($id)
    {
        $this->bannerRepository->delete($id);

        return redirect()->route('admin.banner.index')->with('success', 'Banner üstünlikli aýryldy!');
    }
}
