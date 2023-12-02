<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $meta_seo = metaSeo('', '', [
			'title' => 'Trang chủ',
			'description' => 'Mô tả trang chủ',
			'image' => 'getImage()',
		]);
        return view('web.home', compact('meta_seo'));
    }
}
