<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML><html><head><title>test</title><meta charset="utf-8"/><script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script></head><style>
    body{

    }

    h1{
        text-align: center;
    }

    table.gridtable {
        width:80%;
        margin: 0 auto;
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {

        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        width: 33%;
        text-align: center;
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }

    input{
        width: 200px;
    }

    select{
        width: 200px;
    }


    .addInfo{
        margin-top: 10px;
    }

    .tag{
        display: inline-block;
        width: 70px;

    }

    .add{
        /*border:solid 1px black;*/
    }



</style><body><h1>生活费用开支</h1><table class="gridtable"><tr><th>姓名</th><th>描述</th><th>金额</th><th>日期</th></tr><tbody><tr><td>simon</td><td>洗衣粉</td><td>1111</td><td>2015/07/01</td></tr></tbody></table><div class="add"><form><section><div class="addInfo"><span class="tag">付钱人：</span><select name="payPerson"><option>simon</option><option>tiger</option><option>issac</option><option>world</option></select></div><div class="addInfo"><span class="tag">金额：</span><input type="text" name="money"/></div><div class="addInfo"><span class="tag">备注：</span><input type="text" name="desc" /></div><div class="addInfo"><span class="tag">日期：</span><input type="date" name="date" id="date"/></div><div class="addInfo"><input type="submit"/></div></section></form></div></body><script type="text/javascript">
    document.getElementById('date').valueAsDate = new Date();

</script></html>