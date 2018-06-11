@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        2018年4月各省市用户类型及占比
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">map</li>
      </ol>
    </section>

@endsection
@section('content')
    {{-- <div class="box">
        <div class="box-body">
            <div id="main" style="height:800px;"></div>
        </div>
    </div> --}}
    <div class="box">
        <div class="box-body">
            <div class="page-header">
                <div class="form-horizontal">
                    <div class="control-label col-lg-0">
                    </div>
                    <div class="col-lg-2">
                        <select id="usernum" class="form-control" onchange="selectOnchang(this)">
                            <option value="201804">2018年4月</option>
                            <option value="201803">2018年3月</option>
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
            type : "get",
            async : false,
            url : '/admin/monitor/map/mddata/'+time,
            data : {},
            dataType : "json",
            success : function(result) {
                if(result){
                    $.each(result, function(i, item) {
                        names.push(getprovince(item.prov_id));
                        nums.push(item.user_num/10000);
                    });
                    myBarChart.hideLoading();    //隐藏加载动画
                    myBarChart.setOption({        //加载数据图表
                        xAxis: {
                            data: names
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '人数',
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
            text: '各省人数分布'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['人数']
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
                    formatter: '{value} 万人'
                }
            }
        ],
        series : [
            {
                name:'人数',
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
<script>
    var myChart = echarts.init(document.getElementById('main'));
    //数据定义区
    //参见秋枫雁飞
    //改进之处：地图visualmap和饼图相结合，修改了经纬坐标防止饼图重叠
    var province = ['北京', '天津', '河北', '山西', '内蒙古', '辽宁', '吉林', '黑龙江', '上海', '江苏', '浙江', '安徽', '福建', '江西', '山东', '河南', '湖北', '湖南', '广东', '广西', '海南', '重庆', '四川', '贵州', '云南', '西藏', '陕西', '甘肃', '青海', '宁夏', '新疆'];
    var gdp = [];
    $.ajax({
        type: 'post',
        url: '/admin/monitor/map/mdata',//请求数据的地址
        async:false,
        dataType: "json",        //返回数据形式为json
        success: function (result) {
            gdp = result;
        },
        error: function (errorMsg) {
            //请求失败时执行该函数
            alert("图表请求数据失败!");
        }
    });
    var typeIndex = 1;
    var selectedRange = null;
    var option = null;
    var str = "";
    var data = [];
    var geoCoordMap = {};
    var name = "2018年4月各省市用户类型及占比"
    var mapName = 'china'
    // 地图特征
    var mapFeatures = echarts.getMap(mapName).geoJson.features;
    for (var i = 0; i < province.length; i++) {
        data.push({
            "name": province[i],
            "value": [{
                    "name": '23G融合',
                    value: gdp[i][0]
                },
                {
                    "name": '2I2C',
                    value: gdp[i][1]
                },
                {
                    "name": '2G',
                    value: gdp[i][2]
                },
                {
                    "name": '3G',
                    value: gdp[i][3]
                },
                {
                    "name": '4G',
                    value: gdp[i][4]
                }
            ]
        })
    }
    var geoCoordMap = { //为了保证饼图不互相重叠，我对经纬坐标进行了调整
        '上海':  [121.472644,  31.231706],
        '云南':  [102.712251,  24.040609],
        '内蒙古':  [111.670801,  40.818311],
        '北京':  [116.405285,  39.904989],
        // '台湾': [121.509062, 25.044332],
        '吉林':  [125.3245,  43.886841],
        '四川':  [103.065735,  30.659462],
        '天津':  [119.190182,  39.125596],
        '宁夏':  [106.278179,  38.46637],
        '安徽':  [117.283042,  31.86119],
        '山东':  [118.000923,  36.675807],
        '山西':  [112.049248,  37.057014],
        '广东':  [113.280637,  23.125178],
        '广西':  [108.320004,  22.82402],
        '新疆':  [87.617733,  43.792818],
        '江苏':  [119.467413,  33.741544],
        '江西':  [115.892151,  28.676493],
        '河北':  [114.802461,  37.745474],
        '河南':  [113.665412,  33.757975],
        '浙江':  [120.153576,  29.287459],
        '海南':  [110.33119,  20.031971],
        '湖北':  [113.298572,  30.984355],
        '湖南':  [112.12279,  28.19409],
        // '澳门': [113.54909, 22.198951],
        '甘肃':  [103.823557,  36.058039],
        '福建':  [119.306239,  26.075302],
        '西藏':  [91.132212,  29.660361],
        '贵州':  [106.713478,  26.578343],
        '辽宁':  [123.029096,  41.396767],
        '重庆':  [106.504962,  29.933155],
        '陕西':  [108.948024,  34.263161],
        '青海':  [100.578916,  36.623178],
        // '香港': [114.173355, 22.320048],
        '黑龙江':  [126.642464,  46.756967],
    }
    // 地理坐标图(打印出来方便查看)
    // console.log("===========geoCoordMap===============");
    // for (var i in geoCoordMap) {
    //     console.log(geoCoordMap[i]);
    // }
    // console.log(geoCoordMap);
    // console.log("==============data===============");
    // console.log(data);

    /*变换地图数据（格式）：pie*/
    function convertMapDta(type, data) {
        var mapData = [];
        for (var i = 0; i < data.length; i++) {
            mapData.push({
                'name': province[i],
                "value": gdp[i][5]
            })
        }
        return mapData;
    }

    // console.log("================mapData==================")
    // // console.log(convertMapDta_bar(province[typeIndex],data))
    // console.log(convertMapDta(province[typeIndex], data))
    // console.log("=========================================")

    /*resetPie*/
    function resetPie(myChart, params, geoCoordMap, typeIndex) {
    var op = myChart.getOption();
    var ops = op.series;
    ops.forEach(function(v, i) {
        if (i > 0) {
            var geoCoord = geoCoordMap[v.name];
            var p = myChart.convertToPixel({
                seriesIndex: 0
            }, geoCoord);
            v.center = p;
            if (params != 0 && params.zoom) {
                v.radius = v.radius * params.zoom;
            }
            if (params != 0 && params.selected) {
                var rangeFirstNumber = params.selected[0];
                var rangeSecondNumber = params.selected[1];
                var pd = v.data[typeIndex].value;
                if (pd < rangeFirstNumber || pd > rangeSecondNumber) {
                    v.itemStyle.normal.opacity = 0;
                } else {
                    v.itemStyle.normal.opacity = 1;
                }
            }
        }
    });
    myChart.setOption(op, true);
    }

    /*addPie*/
    function addPie(chart, data) {
        var op = chart.getOption();
        var sd = option.series;
        for (var i = 0; i < data.length; i++) {
            var randomValue = 15;
            var radius = randomValue;
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                var vr = [];
                (data[i].value).map(function(v) {
                    vr.push({
                        name: v.name,
                        value: v.value,
                        visualMap: false
                    }); //饼图的数据不进行映射
                });
                var p = chart.convertToPixel({
                    seriesIndex: 0
                }, geoCoord);
                sd.push({
                    name: data[i].name,
                    type: 'pie',
                    // roseType: 'radius',
                    tooltip: {
                        formatter: function(params) {
                            return params.seriesName + "<br/>" + params.name + " : " + params.value + ' 人';
                        }
                    },
                    radius: radius,
                    center: p,
                    data: vr,
                    zlevel: 4,
                    tooltip: {
                        formatter: '{a}<br/>{b}: {c}人 ({d}%)'
                    },
                    label: {
                        normal: {
                            show: false,
                        },
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    itemStyle: {
                        opacity: 0.2
                    }
                });
            }
        }
        return sd;
    };


    /* 指定图表的配置项和数据:pie*/
    var option = {
        title: {
            text: name,
            left: 'center',
            textStyle: {
                color: 'black'
            }
        },
        legend: {
            data: ['23G融合', '2I2C', '2G', '3G', '4G'],
            orient: 'vertical',
            top: '10%',
            left: 'left',
            zlevel: 4
        },
        toolbox: {
            feature: {
                saveAsImage: {
                    pixelRatio: 5
                }
            }
        },
        tooltip: {
            trigger: 'item',
            formatter: function(params) {
                if (params.value) {
                    return params.name + "<br/>" + "用户: " + params.value + "人";
                }
            }
        },
        visualMap: {
            type: 'continuous',
            show: true,
            min: 0,
            max: 30000000,
            left: 'left',
            top: 'bottom',
            text: ['高    (人)', '低    (人)'], // 文本，默认为数值文本
            calculable: true,
            // seriesIndex: [0],
            inRange: {
                // color: ['#3B5077', '#031525'] // 蓝黑
                // color: ['#ffc0cb', '#800080'] // 红紫
                // color: ['#3C3B3F', '#605C3C'] // 黑绿
                // color:['#3C3B3F','#EE2C2C']//黑红
                color: ['lightskyblue', 'yellow', 'orangered']
                // color: ['#0f0c29', '#302b63', '#24243e'] // 黑紫黑
                // color: ['#23074d', '#cc5333'] // 紫红
                // color: ['#00467F', '#A5CC82'] // 蓝绿
                // color: ['#1488CC', '#2B32B2'] // 浅蓝
                // color: ['#00467F', '#A5CC82'] // 蓝绿
            }
        },

        series: [{
            name: 'chinaMap',
            type: 'map',
            mapType: mapName,
            roam: true,

            label: {
                normal: {
                    show: false,
                },
                emphasis: {
                    show: true
                }
            },
            geo: {
                show: true,
                map: mapName,
                label: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: false,
                    }
                },
                roam: true,
                itemStyle: {
                    normal: {
                        areaColor: '#031525',
                        borderColor: '#3B5077',
                    },
                    emphasis: {
                        areaColor: '#2B91B7',
                    }
                }
            },

            data: convertMapDta(province[typeIndex], data),
            zlevel: 3
        }]
    };
    // console.log('========visualMapdata==========')
    // console.log(convertMapDta(province[typeIndex], data))
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
    /*pie*/
    addPie(myChart, data);
    /*bar*/
    // addBar(myChart,data);
    // console.log("===========option=================");
    // console.log(option);
    myChart.setOption(option, true);

    /*饼图跟着地图移动:pie*/
    myChart.on('georoam', function(params) {
        resetPie(myChart, params, geoCoordMap, typeIndex);
    });
    myChart.on('datarangeselected', function(params) {
        resetPie(myChart, params, geoCoordMap, typeIndex);
    });
    window.addEventListener("resize", function() {
        myChart.resize();
        resetPie(myChart, 0, geoCoordMap);
    })


    myChart.setOption(option);
</script>
@endsection
