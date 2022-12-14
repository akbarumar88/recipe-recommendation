<h3 class="mb-4">Contoh Diagram Batang & Diagram Lingkaran</h3>

<div id="myVizzu" style="width:800px; height:480px;"></div>

<!-- Container untuk Diagram Lingkaran -->
<div id="vizzuRadial" style="width:800px; height:480px;"></div>


<!-- <script type="module">
    
</script> -->
<script type="module">
    import Vizzu from 'https://cdn.jsdelivr.net/npm/vizzu@0.4.3/dist/vizzu.min.js';
    (async () => {
        var dataSample = <?= json_encode($dataSample) ?>;
        // console.log(dataSample)

        // Data By Series
        let dataConfig = {
            series: [{
                    name: 'Genres',
                    values: dataSample.map((el) => el['Genres'])
                },
                {
                    name: 'Types',
                    values: dataSample.map((el) => el['Types'])
                },
                {
                    name: 'Popularity',
                    values: dataSample.map((el) => el['Popularity'])
                }
            ]
        };
        // console.log(dataConfig)

        // Inisialisasi chart Vizzu
        let chart = new Vizzu('myVizzu', {
            data: dataConfig
        })
        chart.animate({
            x: 'Genres',
            y: 'Popularity',
            geometry: 'line',
        });
        chart.animate({
            config: {
                channels: {
                    label: {
                        attach: ['Popularity']
                    }
                },
            }
        })


        // Diagram Lingkaran
        let radialChart = new Vizzu('vizzuRadial');
        let radialChartData = {
            series: [{
                    name: 'Genres',
                    values: dataSample.map((el) => el['Genres'])
                },
                {
                    name: 'Types',
                    values: dataSample.map((el) => el['Types'])
                },
                {
                    name: 'Popularity',
                    values: dataSample.map((el) => el['Popularity'])
                }
            ]
        }

        radialChart.animate({
            data: radialChartData,
            config: {
                channels: {
                    x: {
                        set: ['Popularity']
                    },
                    y: {
                        set: ['Genres'],
                        /* Setting the radius of the empty circle
                        in the centre. */
                        range: {
                            min: '-30%'
                        }
                    },
                    color: {
                        set: ['Genres']
                    },
                    label: {
                        set: ['Popularity']
                    }
                },
                title: 'Radial Bar Chart',
                coordSystem: 'cartesian'
            },
            /* All axes and axis labels are unnecessary 
            on these types of charts, except for the labels 
            of the y-axis. */
            style: {
                plot: {
                    yAxis: {
                        color: '#ffffff00',
                        label: {
                            paddingRight: 20
                        }
                    },
                    xAxis: {
                        title: {
                            color: '#ffffff00'
                        },
                        label: {
                            color: '#ffffff00'
                        },
                        interlacing: {
                            color: '#ffffff00'
                        }
                    }
                }
            }
        });
        let i = 0
        setInterval(() => {
            let geometryChart1
            let coordSystemChart2
            if (i % 2 == 0) {
                geometryChart1 = 'rectangle'
                coordSystemChart2 = "polar"
            } else {
                geometryChart1 = 'line'
                coordSystemChart2 = "cartesian"
            }
            // Animasikan chart 1 (Batang)
            chart.animate({
                geometry: geometryChart1,
            });
            // Animasikan chart 2 (Lingkaran / Kartesius)
            radialChart.animate({
                config: {
                    coordSystem: coordSystemChart2
                }
            })
            i++
        }, 5000)

        // chart.initializing.then(
        //     chart => chart.animate({
        //         dataBySeries
        //     })
        // )
    })()
</script>