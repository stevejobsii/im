@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>管理</h2>
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
                <h5>活动设置</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/event/commodity/create')}}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>新增
                </a>
                <a href="{{url('admin/event/commodity')}}" class="btn btn-warning">全部活动</a>
                <div class="row tree-container">
                    <!-- <div class="col-md-2">
                        <div id="tree"></div>
                    </div> -->
                    <!-- <div class="col-md-10"> --><div class="col-md-12">
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th>图片</th>
                                <th>名称</th>
                                <th>价格</th>
                                <th>库存</th>
                                <th>已售</th>
                                <th>状态</th>
                                <th>上架状态</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commodities as $commodity)
                                <tr>
                                    <td>
                                        <img class="commodity-img-url" src="{{$commodity->event_img}}">
                                    </td>
                                    <td>{{$commodity->event_name}}</td>
                                    <td>&yen;{{$commodity->event_current_price}}</td>
                                    <td>{{$commodity->event_stock_number}}</td>
                                    <td>{{$commodity->event_sold_number}}</td>
                                    <td>{{$commodity->event_disabled}}</td>
                                    <td>{{$commodity->status}}</td>
                                    <td>{{$commodity->event_sort}}</td>
                                    <td>
                                        <a href="{{url('admin/event/commodity/'.$commodity->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                        <form action="{{url('admin/event/commodity/'.$commodity->id)}}" method="post" class="del-form">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button title="删除" type="submit" class="del-btn">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <link href="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script>
        $(function () {

        var treeData = [];

        var _token = $('input[name="_token"]').val();

        $.get('/admin/event/getTreeData', function (response) {
            $.each(response, function (index, item) {
                var obj = {text: '', nodes: []};
                obj.text = item.parent_category.category_name;
                $.each(item.sub_categories, function (i, val) {
                    obj.nodes.push({text: val.category_name});
                });
                treeData[index] = obj;
            });
            initTree(treeData);
        });

        function initTree(data) {
            $('#tree').treeview({
                data: data,
                selectable: true,
                levels: 2
            });

            var lastSelectedNodeId = '';

            $('#tree').on('nodeSelected', function (event, data) {
                if (lastSelectedNodeId !== data.nodeId) {
                    lastSelectedNodeId = data.nodeId;
                    $.get('/admin/event/getTableData', {
                        name: data.text
                    }, function (response) {
                        var html = '<tbody>';
                        $.each(response,function(index,item){
                            var str = '<tr>';
                            str += '<td><img class="commodity-img-url" src="' + item.commodity_img+'"/></td>';
                            str += '<td>' + item.commodity_name+'</td>';
                            str += '<td>&yen;' + item.commodity_current_price+'</td>';
                            str += '<td>' + item.commodity_stock_number+'</td>';
                            str += '<td>' + item.commodity_sold_number+'</td>';
                            str += '<td>' + item.commodity_disabled+'</td>';
                            str += '<td>' + item.commodity_sort+'</td>';
                            str += '<td>';
                            str += '<a class="edit-btn" title="修改" href="/admin/event/commodity/'+item.id+'/edit">修改</a>';
                            str += '<form method="post" class="del-form" action="/admin/event/commodity/'+item.id+'">';
                            str += '<input type="hidden" name="_method" value="DELETE">';
                            str += '<input type="hidden" name="_token" value="'+_token+'">';
                            str += '<button title="删除" type="submit" class="del-btn">删除</button>';
                            str += '</form>';
                            str += '</td>';
                            html += str;
                        });
                        html += '</tbody>';
                        $('tbody').remove();
                        $(html).appendTo($('table'));
                    });
                } else {
                    return false;
                }
            });

        }

        });
    </script>
@endsection