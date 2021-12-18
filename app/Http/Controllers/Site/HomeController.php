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
        $banner_home_1 = Ads::query()->where('position', 'banner_home_1')->where('status', 1)->first();
        $banner_home_2 = Ads::query()->where('position', 'banner_home_2')->where('status', 1)->first();
        $banner_home_3 = Ads::query()->where('position', 'banner_home_3')->where('status', 1)->first();
        $banner_home_4 = Ads::query()->where('position', 'banner_home_4')->where('status', 1)->first();
        $banner_laptop_1 = Ads::query()->where('position', 'banner_laptop_1')->where('status', 1)->first();
        $banner_laptop_2 = Ads::query()->where('position', 'banner_laptop_2')->where('status', 1)->first();
        $banner_pc_1 = Ads::query()->where('position', 'banner_pc_1')->where('status', 1)->first();
        $banner_pc_2 = Ads::query()->where('position', 'banner_pc_2')->where('status', 1)->first();
        $banner_ssd_1 = Ads::query()->where('position', 'banner_ssd_1')->where('status', 1)->first();
        $banner_ssd_2 = Ads::query()->where('position', 'banner_ssd_2')->where('status', 1)->first();
        $banner_ram_1 = Ads::query()->where('position', 'banner_ram_1')->where('status', 1)->first();
        $banner_ram_2 = Ads::query()->where('position', 'banner_ram_2')->where('status', 1)->first();
        $banner_hdd_1 = Ads::query()->where('position', 'banner_hdd_1')->where('status', 1)->first();
        $banner_hdd_2 = Ads::query()->where('position', 'banner_hdd_2')->where('status', 1)->first();
        $banner_working_1 = Ads::query()->where('position', 'banner_working_1')->where('status', 1)->first();
        $banner_working_2 = Ads::query()->where('position', 'banner_working_2')->where('status', 1)->first();

       

        $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();

        $categoryLaptop = ProductCategory::query()->find(Product::PRODUCT_LAPTOP);
        $categoryIdsLaptop = $categoryLaptop->getAllChildren()->pluck('id'); // lay tat ca ID cap co
        $categoryIdsLaptop[]  = $categoryLaptop->id; // them ID của nó vào array
        $itemsLaptop = Product::query()->whereIn('category_id', $categoryIdsLaptop)->get();

        $categoryPc = ProductCategory::query()->find(Product::PRODUCT_PC);
        $categoryIdsPc = $categoryPc->getAllChildren()->pluck('id'); 
        $categoryIdsPc[]  = $categoryPc->id;
        $itemsPc = Product::query()->whereIn('category_id', $categoryIdsPc)->get();

        $categorySsd = ProductCategory::query()->find(Product::PRODUCT_SSD);
        $categoryIdsSsd = $categorySsd->getAllChildren()->pluck('id'); 
        $categoryIdsSsd[]  = $categorySsd->id;
        $itemsSsd = Product::query()->whereIn('category_id', $categoryIdsSsd)->get();

        $categoryRam = ProductCategory::query()->find(Product::PRODUCT_RAM);
        $categoryIdsRam = $categoryRam->getAllChildren()->pluck('id'); 
        $categoryIdsRam[]  = $categoryRam->id;
        $itemsRam = Product::query()->whereIn('category_id', $categoryIdsRam)->get();

        $categoryHdd = ProductCategory::query()->find(Product::PRODUCT_HDD);
        $categoryIdsHdd = $categoryHdd->getAllChildren()->pluck('id'); 
        $categoryIdsHdd[]  = $categoryHdd->id;
        $itemsHdd = Product::query()->whereIn('category_id', $categoryIdsHdd)->get();

        $categoryWor = ProductCategory::query()->find(Product::PRODUCT_WORKING);
        $categoryIdsWor = $categoryWor->getAllChildren()->pluck('id'); 
        $categoryIdsWor[]  = $categoryWor->id;
        $itemsWor = Product::query()->whereIn('category_id', $categoryIdsWor)->get();

        $categoryThe = ProductCategory::query()->find(Product::PRODUCT_THE);
        $categoryIdsThe = $categoryThe->getAllChildren()->pluck('id'); 
        $categoryIdsThe[]  = $categoryThe->id;
        $itemsThe = Product::query()->whereIn('category_id', $categoryIdsThe)->get();

        // $items = Product::query()->where('status', Product::STATUS_ACTIVE)->get();

        $data = [
            'member' => $member,
            'categoryLaptop' => $categoryLaptop,
            'itemsLaptop' => $itemsLaptop,
            'categoryPc' => $categoryPc,
            'itemsPc' => $itemsPc,
            'categorySsd' => $categorySsd,
            'itemsSsd' => $itemsSsd,
            'categoryRam' => $categoryRam,
            'itemsRam' => $itemsRam,
            'categoryHdd' => $categoryHdd,
            'itemsHdd' => $itemsHdd,
            'categoryWor' => $categoryWor,
            'itemsWor' => $itemsWor,
            'categoryThe' => $categoryThe,
            'itemsThe' => $itemsThe,
            'slider' => $slider,
            'banner_home_1' => $banner_home_1,
            'banner_home_2' => $banner_home_2,
            'banner_home_3' => $banner_home_3,
            'banner_home_4' => $banner_home_4,
            "banner_laptop_1" => $banner_laptop_1,
            "banner_laptop_2" => $banner_laptop_2,
            "banner_pc_1" => $banner_pc_1,
            "banner_pc_2" => $banner_pc_2,
            "banner_ssd_1" => $banner_ssd_1,
            "banner_ssd_2" => $banner_ssd_2,
            "banner_ram_1" => $banner_ram_1,
            "banner_ram_2" => $banner_ram_2,
            "banner_hdd_1" => $banner_hdd_1,
            "banner_hdd_2" => $banner_hdd_2,
            "banner_working_1" => $banner_working_1,
            "banner_working_2" => $banner_working_2,
            
        ];
      

        if (View::exists($this->layout . '.home.index')) {
            return view($this->layout . '.home.index', $this->render($data));
        } else {
            return redirect(admin_url())->withErrors('Please login admin select template');
        }
        
    }

}