<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\ProductPlate;
use App\ProductTopic;
use App\eventfacades\EventCommodity;
use Image;

class EventCommodityController extends Controller
{
    public function index()
    {
        $commodities = EventCommodity::paginate(8);
        return view('admin.event.index')->with(['commodities' => $commodities]);
    }

    public function tableData(Request $request)
    {
        $category = ProductCategory::where('category_name', '=', $request->input('name'))->first();
        if ($category->parent_id == 0) {
            $sub_categories = ProductCategory::where('parent_id', '=', $category->id)->get();
            $sub_categories->transform(function ($item, $key) {
                return $item->id;
            });
            $sub_id = $sub_categories->all();
            $commodities = ProductCommodity::whereIn('category_id', $sub_id)->get();
        } else {
            $commodities = ProductCommodity::where('category_id', '=', $category->id)->get();
        }
        return response()->json($commodities);
    }

    public function create()
    {
        // 不需要
        // $categories = ProductCategory::where('parent_id', '>', 0)->orderBy('id', 'desc')->get();
        // $plates = ProductPlate::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        // $topics = ProductTopic::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        return view('admin.event.create');
        //->with(['categories' => $categories, 'plates' => $plates, 'topics' => $topics]);
    }

    public function store(Request $request)
    {
        $commodity = new EventCommodity();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/commodity/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $commodity->event_img = $filePath . $fileName;
        }
        $commodity->event_name = $request->input('event_name');
        $commodity->event_number = $request->input('event_number');
        $commodity->event_original_price = $request->input('event_original_price');
        $commodity->event_current_price = $request->input('event_current_price');
        $commodity->event_stock_number = $request->input('event_stock_number');
        $commodity->event_sold_number = $request->input('event_sold_number');
        $commodity->event_detail_info = $request->input('event_detail_info');
        $commodity->status = $request->input('status');
        $commodity->event_page_url = $request->input('event_page_url');
        $base_info = $request->input('event_base_info');
        $placeholder = "======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。";
        if ($base_info != $placeholder) {
            $commodity->event_base_info = $base_info;
        }
        $commodity->event_disabled = $request->input('event_disabled');
        $commodity->event_sort = $request->input('event_sort');
        if ($commodity->save()) {
            return redirect()->to('admin/event/commodity')->withSuccess('新增商品成功！');
        } else {
            return redirect()->to('admin/event/commodity')->withError('新增商品失败！');
        }
    }

    public function editorUpload(Request $request)
    {
        if ($request->hasFile('editorFile') && $request->file('editorFile')->isValid()) {
            $filePath = '/uploads/editor/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('editorFile'))
                ->encode('png')
                ->save('.' . $filePath . $fileName);
            return $filePath . $fileName;
        } else {
            return "error|上传失败！";
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $commodity = EventCommodity::findOrFail($id);
        
        return view('admin.event.edit');
    }

    public function update(Request $request, $id)
    {
        $commodity = EventCommodity::findOrFail($id);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/commodity/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
           $commodity->event_img = $filePath . $fileName;
        }
        $commodity->event_name = $request->input('event_name');
        $commodity->event_number = $request->input('event_number');
        $commodity->event_original_price = $request->input('event_original_price');
        $commodity->event_current_price = $request->input('event_current_price');
        $commodity->event_stock_number = $request->input('event_stock_number');
        $commodity->event_sold_number = $request->input('event_sold_number');
        $commodity->event_detail_info = $request->input('event_detail_info');
        $commodity->status = $request->input('status');
        $commodity->event_page_url = $request->input('event_page_url');
        $base_info = $request->input('event_base_info');
        $placeholder = "======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。";
        if ($base_info != $placeholder) {
            $commodity->commodity_base_info = $base_info;
        }
        $commodity->event_disabled = $request->input('event_disabled');
        $commodity->event_sort = $request->input('event_sort');
        if ($commodity->save()) {
            return redirect()->to('admin/event/commodity')->withSuccess('修改商品成功！');
        } else {
            return redirect()->to('admin/event/commodity')->withError('修改商品失败！');
        }
    }

    public function destroy($id)
    {
        $commodity = ProductCommodity::findOrFail($id);
        $commodity->delete();
        return redirect()->to('admin/product/commodity')->withSuccess('删除商品成功！');
    }
}
