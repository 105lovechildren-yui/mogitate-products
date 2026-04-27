<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{
    //商品一覧ページ
    public function index(): View
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    //商品登録ページ
    public function register(): View
    {
        return view('products.register');
    }

    //商品登録処理
    public function store(Request $request): RedirectResponse
    {
        // TODO: 要件FN009に従い、FormRequest（ProductRequest）を作成してバリデーションを移行する
        // TODO: FN010のルール（値段0~10000、画像mimes:png,jpeg、説明120文字以内）を適用する
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'required|image',
            'description' => 'required',
            'seasons' => 'required|array',
        ]);

        $imagePath = $request->file('image')->store('fruits-img', 'public');
        $imageName = basename($imagePath);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->image = $imageName;
        $product->description = $request->input('description');
        $product->save();
        // 中間テーブルへの紐付け
        $product->seasons()->attach($request->input('seasons'));

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    //商品詳細ページ
    public function show($productId): View
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }
}
