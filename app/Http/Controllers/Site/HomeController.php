<?php

namespace App\Http\Controllers\Site;

use TinhPHP\Woocommerce\Models\Product;
use TinhPHP\Woocommerce\Models\ProductCategory;
use TinhPHP\Woocommerce\Models\ProductImage;
use TinhPHP\Woocommerce\Services\ProductService;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\RolePermission;

final class HomeController extends SiteController
{
    public function index(Request $request, $slugCategory = '')
    {
        
        // $html = file_get_html("https://topsi.vn/danh-muc/phu-kien-dien-thoai-7.html");
        // $items = $html->find(".block-product .list-product .product-item");
        
        

        // foreach($items as $item){
        //     $listsgia = $item->find(".product-meta div");
        //     foreach($listsgia as $list)
        //     {
        //         $price = $list->innertext;
        //         $price = str_replace( 'Giá bán đề xuất: ', '', $price );
        //         $price = rtrim($price, "đ");
        //     }
         
        //     $listsimg = $item->find(".box-image a");
        //     foreach($listsimg as $list)
        //     {
        //         $img = $list->find("img",0)->src;
        //     }


        //     $lists = $item->find(".box-text h3");
        //     foreach($lists as $list)
        //     {
        //         $href = $list->find("a",0)->href;
        //         $href = htmlentities($href ,ENT_QUOTES, "UTF-8");
        //         $title = $list->find("a",0)->innertext;
        //         $slug = Str::slug($title);                
        //         $sku = strstr($title, 'Mã:');
        //         $sku = str_replace('Mã:', '', $sku);

        //         $htmldetail = file_get_html("$href");

        //         $listitemunit = $htmldetail ->find(".block-dvt-weight");
        //         foreach($listitemunit as $item)
        //         {
        //             $itemunit = $item ->find("div", 0);
        //             $unit = $itemunit->find("p", 1)->innertext;

        //             $itemmass = $item ->find("div", 1);
        //             $mass = $itemmass->find("p", 1)->innertext; 
        //         }
               
        //         $itemdetail = $htmldetail->find("#myTabContent");
        //         foreach($itemdetail as $item){
        //             $detail = $item->find("div", 0)->innertext;
        //         }

        //         $itemgallery = $htmldetail->find(".product-thumbnails");

        //         # vong lap san pham moi set lai biến $gallery = null;
        //         $gallery = [];
        //         foreach($itemgallery as $item){
        //             $listgallery= $item->find("img");
        //             $srcImage = [];
        //             foreach($listgallery as $it1){
        //                 $srcImage = $it1->src;
        //             }
                    
        //             if(!empty($srcImage)) {
        //                 $gallery[] = $srcImage;
        //             }
                    
        //         }
        //     }

        //     $dataCraw[] = [
        //         'title' => $title,
        //         'price' => $price,
        //         'category_id' =>"6",
        //         'img' => $img,
        //         'slug' => $slug,
        //         'quantity' => "999",
        //         'sku' => $sku,
        //         'detail' =>$detail,
        //         'gallery' => $gallery,
        //         'unit' => $unit,
        //         'mass'=> $mass,
        //     ];

        // };


        // foreach($dataCraw as $data) {
        //     $dataCondition = [
        //         'sku' => $data['sku']
        //     ];

        //     $dataInsert = [
        //         'title' => $data['title'],
        //         'category_id' => $data['category_id'],
        //         'slug' => $data['slug'],
        //         'image_url'  => $data['img'],
        //         'price'  => $data['price'],
        //         'quantity' => $data['quantity'],
        //         'detail' => $data['detail'],
        //         'unit' => $data['unit'],
        //         'mass' => $data['mass'],
        //     ];

        //     // ham nay se kiem tra leo dieu sku, neu co roi se update, chua co thi them moi
        //     $product = Product::query()->updateOrCreate($dataCondition, $dataInsert);

        //     // kiem tra neu co ID product va gallery không được rỗng
        //     if(!empty($product->id) && !empty($data['gallery'])) {
        //         foreach($data['gallery'] as $imageUrl) {
        //             ProductImage::query()->updateOrCreate([
        //                 'product_id' => $product->id,
        //                 'image_url'  => $imageUrl,
        //             ]);
        //         };
        //     }
        // };
    
        // lay danh muc

        // $productCategory = ProductCategory::all();
        $items = Product::all();
        $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();


        $data = [
            // 'productCategory' => $productCategory,
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