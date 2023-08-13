//timer
function full_time(change){
    if(change<10) return "0"+change;
    else return change;
}
var month = ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"];
function time_now(){
    var date = new Date();
    var now = date.getDate()+" "+month[date.getMonth()]+" "+date.getFullYear()+"r "+full_time(date.getHours())+":"+full_time(date.getMinutes())+":"+full_time(date.getSeconds());
    document.getElementById("time_now").innerHTML = now;
}
setInterval(time_now, 1000);

function holiday(){
    var date = new Date().getTime();
    var holiday = new Date(2023, 5, 23, 9, 59, 59, 0).getTime();
    var time = holiday-date;
    var sec = (time/1000).toFixed(0);
    var min = (sec/60).toFixed(0); 
    var houre = (min/60).toFixed(0);
    var day = (houre/24).toFixed(0);
    var week = (day/7).toFixed(0);

    document.getElementById("holiday_sec").innerHTML = sec%60;
    document.getElementById("holiday_min").innerHTML = min%60;
    document.getElementById("holiday_houre").innerHTML = houre%24;
    document.getElementById("holiday_day").innerHTML = day%7;
    document.getElementById("holiday_week").innerHTML = week;
}
setInterval(holiday, 1000);

function holiday_time(){
    var date = new Date().getTime();
    var holiday = new Date(2023, 5, 23, 10, 59, 59, 0).getTime();
    var time = holiday-date;
    var sec = (time/1000).toFixed(0);
    var min = (sec/60).toFixed(0); 
    var houre = (min/60).toFixed(0);
    var day = (houre/24).toFixed(0);
    var week = (day/7).toFixed(0);

    document.getElementById("holiday_sec_time").innerHTML = sec;
    document.getElementById("holiday_min_time").innerHTML = min;
    document.getElementById("holiday_houre_time").innerHTML = houre;
    document.getElementById("holiday_day_time").innerHTML = day;
    document.getElementById("holiday_week_time").innerHTML = week;
}
setInterval(holiday_time, 1000);