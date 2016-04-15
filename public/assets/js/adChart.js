function yyyymmdd(dateIn) {
   var a = dateIn;
   var b = a.getFullYear();
   var c = a.getMonth();
   (++c < 10)? c = "0" + c : c;
   var d = a.getDate();
   (d < 10)? d = "0" + d : d;
   var final = b + "-" + c + "-" + d; 
   return final;
}
var arrAd = $('.ad_stats');
var arrAdUnique = $('.ad_unique_stats');
var adDays = [];

for(var i = 0; i < arrAd.length; i++){
    adDays.push(arrAd[i].value);
}

var uniqueAdDays = [];
for(var i = 0; i < arrAdUnique.length; i++){
    uniqueAdDays.push(arrAdUnique[i].value);
}

var uniqueAdDaysTotal = [];
$.each(adDays, function(i, el){
    if($.inArray(el, uniqueAdDaysTotal) === -1) uniqueAdDaysTotal.push(el);
});

var uniqueAdDaysUnique = [];
$.each(uniqueAdDays, function(i, el){
    if($.inArray(el, uniqueAdDaysUnique) === -1) uniqueAdDaysUnique.push(el);
});

var totalAdClicks = [];
var totalAdCount = 0;
for(var j = 0; j < uniqueAdDaysTotal.length; j++){
    for(var k = 0; k < adDays.length; k++){
        if(uniqueAdDaysTotal[j] == adDays[k]){
            totalAdCount++;
        }
    }
    totalAdClicks.push(totalAdCount);
    totalAdCount = 0;
}

var uniqueAdClicks = [];
var uniqueAdCount = 0;
for(var j = 0; j < uniqueAdDaysTotal.length; j++){
    for(var k = 0; k < uniqueCampaignsDays.length; k++){
        if(uniqueAdDaysTotal[j] == uniqueAdDays[k]){
            uniqueAdCount++;
        }
    }
    uniqueAdClicks.push(uniqueAdCount);
    uniqueAdCount = 0;
}
var ad_date = ['x1'];
var ad_data = ['total'];
var ad_dateUnique = ['x2'];
var ad_dataUnique = ['unique'];

ad_data = ad_data.concat( totalAdClicks );
ad_date = ad_date.concat( uniqueAdDaysTotal );
ad_dataUnique = ad_dataUnique.concat( uniqueAdClicks );
ad_dateUnique = ad_dateUnique.concat( uniqueAdDaysTotal );
// var date = ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'];
// var data = ['clicks', 30, 200, 100, 400, 150, 250];
$('input[name="adDaterange"]').daterangepicker(
{
    locale: {
      format: 'Y-MM-DD'
    },
    startDate: moment().add('months', -1),
    endDate: moment()
}, 
function(start, end, label) {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var first = start._d;
    var second = end._d;
    var diffDays = Math.round(Math.abs((first.getTime() - second.getTime())/(oneDay)));

    days = [];
    for(var i = 0; i < diffDays; i++){
        
        var d = new Date(first.setDate(first.getDate()+i));
        d = yyyymmdd(d);

        days.push(d);
        first.setDate(start._d.getDate()-i);
    }

    var new_ad_date = [];
    var new_ad_data = [];
    var ad_count = 0;
    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_ad_date.push(el);
                new_ad_data.push(ad_data[i]);
                ad_count+= ad_data[i];
            }
        }
    })

    var new_ad_date_unique = [];
    var new_ad_data_unique = [];
    var ad_count_unique = 0;

    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(ad_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_ad_date_unique.push(el_un);
                        new_ad_data_unique.push(ad_dataUnique[j]);                        
                        ad_count_unique+= ad_dataUnique[j];
                    }
                })                        
            }
        }
    })

    $('.total_ad_clicks').html(ad_count);
    $('.unique_ad_clicks').html(ad_count_unique);
    
    var filtered_ad_date = ['x1'];
    var filtered_ad_data = ['total'];
    new_ad_date = filtered_ad_date.concat( new_ad_date );
    new_ad_data = filtered_ad_data.concat( new_ad_data );
    var filtered_ad_date_unique = ['x2'];
    var filtered_ad_data_unique = ['unique'];    
    new_ad_data_unique = filtered_ad_data_unique.concat( new_ad_data_unique );
    new_ad_date_unique = filtered_ad_date_unique.concat( new_ad_date_unique );
        

    var chart = c3.generate({
        bindto: '#ad_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_ad_date,
                new_ad_data,
                new_ad_date_unique,
                new_ad_data_unique,
            ],        
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%Y-%m-%d'
                }
            }
        }
    });
});


var chart = c3.generate({
    bindto: '#ad_chart',
    data: {        
        xs: {
            'total': 'x1',
            'unique': 'x2',
        },
        columns: [
            ad_date,
            ad_data,
            ad_dateUnique,
            ad_dataUnique,
        ],        
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%Y-%m-%d'
            }
        }
    }
});

$('.ad_month').on('click', function() {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var first = new Date();
    var second = new Date();
    first.setMonth(first.getMonth() - 1);
    second.setTime(second.getTime() + 24 * 60 * 60 * 1000);
    var diffDays = Math.round(Math.abs((first.getTime() - second.getTime())/(oneDay)));

    days = [];
    for(var i = 0; i < diffDays; i++){
        
        var d = new Date(first.setDate(first.getDate()+i));
        d = yyyymmdd(d);

        days.push(d);
        first.setDate(first.getDate()-i);
    }

    var new_ad_date = [];
    var new_ad_data = [];
    var ad_count = 0;
    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_ad_date.push(el);
                new_ad_data.push(ad_data[i]);
                ad_count+= ad_data[i];
            }
        }
    })

    var new_ad_date_unique = [];
    var new_ad_data_unique = [];
    var ad_count_unique = 0;

    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(ad_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_ad_date_unique.push(el_un);
                        new_ad_data_unique.push(ad_dataUnique[j]);                        
                        ad_count_unique+= ad_dataUnique[j];
                    }
                })                        
            }
        }
    })

    $('.total_ad_clicks').html(ad_count);
    $('.unique_ad_clicks').html(ad_count_unique);
    
    var filtered_ad_date = ['x1'];
    var filtered_ad_data = ['total'];
    new_ad_date = filtered_ad_date.concat( new_ad_date );
    new_ad_data = filtered_ad_data.concat( new_ad_data );
    var filtered_ad_date_unique = ['x2'];
    var filtered_ad_data_unique = ['unique'];    
    new_ad_data_unique = filtered_ad_data_unique.concat( new_ad_data_unique );
    new_ad_date_unique = filtered_ad_date_unique.concat( new_ad_date_unique );

    var chart = c3.generate({
        bindto: '#ad_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_ad_date,
                new_ad_data,
                new_ad_date_unique,
                new_ad_data_unique,
            ],        
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%Y-%m-%d'
                }
            }
        }
    });
});

$('.ad_week').on('click', function() {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var first = new Date();
    var second = new Date();
    first.setTime(first.getTime() - 7 * 24 * 60 * 60 * 1000);
    second.setTime(second.getTime() + 24 * 60 * 60 * 1000);
    var diffDays = Math.round(Math.abs((first.getTime() - second.getTime())/(oneDay)));

    days = [];
    for(var i = 0; i < diffDays; i++){
        
        var d = new Date(first.setDate(first.getDate()+i));
        d = yyyymmdd(d);

        days.push(d);
        first.setDate(first.getDate()-i);
    }

    var new_ad_date = [];
    var new_ad_data = [];
    var ad_count = 0;
    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_ad_date.push(el);
                new_ad_data.push(ad_data[i]);
                ad_count+= ad_data[i];
            }
        }
    })

    var new_ad_date_unique = [];
    var new_ad_data_unique = [];
    var ad_count_unique = 0;

    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(ad_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_ad_date_unique.push(el_un);
                        new_ad_data_unique.push(ad_dataUnique[j]);                        
                        ad_count_unique+= ad_dataUnique[j];
                    }
                })                        
            }
        }
    })

    $('.total_ad_clicks').html(ad_count);
    $('.unique_ad_clicks').html(ad_count_unique);
    
    var filtered_ad_date = ['x1'];
    var filtered_ad_data = ['total'];
    new_ad_date = filtered_ad_date.concat( new_ad_date );
    new_ad_data = filtered_ad_data.concat( new_ad_data );
    var filtered_ad_date_unique = ['x2'];
    var filtered_ad_data_unique = ['unique'];    
    new_ad_data_unique = filtered_ad_data_unique.concat( new_ad_data_unique );
    new_ad_date_unique = filtered_ad_date_unique.concat( new_ad_date_unique );
    
    var chart = c3.generate({
        bindto: '#ad_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_ad_date,
                new_ad_data,
                new_ad_date_unique,
                new_ad_data_unique,
            ],        
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%Y-%m-%d'
                }
            }
        }
    });
});

$('.ad_today').on('click', function() {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var first = new Date();
    var second = new Date();
    // first.setTime(first.getTime() - 24 * 60 * 60 * 1000);
    second.setTime(second.getTime() + 24 * 60 * 60 * 1000);
    var diffDays = Math.round(Math.abs((first.getTime() - second.getTime())/(oneDay)));

    days = [];
    for(var i = 0; i < diffDays; i++){
        
        var d = new Date(first.setDate(first.getDate()+i));
        d = yyyymmdd(d);

        days.push(d);
        first.setDate(first.getDate()-i);
    }

    var new_ad_date = [];
    var new_ad_data = [];
    var ad_count = 0;
    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_ad_date.push(el);
                new_ad_data.push(ad_data[i]);
                ad_count+= ad_data[i];
            }
        }
    })
    
    var new_ad_date_unique = [];
    var new_ad_data_unique = [];
    var ad_count_unique = 0;

    $.each(ad_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(ad_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_ad_date_unique.push(el_un);
                        new_ad_data_unique.push(ad_dataUnique[j]);                        
                        ad_count_unique+= ad_dataUnique[j];
                    }
                })                        
            }
        }
    })

    $('.total_ad_clicks').html(ad_count);
    $('.unique_ad_clicks').html(ad_count_unique);
    
    var filtered_ad_date = ['x1'];
    var filtered_ad_data = ['total'];
    new_ad_date = filtered_ad_date.concat( new_ad_date );
    new_ad_data = filtered_ad_data.concat( new_ad_data );
    var filtered_ad_date_unique = ['x2'];
    var filtered_ad_data_unique = ['unique'];    
    new_ad_data_unique = filtered_ad_data_unique.concat( new_ad_data_unique );
    new_ad_date_unique = filtered_ad_date_unique.concat( new_ad_date_unique );    

    var chart = c3.generate({
        bindto: '#ad_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_ad_date,
                new_ad_data,
                new_ad_date_unique,
                new_ad_data_unique,
            ],        
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%Y-%m-%d'
                }
            }
        }
    });
});


