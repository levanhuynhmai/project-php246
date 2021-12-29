<?php

namespace App\Http\Controllers\Site;

use TinhPHP\Woocommerce\Models\Product;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\RolePermission;



/**
 * Class SearchController.
 *
 * @property PostService $postService
 */
final class SearchController extends SiteController
{
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $params = $request->only('s');
        $itemProducts = null;
        $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();


        if (!empty($params['s'])) {
            $keyword = $params['s'];
            $itemProducts = Product::query()
                ->where('status', '=', 1)
                ->where('title', 'like','%'. $keyword . '%')
                ->orderByDesc('id')->get()->take(16);
        }

        $data = [
            'itemProducts' => $itemProducts,
            'title' => trans('common.search'),
            'member' => $member,
        ];

        return view($this->layout.'search.index', $this->render($data));
    }
}
