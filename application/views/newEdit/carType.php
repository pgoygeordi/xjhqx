	<?php

		function recurseTypes($arr, $level){
			$rt = "";
			if(count($arr)){
				foreach ($arr as $row){
					if(!empty($row["children"])){ // the index "children" is set if there is any Child element exists by php file newAdd.php => getRowsWithParentId, this children is not refer to the childrenIds column in the database table.
						$rt .= "<li class='level".$level."-li'><div class='expandIcon'></div><div class='typeNameDisplay'>".$row["name"]."</div><input type='hidden' value='".$row["id"]."'>";
						$newLevel = $level + 1;
						$rt.= recurseTypes($row["children"], $newLevel);
					}
					else{
						$rt .= "<li class='level".$level."-li'><div class='placeHoderIcon'></div><div class='typeNameDisplay'>".$row["name"]."</div><input type='hidden' value='".$row["id"]."'>";
					}
					$rt.= "</li>";
				}
			}
			if($rt!=""){
				$cssClass = ($level==0)?"":" hidden";
				$rt = "<ul class='level".$level.$cssClass."'>".$rt."</ul>";
			}
			return $rt;
		}
		$isEditing = ($action === "edit");
		$fromTitle = "添加车辆类型：";
		if($isEditing){
			$fromTitle = "编辑车辆类型：";
			$row = $editQuery->result()[0];
			//var_dump($row);
			echo "<script type='text/javascript'>$(document).ready(function (){locateParentItemInDropDown(".$row->parentId.");});</script>";
		}

	?>
<div id="mainCont">
	<div id="listDisplay">
		<h2><?php echo $fromTitle;?></h2>
		<form id="addForm" action="<?php echo site_url('newAdd/typeModification');?>" method="post">
			<div id="formCont">
				<input type="hidden" name="action" value="<?php echo $action;?>">
				<div class="formDiv">
					<input type="submit" name="submit" value="确定"/> 
					<input type="reset" name="cancel" value="取消" <?php echo ($isEditing)?'onclick="locateParentItemInDropDown('.$row->parentId.')"':'';?>  />
				</div>

				<div class="formDiv<?php echo ($isEditing)?'':' hidden';?>" >
					<label for="id">ID: </label>
					<input type="text" id="id" name="id" value="<?php echo ($isEditing)?$row->t_id:'';?>" placeholder="不需要更改" class="formElement"/>
				</div>			
				<div class="formDiv">
					<label for="name">名称: </label>
					<input type="text" id="name" name="name" value="<?php echo ($isEditing)?$row->name:'';?>" placeholder="名称" class="formElement"/>
				</div>
				<div class="formDiv">
					<label for="fuelType">燃油类型: </label>
					<select id="fuelType" name="fuelType" class="formElement">
						<option value="">--请选择--</option>
						<option value="汽油" selected="true">汽油</option>
						<option value="柴油">柴油</option>
						<option value="汽油/柴油">汽油/柴油</option>
					</select>
				</div>
				<div class="formDiv">
					<label for="capacity">排量: </label>
					<input type="text" id="capacity" name="capacity" value="<?php echo ($isEditing)?$row->capacity:'';?>" placeholder="排量(升)" class="formElement"/>
				</div>
				<div class="formDiv">
					<label for="parentName">归属于: </label>
					<input type="hidden" id="parentId" name="parentId" value="<?php echo ($isEditing)?$row->parentId:'';?>"  class="formElement"/>
					<input type="text" id="parentName" name="parentName" value="" disabled="true" placeholder="请在下方选择车辆类型" class="formElement"/>
					<input type="button" value="重选" onclick="clearParentField()"/>
					<div id="parentSelectMenu"><?php echo recurseTypes($types, 0);?></div>
				</div>
				
			</div>
		</form>
	</div>
</div>
<!--
<div class="formDiv"><label for="email" class="accessAid">名称</label><input type="email" id="email" name="email" required="required" class="validate" value="" placeholder="名称" maxlength="127" autocomplete="off" autocorrect="off" autocapitalize="off" aria-required="true" pattern="^[^\s()<>@,;:]+@((?=[a-zA-Z0-9-]+)|[a-zA-Z-]+)([a-zA-Z0-9-]+)*(\.([0-9]+(?=[a-zA-Z-]+)|[a-zA-Z-]+)(-?[a-zA-Z0-9-]+)?)+$" aria-invalid="true"></div>

-->