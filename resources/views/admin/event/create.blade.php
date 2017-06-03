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
                <h5>活动新增</h5>
            </div>
            <div class="ibox-content">
                <form class="form-small-text" action="{{url('admin/event/commodity')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="event_sort" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="event_name" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>主办方：</label>
                        <input name="manager" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>地点：</label>
                        <input name="event_place" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        <input name="file" type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>链接：</label>
                        <input name="event_page_url" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>截止日期：</label>
                        <input name="end_time" type="text" class="form-control" placeholder="XXXX年XX月XX日">
                    </div>
                    <div class="form-group">
                        <label>编号：</label>
                        <input name="event_number" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>活动简介：</label>
                        <textarea  rows="4" cols="80" name="event_base_info" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>活动详情：</label>
                        <textarea id="editor" name="event_detail_info" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>原价：</label>
                        <input name="event_original_price" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>现价：</label>
                        <input name="event_current_price" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>库存：</label>
                        <input name="event_stock_number" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>销量：</label>
                        <input name="event_sold_number" type="text" class="form-control" placeholder="可选，默认为0">
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="event_disabled" value="1" checked> 上架
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="event_disabled" value="2"> 下架
                        </label>
                    </div>
                    <div class="form-group">
                        <label>上架状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="报名中" checked> 报名中
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="已报满"> 已报满
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="已结束"> 已结束
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
    <script>
        $(function () {
        var placeholder = '======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。';
        var $textarea = $('textarea[name="event_base_info"]');
        if (!$textarea){
            var $textarea = $('textarea[name="event_base_info"]');
        };
        $textarea.val(placeholder);
        $textarea.focus(function () {
            if ($(this).val() === placeholder) {
                $(this).val('');
            }
        });
        $textarea.blur(function () {
            if ($(this).val() === '') {
                $(this).val(placeholder);
            }
        });

        var editor = new wangEditor('editor');
        editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
            if (item === 'source') {
                return null;
            }
            if(item === 'bgcolor'){
                return null;
            }
            if(item === '|'){
                return null;
            }
            if (item === 'emotion') {
                return null;
            }
            if(item === 'location'){
                return null;
            }
            if(item === 'insertcode'){
                return null;
            }
            return item;
        });
        editor.config.menuFixed = false;
        editor.config.uploadImgUrl = '/admin/product/editorUpload';
        editor.config.uploadParams = {
            _token: $('input[name="_token"]').val()
        };
        editor.config.uploadImgFileName = 'editorFile';
        editor.create();

    });
    </script>
@endsection