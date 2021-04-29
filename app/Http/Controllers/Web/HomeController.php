<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function homePageProduct()
    {
        $featuredProducst  = Product::where('status', 1)->limit(8)->get();
        $trends  = Product::where(['status', 1], ['trend', 1])->limit(8)->get();
        $bestRateds  = Product::where(['status', 1], ['best_rated', 1])->limit(8)->get();
        return view('web.home.homeIndex', compact('featuredProducts', 'trends', 'bestRateds'));
    }

    public function homeCats()
    {
        $cats = Category::get();
        return view('web.layout', compact('cats'));
    }

    public function home()
    {
        $featuredProducst = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $trends = Product::where([['status', 1], ['trend', 1]])->get();
        $bestRateds = Product::where([['status', 1], ['best_rated', 1]])->get();
        $hots = Product::where([['status', 1], ['hot_deal', 1]])
            ->latest()
            ->take(3)
            ->get();

        $midSliders = Product::where([['status', 1], ['mid_slider', 1]])
            ->latest()
            ->take(3)
            ->get();

        $cats = Category::get();
        $cat_1 = Category::skip(0)->first();
        $cat_2 = Category::skip(3)->first();
        $cat_1_id = $cat_1->id;
        $cat_2_id = $cat_2->id;

        $products_cat_one = Product::where([['category_id', $cat_1_id], ['status', 1]])
            ->limit(10)
            ->latest()
            ->get();

        $products_cat_two = Product::where([['category_id', $cat_2_id], ['status', 1]])
            ->limit(10)
            ->latest()
            ->get();

        $buyone_getone = Product::where([['status', 1], ['buyone_getone', 1]])->get();

        $data = [
            'featuredProducst' => $featuredProducst,
            'trends' => $trends,
            'bestRateds' => $bestRateds,
            'hots' => $hots,
            'midSliders' => $midSliders,
            'cats' => $cats,
            'cat_1' => $cat_1,
            'cat_2' => $cat_2,
            'products_cat_one' => $products_cat_one,
            'products_cat_two' => $products_cat_two,
            'buyone_getone' => $buyone_getone,
        ];
        return view('web.home.homeIndex')->with($data);
    }
}
