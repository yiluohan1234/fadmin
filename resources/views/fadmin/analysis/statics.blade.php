@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{substr($month[0]->month_id,0,4)}}年各省数据分布
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">statics</li>
      </ol>
    </section>

@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="page-header">
                <div class="form-horizontal">
                    <div class="control-label col-lg-0">
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <select id="prov" class="form-control" onchange="selectChange(this)">
                                @foreach($province as $p)
                                    <option value="{{$p['value']}}">{{$p['name']}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg-2">
                            <select id="category" class="form-control" onchange="selectChange(this)">
                                @foreach($category as $m)
                                    <option value="{{$m['value']}}">{{$m['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2" id="date">
                            <select id="month" class="form-control" onchange="selectChange(this)">
                                @foreach($month as $m)
                                    <option value="{{$m->month_id}}">{{substr($m->month_id,0,4)}}年{{substr($m->month_id,-2)}}月</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-lg-2 pull-right">
                            <button type="button" class="btn btn-info">下载</button>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div id="lineFee" style="height:340px;width:1000px"></div>
        </div>
    </div>


@endsection
@section('after_scripts')
<script src="/fadmin/js/echarts.js"></script>
<script src="/fadmin/js/china.js"></script>
<script type="text/javascript">
    function getdata(prov_id, category_id, month_id){
        $.ajax({
            type : "post",
            async : false,
            url : '/admin/analysis/statics/sdata/',
            data : {'prov':prov_id, 'category': category_id, 'month': month_id},
            dataType : "json",
            success : function(result) {
                if(result){
                    $.each(result, function(i, item) {
                        if(prov_id != '0'){
                            names.push(item.month_id);
                            datas.push(item.data);
                        }else{
                            names.push(getprovince(item.prov_id));
                            datas.push(item.data);
                        }
                    });
                    myFeeChart.hideLoading();    //隐藏加载动画
                    myFeeChart.setOption({        //加载数据图表
                        xAxis: {
                            data: names
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '数据',
                            data: datas
                        }]
                    });
                }

            },
            error : function(errorMsg) {
                //请求失败时执行该函数
                alert("图表请求数据失败!");
                myFeeChart.hideLoading();
            }
        })
    }
    function getprovince(prov_id)
    {
        var list = new Array();
        list["010"] = "内蒙古";
        list["011"] = "北京";
        list["013"] = "天津";
        list["017"] = "山东";
        list["018"] = "河北";
        list["019"] = "山西";
        list["022"] = "澳门";
        list["030"] = "安徽";
        list["031"] = "上海";
        list["034"] = "江苏";
        list["036"] = "浙江";
        list["038"] = "福建";
        list["050"] = "海南";
        list["051"] = "广东";
        list["059"] = "广西";
        list["070"] = "青海";
        list["071"] = "湖北";
        list["074"] = "湖南";
        list["075"] = "江西";
        list["076"] = "河南";
        list["079"] = "西藏";
        list["081"] = "四川";
        list["083"] = "重庆";
        list["084"] = "陕西";
        list["085"] = "贵州";
        list["086"] = "云南";
        list["087"] = "甘肃";
        list["088"] = "宁夏";
        list["089"] = "新疆";
        list["090"] = "吉林";
        list["091"] = "辽宁";
        list["097"] = "黑龙江"
        return list[prov_id];
    }

    function selectChange(obj){
        var prov_value = $('#prov').val();
        var category_value = $('#category').val();
        var month_value = $('#month').val();

        var prov_id=document.getElementById('prov');
        var date_id=document.getElementById('date');
        if(prov_id.value=="0")
        {
            date_id.style.display='';
            var date_value = $(obj).val();
            names.splice(0,names.length);//清空之前的数据
            datas.splice(0,datas.length);//清空之前的数据
            // myChart.clear();
            getdata(prov_value, category_value, month_value);

        }else
        {
            date_id.style.display='none';
            names.splice(0,names.length);//清空之前的数据
            datas.splice(0,datas.length);//清空之前的数据
            // myChart.clear();
            getdata(prov_value, category_value, month_value);
        }
    }
    var myFeeChart = echarts.init(document.getElementById('lineFee'));
    option1 = {
        color: ['#3398DB'],
        // title : {
        //     text: '用户人数分布'
        // },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['数据']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : true,
                //设置字体倾斜
                axisLabel: {
                   interval:0,
                   rotate:40
                },

                data : []
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLabel : {
                    formatter: function (params) {
                        $cagtegory_id = $('#category').val()
                        if ($cagtegory_id == '001' || $cagtegory_id == '004') {
                           return params + " 万";
                        }
                        else if($cagtegory_id == '002' || $cagtegory_id == '005'){
                            return params + " G";
                        }else {
                            return params + " 亿";
                        }
                    }
               }
            }
        ],
        series : [
            {
                name:'数据',
                type:'bar',
                data: [], // y轴的数据，由上个方法中得到的ttls
                markPoint:{
                    data:[
                        {type:'average', name:'平均值'}
                    ]
                }
            }
        ]
    };
    myFeeChart.setOption(option1,true);
    myFeeChart.showLoading();
    var names=[];
    var datas=[];
    $(window).on('load', function () {
        var prov_id = $('#prov').val();
        var category_id = $('#category').val();
        var month_id = $('#month').val();
        getdata(prov_id, category_id, month_id);
    });
</script>

@endsection
