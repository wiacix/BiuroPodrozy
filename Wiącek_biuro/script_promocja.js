var img = ["bergamo_1.png", "glasgow_2.png", "gruzja_3.png", "triglav_4.png"];

function getRandom(min, max){
    return Math.random()*(max-min)+min;
}

function los_obr(){
    document.getElementById("img_promocja").src = img[Math.floor(getRandom(0,4))];
}