<pre id="tsv" style="display:none">
    <?php //echo $getText; ?>
</pre>
<!--<div class="row">
    <div class="col-md-12" id="container">
    </div>
</div>
-->
<div class="row">
    <!--<div class="col-md-6" id="buydepth">
    </div>
    <div class="col-md-6" id="selldepth">
    </div>-->

    <div class="col-md-6">
        <?php echo $getText; ?>
    </div>
    <div class="col-md-6" >
        <div class="col-md-12" id="container">
        </div>

    </div>

</div>

<script>
   // window.setTimeout(function(){document.location.reload(true); },45000);
</script>

<script type="text/javascript">

    $(function () {


        // console.log(test)



        $("table[bgcolor='#E8FFFB']").attr("id", "buybox");
        //      $("table[bgcolor='#E8FFFB']").attr("class", "table table-condensed table-hover");

        $('td[bgcolor="#FFFFFF"] table').attr("id", "sellbox");



        var buyPrice = [];
        var buyVolume = [];
        var sellPrice = [];
        var sellVolume = [];
        var i=0;
        $('td[bgcolor="#CCCCCC"]').each(function (index, element) {


            var divtextWithHtml=$(this).html();
            var onlyText=$(divtextWithHtml).text();
            var floatVal=parseFloat(onlyText);

            if(i%2==0)
            {
                buyPrice.push(floatVal);

            }else
            {
                buyVolume.push(-1*floatVal);
            }
            i++;


        });

for( j=i/2;j<10;j++)
{

    buyPrice.push(0);
    buyVolume.push(0);
}

        //   alert(buyVolume.toSource());
        //  alert(buyPrice.toSource());


        var i=0;
        $('td[bgcolor="#B2B2B2"]').each(function (index, element) {

            var divtextWithHtml=$(this).html();
            var onlyText=$(divtextWithHtml).text();
            var floatVal=parseFloat(onlyText);
            if(i%2==0)
            {
                sellPrice.push(floatVal);

            }else
            {
                sellVolume.push(floatVal);
            }
            i++;

        });


        for(j=i/2;j<10;j++)
        {
            sellPrice.push(0);
            sellVolume.push(0);
        }

        var buyPrice=buyPrice.reverse();
        var buyVolume=buyVolume.reverse();
        var sellPrice=sellPrice.reverse();
        var sellVolume=sellVolume.reverse();


        var categories = sellPrice;

        $(document).ready(function () {
            $('#container').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: "Buyer Seller chart-<?php echo $code; ?>"
                },
                subtitle: {
                    text: ''
                },
                xAxis: [{
                    categories: buyPrice,
                    reversed: false,
                    labels: {
                        step: 1
                    }
                }, { // mirror axis on right side
                    opposite: true,
                    reversed: false,
                    categories: sellPrice,
                    linkedTo: 0,
                    labels: {
                        step: 1
                    }
                }],
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        formatter: function () {
                            return (Math.abs(this.value)) + '';
                        }
                    }//,
                //    min: -4000000,
                //    max: 4000000
                },

                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + ', Price ' + this.point.category + '</b><br/>' +
                            'Total order: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                    }
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

                series: [{
                    name: 'Buyer',
                    color: '#35AA47',
                    data: buyVolume/*[-1746181, -1884428, -2089758, -2222362, -2537431, -2507081, -2443179,
                        -2664537, -3556505, -3680231, -3143062, -2721122, -2229181, -2227768,
                        -2176300, -1329968, -836804, -354784, -90569, -28367, -3878]*/
                }, {
                    name: 'Seller',
                    color: '#F3565D',
                    data: sellVolume/*[1656154, 1787564, 1981671, 2108575, 2403438, 2366003, 2301402, 2519874,
                        3360596, 3493473, 3050775, 2759560, 2304444, 2426504, 2568938, 1785638,
                        1447162, 1005011, 330870, 130632, 21208]*/
                }]
            });
        });

    });

</script>