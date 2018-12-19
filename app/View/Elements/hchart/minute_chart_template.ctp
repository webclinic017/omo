<script>
    $(function () {
        $('#<?php echo $chartData["div"]; ?>').highcharts({
            chart: {
                zoomType: 'x',
                defaultSeriesType: 'spline',
                showAxes: true,
                shadow: false,
                borderWidth: 1,
                borderColor: "#4572A7",
                backgroundColor: "#FFFFFF",
                spacingLeft: 2,
                spacingRight: 2,
                height:<?php echo $chartData["height"]; ?>

            },
            title: {
                text: '<?php echo $chartData["title"]; ?>'
            },
            subtitle: {
                text: '<?php echo $chartData["subtitle"]; ?>'
            },
            xAxis: [{
                categories: [
                    //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'

                    <?php echo $this->Text->toList($chartData["xcat"],','); ?>

                ],
                tickInterval: 15,
                labels: {
                    enabled: true,
                    rotation: -90,
                    align: 'right'

                    //x:10,
                }
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Price',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Volume',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
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
                    align: 'left',
                    verticalAlign: 'top',
                    x: 5,
                    y: 15
                }
            },
            legend: {
                enabled: false

            },
            series: [{
                name: 'Volume',
                type: 'column',
                color: '#4572A7',
                yAxis: 1,
                data: [<?php echo $this->Text->toList($chartData["ydata"],','); ?>],
                tooltip: {
                    valueSuffix: ''
                }

            }, {
                name: 'Price',
                type: 'spline',
                color: '#89A54E',
                marker: {
                    radius: 1
                },
                data: [<?php echo $this->Text->toList($chartData["xdata"],','); ?>],
                tooltip: {
                    valueSuffix: ''
                }
            }]
        });
    });

</script>