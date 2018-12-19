<script>
    $(function () {
        $('#<?php echo $chartData["div"]; ?>').highcharts({
            chart: {
                zoomType: 'x',
                defaultSeriesType: 'spline',
                showAxes: true,
                shadow: false,
                borderWidth: 1,
                borderColor: "#D5DAE0",
                backgroundColor: "#FFFFFF",
                spacingLeft: 2,
                spacingRight: 2,
                height:<?php echo $chartData["height"]; ?>

            },
            title: {
                text: '<?php echo $chartData["instrument_code"]; ?>'

            },
            subtitle: {
                text: '<?php echo $chartData["subtitle"]; ?>'
            },
            xAxis: [
                {
                    categories: [
                        //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'


                        <?php echo $this->Text->toList(array_slice($chartData["xcat"], -15, 15,true),','); ?>

                    ],
                    tickInterval: 1,
                    labels: {
                        enabled: true,
                        rotation: -90,
                        align: 'right'

                        //x:10,
                    }
                }
            ],
            yAxis: [
                { // Primary yAxis

                    title: {
                       /* text: 'Price',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }*/
                        text: null
                    }
                },
                { // Secondary yAxis
                    title: {
                        text: null
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }
            ],
            tooltip: {
                shared: true
            },
            credits: {
                enabled: true,
                href: "http://www.stockbangladesh.com",
                text: "stockbangladesh.com",
                style: {
                    color: '#4572A7'

                },
                position: {
                    align: 'right',
                    verticalAlign: 'bottom'
                  /*  x: 5,
                    y: 15*/
                }
            },
            legend: {
                enabled: false
                //layout: 'vertical',
             /*   align: 'left',
                verticalAlign: 'bottom'*/
               /* x: 120,
                verticalAlign: 'top',
                y: 100,*/
              /*  floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'*/
            },
            series: [
                {
                    name: 'Volume',
                    type: 'column',
                    color: '#8CC152',
                    yAxis: 1,
                    data: [<?php echo $this->Text->toList(array_slice($chartData["ydata"], -15, 15,true),','); ?>],
                    tooltip: {
                        valueSuffix: ''
                    }

                },
                {
                    name: 'Price',
                    type: 'spline',
                    color: '#F6BB42',
                    marker: {
                        radius: 1
                    },
                    data: [<?php echo $this->Text->toList(array_slice($chartData["xdata"], -15, 15,true),','); ?>],
                    tooltip: {
                        valueSuffix: ''
                    }
                }
            ]
        });
    });

</script>