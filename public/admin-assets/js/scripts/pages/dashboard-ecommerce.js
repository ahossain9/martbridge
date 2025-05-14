
$(window).on('load', function () {
  'use strict';

  var $barColor = '#f3f3f3';
  var $trackBgColor = '#EBEBEB';
  var $textMutedColor = '#b9b9c3';
  var $budgetStrokeColor2 = '#dcdae3';
  var $goalStrokeColor2 = '#51e5a8';
  var $strokeColor = '#ebe9f1';
  var $textHeadingColor = '#5e5873';
  var $earningsStrokeColor2 = '#28c76f66';
  var $earningsStrokeColor3 = '#28c76f33';

  var $statisticsOrderChart = document.querySelector('#statistics-order-chart');
  var $statisticsProfitChart = document.querySelector('#statistics-profit-chart');
  var $earningsChart = document.querySelector('#earnings-chart');
  var $revenueReportChart = document.querySelector('#revenue-report-chart');
  var $budgetChart = document.querySelector('#budget-chart');
  var $browserStateChartPrimary = document.querySelector('#browser-state-chart-primary');
  var $browserStateChartWarning = document.querySelector('#browser-state-chart-warning');
  var $browserStateChartSecondary = document.querySelector('#browser-state-chart-secondary');
  var $browserStateChartInfo = document.querySelector('#browser-state-chart-info');
  var $browserStateChartDanger = document.querySelector('#browser-state-chart-danger');
  var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');

  var statisticsOrderChartOptions;
  var statisticsProfitChartOptions;
  var earningsChartOptions;
  var revenueReportChartOptions;
  var budgetChartOptions;
  var browserStatePrimaryChartOptions;
  var browserStateWarningChartOptions;
  var browserStateSecondaryChartOptions;
  var browserStateInfoChartOptions;
  var browserStateDangerChartOptions;
  var goalOverviewChartOptions;

  var statisticsOrderChart;
  var statisticsProfitChart;
  var earningsChart;
  var revenueReportChart;
  var budgetChart;
  var browserStatePrimaryChart;
  var browserStateDangerChart;
  var browserStateInfoChart;
  var browserStateSecondaryChart;
  var browserStateWarningChart;
  var goalOverviewChart;
  var isRtl = $('html').attr('data-textdirection') === 'rtl';

  // On load Toast
  // setTimeout(function () {
  //   toastr['success'](
  //     'You have successfully logged in. Now you can start to explore!',
  //     '👋 Welcome back!',
  //     {
  //       closeButton: true,
  //       tapToDismiss: false,
  //       rtl: isRtl
  //     }
  //   );
  // }, 2000);

  //------------ Statistics Bar Chart ------------
  //----------------------------------------------
  statisticsOrderChartOptions = {
    chart: {
      height: 70,
      type: 'bar',
      stacked: true,
      toolbar: {
        show: false
      }
    },
    grid: {
      show: false,
      padding: {
        left: 0,
        right: 0,
        top: -15,
        bottom: -15
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '20%',
        startingShape: 'rounded',
        colors: {
          backgroundBarColors: [$barColor, $barColor, $barColor, $barColor, $barColor],
          backgroundBarRadius: 5
        }
      }
    },
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    },
    colors: [window.colors.solid.warning],
    series: [
      {
        name: '2020',
        data: [45, 85, 65, 45, 65]
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      show: false
    },
    tooltip: {
      x: {
        show: false
      }
    }
  };

  //--------------- Earnings Chart ---------------
  //----------------------------------------------
  earningsChartOptions = {
    chart: {
      type: 'donut',
      height: 120,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    series: [53, 16, 31],
    legend: { show: false },
    comparedResult: [2, -3, 8],
    labels: ['App', 'Service', 'Product'],
    stroke: { width: 0 },
    colors: [$earningsStrokeColor2, $earningsStrokeColor3, window.colors.solid.success],
    grid: {
      padding: {
        right: -20,
        bottom: -8,
        left: -20
      }
    },
    plotOptions: {
      pie: {
        startAngle: -10,
        donut: {
          labels: {
            show: true,
            name: {
              offsetY: 15
            },
            value: {
              offsetY: -15,
              formatter: function (val) {
                return parseInt(val) + '%';
              }
            },
            total: {
              show: true,
              offsetY: 15,
              label: 'App',
              formatter: function (w) {
                return '53%';
              }
            }
          }
        }
      }
    },
    responsive: [
      {
        breakpoint: 1325,
        options: {
          chart: {
            height: 100
          }
        }
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 120
          }
        }
      },
      {
        breakpoint: 1045,
        options: {
          chart: {
            height: 100
          }
        }
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 120
          }
        }
      }
    ]
  };


  //------------ Browser State Charts ------------
  //----------------------------------------------

  // State Primary Chart
  browserStatePrimaryChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.primary],
    series: [54.4],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
});
