<h3 class="mb-4">Data Indodax</h3>

<div id="myVizzu" style="width:800px; height:480px;"></div>

<!-- Container untuk Diagram Lingkaran -->
<div id="vizzuRadial" style="width:800px; height:480px;"></div>


<!-- <script type="module">
    
</script> -->
<script type="module">
    import Vizzu from 'https://cdn.jsdelivr.net/npm/vizzu@0.4.3/dist/vizzu.min.js';
    (async () => {
        let {
            data: {
                tickers: crypto
            }
        } = await axios.get("https://indodax.com/api/tickers")
        // console.log(crypto)

        // Data berjenis objek, jadikan array terlebih dahulu
        let cryptoList = []
        for (const key in crypto) {
            // console.log(key, 'key gan')
            if (Object.hasOwnProperty.call(crypto, key)) {
                const element = crypto[key];
                cryptoList = [...cryptoList, {
                    jenis: key,
                    ...element
                }]
            }
        }
        // cryptoList = cryptoList.slice(0, 100)
        console.log(cryptoList, cryptoList.length)

        let lastIsLow = cryptoList.filter(el => el.last == el.low) // Data terakhir sedang drop
        let lastIsHigh = cryptoList.filter(el => el.last == el.high) // Data terakhir sedang naik

        let filterPercentage = (el, inc = 1) => {
            let selisihRange = el.high - el.low
            selisihRange = Math.round(selisihRange * Math.pow(10, 10)) / Math.pow(10, 10) // Untuk pembulatan, agar menghilangkan desimal yang terlalu panjang
            let incPer10 = Math.round((selisihRange / 10) * Math.pow(10, 10)) / Math.pow(10, 10) // Untuk pembulatan, agar menghilangkan desimal yang terlalu panjang
            let kriteria = parseFloat(el.low) + (incPer10 * inc)
            return parseFloat(el.last) > parseFloat(kriteria)
        }
        let tenAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 1)
        })
        let twentyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 2)
        })
        let thirtyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 3)
        })
        let fiftyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 5)
        })
        let sixtyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 6)
        })
        let seventyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 7)
        })
        let eightyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 8)
        })
        let ninetyAboveLow = cryptoList.filter(el => {
            return filterPercentage(el, 9)
        })
        // ninetyAboveLow.map(el => {
        //     let selisihRange = el.high - el.low
        //     selisihRange = Math.round(selisihRange * Math.pow(10, 10)) / Math.pow(10, 10) // Untuk pembulatan, agar menghilangkan desimal yang terlalu panjang
        //     let incPer10 = Math.round((selisihRange / 10) * Math.pow(10, 10)) / Math.pow(10, 10) // Untuk pembulatan, agar menghilangkan desimal yang terlalu panjang
        //     let kriteria = el.low + (incPer10 * 9)
        //     console.log({
        //         ...el,
        //         // jenis: 'ninety percent',
        //         incPer10,
        //         diff: selisihRange,
        //         kriteria_10: parseFloat(el.low) + parseFloat(incPer10*1),
        //         kriteria_20: parseFloat(el.low) + parseFloat(incPer10*2),
        //         kriteria_30: parseFloat(el.low) + parseFloat(incPer10*3),
        //         kriteria_40: parseFloat(el.low) + parseFloat(incPer10*4),
        //         kriteria_50: parseFloat(el.low) + parseFloat(incPer10*5),
        //         kriteria_60: parseFloat(el.low) + parseFloat(incPer10*6),
        //         kriteria_70: parseFloat(el.low) + parseFloat(incPer10*7),
        //         kriteria_80: parseFloat(el.low) + parseFloat(incPer10*8),
        //         kriteria_90: parseFloat(el.low) + parseFloat(incPer10*9),
        //         masuk_kriteria_10: parseFloat(el.last) > parseFloat(el.low + incPer10*1),
        //         masuk_kriteria_20: parseFloat(el.last) > parseFloat(el.low + incPer10*2),
        //         masuk_kriteria_30: parseFloat(el.last) > parseFloat(el.low + incPer10*3),
        //         masuk_kriteria_40: parseFloat(el.last) > parseFloat(el.low + incPer10*4),
        //         masuk_kriteria_50: parseFloat(el.last) > parseFloat(el.low + incPer10*5),
        //         masuk_kriteria_60: parseFloat(el.last) > parseFloat(el.low + incPer10*6),
        //         masuk_kriteria_70: parseFloat(el.last) > parseFloat(el.low + incPer10*7),
        //         masuk_kriteria_80: parseFloat(el.last) > parseFloat(el.low + incPer10*8),
        //         masuk_kriteria_90: parseFloat(el.last) > parseFloat(el.low + incPer10*9),
        //         last: parseFloat(el.last)
        //     })
        // })

        // console.log({
        //     diatas10: tenAboveLow.map(el => el.jenis),
        //     diatas90: ninetyAboveLow.map(el => el.jenis)
        // })

        // Data By Series
        let dataSample = {
            series: [{
                    name: 'Category',
                    values: ['Last=Low', 'Last=High', 'Diatas 10%', 'Diatas 20%', 'Diatas 30%', 'Diatas 50%', 'Diatas 60%', 'Diatas 70%', 'Diatas 80%', 'Diatas 90%']
                },
                {
                    name: 'Value',
                    values: [
                        lastIsLow.length,
                        lastIsHigh.length,
                        tenAboveLow.length,
                        twentyAboveLow.length,
                        thirtyAboveLow.length,
                        fiftyAboveLow.length,
                        sixtyAboveLow.length,
                        seventyAboveLow.length,
                        eightyAboveLow.length,
                        ninetyAboveLow.length
                    ]
                },
                {
                    name: 'Baz',
                    values: [5, 3, 2]
                }
            ]
        };

        // Inisialisasi chart Vizzu
        let chart = new Vizzu('myVizzu', {
            data: dataSample
        })
        chart.animate({
            x: 'Category',
            y: 'Value',
            geometry: 'line',
        });
        chart.animate({
            config: {
                channels: {
                    label: {
                        attach: ['Value']
                    }
                },
            }
        })


        // Diagram Lingkaran
        let radialChart = new Vizzu('vizzuRadial');
        let radialChartData = {
            series: [{
                name: "Category",
                type: "dimension",
                values: ['Last=Low', 'Last=High', 'Diatas 10%', 'Diatas 20%', 'Diatas 30%', 'Diatas 50%', 'Diatas 60%', 'Diatas 70%', 'Diatas 80%', 'Diatas 90%']
            }, {
                name: "Value",
                type: "measure",
                values: [
                    lastIsLow.length,
                    lastIsHigh.length,
                    tenAboveLow.length,
                    twentyAboveLow.length,
                    thirtyAboveLow.length,
                    fiftyAboveLow.length,
                    sixtyAboveLow.length,
                    seventyAboveLow.length,
                    eightyAboveLow.length,
                    ninetyAboveLow.length
                ]
            }]
        }

        radialChart.animate({
            data: radialChartData,
            config: {
                channels: {
                    x: {
                        set: ['Value']
                    },
                    y: {
                        set: ['Category'],
                        /* Setting the radius of the empty circle
                        in the centre. */
                        range: {
                            min: '-30%'
                        }
                    },
                    color: {
                        set: ['Category']
                    },
                    label: {
                        set: ['Value']
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