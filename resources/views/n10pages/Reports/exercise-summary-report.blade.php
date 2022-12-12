@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="mb-5 hover-scroll-x">
                <div class="d-grid">
                    <ul class="nav nav-tabs flex-nowrap text-nowrap">
                        <li class="nav-item">
                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                data-bs-toggle="tab" href="#kt_tab_pane_1">Report Part 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                data-bs-toggle="tab" href="#kt_tab_pane_2">Report Part 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                data-bs-toggle="tab" href="#kt_tab_pane_3">Report Part 3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                data-bs-toggle="tab" href="#kt_tab_pane_4">Report Part 4</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                data-bs-toggle="tab" href="#kt_tab_pane_5">Report Part 5</a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    <div class="card p-5" style="overflow-x: scroll">
                        @php
                            $last_ex = '';
                        @endphp
                        @for ($i = 1; $i <= $program->days; $i++)

                            <label for="" class="mt-5 mb-5"><strong style="color:blue;">Day
                                    {{ $i }}</strong></label>

                            <div class="row">
                                <div class="col-12" style="display: flex">
                                    @for ($j = 1; $j <= $program->weeks; $j++)
                                        @if ($j == 1)
                                            <div class="col-5">
                                            @else
                                                <div class="col-2">
                                        @endif
                                        <table class="table">

                                            @foreach ($exercises_report[$j][$i] as $item)
                                                <tr style="border-top:solid">
                                                    @if ($j == 1)
                                                        <td><strong>Week</strong></td>
                                                    @endif
                                                    <td colspan=""><strong>W {{ $j }}</strong></td>
                                                </tr>
                                                <tr style="border-top:solid">
                                                    @if ($j == 1)
                                                        <td><strong>Movement</strong></td>
                                                    @endif
                                                    @if ($item->exerciseLibrary->name != $last_ex)
                                                        <td colspan="">{{ $item->exerciseLibrary->name }}</td>
                                                    @else
                                                        <td colspan="">.</td>
                                                    @endif
                                                </tr>
                                                @php
                                                    $last_ex = $item->exerciseLibrary->name;
                                                @endphp
                                                @for ($set_no = 1; $set_no <= $set[$j][$i][$item->id]; $set_no++)
                                                    @isset($set_ans[$j][$i][$item->id][$set_no])
                                                        @if ($set_no == 1)
                                                            <tr class="set 1 pkMax" style="border-top:solid">
                                                                @if ($j == 1)
                                                                    <td><strong>PK MAX</strong></td>
                                                                @endif
                                                                <td>{{ $set_ans[$j][$i][$item->id][$set_no]->highest_peak_exterted_max }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr class="set 1 load" style="border-top:solid">
                                                            @if ($j == 1)
                                                                <td><strong>Load</strong></td>
                                                            @endif
                                                            <td>{{ $set_ans[$j][$i][$item->id][$set_no]->weight }}</td>
                                                        </tr>
                                                        <tr class="set 1 reps">
                                                            @if ($j == 1)
                                                                <td><strong>Reps</strong></td>
                                                            @endif
                                                            <td>{{ $set_ans[$j][$i][$item->id][$set_no]->reps }}</td>
                                                        </tr>
                                                        <tr class="set 1 rpe">
                                                            @if ($j == 1)
                                                                <td><strong>Rpe</strong></td>
                                                            @endif
                                                            <td>{{ $set_ans[$j][$i][$item->id][$set_no]->rpe }}</td>
                                                        </tr>
                                                        <tr >
                                                            @if ($j == 1)
                                                                <td><strong>One Rep Max</strong></td>
                                                            @endif
                                                            <td class="set 1 onerepmax_{{ $item->exerciseLibrary->exerciseCategory->name }}_{{$i}}">{{ round($set_ans[$j][$i][$item->id][$set_no]->weight /( 1.0278 - 0.0278 *  $set_ans[$j][$i][$item->id][$set_no]->reps ))}}</td>
                                                        </tr>
                                                    @else
                                                        @if ($set_no == 1)
                                                            <tr class="set 1 pkMax" style="border-top:solid">
                                                                @if ($j == 1)
                                                                    <td><strong>PK MAX</strong></td>
                                                                @endif
                                                                <td>0</td>
                                                            </tr>
                                                        @endif
                                                        <tr class="set 1 load" style="border-top:solid">
                                                            @if ($j == 1)
                                                                <td><strong>Load</strong></td>
                                                            @endif
                                                            <td>0</td>
                                                        </tr>
                                                        <tr class="set 1 reps">
                                                            @if ($j == 1)
                                                                <td><strong>Reps</strong></td>
                                                            @endif
                                                            <td>0</td>
                                                        </tr>
                                                        <tr class="set 1 rpe">
                                                            @if ($j == 1)
                                                                <td><strong>Rpe</strong></td>
                                                            @endif
                                                            <td>0</td>
                                                        </tr>

                                                        <tr class="set 1 onerepmax">
                                                            @if ($j == 1)
                                                                <td><strong>One Rep Max</strong></td>
                                                            @endif
                                                            <td>0</td>
                                                        </tr>
                                                    @endisset
                                                @endfor
                                            @endforeach
                                        </table>
                                </div>
                        @endfor


                </div>
                </div>
                @endfor

        </div>
                </div>
        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
            <div class="card p-5" style="overflow-x: scroll">
                @php
                    $last_ex = '';
                @endphp
                @for ($i = 1; $i <= $program->days; $i++)

                    <label for="" class="mt-5 mb-5"><strong style="color:blue;">Day
                            {{ $i }}</strong></label>

                    <div class="row">
                        <div class="col-12" style="display: flex">
                            @for ($j = 1; $j <= $program->weeks; $j++)
                                @if ($j == 1)
                                    <div class="col-3">
                                    @else
                                        <div class="col-2">
                                @endif
                                <table class="table">

                                    @foreach ($exercises_report[$j][$i] as $item)
                                        <tr style="border-top:solid">
                                            @if ($j == 1)
                                                <td><strong>Week</strong></td>
                                            @endif
                                            <td colspan=""><strong>W {{ $j }}</strong></td>
                                        </tr>
                                        <tr style="border-top:solid">
                                            @if ($j == 1)
                                                <td><strong>Category</strong></td>
                                            @endif
                                            <td colspan="">{{ $item->exerciseLibrary->exerciseCategory->name }}</td>

                                        </tr>
                                        @php
                                            $last_ex = $item->exerciseLibrary->name;
                                            $pk_max = 0;
                                            $strength = 0;
                                            $hyper = 0;
                                            $avg_rpe = 0;
                                            $count = 0;
                                        @endphp
                                        @for ($set_no = 1; $set_no <= $set[$j][$i][$item->id]; $set_no++)
                                            @isset($set_ans[$j][$i][$item->id][$set_no])
                                                @php
                                                    $pk_max = $set_ans[$j][$i][$item->id][$set_no]->highest_peak_exterted_max;
                                                    $count += 1;
                                                    if ($set_ans[$j][$i][$item->id][$set_no]->reps <= 5 && $set_ans[$j][$i][$item->id][$set_no]->reps > 0) {
                                                        $strength += 1;
                                                    } elseif ($set_ans[$j][$i][$item->id][$set_no]->reps >= 6) {
                                                        $hyper += 1;
                                                    }
                                                    $avg_rpe += $set_ans[$j][$i][$item->id][$set_no]->rpe;
                                                    $avg_rpe += $set_ans[$j][$i][$item->id][$set_no]->rpe;

                                                @endphp
                                            @endisset
                                        @endfor
                                        <tr class="set 1 pkMax" style="border-top:solid">
                                            @if ($j == 1)
                                                <td><strong>PK MAX</strong></td>
                                            @endif
                                            <td
                                                class="day_{{ $i }}_{{ $item->exerciseLibrary->exerciseCategory->name }}_pkmax_{{ $j }}">
                                                {{ $pk_max }}</td>
                                        </tr>
                                        <tr class="set 1 load">
                                            @if ($j == 1)
                                                <td><strong>Strength</strong></td>
                                            @endif
                                            <td
                                                class="day_{{ $i }}_{{ $item->exerciseLibrary->exerciseCategory->name }}_strength_{{ $j }}">
                                                {{ $strength }}</td>
                                        </tr>
                                        <tr class="set 1 reps">
                                            @if ($j == 1)
                                                <td><strong>Hyper</strong></td>
                                            @endif
                                            <td
                                                class="day_{{ $i }}_{{ $item->exerciseLibrary->exerciseCategory->name }}hyper_{{ $j }}">
                                                {{ $hyper }}</td>
                                        </tr>
                                        <tr class="set 1 rpe">
                                            @if ($j == 1)
                                                <td><strong>Avg Rpe</strong></td>
                                            @endif
                                            @if ($count > 0)
                                                <td
                                                    class="day_{{ $i }}_{{ $item->exerciseLibrary->exerciseCategory->name }}_avgrpe_{{ $j }}">
                                                    {{ $avg_rpe / $count }}</td>
                                            @else
                                                <td>0</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                        </div>
                @endfor


        </div>
          </div>
        @endfor

    </div>
        </div>
    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
        <div class="card p-5" style="overflow-x: scroll">

            @for ($i = 1; $i <= $program->days; $i++)

                <label for="" class="mt-5 mb-5"><strong style="color:blue;">Day
                        {{ $i }}</strong></label>
                <div class="row">
                    <div class="col-12" style="display: flex">
                        @for ($j = 1; $j <= $program->weeks; $j++)
                            @if ($j == 1)
                                <div class="col-3">
                                @else
                                    <div class="col-2">
                            @endif
                            <table class="table">

                                @foreach ($categories as $item)
                                    <tr style="border-top:solid">
                                        @if ($j == 1)
                                            <td><strong>{{ $item->name }}</strong></td>
                                        @endif
                                        <td colspan=""><strong>W {{ $j }}</strong></td>
                                    </tr>



                                    @if ($j == 1)
                                        <td><strong>PK MAX</strong></td>
                                    @endif
                                    <td
                                        class="day_{{ $i }}_{{ $item->name }}_pkmax_{{ $j }}_finalreport">
                                        {{ $pk_max }}</td>
                                    </tr>
                                    <tr class="set 1 load">
                                        @if ($j == 1)
                                            <td><strong>Strength</strong></td>
                                        @endif
                                        <td
                                            class="day_{{ $i }}_{{ $item->name }}_strength_{{ $j }}_finalreport">
                                            {{ $strength }}</td>
                                    </tr>
                                    <tr class="set 1 reps">
                                        @if ($j == 1)
                                            <td><strong>Hyper</strong></td>
                                        @endif
                                        <td
                                            class="day_{{ $i }}_{{ $item->name }}hyper_{{ $j }}_finalreport">
                                            {{ $hyper }}</td>
                                    </tr>
                                    <tr class="set 1 rpe">
                                        @if ($j == 1)
                                            <td><strong>Avg Rpe</strong></td>
                                        @endif

                                        <td
                                            class="day_{{ $i }}_{{ $item->name }}_avgrpe_{{ $j }}_finalreport">
                                            0</td>

                                    </tr>
                                @endforeach
                            </table>
                    </div>
            @endfor



    </div>
     </div>
    @endfor

    </div>
    </div>

    <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
        <div class="card p-5" style="overflow-x: scroll">
            @for ($i = 1; $i <= $program->days; $i++)
                <label for="" class="mt-5 mb-5"><strong style="color:blue;">Day
                        {{ $i }}</strong></label>
                <div class="card card-bordered">
                    <div class="card-body">
                        <label for="">Set Volume</label>
                        <div id="kt_apexcharts_{{ $i }}" style="height: 350px;"></div>
                    </div>
                </div>
            @endfor
        </div>

    </div>

     <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
        <div class="card p-5" style="overflow-x: scroll">
            @for ($i = 1; $i <= $program->days; $i++)
                <label for="" class="mt-5 mb-5"><strong style="color:blue;">Day
                        {{ $i }}</strong></label>
            @foreach ($categories as $item)

                <div class="card card-bordered" id="kt_apexcharts_{{ $i }}_{{trim($item->name)}}_head">
                    <div class="card-body">
                        <label for="">{{$item->name}}</label>
                        <div id="kt_apexcharts_{{ $i }}_{{trim($item->name)}}" style="height: 350px;"></div>
                    </div>
                </div>
                @endforeach
            @endfor
        </div>

    </div>


    </div>
    </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {
            let weeks = {!! $program->weeks !!};
            let days = {!! $program->days !!};
            let categories = {!! $categories !!};

            for (let i = 1; i <= days; i++) {
                let hyper_array = [];
                let strength_array = [];
                let week_array = [];
                for (let p = 1; p <= weeks; p++) {
                    hyper_array.push(0);
                    strength_array.push(0);
                    week_array.push('W' + p);
                }
                //.weight / ( 1.0278 – 0.0278 × reps )
                categories.forEach(category => {
                    let category_wise_1_rep_max = [];
                    // for (let p = 1; p <= weeks; p++) {
                    //     category_wise_1_rep_max.push(0);
                    // }
                    for (let index = 1; index <= weeks; index++) {
                        let category_in_use = category['name'];
                        const week = index;
                        let count = 0;
                        let strength = 0
                        let pk_max = 0;
                        let hyper = 0;
                        let avgrpe = 0;

                        $('.day_' + i + '_' + category_in_use + '_pkmax_' + week).each(function() {
                            if (pk_max < parseFloat($(this).html())) {
                                pk_max = parseFloat($(this).html());
                            }
                        });
                        $('.day_' + i + '_' + category_in_use + '_pkmax_' + week + "_finalreport").html(
                            pk_max);

                        $('.day_' + i + '_' + category_in_use + '_strength_' + week).each(function() {
                            strength += parseFloat($(this).html());
                            strength_array[index - 1] += parseFloat($(this).html());

                        });
                        $('.day_' + i + '_' + category_in_use + '_strength_' + week + "_finalreport").html(
                            strength);

                        $('.day_' + i + '_' + category_in_use + 'hyper_' + week).each(function() {
                            hyper += parseFloat($(this).html());
                            hyper_array[index - 1] += parseFloat($(this).html());
                        });
                        $('.day_' + i + '_' + category_in_use + 'hyper_' + week + "_finalreport").html(
                            hyper);

                        $('.day_' + i + '_' + category_in_use + '_avgrpe_' + week).each(function() {
                            avgrpe += parseFloat($(this).html());
                            count += 1;
                        });
                        if (count > 0) {
                            avgrpe = avgrpe / count;
                        } else {
                            avgrpe = 0;
                        }
                        $('.day_' + i + '_' + category_in_use + '_avgrpe_' + week + "_finalreport").html(
                            avgrpe);

                    }
                    $('.onerepmax' + '_' + category['name'] + '_' + i).each(function() {
                                category_wise_1_rep_max.push(($(this).html()));
                        });
                    oneRepMaxCharts(i,category['name'].trim(),category_wise_1_rep_max)
                });
                setupChart(i, hyper_array, strength_array, week_array);

            }
        });

        function setupChart(day, hyper_array, strength_array, week_array) {
            var element = document.getElementById('kt_apexcharts_' + day);

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');

            var baseColor = KTUtil.getCssVariableValue('--kt-primary');
            var baseLightColor = KTUtil.getCssVariableValue('--kt-primary-light');
            var secondaryColor = KTUtil.getCssVariableValue('--kt-info');

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Hyper Stimulus',
                    type: 'bar',
                    stacked: true,
                    data: hyper_array
                }, {
                    name: 'Strength Stimulus',
                    type: 'bar',
                    stacked: true,
                    data: strength_array
                }],
                chart: {
                    fontFamily: 'inherit',
                    stacked: true,
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        stacked: true,
                        horizontal: false,
                        endingShape: 'rounded',
                        columnWidth: ['12%']
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: week_array,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    max: 10,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return '' + val + ' '
                        }
                    }
                },
                colors: [baseColor, secondaryColor, baseLightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();

        }


        function oneRepMaxCharts(day,category_name,category_wise_1_rep_max) {
            var element = document.getElementById('kt_apexcharts_'+day+'_'+category_name);
            var element_head = document.getElementById('kt_apexcharts_'+day+'_'+category_name+'_head');

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');

            var baseColor = KTUtil.getCssVariableValue('--kt-primary');
            var baseLightColor = KTUtil.getCssVariableValue('--kt-primary-light');
            var secondaryColor = KTUtil.getCssVariableValue('--kt-info');

            if (!element) {
                return;
            }
            if(category_wise_1_rep_max.length <= 0){
                element_head.style.display="none";
            }

            var options = {
                series: [{
                    name: '1 Rep Max',
                    type: 'bar',
                    stacked: true,
                    data: category_wise_1_rep_max
                }],
                chart: {
                    fontFamily: 'inherit',
                    stacked: true,
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        stacked: true,
                        horizontal: false,
                        endingShape: 'rounded',
                        columnWidth: ['12%']
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: category_wise_1_rep_max,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    max: 800,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return  val + ' Max'
                        }
                    }
                },
                colors: [baseColor, secondaryColor, baseLightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }
    </script>
@endsection
