@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{ trans('base.dashboard') }}<small>{{ trans('base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ fadmin_url() }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">{{ trans('base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('base.logged_in') }}</div>
            </div>
        </div>
    </div>
    <!-- 顶部数据展示 -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$latest_data_show[0]['data']}}<sup style="font-size: 20px">亿</sup></h3>

            <p>{{trans('dashboard.users')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{Route('fadmin.analysis.statics')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$latest_data_show[1]['data']}}<sup style="font-size: 20px">亿</sup></h3>

            <p>{{trans('dashboard.fee')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{Route('fadmin.analysis.statics')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$label_num}}</h3>

            <p>{{trans('dashboard.o files')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{Route('fadmin.monitor.table')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$O_num}}</h3>

            <p>{{trans('dashboard.label files')}}</p>
            {{-- <p>↑&nbsp;0.01%</p> --}}
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{Route('fadmin.monitor.table')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- 顶部数据展示 -->
    <!-- 收入，dou展示 -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{trans('dashboard.Monthly report')}}</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                {{-- <p class="text-center">
                  <strong>收入：近6个月变化情况</strong>
                </p> --}}

                <div class="chart">
                  <!-- 用户近6个月收入情况 -->
                  <div id="container"  style="height: 250px;"></div>
                </div>
                <!-- 用户近6个月收入情况-->
              </div>
              <!-- 2018年05月份总体情况 -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>{{substr($month_id,0,4)}}年{{substr($month_id,-2)}}月份总体情况</strong>
                </p>

                <div class="box-body no-padding">
                  <table class="table table-condensed">
                    <tr>
                      <th>{{trans('dashboard.name')}}</th>
                      <th>{{trans('dashboard.data')}}</th>
                      <th>{{trans('dashboard.growth rate')}}</th>
                    </tr>
                    @foreach($latest_data_show as $v)
                    <tr>
                      <td>{{$v['name']}}</td>
                      <td>
                        {{$v['data']}}
                      </td>
                      <td>
                        @if($v['percentage']> 0)
                          <span class="description-percentage text-red">
                          <i class="fa fa-caret-up"></i>
                        @elseif ($v['percentage'] < 0)
                          <span class="description-percentage text-green">
                          <i class="fa fa-caret-down"></i>
                        @else
                          <span class="description-percentage text-yellow">
                          <i class="fa fa-caret-left"></i>
                        @endif
                        {{$v['percentage']}}%</span>
                      </td>
                    </tr>
                    @endforeach

                  </table>
                </div>
              </div>
              <!-- 2018年05月份总体情况 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- 收入，dou展示 -->
    @if(getenv('APP_ENV') == 'local')
    @role('admin')
    @if(count($timeline) != 0)
    <div class="box">
        <div class="box-body">
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              @foreach($timeline as $t)
                @foreach($t as $key => $value)
                  <li class="time-label">
                        <span class="bg-blue">
                          {{$key}}
                        </span>
                  </li>

                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  @foreach($value as $v)
                  <li>
                    <i class="fa {{$v->action}} {{$v->color}}"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{$v->date}}</span>

                      <h3 class="timeline-header">{{$v->title}}</h3>

                      <div class="timeline-body">
                        {!!$v->content!!}
                      </div>
                      <!-- <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div> -->
                    </div>
                  </li>
                  @endforeach
                @endforeach
              @endforeach
              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
        </div>
    </div>
    @endif
    @endrole
    @endif
@endsection
@section('after_scripts')
<script src="/fadmin/js/echarts.js"></script>
<script type="text/javascript">
    function getdata(ec){
        $.ajax({
            type : "post",
            async : false,
            url : '/admin/dashboard/country/data',
            data : {},
            dataType : "json",
            success : function(result) {
                if(result){
                    $.each(result.fee, function(i, item) {
                        names.push(item.month_id);
                        ttls_O.push((item.total_fee/10000/10000).toFixed(2));
                    });
                    $.each(result.fee_hv, function(i, item) {
                        ttls_l.push((item.hightv_total_fee/10000/10000).toFixed(2));
                    });
                    ec.hideLoading();    //隐藏加载动画
                    ec.setOption({        //加载数据图表
                        xAxis: {
                            data: names
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '{{trans('dashboard.fee')}}',
                            data: ttls_O
                        },
                        {
                            name: '{{trans('dashboard.High value user revenue')}}',
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
    var myLineChart = echarts.init(document.getElementById('container'));

    option = {
        title : {
            text: '{{trans('dashboard.Users income in the past 6 months')}}'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['{{trans('dashboard.fee')}}', '{{trans('dashboard.High value user revenue')}}']
        },
        toolbox: {
            show : false,
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
                name:'总收入',
                type:'bar',
                barWidth: 20,
                data: []// y轴的数据，由上个方法中得到的ttls
            },
            {
                name:'高价值用户总收入',
                type:'bar',
                barWidth: 20,
                data: []  // y轴的数据，由上个方法中得到的ttls
            }
        ]
    };
    myLineChart.setOption(option,true);
    myLineChart.showLoading();
    var names = [],ttls_O = [],ttls_l = [];
    getdata(myLineChart);
</script>
@endsection
