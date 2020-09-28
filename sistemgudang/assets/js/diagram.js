    
// $(document).ready(function(){

//     $('#select-filter2').click(function() {
//         console.log(base_url + 'review/source_kehamilan_grafik');
//         // year = $('#year-choose').val();

//         // $.ajax({
//         //     url : "<?php echo site_url('review/source_kehamilan_grafik');?>",
//         //     data : "year=" + year, 
//         //     type : 'GET',
//         //     dataType : "json",
//         //     success : function(result) {
//         //         console.log(result);
//         //     }

//         // });
//     });



// });
    


//     // function Graph(id1, id2, data1, data2) {
//     //     Highcharts.chart(id1, {
//     //         chart: {
//     //             type: 'column',
//     //         },

//     //         title: {
//     //             text: 'Jumlah Kehamilan Baru Desa <?php echo desa_convert(id_desa());?> Tahun <?php echo date('Y');?>'
//     //         },

//     //         xAxis: {
//     //             categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
//     //         },

//     //         yAxis: {
//     //             allowDecimals: false,
//     //             min: 0,
//     //             title: {
//     //                 text: 'Jumlah Kehamilan'
//     //             }
//     //         },

//     //         tooltip: {
//     //             headerFormat: '<b>{point.key}</b><br>',
//     //             pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
//     //         },

//     //         plotOptions: {
//     //             column: {
//     //                 stacking: 'normal',
//     //                 depth: 40
//     //             }
//     //         },

//     //         series: [{
//     //             name: 'Resiko Rendah',
//     //             data: data1,
//     //             stack: 'kehamilan'
//     //         }, {
//     //             name: 'Resiko Tinggi',
//     //             data: data2,
//     //             stack: 'kehamilan'
//     //         }]
//     //     });


//     //     var total1 = data1.reduce(function(a, b) { return a + b; }, 0);
//     //     var total2 = data2.reduce(function(a, b) { return a + b; }, 0);


//     //     Highcharts.chart(id2, {
//     //         chart: {
//     //             plotBackgroundColor: null,
//     //             plotBorderWidth: null,
//     //             plotShadow: false,
//     //             type: 'pie'
//     //         },
//     //         title: {
//     //             text: 'Resiko'
//     //         },
//     //         tooltip: {
//     //             pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//     //         },
//     //         plotOptions: {
//     //             pie: {
//     //                 allowPointSelect: true,
//     //                 cursor: 'pointer',
//     //                 dataLabels: {
//     //                     enabled: true,
//     //                     format: '<b>{point.name}</b>: ({point.y}) {point.percentage:.1f} %',
//     //                     style: {
//     //                         color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//     //                     }
//     //                 }
//     //             }
//     //         },
//     //         series: [{
//     //             name: 'Resiko',
//     //             colorByPoint: true,
//     //             data: [

//     //             {
//     //                 name: 'Rendah',
//     //                 y: total1
//     //             }, {
//     //                 name: 'Tinggi',
//     //                 y: total2
//     //                 sliced: true,
//     //                 selected: true
//     //             }]
//     //         }]
//     //     });
//     // }