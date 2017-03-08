<div id="mainCont">
	<div id="searchDisplay">
		<form id="searchForm" action="<?php echo site_url('lists/doSearch');?>" method="post">
			<input type="hidden" name="orderBy" id="orderBy" value="<?php //echo $orderBy;?>" />
			<input type="hidden" name="formOn" id="formOn" value="<?php //echo $formOn;?>" />
			<input type="hidden" name="orderDir" id="orderDir" value="<?php //echo $orderDir;?>"/>
		 	<input type="text" name="searchOption" placeholder="名称/燃油类型/排量" value="<?php //echo $searchOption;?>" />
  			<input type="submit" value="搜索" /> 
  			<a href="<?php echo site_url('newAdd/carType/add');?>" target="_self">添加</a> 
  			<a href="javascript:void(0);" onclick="submitForm('listForm','确定要删除所有选中项吗？')">删除选中项</a>
  			<div id="errorMsg" class="hidden">*Please Select</div> 
		</form> 
	</div>
	<div id="listDisplay">
		<form id="listForm" action="<?php //echo site_url('newAdd/deleteSelectedType');?>" method="post">
		<table id="typeList">
			<tr>
				<th class="squaredOne">序号</th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">状态</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">送修人</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">车牌号</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">颜色</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">号牌种类</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">厂牌型号</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">取车人</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">维修人</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">送修时间</a></th>
				<th><a href="javascript:void(0);" onclick="doSearch('')">取车时间</a></th>
			</tr>
<?php
	if(isset($listData)){
		$len = count($listData->result());
		$num = 1;
		foreach ($listData->result() as $row)
		{
?>
	        <tr>
	        	<td><?php echo $num?></td>
	        	<td><?php //echo $row->t_id?></td>
	        	<td><a href='<?php echo site_url('newAdd/carType/edit?id='.$row->t_id)?>' target='_self' title='编辑该条'><?php echo ""?></a></td>
	        	<td><?php echo ""?></td>
	        	<td><?php echo ""?></td>
	        	<td><?php echo ""?></td>
	        	<td><?php echo ""?></td>
	        </tr>
<?php
			$num++;
		}
	}
?>
		</table>
		</form>
	</div>
	<div id="pageNavRow"><?php echo $this->pagination->create_links();?></div>	
</div>