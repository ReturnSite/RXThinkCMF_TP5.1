/**
 * 部门管理
 * @auth 牧羊人
 * @date 2019/5/7
 */
layui.use(['func'], function () {
    var func = layui.func,
        common = layui.common,
        $ = layui.$;

    if (A == 'index') {
        //【TREE列数组】
        var layout =
            [
                {
                    name: 'ID',
                    headerClass: 'value_col',
                    colClass: 'value_col',
                    style: 'width: 5%',
                    render: function (row) {
                        return row.id;
                    }
                },
                {
                    name: '部门名称',
                    treeNodes: true,
                    headerClass: 'value_col2',
                    colClass: 'value_col2',
                    style: '15%;min-width:200px;',
                    render: function (row) {
                        return row.name;
                    }
                },
                {
                    name: '创建人',
                    headerClass: 'value_col',
                    colClass: 'value_col',
                    style: 'width: 10%;min-width:80px;',
                    render: function (row) {
                        return row.format_create_user;
                    }
                },
                {
                    name: '创建时间',
                    headerClass: 'value_col',
                    colClass: 'value_col',
                    style: 'width: 10%;min-width:150px;',
                    render: function (row) {
                        return row.format_create_time;
                    }
                },
                {
                    name: '更新时间',
                    headerClass: 'value_col',
                    colClass: 'value_col',
                    style: 'width: 10%;min-width:150px;',
                    render: function (row) {
                        return row.format_update_time ? row.format_update_time : '';
                    }
                },
                {
                    name: '排序',
                    headerClass: 'value_col',
                    colClass: 'value_col',
                    style: 'width: 10%;min-width:50px;',
                    render: function (row) {
                        return row.sort;
                    }
                },
                {
                    name: '操作',
                    headerClass: 'value_col',
                    colClass: 'value_col2',
                    style: 'width: 20%;min-width:180px;text-align:left;',
                    render: function (row) {
                        var strXml = $("#toolBar").html();
                        var regExp = /<a.*?>([\s\S]*?)<\/a>/g;
                        //exec返回一个数组对象
                        var arr = strXml.match(regExp);

                        var itemStr = '';
                        if (arr != null) {
                            for (var i = 0; i < arr.length; i++) {
                                if (i == 2 && row.parent_id != 0) {
                                    continue;
                                }
                                itemStr += arr[i].replace('<a', "<a data-id=" + row.id);
                            }
                        }
                        return itemStr;
                    }
                }
            ];

        //【TREE渲染】
        func.treeIns(layout, "treeList", true, function (layEvent, id, pid) {
            if (layEvent === 'btnAdd2') {
                console.log("添加");
                common.edit("部门", id, 500, 300, ['pid=' + pid]);
            } else if (layEvent === 'btnEdit') {
                console.log("编辑");
                common.edit("部门", id, 500, 300);
            } else if (layEvent === 'btnDel') {
                console.log("删除");
                common.drop(id, function (id, isSuc) {
                    console.log("树节点已删除");
                });
            } else if (layEvent === 'btnSetAuth') {
                console.log("部门权限设置");
                location.href = mUrl + "/adminAuth/index?type=4&type_id=" + id;
            }
        });

        //【设置弹框】
        func.setWin("部门", 550, 300);
    }
});

