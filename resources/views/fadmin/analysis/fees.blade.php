@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        2018年各省出账收入分布
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">analysis-fees</li>
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
                    <div class="col-lg-2">
                        <select id="usernum" class="form-control" onchange="selectOnchang(this)">
                            @foreach($month as $m)
                                <option value="{{$m->month_id}}">{{substr($m->month_id,0,4)}}年{{substr($m->month_id,-2)}}月</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="lineMain" style="height:500px;"></div>
        </div>
    </div>


@endsection
@section('after_scripts')
<script src="/fadmin/js/echarts.js"></script>
<script src="/fadmin/js/china.js"></script>
<script type="text/javascript">
    function getdata(time){
        $.ajax({
            type : "post",
            async : false,
            url : '/admin/analysis/fees/fdata/',
            data : {'time': time},
            dataType : "json",
            success : function(result) {
                if(result){
                    $.each(result, function(i, item) {
                        names.push(getprovince(item.prov_id));
                        nums.push((item.total_fee/10000/10000).toFixed(2));
                    });
                    myBarChart.hideLoading();    //隐藏加载动画
                    myBarChart.setOption({        //加载数据图表
                        xAxis: {
                            data: names
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '收入',
                            data: nums
                        }]
                    });
                }

            },
            error : function(errorMsg) {
                //请求失败时执行该函数
                alert("图表请求数据失败!");
                myBarChart.hideLoading();
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
    function selectOnchang(obj){
        var value = $(obj).val();
        names.splice(0,names.length);//清空之前的数据
        nums.splice(0,nums.length);//清空之前的数据
        // myChart.clear();
        getdata(value);
    }
    var myBarChart = echarts.init(document.getElementById('lineMain'));
    option = {
        color: ['#3398DB'],
        title : {
            text: '各省出账用户收入分布'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['收入']
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
                    formatter: '{value} 亿'
                }
            }
        ],
        series : [
            {
                name:'收入',
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
    myBarChart.setOption(option,true);
    myBarChart.showLoading();
    var names=[];
    var nums=[];
    $(window).on('load', function () {
        var value = $('#usernum').val();
        getdata(value);
    });
</script>

@endsection
