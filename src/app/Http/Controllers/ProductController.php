<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    //商品一覧ページ
    public function index(Request $request): View
    {
        //クエリビルダを開始
        $query = Product::query();
        //商品名キーワード検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        //並び替え機能
        if ($request->filled('sort')) {
            if ($request->input('sort') === 'desc') {
                $query->orderBy('price', 'desc'); //価格の高い順
            } elseif ($request->input('sort') === 'asc') {
                $query->orderBy('price', 'asc'); //価格の低い順
            }
        }

        //ページネーションで6件ずつ表示
        $products = $query->paginate(6);
        return view('products.index', compact('products'));
    }

    //商品登録ページ
    public function register(): View
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    //商品登録処理
    public function store(RegisterProductRequest $request): RedirectResponse
    {

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
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();

        return view('products.detail', compact('product', 'seasons'));
    }
    // 商品更新処理
    public function update(UpdateProductRequest $request, $productId)
    {
        // 1. 該当する商品を取得
        $product = Product::findOrFail($productId);

        // 2. 入力データの取得
        $data = $request->all();

        // 3. 画像の保存処理 (FN017)
        // 新しい画像がアップロードされた場合のみ、保存してファイル名を更新する
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->storeAs('public/fruits-img', $filename);
            $data['image'] = $filename;
        }

        // 4. 商品情報の更新 (FN013)
        $product->update($data);

        // 5. 季節（中間テーブル）の同期 (FN016)
        // $request->seasons はチェックボックスの配列
        $product->seasons()->sync($request->seasons);

        // 6. 更新後、商品一覧ページへ遷移する (FN013-4)
        return redirect()->route('products.index');
    }

    // 商品削除処理
    public function destroy($productId): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        // 中間テーブルも一応整理（安全）
        $product->seasons()->detach();

        // 商品削除
        $product->delete();

        return redirect()->route('products.index');
    }
}
