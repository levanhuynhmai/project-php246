<?php

namespace App\Http\Controllers\Site;

use TinhPHP\Woocommerce\Models\Product;
use TinhPHP\Woocommerce\Models\ProductCategory;
use TinhPHP\Woocommerce\Models\ProductImage;
use TinhPHP\Woocommerce\Services\ProductService;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ads;
use App\Models\Member;
use App\Models\RolePermission;


final class HomeController extends SiteController
{
    public function index(Request $request, $slugCategory = '')
    {
        

        $slider = Ads::query()->where('position', 'slider')->where('status', 1)->get();
        $items = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();

     
        $data = [
            'slider' => $slider,
            'member' => $member,
            'items' => $items,
        ];
        if (View::exists($this->layout . '.home.index')) {
            return view($this->layout . '.home.index', $this->render($data));
        } else {
            return redirect(admin_url())->withErrors('Please login admin select template');
        }
        
    }

}