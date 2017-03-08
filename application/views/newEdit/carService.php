<?php
	$isEditing = ($action === "edit");
	$formTitle = "维修信息采集";
	if($isEditing){
		$formTitle = "维修信息修改";
		$row = $editQuery->result()[0];
		//var_dump($row);
		echo "<script type='text/javascript'>$(document).ready(function (){locateParentItemInDropDown(".$row->parentId.");});</script>";
	}
?>
<div id="mainCont">
	<div id="listDisplay">
		<h2><?php echo $formTitle;?></h2>
		<form id="addForm" action="<?php echo site_url('newAdd/typeModification');?>" method="post">
			<input type="hidden" name="action" value="<?php echo $action;?>">
			<div id="formCont">
				<fieldset id="f_customer">
				    <legend>送修人信息</legend>
				    <div class="formCustomerDiv">
					    <label for="c_name">姓名:</label>
						<input type="text" id="c_name" name="c_name" placeholder="姓名" />
						<label for="c_gender">性别:</label>
						<select id="c_gender" name="c_gender">
							<option value="男">男</option>
							<option value="女">女</option>
						</select>
						<label for="c_typeOfId">证件类型:</label>
						<select id="c_typeOfId" name="c_typeOfId">
							<option value="身份证">身份证</option>
							<option value="驾驶证">驾驶证</option>
						</select>
						<label for="c_idCardNum">证件号码:</label>
						<input type="text" id="c_idCardNum" name="c_idCardNum"/>
					</div>
					<div class="formCustomerDiv">
						<label for="c_addr">户籍地址:</label>
						<input type="text" id="c_addr" name="c_addr" class="formElement"/><br/>
					</div>
					<div class="formCustomerDiv">
						<label for="c_serviceDate">送修时间:</label>
						<input type="text" id="c_serviceDate" name="c_serviceDate"/>
						<label for="c_DLCardNum">驾驶证条码:</label>
						<input type="text" id="c_DLCardNum" name="c_DLCardNum"/>
					</div>
				</fieldset>
				<fieldset id="f_viechle">
				    <legend>车辆信息</legend>
				    <div class="formViechleDiv">
					    <label for="v_DPCardNum">行驶证条码:</label>
					    <input type="text" id="v_DPCardNum" name="v_DPCardNum" placeholder="" />
				    </div>
				    <div class="formViechleDiv">
					    <label for="v_typeOfViechle">车辆类型:</label>
					    <select id="v_typeOfViechle" name="v_typeOfViechle">
							<option value="轿车">轿车</option>
							<option value="货车">货车</option>
						</select>
					</div>
					<div class="formViechleDiv">
					    <label for="v_carColour">车身主颜色:</label>
					    <select id="v_carColour" name="v_carColour">
							<option value="黑">黑</option>
							<option value="白">白</option>
							<option value="银">银</option>
							<option value="黄">黄</option>
							<option value="金">金</option>
							<option value="粉">粉</option>
							<option value="红">红</option>
							<option value="蓝">蓝</option>
							<option value="绿">绿</option>
						</select>
					</div>
					<div class="formViechleDiv">
					    <label for="v_numPlateType">号牌种类:</label>
					    <select id="v_numPlateType" name="v_numPlateType">
							<option value="普">小型汽车(蓝底白字)</option>
							<option value="租">出租车</option>
							<option value="使">使馆车</option>
							<option value="货">货车</option>
							<option value="军">军车</option>
						</select>
					</div>
					<div class="formViechleDiv">
					    <label for="v_regNum">车牌号:</label>
					    <input type="text" id="v_regNum" name="v_regNum" hidden=""/>
						<select id="city" onchange="changeZimu()">
							<option>京</option>
							<option>津</option>
							<option>沪</option>
							<option>冀</option>
							<option>豫</option>
							<option>云</option>
							<option>辽</option>
							<option>黑</option>
							<option>湘</option>
							<option>皖</option>
							<option>鲁</option>
							<option>新</option>
							<option>苏</option>
							<option>浙</option>
							<option>赣</option>
							<option>鄂</option>
							<option>桂</option>
							<option>甘</option>
							<option>晋</option>
							<option>蒙</option>
							<option>陕</option>
							<option>吉</option>
							<option>闽</option>
							<option>贵</option>
							<option>粤</option>
							<option>川</option>
							<option>青</option>
							<option>藏</option>
							<option>琼</option>
							<option>宁</option>
							<option>渝</option>
						</select>
						<input type="text" id="v_regNum1" name="v_regNum1" placeholder="" />	
				    </div>
				    <div class="formViechleDiv">
					    <label for="v_carFrameNum">车架号:</label>
					    <input type="text" id="v_carFrameNum" name="v_carFrameNum" placeholder="" />
				    </div>
				    <div class="formViechleDiv">
					    <label for="v_carBrand">中文品牌:</label>
					    <select id="v_carBrand" onchange="changeCarBrand()">
							<option>京</option>
							<option>津</option>
							<option>沪</option>
							<option>冀</option>
							<option>豫</option>
							<option>云</option>
							<option>辽</option>
							<option>黑</option>
							<option>湘</option>
							<option>皖</option>
							<option>鲁</option>
							<option>新</option>
							<option>苏</option>
							<option>浙</option>
							<option>赣</option>
							<option>鄂</option>
							<option>桂</option>
							<option>甘</option>
							<option>晋</option>
							<option>蒙</option>
							<option>陕</option>
							<option>吉</option>
							<option>闽</option>
							<option>贵</option>
							<option>粤</option>
							<option>川</option>
							<option>青</option>
							<option>藏</option>
							<option>琼</option>
							<option>宁</option>
							<option>渝</option>
						</select>
					</div>
					<div class="formViechleDiv">
					    <label for="v_carModelNum">车辆型号:</label>
					    <input type="text" id="v_carModelNum" name="v_carModelNum" placeholder="" />
					</div>
					<div class="formViechleDiv">
					    <label for="v_carOwner">车主/单位:</label>
					    <textarea id="v_carOwner" name="v_carOwner"></textarea>
					</div>
				</fieldset>
				<fieldset id="f_service">
					<legend>维修信息</legend>
					<label for="v_mechanicName">维修人员:</label>
				    <input type="text" id="v_mechanicName" name="v_mechanicName" placeholder="" />
				</fieldset>
				<fieldset id="f_pickUpCustomer">
				    <legend>取车人信息</legend>
				    <input type='checkbox' name='pickup' value='取车'/>
				    <div class="formViechloDiv">
					    <label for="pc_name">姓名:</label>
						<input type="text" id="pc_name" name="pc_name" placeholder="姓名" />
						<label for="pc_gender">性别:</label>
						<select id="pc_gender" name="pc_gender">
							<option value="男">男</option>
							<option value="女">女</option>
						</select>
						<label for="pc_typeOfId">证件类型:</label>
						<select id="pc_typeOfId" name="pc_typeOfId">
							<option value="身份证">身份证</option>
							<option value="驾驶证">驾驶证</option>
						</select>
						<label for="pc_idCardNum">证件号码:</label>
						<input type="text" id="pc_idCardNum" name="pc_idCardNum"/>
					</div>
					<div class="formViechloDiv">
						<label for="pc_addr">户籍地址:</label>
						<input type="text" id="pc_addr" name="pc_addr" class="formElement"/><br/>
					</div>
					<div class="formViechloDiv">
						<label for="pc_serviceDate">送修时间:</label>
						<input type="text" id="pc_serviceDate" name="pc_serviceDate"/>
						<label for="pc_DLCardNum">驾驶证条码:</label>
						<input type="text" id="pc_DLCardNum" name="pc_DLCardNum"/>
					</div>
				</fieldset>
				<div class="formViechloDiv">
					<input type="submit" name="submit" value="确定"/> 
					<input type="reset" name="cancel" value="取消" <?php echo ($isEditing)?'onclick="locateParentItemInDropDown('.$row->parentId.')"':'';?>  />
				</div>				
			</div>
		</form>
	</div>
</div>

