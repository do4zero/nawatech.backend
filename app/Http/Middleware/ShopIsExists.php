<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use App\Interfaces\Products\API\FEShopRepositoryInterface;
use App\Libs\HttpStatusCode;
use Closure;
use Illuminate\Http\Request;

class ShopIsExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $shop = app('App\Interfaces\Products\API\FEShopRepositoryInterface');

        $shopIsExists = $shop->isExists([
            'shop_code' => $request->route('shopcode')
        ]);

        if($shopIsExists < 1){
            $controller = new ApiController();
            return $controller->respond(null, HttpStatusCode::HTTP_404_NOT_FOUND);
        }

        return $next($request);
    }
}
