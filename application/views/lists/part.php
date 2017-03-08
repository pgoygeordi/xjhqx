<div id="mainCont">
	<div id="searchDisplay">
		<form id="searchForm" action="<?php echo site_url('lists/doSearch');?>" method="post">
			<input type="hidden" name="orderBy" id="orderBy" value="<?php echo $orderBy;?>" />
			<input type="hidden" name="formOn" id="formOn" value="<?php echo $formOn;?>" />
			<input type="hidden" name="orderDir" id="orderDir" value="<?php echo $orderDir;?>"/>
		 	<input type="text" name="searchOption" placeholder="名称/燃油类型/排量" value="<?php echo $searchOption;?>" />
  			<input type="submit" value="搜索" /> 
  			<a href="<?php echo site_url('newAdd/carType/add');?>" target="_self">添加</a> 
  			<a href="javascript:void(0);" onclick="submitForm('listForm','确定要删除所有选中项吗？')">删除选中项</a>
  			<div id="errorMsg" class="hidden">*Please Select</div> 
		</form> 
	</div>
	<div id="listDisplay">
		<form id="listForm" action="<?php echo site_url('newAdd/deleteSelectedPart');?>" method="post">
		<table id="typeList">
			<tr>
				<th class="squaredOne"><input type="checkbox" id="selectAll" onclick="checkBoxToggle(this)" /><label for="selectAll"></label></th>
				<th>Id</th>
				<th>名称</th>
				<th>车辆类型id</th>
				<th>单价</th>
				<th>工时费</th>
				<th>产品型号</th>
				<th>供应商</th>
				<th>库存</th>
				<th>产品说明</th>
				<th>管理</th>
			</tr>
<?php
	if(isset($listData)){
		$len = count($listData->result());
		foreach ($listData->result() as $row)
		{
	        echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row->p_id."'/></td><td>".$row->p_id."</td><td>".$row->name."</td><td>".$row->carTypeId."</td><td>".$row->partPrice."</td><td>".$row->labourPrice."</td><td>".$row->partCode."</td><td>".$row->supplier."</td><td>".$row->stock."</td><td>".$row->partDescription."</td><td><a href='".site_url('newAdd/carType/edit?id='.$row->p_id)."' target='_self'>编辑</a> <a href='".site_url('newAdd/delOneRec/?id='.$row->p_id)."' onclick='return confirm(\"确定要删除这一项吗?\")'>删除</a></td></tr>";
		}
	}
?>
		</table>
		</form>
	</div>
	<div id="pageNavRow">第页 第1页 上一页 下一页 最后1页</div>	
</div>

