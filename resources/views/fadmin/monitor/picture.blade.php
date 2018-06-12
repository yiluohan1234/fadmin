@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{trans('monitor.Stock data update status')}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">{{trans('monitor.picture')}}</li>
      </ol>
    </section>

@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <div id="lineMain" style="height:400px"></div>
            <div id="pieMain" style="height:400px"></div>
        </div>
    </div>
    <!-- /.content -->
@endsection
@section('after_scripts')
<!-- ECharts单文件引入 -->
@if(env('APP_LOCALE') == 'zh-CN')
<script src="/fadmin/js/echarts.js"></script>
@else
<script src="/fadmin/js/echarts-en.js"></script>
@endif
<script type="text/javascript">
    function getdata(ec){
        $.ajax({
            type : "post",
            async : false,
            url : '/admin/monitor/picture/odata',
            data : {},
            dataType : "json",
            success : function(result) {
                if(result){
                    $.each(result.O, function(i, item) {
                        names.push(item.update_date);
                        ttls_O.push(item.space_size);
                    });
                    $.each(result.label, function(i, item) {
                        ttls_l.push(item.space_size);
                    });
                    ec.hideLoading();    //隐藏加载动画
                    ec.setOption({        //加载数据图表
                        xAxis: {
                            data: names
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '{{trans('monitor.O_data')}}',
                            data: ttls_O
                        },
                        {
                            name: '{{trans('monitor.label_data')}}',
                            data: ttls_l
                        }
                        ]
                    });
                }

            },
            error : function(errorMsg) {
                //请求失败时执行该函数
                alert("图表请求数据失败!");
                ec.hideLoading();
            }
        })
    }
    var myLineChart = echarts.init(document.getElementById('lineMain'));
    option = {
        title : {
            text: '{{trans('monitor.Last 7 days')}}'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['{{trans('monitor.O_data')}}', '{{trans('monitor.label_data')}}']
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
                boundaryGap : false,
                data : []
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLabel : {
                    formatter: '{value} M'
                }
            }
        ],
        series : [
            {
                name:'{{trans('monitor.O_data')}}',
                type:'line',
                data: []// y轴的数据，由上个方法中得到的ttls
            },
            {
                name:'{{trans('monitor.label_data')}}',
                type:'line',
                data: []  // y轴的数据，由上个方法中得到的ttls
            }
        ]
    };
    myLineChart.setOption(option,true);
    myLineChart.showLoading();
    var names = [],ttls_O = [],ttls_l = [];
    getdata(myLineChart);
</script>
<script type="text/javascript">
    function getdata(ec){
        $.ajax({
            type : "post",
            async : false,
            url : '/admin/monitor/picture/filesystem',
            data : {},
            dataType : "json",
            success : function(result) {
                if(result){
                    datas = result;
                    ec.hideLoading();    //隐藏加载动画
                    ec.setOption({        //加载数据图表
                        series: [{
                            data: datas
                        }]
                    });
                }

            },
            error : function(errorMsg) {
                //请求失败时执行该函数
                alert("图表请求数据失败!");
                ec.hideLoading();
            }
        })
    }
    var myBarChart = echarts.init(document.getElementById('pieMain'));
    option = {
        title : {
            text: '{{trans('monitor.Disk usage')}}',
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'right',
            data:['{{trans('monitor.Total')}}','{{trans('monitor.Usage')}}']
        },
        series: [
            {
                name:'{{trans('monitor.Disk usage')}}',
                type:'pie',
                radius : '55%',
                center: ['50%', '60%'],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },
                data:[]
            }
        ]
    };
    myBarChart.setOption(option,true);
    myBarChart.showLoading();
    getdata(myBarChart);
</script>
@endsection
