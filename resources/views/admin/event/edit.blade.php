@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>活动管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">活动管理</a>
                </li>
                <li class="active">
                    <strong>活动</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>活动修改</h5>
            </div>
            <div class="ibox-content">
                <form class="form-small-text" action="{{url('admin/event/commodity/'.$commodity->id)}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" value="PUT" name="_method">
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="event_sort" value="{{$commodity->event_sort}}" type="number"
                               class="form-control" placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="event_name" value="{{$commodity->event_name}}" type="text" class="form-control"
                               placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>主办方：</label>
                        <input name="manager_id" value="{{$commodity->manager_id}}" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        @if($commodity->event_img)
                            <img src="{{$commodity->event_img}}" class="img-thumbnail">
                            <input id="file" name="file" type="file" class="form-control hidden">
                        @else
                            <input name="file" type="file" class="form-control">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>编号：</label>
                        <input name="event_number" value="{{$commodity->event_number}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>链接：</label>
                        <input name="event_page_url" value="{{$commodity->event_page_url}}" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>截止日期：</label>
                        <input name="end_time" type="text" class="form-control" value="{{$commodity->end_time}}" placeholder="XXXX年XX月XX日">
                    </div>
                    <div class="form-group">
                        <label>活动简介：</label>
                        <textarea rows="4" cols="80" name="event_base_info" class="form-control">{{$commodity->event_base_info}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>活动详情：</label>
                        <textarea id="editor" name="event_detail_info" class="form-control">{{$commodity->event_detail_info}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>原价：</label>
                        <input name="event_original_price" value="{{$commodity->event_original_price}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>现价：</label>
                        <input name="event_current_price" value="{{$commodity->event_current_price}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>库存：</label>
                        <input name="event_stock_number" value="{{$commodity->event_stock_number}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>销量：</label>
                        <input name="event_sold_number" value="{{$commodity->event_sold_number}}" type="text"
                               class="form-control" placeholder="可选，默认为0">
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="event_disabled" value="1" @if($commodity->event_disabled == '已上架') checked @endif> 上架
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="event_disabled" value="2" @if($commodity->event_disabled == '已下架') checked @endif> 下架
                        </label>
                    </div>
                    <div class="form-group">
                        <label>上架状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="报名中"
                            @if($commodity->status == '报名中') checked @endif> 报名中
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="已报满"      @if($commodity->status == '已报满') checked @endif> 已报满
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="已结束"
                            @if($commodity->status == '已结束') checked @endif> 已结束
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <link href="//cdn.bootcss.com/wangeditor/2.1.20/css/wangEditor.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/wangeditor/2.1.20/js/wangEditor.min.js"></script>
    <script src="{{asset('js/admin/product/commodityEdit.js')}}"></script>
@endsection