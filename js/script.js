var doms = {};
$(document).ready(function (){
    doms.parentId = document.getElementById("parentId");
    doms.parentName = document.getElementById("parentName");
    doms.errorMsg = $('div#errorMsg');
    initalExpandMenu();
    //clickMenu("menu");
});
sendRequestToServer = function (xmlRequest, parserFunction) 
{
    $.ajax({
        type: "POST",         //获取方式
        url: "http://localhost/xjhqx/index.php/DataOutput?"+Math.random(),    //数据读取地址，最好使用   url: "data/"+index+".html?"+Math.random() 避免浏览器缓存问题
        data: "&listTable=type&limit=30&pageNum=1",   //地址栏动态获取数据
        dataType:"json",    //数据格式
        success: function(resp){     //resp获得的是对象或者数组
            var data = resp.data;
        },
        error: function() 
        {
            var errorNode = '<Error xml:lang="en-GB" code="ERROR" msg="Connection with server lost" />';
            //game.handleError(errorNode);
            alert("error!");
        }
    });
};
//sendRequestToServer();
submitForm = function (formId,msgVar){
    var msg = (!!msgVar)?msgVar:"Are you sure?";
    var checkedArr = $("input[type=checkbox][id!=selectAll][checked]");
    if(checkedArr.length){
        if(confirm(msg)){
            //console.log("Yes");
            doms.errorMsg.addClass("hidden");
            document.getElementById(formId).submit();
        }
        else{
            console.log("confirm selected No!");
        }
    }
    else{
        doms.errorMsg.text("* 请至少选择一项记录");
        doms.errorMsg.removeClass("hidden");
    }
};
doSearch = function (orderBy){
    if(!!orderBy){
        var domOrderBy = $("#orderBy");
        var domOrderDir = $("#orderDir");
        if(domOrderBy.attr("value") != orderBy){
            domOrderBy.attr("value", orderBy);
            domOrderDir.attr("value", "asc");
        }
        else{
            if(domOrderDir.attr("value") == "asc"){
                domOrderDir.attr("value", "desc");
            }
            else{
                domOrderDir.attr("value", "asc");
            }
        }
        doms.errorMsg.addClass("hidden");
        document.getElementById("searchForm").submit();
    }
};
checkBoxToggle = function (selectAllEle){
    $("input[type=checkbox][id!=selectAll]").each(function (){
        this.checked = selectAllEle.checked;
    });
};
clearParentField = function (){
    $("input[id=parentId]").attr("value","");
    $("input[id=parentName]").attr("value","");
    $("div.typeNameDisplay.clicked").removeClass("clicked");
};
locateParentItemInDropDown = function (pid){
    $('#parentSelectMenu li').each(function (){
        if($(this).find("> input").attr("value") == pid){
            $(this).parents("li").each(function (){
                $(this).find("> div.expandIcon").click(); //expand parent ul
            });
            $(this).find("> div.expandIcon").click(); // expand direct parent ul
            $(this).find("> div.typeNameDisplay").addClass("clicked"); // select the parent item.
        }
    });
};
initalExpandMenu = function (){
    $(".level0-li div.expandIcon").click(function(event){
        doms.allSubUl = $(this).parent().find("ul");
        doms.allExpandIcon = $(this).parent().find("div.expandIcon");
        var childUldom = $(this.parentElement.lastChild);
        if(childUldom.hasClass("hidden")){
            $(this).addClass("expanded");
            childUldom.removeClass("hidden");
        }
        else{
            doms.allSubUl.addClass("hidden");
            doms.allExpandIcon.removeClass("expanded");
        }
    }); 
    $("ul.level0 li").click(function (event){
        //event.preventDefault();
        event.stopPropagation(); //stop bubbling up
        $("ul.level0 li > div.typeNameDisplay").removeClass("clicked");
        $(this).find("> div.typeNameDisplay").addClass("clicked");
        doms.parentId.value = $(this).find("> input").attr("value");


        //get textString from the div.typeNameDisplay and merge them together.
        var typeName = [];
        typeName.push($(this).find("> div.typeNameDisplay").text());
        $(this).parents("li").each(function(){
            typeName.push($(this).find("> div.typeNameDisplay").text());
        });
        doms.parentName.value = typeName.reverse().join("");
    });
    $("div.typeNameDisplay").mouseover(function (event){
        event.stopPropagation();
        $(this).addClass("hover");
    });
    $("div.typeNameDisplay").mouseout(function (event){
        event.stopPropagation();
        $(this).removeClass("hover");
    });
};









//window.onload(clickMenu);
//clickMenu('menu');