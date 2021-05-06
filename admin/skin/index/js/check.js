/**
 * Created by Administrator on 2016/8/4.
 */

var name, work,order,currentID, flag = true;
function Checkload() {
    $('#table').bootstrapTable({
        method: "get",
        striped: true,
        singleSelect: false,
        dataType: "json",
        pagination: true, //分页
        pageSize: 10,
        pageNumber: 1,
        search: false, //显示搜索框
        contentType: "application/x-www-form-urlencoded",
        queryParams: null,
        columns: [

            {
                checkbox:"true",
                field: 'ID',
                align: 'center',
                valign: 'middle'
            },
            {
                title: "工作证号",
                field: 'class',
                align: 'center',
                valign: 'middle'
            },
            {
                title: '姓名',
                field: 'sex',
                align: 'center',
                valign: 'middle'
            },
            {
                title: '所在部门',
                field: 'type',
                align: 'center'
            },
            {
                title: '职位',
                field: 'name',
                align: 'center',
                valign: 'middle'
            },
            {
                title: '排名',
                field: 'work',
                align: 'center'
            },
            {
                title: '考核成绩',
                field: 'work',
                align: 'center'
            },
            {
                title: '编制类型',
                field: 'work',
                align: 'center'
            },
           
            {
                title: '操作',
                field: '',
                align: 'center',
                formatter: function (value, row) {
                    var e = '<button button="#" mce_href="#" onclick="delNotice(\'' + row.WORKRECORDID + '\')">删除</button> '
                    var d = '<button button="#" mce_href="#" onclick="editNotice(\'' + row.WORKRECORDID + '\')">编辑</button> ';

                    return e + d;
                }
            }
        ]
    });
    getData();
    getOrder();
    getWork();

}
function getData() {
    if (flag) {
        name = "";
        work = "";
        order="";


        flag = false;
    } else {
        name = $("#name").val();
        work= $("#work").val();
        order=$("#order").val();


    }
    $.ajax({
        type: "GET",
        url: "../WorkRecord/SearchWork?dtStart=" + name + "&dtEnd=" + work+ "&dtEnd=" + order,
        dataType: "json",
        success: function (result) {
            if (result.data) {
                var TableData = result.data;
                $('#table').bootstrapTable("load", TableData);
            }
        }
    })
}
//初始化职位下拉菜单
function getWork() {
    $.ajax({
        url: '../Common/GetTaskTypeList',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var TYPEValue = data.data;
            var TYPEItem = "<Option value = " + "-1" + ">" + "全部" + "</Option>";
            $("#work").append(TYPEItem);
            for (var i = 0; i < TYPEValue.length; i++) {
                var html = "<Option value = '" + TYPEValue[i].ID + "'>" + TYPEValue[i].NAME + "</Option>";
                $("#work").append(html);
            }
        },
        error: function (err) {
        }

    })
}
//初始化排名下拉菜单
function getWork() {
    $.ajax({
        url: '../Common/GetTaskTypeList',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var TYPEValue = data.data;
            var TYPEItem = "<Option value = " + "-1" + ">" + "全部" + "</Option>";
            $("#order").append(TYPEItem);
            for (var i = 0; i < TYPEValue.length; i++) {
                var html = "<Option value = '" + TYPEValue[i].ID + "'>" + TYPEValue[i].NAME + "</Option>";
                $("#order").append(html);
            }
        },
        error: function (err) {
        }

    })
}

function add() {
    openlayer()
    currentID = "";
}
function edit(id) {
    openlayer()
    currentID = id;
}
function del(id) {
    alert(id)
    var NoticeId = id;
    $.ajax({
        url: '../WorkRecord/DeleteWork?workId=' + NoticeId,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.data) {
                alert("删除成功！")
                getData();
            } else {
                alert("删除失败")
            }
        },
        error: function (err) {
        }
    });
}
function getCurrentID() {
    return currentID;
}
function openlayer(id){
    layer.open({
        type: 2,
        title: '添加信息',
        shadeClose: true,
        shade: 0.5,
        skin: 'layui-layer-rim',
//            maxmin: true,
        closeBtn:2,
        area: ['80%', '90%'],
        shadeClose: true,
        closeBtn: 2,
        content: 'check_tail01.html'
        //iframe的url
    });
}





