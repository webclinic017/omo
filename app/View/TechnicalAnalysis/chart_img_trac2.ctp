<!--<div class="row">
<div class="col-md-12 chart-meta">
    <h3> <?php echo $instrumentInfo['Instrument']['name']; ?> </h3>
    <ul class="list-inline">
        <li><i class="fa fa-calendar"></i> <?php echo $this->Time->nice($ohlcData['realtimeStamps'][$totalData-1]); ?></li>
        <li><i class="fa fa-sitemap"></i>Category : <?php echo $instrumentInfo['Instrument']['category']; ?></li>
        <li><i class="fa fa-tag"></i>Lot : <?php echo $instrumentInfo['Instrument']['market_lot']; ?></li>
        <li><i class="fa fa-tag"></i>Eps : <?php echo $instrumentInfo['Instrument']['market_lot']; ?></li>
        <li><i class="fa fa-tag"></i>PE : <?php echo $instrumentInfo['Instrument']['market_lot']; ?></li>
        <li><i class="fa fa-tag"></i>NAV : <?php echo $instrumentInfo['Instrument']['market_lot']; ?></li>


    </ul>
    <ul class="list-inline">
        <li><i class="fa fa-tag"></i> Close: <?php  echo $this->Number->format($ohlcData['close'][$totalData-1], array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
            )); ?></li>
        <li><i class="fa fa-tag"></i>Open: <?php  echo $this->Number->format($ohlcData['open'][$totalData-1], array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
            )); ?></li>
        <li><i class="fa fa-tag"></i>High: <?php  echo $this->Number->format($ohlcData['high'][$totalData-1], array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
            )); ?></li>
        <li><i class="fa fa-tag"></i>Low: <?php  echo $this->Number->format($ohlcData['low'][$totalData-1], array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
            )); ?></li>

    </ul>
</div>
</div>

<div class="row">

    <div class="col-sm-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p>TODAY VISITORS</p>
                <h1 class="bolded">12,254K</h1>
                <div class="progress no-rounded progress-xs">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    </div>&lt;!&ndash; /.progress-bar .progress-bar-success &ndash;&gt;
                </div>&lt;!&ndash; /.progress .no-rounded &ndash;&gt;
                <p><small>Better than yesterday ( 7,5% )</small></p>
            </div>&lt;!&ndash; /.tiles-inner &ndash;&gt;
        </div>&lt;!&ndash; /.the-box no-border &ndash;&gt;
    </div>&lt;!&ndash; /.col-sm-3 &ndash;&gt;
    <div class="col-sm-3">
        <div class="the-box no-border bg-primary tiles-information">
            <i class="fa fa-shopping-cart icon-bg"></i>
            <div class="tiles-inner text-center">
                <p>TODAY SALES</p>
                <h1 class="bolded">521</h1>
                <div class="progress no-rounded progress-xs">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    </div>&lt;!&ndash; /.progress-bar .progress-bar-primary &ndash;&gt;
                </div>&lt;!&ndash; /.progress .no-rounded &ndash;&gt;
                <p><small>Better than yesterday ( 10,5% )</small></p>
            </div>&lt;!&ndash; /.tiles-inner &ndash;&gt;
        </div>&lt;!&ndash; /.the-box no-border &ndash;&gt;
    </div>&lt;!&ndash; /.col-sm-3 &ndash;&gt;
    <div class="col-sm-3">
        <div class="the-box no-border bg-danger tiles-information">
            <i class="fa fa-comments icon-bg"></i>
            <div class="tiles-inner text-center">
                <p>TODAY FEEDBACK</p>
                <h1 class="bolded">124</h1>
                <div class="progress no-rounded progress-xs">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    </div>&lt;!&ndash; /.progress-bar .progress-bar-danger &ndash;&gt;
                </div>&lt;!&ndash; /.progress .no-rounded &ndash;&gt;
                <p><small>Less than yesterday ( <span class="text-danger">-7,5%</span> )</small></p>
            </div>&lt;!&ndash; /.tiles-inner &ndash;&gt;
        </div>&lt;!&ndash; /.the-box no-border &ndash;&gt;
    </div>&lt;!&ndash; /.col-sm-3 &ndash;&gt;
    <div class="col-sm-3">
        <div class="the-box no-border bg-warning tiles-information">
            <i class="fa fa-money icon-bg"></i>
            <div class="tiles-inner text-center">
                <p>TODAY EARNINGS</p>
                <h1 class="bolded">10,241</h1>
                <div class="progress no-rounded progress-xs">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    </div>&lt;!&ndash; /.progress-bar .progress-bar-warning &ndash;&gt;
                </div>&lt;!&ndash; /.progress .no-rounded &ndash;&gt;
                <p><small>Better than yesterday ( 2,5% )</small></p>
            </div>&lt;!&ndash; /.tiles-inner &ndash;&gt;
        </div>&lt;!&ndash; /.the-box no-border &ndash;&gt;
    </div>&lt;!&ndash; /.col-sm-3 &ndash;&gt;

</div>-->
<div class="row">
    <div class="col-md-12">
        <?php
echo $viewer->renderHTML();
        ?>

    </div>
</div>





<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

//$this->start('script_at_page_end');
?>

<script type="text/javascript">

//
// Use the window load event to set up the MouseMovePlotArea event handler
//


var viewer = JsChartViewer.get('<?php echo $viewer->getId()?>');

// Draw track cursor when mouse is moving over plotarea
viewer.attachHandler("MouseMovePlotArea", function(e) {
    traceFinance(viewer, viewer.getPlotAreaMouseX());
    //  crossHairAxisLabel(viewer, viewer.getPlotAreaMouseX(), viewer.getPlotAreaMouseY());
    viewer.setAutoHide("all", "MouseOutPlotArea");
});

// Initialize the track line with legend to show the latest data point
if (viewer.getChart())
    traceFinance(viewer, viewer.getChart().getPlotArea().getRightX());


/* JsChartViewer.addEventListener(window, 'load', function() {
 var viewer = JsChartViewer.get('<?php echo $viewer->getId()?>');

 // Draw track cursor when mouse is moving over plotarea. Hide it when mouse leaves plot area.
 viewer.attachHandler("MouseMovePlotArea", function(e) {
 crossHairAxisLabel(viewer, viewer.getPlotAreaMouseX(), viewer.getPlotAreaMouseY());
 viewer.setAutoHide("all", "MouseOutPlotArea");
 });
 });*/


//
// Draw finance chart track line with legend
//
function traceFinance(viewer, mouseX)
{
    // Remove all previously drawn tracking object
    viewer.hideObj("all");

    // It is possible for a FinanceChart to be empty, so we need to check for it.
    if (!viewer.getChart())
        return;

    // Get the data x-value that is nearest to the mouse
    var xValue = viewer.getChart().getNearestXValue(mouseX);

    // Iterate the XY charts (main price chart and indicator charts) in the FinanceChart
    var c = null;
    for (var i = 0; i < viewer.getChartCount(); ++i)
    {
        c = viewer.getChart(i);

        // Variables to hold the legend entries
        var ohlcLegend = "";
        var legendEntries = [];

        // Iterate through all layers to build the legend array
        for (var j = 0; j < c.getLayerCount(); ++j)
        {
            var layer = c.getLayerByZ(j);
            var xIndex = layer.getXIndexOf(xValue);
            var dataSetCount = layer.getDataSetCount();

            // In a FinanceChart, only layers showing OHLC data can have 4 data sets
            if (dataSetCount == 4)
            {
                var highValue = layer.getDataSet(0).getValue(xIndex);
                var lowValue = layer.getDataSet(1).getValue(xIndex);
                var openValue = layer.getDataSet(2).getValue(xIndex);
                var closeValue = layer.getDataSet(3).getValue(xIndex);

                if (closeValue == null)
                    continue;

                // Build the OHLC legend
                ohlcLegend =
                        "Open: " + openValue.toPrecision(4) + ", High: " + highValue.toPrecision(4) +
                                ", Low: " + lowValue.toPrecision(4) + ", Close: " + closeValue.toPrecision(4);

                // We also draw an upward or downward triangle for up and down days and the % change
                var lastCloseValue = layer.getDataSet(3).getValue(xIndex - 1);
                if (lastCloseValue != null)
                {
                    var change = closeValue - lastCloseValue;
                    var percent = change * 100 / closeValue;
                    if (change >= 0)
                        ohlcLegend += "&nbsp;&nbsp;<span style='color:#008800;'>&#9650; ";
                    else
                        ohlcLegend += "&nbsp;&nbsp;<span style='color:#CC0000;'>&#9660; ";
                    ohlcLegend += change.toPrecision(4) + " (" + percent.toFixed(2) + "%)</span>";
                }

                // Add a spacer box, and make sure the line does not wrap within the legend entry
                ohlcLegend = "<nobr>" + ohlcLegend + viewer.htmlRect(20, 0) + "</nobr> ";
            }
            else
            {
                // Iterate through all the data sets in the layer
                for (var k = 0; k < dataSetCount; ++k)
                {
                    var dataSet = layer.getDataSetByZ(k);
                    var name = dataSet.getDataName();
                    var value = dataSet.getValue(xIndex);
                    if ((!name) || (value == null))
                        continue;

                    // In a FinanceChart, the data set name consists of the indicator name and its latest value. It is
                    // like "Vol: 123M" or "RSI (14): 55.34". As we are generating the values dynamically, we need to
                    // extract the indictor name out, and also the volume unit (if any).

                    // The unit character, if any, is the last character and must not be a digit.
                    var unitChar = name.charAt(name.length - 1);
                    if ((unitChar >= '0') && (unitChar <= '9'))
                        unitChar = '';

                    // The indicator name is the part of the name up to the colon character.
                    var delimiterPosition = name.indexOf(':');
                    if (delimiterPosition != -1)
                        name = name.substring(0, delimiterPosition);

                    // In a FinanceChart, if there are two data sets, it must be representing a range.
                    if (dataSetCount == 2)
                    {
                        // We show both values in the range
                        var value2 = layer.getDataSetByZ(1 - k).getValue(xIndex);
                        name = name + ": " + Math.min(value, value2).toPrecision(4) + " - "
                                + Math.max(value, value2).toPrecision(4);
                    }
                    else
                    {
                        // In a FinanceChart, only the layer for volume bars has 3 data sets for up/down/flat days
                        if (dataSetCount == 3)
                        {
                            // The actual volume is the sum of the 3 data sets.
                            value = layer.getDataSet(0).getValue(xIndex) + layer.getDataSet(1).getValue(xIndex) +
                                    layer.getDataSet(2).getValue(xIndex);
                        }

                        // Create the legend entry
                        name = name + ": " + value.toPrecision(4) + unitChar;
                    }

                    // Build the legend entry, consist of a colored square box and the name (with the data value in it).
                    legendEntries.push("<nobr>" + viewer.htmlRect(5, 5, dataSet.getDataColor(),
                            "solid 1px black") + " " + name + viewer.htmlRect(20, 0) + "</nobr>");
                }
            }
        }

        // The legend is formed by concatenating the legend entries.
        var legend = legendEntries.reverse().join(" ");

        // Add the date and the ohlcLegend (if any) at the beginning of the legend
        legend = "<nobr>[" + c.xAxis().getFormattedLabel(xValue, "mmm dd, yyyy") + "]" + viewer.htmlRect(20, 0) +
                "</nobr> " + ohlcLegend + legend;

        // Get the plot area position relative to the entire FinanceChart
        var plotArea = c.getPlotArea();
        var plotAreaLeftX = plotArea.getLeftX() + c.getAbsOffsetX();
        var plotAreaTopY = plotArea.getTopY() + c.getAbsOffsetY();

        // Draw a vertical track line at the x-position
        viewer.drawVLine("trackLine" + i, c.getXCoor(xValue) + c.getAbsOffsetX(), plotAreaTopY,
                plotAreaTopY + plotArea.getHeight(), "black 1px dotted");

        // Display the legend on the top of the plot area
        viewer.showTextBox("legend" + i, plotAreaLeftX + 1, plotAreaTopY + 1, JsChartViewer.TopLeft, legend,
                "padding-left:5px;width:" + (plotArea.getWidth() - 1) + "px;font:11px Arial;");
    }
}

function crossHairAxisLabel(viewer, x, y)
{
    // Show cross hair
    viewer.showCrossHair(x, y);

    // The chart, its plot area and axes
    var c = viewer.getChart();
    var xAxis = c.xAxis();
    var yAxis = c.yAxis();

    // The axis label style
    var labelStyle = "padding:2px 4px; font: bold 8pt arial; border:1px solid black; background-color:#DDDDFF";

    // Draw x-axis label
    var yPos = xAxis.getY() + ((xAxis.getAlignment() == JsChartViewer.Top) ? -2 : 3);
    var alignment = (xAxis.getAlignment() == JsChartViewer.Top) ? JsChartViewer.Bottom : JsChartViewer.Top;
    viewer.showTextBox("xAxisLabel", x, yPos, alignment, c.getXValue(x).toPrecision(4), labelStyle);

    // Draw y-axis label
    var xPos = yAxis.getX() + ((yAxis.getAlignment() == JsChartViewer.Left) ? -2 : 3);
    var alignment = (yAxis.getAlignment() == JsChartViewer.Left) ? JsChartViewer.Right : JsChartViewer.Left;
    viewer.showTextBox("yAxisLabel", xPos, y, alignment, c.getYValue(y, yAxis).toPrecision(4), labelStyle);
}

//
// Show custom tooltip for data points
//
function showDataPointToolTip(x, y)
{
    var viewer = JsChartViewer.get('<?php echo $viewer->getId()?>');
    viewer.showTextBox("toolTipBox", viewer.getChartMouseX() + 20, viewer.getChartMouseY() + 20, JsChartViewer.TopLeft,
            "<table><tr><td>Concentration</td><td>: " + x.toPrecision(4) +
                    " g/liter</td></tr><tr><td>Conductivity</td><td>: " + y.toPrecision(4) + " W/K</td></tr></table>",
            "padding:0px; font:bold 8pt arial; border:1px solid black; background-color:#DDDDFF");
}

//
// Show custom tooltip for the trend line
//
function showTrendLineToolTip(slope, intercept)
{
    var viewer = JsChartViewer.get('<?php echo $viewer->getId()?>');
    viewer.showTextBox("toolTipBox", viewer.getChartMouseX() + 20, viewer.getChartMouseY() + 20, JsChartViewer.TopLeft,
            "Trend Line: y = " + slope.toFixed(4) + " x + " + intercept.toFixed(4),
            "padding:2px 4px; font:bold 8pt arial; border:1px solid black; background-color:#DDDDFF");
}

//
// Hide custom tooltip
//
function hideToolTip()
{
    var viewer = JsChartViewer.get('<?php echo $viewer->getId()?>');
    viewer.hideObj("toolTipBox");
}


</script>


<?php //$this->end(); ?>




