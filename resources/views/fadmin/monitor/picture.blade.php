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
    var names = [],ttls_O = [],ttls_l = [];

    function getdata(){
        $.post("{{ url('/admin/monitor/picture/odata') }}", {
            "_token": "{{ csrf_token() }}"
        }, function(data) {
            $.each(data.O, function(i, item) {
                names.push(item.update_date);
                ttls_O.push(item.space_size);
            });
            $.each(data.label, function(i, item) {
                ttls_l.push(item.space_size);
            });
        });
        return names,ttls_O, ttls_l;
    };
    getdata();
    function chart_line() {
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
                    data : names
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
                    data: ttls_O // y轴的数据，由上个方法中得到的ttls
                },
                {
                    name:'{{trans('monitor.label_data')}}',
                    type:'line',
                    data: ttls_l  // y轴的数据，由上个方法中得到的ttls
                }
            ]
        };
        myLineChart.setOption(option);
    }
    setTimeout('chart_line()', 1000);
</script>
<script type="text/javascript">

    var datas = [];
    function getdata(){
        $.post("{{ url('/admin/monitor/picture/filesystem') }}", {
            "_token": "{{ csrf_token() }}"
        }, function(result) {
            datas = result;
        });
        return datas;
    };
    getdata();
    function chart_pie(){
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
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        normal: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            show: true,
                            textStyle: {
                                fontSize: '30',
                                fontWeight: 'bold'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data:datas
                }
            ]
        };

        myBarChart.setOption(option);
    };
    setTimeout('chart_pie()', 1000);
</script>
@endsection
