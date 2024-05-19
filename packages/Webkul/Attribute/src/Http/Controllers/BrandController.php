<?php

namespace Webkul\Attribute\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Attribute\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    protected $brandRepository;
    protected $attribute_id;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->attribute_id = DB::table('attributes')
            ->select('attributes.id')
            ->where('code', '=', 'brand')->first();
    }

    public function index()
    {
        $brands = $this->brandRepository->all();
        return view('admin::catalog.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin::catalog.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'swatch_value' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Örnek validasyon, değiştirilebilir
            'translations' => 'required|array',
            'translations.*' => 'string|max:255',
        ]);

        $data = $request->all();


        // dd($data);
        if ($request->hasFile('swatch')) {
            $imagePath = $request->file('swatch')->store('attribute_option', 'public');
            $data['swatch_value'] = $imagePath;
        }

        // dd($data['swatch_value']);

        $brand = $this->brandRepository->create([
            'admin_name' => $data['admin_name'],
            'attribute_id' => $this->attribute_id->id, // Assuming the attribute ID for 'brand'
            'sort_order' => $data['position'],
            'swatch_value' => $data['swatch_value'],
        ]);

        foreach ($data['translations'] as $locale => $translation) {
            DB::table('attribute_option_translations')->insert([
                'locale' => $locale,
                'label' => $translation,
                'attribute_option_id' => $brand->id,
            ]);
        }

        return redirect()->route('admin.catalog.brands.index')->with('success', 'Brand successfully created!');
    }

    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);

        $translations = DB::table('attribute_option_translations')
            ->where('attribute_option_id', $id)
            ->pluck('label', 'locale')
            ->toArray();

        return view('admin::catalog.brands.edit', compact('brand', 'translations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'swatch' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Uygun doğrulama kuralları
            'translations' => 'required|array',
            'translations.*' => 'string|max:255',
        ]);

        $data = $request->all();

        // Fotoğrafın yüklenmesi ve güncellenmesi
        if ($request->hasFile('swatch')) {
            $imagePath = $request->file('swatch')->store('brands', 'public');
            $data['swatch_value'] = $imagePath;
        }

        $this->brandRepository->update([
            'admin_name' => $data['admin_name'],
            'swatch_value' => $data['swatch_value'],
        ], $id);

        foreach ($data['translations'] as $locale => $translation) {
            DB::table('attribute_option_translations')->updateOrInsert(
                [
                    'attribute_option_id' => $id,
                    'locale' => $locale,
                ],
                [
                    'label' => $translation,
                ]
            );
        }

        return redirect()->route('admin.catalog.brands.index')->with('success', 'Brand successfully updated!');
    }

    public function destroy($id)
    {
        $this->brandRepository->delete($id);
        return redirect()->route('admin.catalog.brands.index')->with('success', 'Brend üstünlikli aýryldy!');
    }
}
