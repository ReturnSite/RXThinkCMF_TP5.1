/**
 *	角色管理
 *
 *	@auth 牧羊人
 *	@date 2018-07-12
 */
layui.use(['func'],function(){
	
	//【声明变量】
	var func = layui.func
		,$ = layui.$;
	
	if(A=='index') {
		
		//【TABLE列数组】
		var cols = [
				{ type:'checkbox', fixed: 'left' }
				,{ field:'id', width:80, title: 'ID', align:'center', sort: true, fixed: 'left' }
				,{ field:'name', width:300, title: '角色名称', align:'center' }
				,{ field:'format_create_user', width:100, title: '创建人', align:'center' }
				,{ field:'format_create_time', width:180, title: '创建时间', align:'center', sort: true }
				,{ field:'format_update_time', width:180, title: '更新时间', align:'center', sort: true }
				,{ field:'sort', width:100, title: '排序', align:'center' }
				,{ fixed:'right', width:280, title: '功能操作', align:'center', toolbar: '#toolBar' }
			];
		
		//【渲染TABLE】
		func.tableIns(cols,"tableList",function(layEvent,data){

			if(layEvent === 'auth'){
				console.log("权限设置");
				location.href = "/adminauth/index?type=1&type_id="+data.id;
			}
			
		});
		
		//【设置弹框】
		func.setWin("角色",500,250);
		
	}

});