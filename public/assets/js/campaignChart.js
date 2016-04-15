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
var arrCampaignUnique = $('.campaign_unique_stats');
var arrCampaign = $('.campaign_stats');
var days = [];
for(var i = 0; i < arrCampaign.length; i++){
    days.push(arrCampaign[i].value);
}
var uniqueCampaignsDays = [];
for(var i = 0; i < arrCampaignUnique.length; i++){
    uniqueCampaignsDays.push(arrCampaignUnique[i].value);
}
var uniqueDaysTotal = [];
$.each(days, function(i, el){
    if($.inArray(el, uniqueDaysTotal) === -1) uniqueDaysTotal.push(el);
});
var uniqueDaysUnique = [];
$.each(uniqueCampaignsDays, function(i, el){
    if($.inArray(el, uniqueDaysUnique) === -1) uniqueDaysUnique.push(el);
});

var totalCampaignClicks = [];
var totalCampaignCount = 0;
for(var j = 0; j < uniqueDaysTotal.length; j++){
    for(var k = 0; k < days.length; k++){
        if(uniqueDaysTotal[j] == days[k]){
            totalCampaignCount++;
        }
    }
    totalCampaignClicks.push(totalCampaignCount);
    totalCampaignCount = 0;
}
var uniqueCampaignClicks = [];
var uniqueCampaignCount = 0;
for(var j = 0; j < uniqueDaysTotal.length; j++){
    for(var k = 0; k < uniqueCampaignsDays.length; k++){
        if(uniqueDaysTotal[j] == uniqueCampaignsDays[k]){
            uniqueCampaignCount++;
        }
    }
    uniqueCampaignClicks.push(uniqueCampaignCount);
    uniqueCampaignCount = 0;
}
var campaign_date = ['x1'];
var campaign_data = ['total'];
var campaign_dateUnique = ['x2'];
var campaign_dataUnique = ['unique'];
campaign_data = campaign_data.concat( totalCampaignClicks );
campaign_date = campaign_date.concat( uniqueDaysTotal );
campaign_dateUnique = campaign_dateUnique.concat( uniqueDaysTotal );
campaign_dataUnique = campaign_dataUnique.concat( uniqueCampaignClicks );

$('input[name="campaignDaterange"]').daterangepicker(
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

    var new_date = [];
    var new_data = [];
    var count = 0;
    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_date.push(el);
                new_data.push(campaign_data[i]);
                count+= campaign_data[i];
            }
        }
    })
    
    var new_date_unique = [];
    var new_data_unique = [];
    var count_unique = 0;

    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(campaign_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_date_unique.push(el_un);
                        new_data_unique.push(campaign_dataUnique[j]);
                        count_unique+= campaign_dataUnique[j];
                    }
                })                        
            }
        }
    })

    $('.total_campaign_clicks').html( count );
    $('.unique_campaign_clicks').html( count_unique );
    var filtered_date = ['x1'];
    var filtered_data = ['total'];
    new_data = filtered_data.concat( new_data );
    new_date = filtered_date.concat( new_date );
    var filtered_date_unique = ['x2'];
    var filtered_data_unique = ['unique'];
    new_data_unique = filtered_data_unique.concat( new_data_unique );
    new_date_unique = filtered_date_unique.concat( new_date_unique );

    var chart = c3.generate({
        bindto: '#campaign_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_date,
                new_data,
                new_date_unique,
                new_data_unique,
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
    bindto: '#campaign_chart',
    data: {        
        xs: {
            'total': 'x1',
            'unique': 'x2',
        },
        columns: [
            campaign_date,
            campaign_data,
            campaign_dateUnique,
            campaign_dataUnique,
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

$('.campaign_month').on('click', function() {
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

    var new_date = [];
    var new_data = [];    
    var count = 0;

    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_date.push(el);
                new_data.push(campaign_data[i]);
                count+= campaign_data[i];
            }
        }
    })

    var new_date_unique = [];
    var new_data_unique = [];
    var count_unique = 0;

    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(campaign_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_date_unique.push(el_un);
                        new_data_unique.push(campaign_dataUnique[i]);
                        count_unique+= campaign_dataUnique[i];
                    }
                })                        
            }
        }
    })

    $('.total_campaign_clicks').html( count );
    $('.unique_campaign_clicks').html( count_unique );
    var filtered_date = ['x1'];
    var filtered_data = ['total'];
    new_data = filtered_data.concat( new_data );
    new_date = filtered_date.concat( new_date );
    var filtered_date_unique = ['x2'];
    var filtered_data_unique = ['unique'];
    new_data_unique = filtered_data_unique.concat( new_data_unique );
    new_date_unique = filtered_date_unique.concat( new_date_unique );
    var chart = c3.generate({
        bindto: '#campaign_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_date,
                new_data,
                new_date_unique,
                new_data_unique,
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

$('.campaign_week').on('click', function() {
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

    var new_date = [];
    var new_data = [];
    var count = 0;
    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_date.push(el);
                new_data.push(campaign_data[i]);
                count+= campaign_data[i];
            }
        }
    })

    var new_date_unique = [];
    var new_data_unique = [];
    var count_unique = 0;

    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(campaign_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_date_unique.push(el_un);
                        new_data_unique.push(campaign_dataUnique[i]);
                        count_unique+= campaign_dataUnique[i];
                    }
                })                        
            }
        }
    })

    $('.total_campaign_clicks').html(count);
    $('.unique_campaign_clicks').html( count_unique );
    var filtered_date = ['x1'];
    var filtered_data = ['total'];
    new_data = filtered_data.concat( new_data );
    new_date = filtered_date.concat( new_date );
    var filtered_date_unique = ['x2'];
    var filtered_data_unique = ['unique'];
    new_data_unique = filtered_data_unique.concat( new_data_unique );
    new_date_unique = filtered_date_unique.concat( new_date_unique );
    
    var chart = c3.generate({
        bindto: '#campaign_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_date,
                new_data,
                new_date_unique,
                new_data_unique,
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

$('.campaign_today').on('click', function() {
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

    var new_date = [];
    var new_data = [];
    var count = 0;
    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                new_date.push(el);
                new_data.push(campaign_data[i]);
                count+= campaign_data[i];
            }
        }
    })

    var new_date_unique = [];
    var new_data_unique = [];
    var count_unique = 0;

    $.each(campaign_date ,function(i,el){
        for( day in days ){
            if( el == days[day]){
                $.each(campaign_dateUnique, function(j,el_un){
                    if( el_un == el ){
                        new_date_unique.push(el_un);
                        new_data_unique.push(campaign_dataUnique[i]);
                        count_unique+= campaign_dataUnique[i];
                    }
                })                        
            }
        }
    })

    $('.total_campaign_clicks').html(count);
    $('.unique_campaign_clicks').html( count_unique );
    var filtered_date = ['x1'];
    var filtered_data = ['total'];
    new_data = filtered_data.concat( new_data );
    new_date = filtered_date.concat( new_date );
    var filtered_date_unique = ['x2'];
    var filtered_data_unique = ['unique'];
    new_data_unique = filtered_data_unique.concat( new_data_unique );
    new_date_unique = filtered_date_unique.concat( new_date_unique );

    var chart = c3.generate({
        bindto: '#campaign_chart',
        data: {        
            xs: {
                'total': 'x1',
                'unique': 'x2',
            },
            columns: [
                new_date,
                new_data,
                new_date_unique,
                new_data_unique,
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


