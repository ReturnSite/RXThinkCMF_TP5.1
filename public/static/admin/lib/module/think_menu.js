/**
 * 菜单管理
 *
 * @auth 牧羊人
 * @date 2019/5/7
 */
// layui.use(['func'], function () {
//     var func = layui.func,
//         $ = layui.$;
//
//     if (A == 'index') {
//         //【TREE列数组】
//         var layout =
//             [
//                 {
//                     name: 'ID',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:50px;',
//                     render: function (row) {
//                         return row.id;
//                     }
//                 },
//                 {
//                     name: '菜单名称',
//                     treeNodes: true,
//                     headerClass: 'value_col2',
//                     colClass: 'value_col2',
//                     style: '20%;min-width:150px;',
//                     render: function (row) {
//                         return row.title;
//                     }
//                 },
//                 {
//                     name: '图标',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:50px;',
//                     render: function (row) {
//                         return '<i class="larry-icon ' + row.icon + '" data-icon="' + row.icon + '" data-font="larry-icon"></i>';
//                     }
//                 },
//                 {
//                     name: '类型',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:50px;',
//                     render: function (row) {
//                         var cls = "";
//                         if (row.type == 1) {
//                             //模块
//                             cls = "layui-btn-normal";
//                         } else if (row.type == 2) {
//                             //导航
//                             cls = "layui-btn-danger";
//                         } else if (row.type == 3) {
//                             //菜单
//                             cls = "layui-btn-warm";
//                         } else if (row.type == 4) {
//                             //节点
//                             cls = "";
//                         }
//                         return '<span class="layui-btn ' + cls + ' layui-btn-xs">' + row.type_name + '</span>';
//                     }
//                 },
//                 {
//                     name: '菜单URL',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 10%;min-width:150px;',
//                     render: function (row) {
//                         return row.url ? row.url : '';
//                     }
//                 },
//                 {
//                     name: '权限标识',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 8%;min-width:150px;',
//                     render: function (row) {
//                         return row.auth ? row.auth : '';
//                     }
//                 },
//                 {
//                     name: '状态',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:50px;',
//                     render: function (row) {
//                         return (row.is_show == 1 ? '<span class="layui-btn layui-btn-normal layui-btn-xs">显示</span>' : '<span class="layui-btn layui-btn-normal layui-btn-xs layui-btn-danger">不显示</span>');
//                     }
//                 },
//                 {
//                     name: '是否公共',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:60px;',
//                     render: function (row) {
//                         return row.is_public == 1 ? "是" : "否";
//                     }
//                 },
//                 {
//                     name: '排序',
//                     headerClass: 'value_col',
//                     colClass: 'value_col',
//                     style: 'width: 5%;min-width:50px;',
//                     render: function (row) {
//                         return row.sort;
//                     }
//                 },
//                 {
//                     name: '操作',
//                     headerClass: 'value_col',
//                     colClass: 'value_col2',
//                     style: 'width: 15%;min-width:180px;text-align:left;',
//                     render: function (row) {
//
//                         var strXml = $("#toolBar").html();
//                         var regExp = /<a.*?>([\s\S]*?)<\/a>/g;
//                         var itemArr = strXml.match(regExp);
//                         if (itemArr) {
//                             var itemStr = "";
//                             for (var i = 0; i < itemArr.length; i++) {
//                                 if (i == 2 && row.type > 3) continue;
//                                 itemStr += itemArr[i].replace('<a', "<a data-id=" + row.id);
//                             }
//                             return itemStr;
//                         }
//                         return "";
//                     }
//                 }
//             ];
//
//         //【TREE渲染】
//         func.treeIns(layout, "treeList", false, function (layEvent, id, pid) {
//             if (layEvent === 'btnAdd2') {
//                 //添加
//                 var url = '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">菜单管理模块主要是为了实现系统权限架构而设计制作，节点权限的设置分为多种模式可供选择<br><br>我们将为您提供最真挚的服务 ^_^</div>';
//                 func.showWin("功能节点", url, 450, 300, null, 1, ['独立设置', '批量设置', '关闭'], function (layero, index) {
//                     //弹框回调
//                     var btn = layero.find('.layui-layer-btn');
//                     btn.find('.layui-layer-btn0').click(function () {
//                         layer.msg("独立设置");
//                         layui.common.edit("菜单", 0, 0, 0, ['pid=' + pid]);
//                     });
//                     btn.find('.layui-layer-btn1').click(function () {
//                         layer.msg("批量设置" + pid);
//                         var url = cUrl + "/batchFunc?menu_id=" + pid;
//                         func.showWin("权限节点配置", url, 600, 350);
//                     });
//
//                 });
//             } else if (layEvent === 'btnEdit') {
//                 //编辑
//                 layui.common.edit("菜单", id, 0, 0);
//             } else if (layEvent === 'btnDel') {
//                 //删除
//                 layui.common.drop(id, function (data, isSuc) {
//                     console.log("树节点已删除");
//                 });
//             }
//         });
//
//         //【设置弹框】
//         func.setWin("菜单");
//     } else {
//         /**
//          * 选择图标
//          */
//         $(".btnIcon").click(function () {
//             var url = cUrl + "/get_system_icon";
//             func.showWin("选择图标", url);
//         });
//     }
// });

layui.use(['func'], function () {

    //【声明变量】
    var func = layui.func
        , $ = layui.$;

    if (A == 'index') {
        //【TABLE列数组】
        var cols = [
            {type: 'checkbox'}
            , {field: 'id', width: 80, title: 'ID', align: 'center'}
            , {field: 'name', width: 200, title: '菜单名称', align: 'left'}
            , {
                field: 'icon', width: 100, title: '图标', align: 'center', templet: function (d) {
                    return '<i class="larry-icon ' + d.icon + '" data-icon="' + d.icon + '" data-font="larry-icon"></i>';
                }
            }
            , {
                field: 'type', width: 100, title: '类型', align: 'center', templet(d) {
                    var cls = "";
                    if (d.type == 1) {
                        //模块
                        cls = "layui-btn-normal";
                    } else if (d.type == 2) {
                        //导航
                        cls = "layui-btn-danger";
                    } else if (d.type == 3) {
                        //菜单
                        cls = "layui-btn-warm";
                    } else if (d.type == 4) {
                        //节点
                        cls = "";
                    }
                    return '<span class="layui-btn ' + cls + ' layui-btn-xs">' + d.type_name + '</span>';
                }
            }
            , {field: 'url', width: 200, title: '菜单URL', align: 'center'}
            , {field: 'auth', width: 200, title: '权限标识', align: 'center'}
            , {
                field: 'is_show', width: 100, title: '状态', align: 'center', templet(d) {
                    return (d.is_show == 1 ? '<span class="layui-btn layui-btn-normal layui-btn-xs">显示</span>' : '<span class="layui-btn layui-btn-normal layui-btn-xs layui-btn-danger">不显示</span>');
                }
            }
            , {
                field: 'is_public', width: 100, title: '是否公共', align: 'center', templet(d) {
                    return d.is_public == 1 ? "是" : "否";
                }
            }
            , {field: 'sort', width: 100, title: '排序', align: 'center'}
            , {fixed: 'right', width: 280, title: '功能操作', align: 'left', toolbar: '#toolBar'}
        ];

        //【渲染TABLE】
        func.treetable(cols, 'tableList', false, 0, null, function (layEvent, id, pid) {
            if (layEvent === 'batchFunc') {
                var url = cUrl + "/batchFunc?menu_id=" + id;
                func.showWin("权限节点配置", url, 600, 350);
            }
        });

        //【设置弹框】
        func.setWin("菜单");
    } else {
        // 选择图标
        $(".btnIcon").click(function () {
            var url = cUrl + "/getSystemIcon";
            func.showWin("选择图标", url);
        });
    }
});

