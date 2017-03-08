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
		<form id="listForm" action="<?php echo site_url('newAdd/deleteSelectedType');?>" method="post">
		<table id="typeList">
			<tr>
				<th class="squaredOne"><input type="checkbox" id="selectAll" onclick="checkBoxToggle(this)" /><label for="selectAll"></label></th>
				<th><a href="javascript:void(0);" onclick="doSearch('id')">Id</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('name')">名称</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('fuel')">燃油类型</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('capacity')">排量</a></th>
				<th>ParentId</th>
				<th>ChildIds</th>
			</tr>
<?php
	if(isset($listData)){
		$len = count($listData->result());
		foreach ($listData->result() as $row)
		{
?>
        	<tr>
        		<td><input type='checkbox' name='checkbox[]' value='<?php echo $row->t_id?>'/></td>
        		<td><?php echo $row->t_id?></td><td><a href='<?php echo site_url('newAdd/carType/edit?id='.$row->t_id)?>' target='_self' title='编辑该条'><?php echo $row->name?></a></td>
        		<td><?php echo $row->fuelType?></td>
        		<td><?php echo $row->capacity?></td>
        		<td><?php echo $row->parentId?></td>
        		<td><?php echo $row->childrenIds?></td>
        	</tr>
<?php
		}
	}
?>
		</table>
		</form>
	</div>
	<div id="pageNavRow"><?php echo $this->pagination->create_links();?></div>	
</div>