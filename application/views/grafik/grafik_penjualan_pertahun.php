<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>

</figure>


<script type="text/javascript">
	// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Penjualan Setiap Tahun'
    },
    subtitle: {
        text: 'Salwa Toko - Supplier Hasil Bumi dan Sembako'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: "Chrome",
                    y: 62.74,
                  
                },
                {
                    name: "Firefox",
                    y: 10.57,
                },
                {
                    name: "Internet Explorer",
                    y: 7.23,
                },
                {
                    name: "Safari",
                    y: 5.58,
                },
                {
                    name: "Edge",
                    y: 4.02,
                },
                {
                    name: "Opera",
                    y: 1.92,
                },
                {
                    name: "Other",
                    y: 7.62,
                }
            ]
        }
    ]
});
</script>