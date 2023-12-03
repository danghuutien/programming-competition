<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     return view('diaban.index');
    // }
    public function index(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $diaban = Diaban::orderBy('id', 'desc');
        $diaban = searchColum($diaban, $searchcolum, $searchnow);
 
        $diaban = $diaban->get();
        foreach ($diaban as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($diaban)->make(true);
    }
    public function create(Request $request)
    {
 
        $diaban = new Diaban();
        $diaban->name = $request->name;
        $diaban->CapTrenId = $request->CapTrenId;

        $diaban->save();
        return 'thành công';
    }
    public function updatediaban(Request $request)
    {
        $diaban = Diaban::where('id', $request->id)->first();
        $diaban->name = $request->data['name'];
        $diaban->CapTrenId = $request->data['CapTrenId'];
        $diaban->save();
        return 'thành công';
    }
    public function deletediaban(Request $request)
    {
        Diaban::destroy($request->id);
        return 'thành công';
    }
}
