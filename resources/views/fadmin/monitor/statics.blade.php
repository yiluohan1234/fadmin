<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
<pre>
hi, {{$user}}:
    {{$content}}
    <h3>数据大小</h3>
    <table class= "table-container" width="90%" id="mytab"  border="1" class="t1">
      <thead>
        <th></th>
        @foreach($odata as $data)
        <th>{{$data->update_date}}</th>
        @endforeach
        <th>总计</th>
      </thead>
      <tr>
        <td>探针数据</td>
        @foreach($odata as $data)
        <td>{{$data->space_size}}M</td>
        @endforeach
        <td>{{$sumOdata}}G</td>
      </tr>
      <tr>
        <td>标签数据</td>
        @foreach($ldata as $data)
        <td>{{$data->space_size}}M</td>
        @endforeach
        <td>{{$sumLdata}}G</td>
      </tr>
      <tr>
        <td>畅越数据</td>
        @foreach($cdata as $data)
        <td>{{$data->space_size}}M</td>
        @endforeach
        <td>{{$sumCdata}}G</td>
      </tr>
    </table>
    <h3>数据数量</h3>
    <table class= "table-container" width="90%" id="mytab"  border="1" class="t1">
      <thead>
        <th></th>
        @foreach($odata as $data)
        <th>{{$data->update_date}}</th>
        @endforeach
        <th>总计</th>
      </thead>
      <tr>
        <td>探针数据</td>
        @foreach($odata as $data)
        <td>{{$data->file_num}}个</td>
        @endforeach
        <td>{{$sumOdataNum}}个</td>
      </tr>
      <tr>
        <td>标签数据</td>
        @foreach($ldata as $data)
        <td>{{$data->file_num}}个</td>
        @endforeach
        <td>{{$sumLdataNum}}个</td>
      </tr>
      <tr>
        <td>畅越数据</td>
        @foreach($cdata as $data)
        <td>{{$data->file_num}}个</td>
        @endforeach
        <td>{{$sumCdataNum}}个</td>
      </tr>
    </table>
</pre>
<table border="0"  cellpadding="0"  cellspacing="0"  style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
<tr>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
        <a href="http://127.0.0.1:8888/admin/monitor/table"  class="button button-blue"  target="_blank"  style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #FFF; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097D1; border-top: 10px solid #3097D1; border-right: 18px solid #3097D1; border-bottom: 10px solid #3097D1; border-left: 18px solid #3097D1;">点击查看详情</a>
    </td>
</tr>
</table>

<style type="text/css">
<!--
body,table,pre{
    font-size:16px;
    font-family: 微软雅黑;
}
table{
    table-layout:fixed;
    empty-cells:show;
    border-collapse: collapse;
    margin:0 auto;
}
td{
    height:20px;
    text-align: center;
}
h1,h2,h3{
    font-size:12px;
    margin:0;
    padding:0;
}

.title { background: #FFF; border: 1px solid #9DB3C5; padding: 1px; width:90%;margin:20px auto; }
    .title h1 { line-height: 31px; text-align:center;  background: #2F589C url(th_bg2.gif); background-repeat: repeat-x; background-position: 0 0; color: #FFF; }
        .title th, .title td { border: 1px solid #CAD9EA; padding: 5px; }


/*这个是借鉴一个论坛的样式*/
table.t1{
    border:1px solid #cad9ea;
    color:#666;
}
table.t1 th {
    background-image: url(th_bg1.gif);
    background-repeat::repeat-x;
    height:30px;
}
table.t1 td,table.t1 th{
    border:1px solid #cad9ea;
    padding:0 1em 0;
}
table.t1 tr.a1{
    background-color:#f5fafe;
}



table.t2{
    border:1px solid #9db3c5;
    color:#666;
}
table.t2 th {
    background-image: url(th_bg2.gif);
    background-repeat::repeat-x;
    height:30px;
    color:#fff;
}
table.t2 td{
    border:1px dotted #cad9ea;
    padding:0 2px 0;
}
table.t2 th{
    border:1px solid #a7d1fd;
    padding:0 2px 0;
}
table.t2 tr.a1{
    background-color:#e8f3fd;
}



table.t3{
    border:1px solid #fc58a6;
    color:#720337;
}
table.t3 th {
    background-image: url(th_bg3.gif);
    background-repeat::repeat-x;
    height:30px;
    color:#35031b;
}
table.t3 td{
    border:1px dashed #feb8d9;
    padding:0 1.5em 0;
}
table.t3 th{
    border:1px solid #b9f9dc;
    padding:0 2px 0;
}
table.t3 tr.a1{
    background-color:#fbd8e8;
}
.table-container
{
width: 100%;
overflow-y: auto;
_overflow: auto;
margin: 0 0 1em;
}
-->
</style>
</html>
