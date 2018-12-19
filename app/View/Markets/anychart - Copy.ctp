<html>
<head>
    <title>Basic Sample</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" language="javascript" src="http://localhost/omo/js/AnyChartStock.js?v=1.0.0r7416"></script>
    <!--<?php echo $this->Html->script('assets/scripts/AnyChartStock.js',array('inline' => false)); ?>-->

    <script type="text/javascript" language="javascript">
        // Creating new chart object.
        /*var chart = new AnyChartStock("<?php echo Router::url('/', true);?>assets/swf/AnyChartStock.swf?v=1.0.0r7416", "<?php echo Router::url('/', true);?>assets/swf/Preloader.swf?v=1.0.0r7416");*/
        var chart = new AnyChartStock("http://localhost/omo/swf/AnyChartStock.swf?v=1.0.0r7416", "http://localhost/omo/swf/Preloader.swf?v=1.0.0r7416");
        // Setting XML config file.
        chart.setXMLFile("http://localhost/omo/config.xml");
        // Writing the flash object into the page DOM.
        chart.write("chartContainer");
    </script>
</head>
<body>
<div id="chartContainer"><!-- Chart Container --></div>
</body>
</html>

