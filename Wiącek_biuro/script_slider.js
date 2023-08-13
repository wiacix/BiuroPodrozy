// SLIDER
var slider_l_bt = document.getElementById("slider_l_bt");
var slider_r_bt = document.getElementById("slider_r_bt");
var slider = document.getElementById("slider");

var img = ["bergamo_1.png", "glasgow_2.png", "gruzja_3.png", "triglav_4.png"];

function which_img(name){
    return (name.slice(-5)).slice(0,1)-1;
}

slider_l_bt.addEventListener("click", ()=>{
    var name = which_img(document.getElementById("img_slider").src);
    if(name<=0) name = 3;
    else name--;

    document.getElementById("img_slider").src = img[name];
    document.getElementById(name).checked = true;
});

slider_r_bt.addEventListener("click", ()=>{
    var name = which_img(document.getElementById("img_slider").src);
    if(name>=3) name = 0;
    else name++;

    document.getElementById("img_slider").src = img[name];
    document.getElementById(name).checked = true;
});

function slider_automate(){
    var name = which_img(document.getElementById("img_slider").src);
    if(name>=3) name = 0;
    else name++;

    document.getElementById("img_slider").src = img[name];
    document.getElementById(name).checked = true;
}
setInterval(slider_automate, 7000);

var rad_0 = document.getElementById('0');
var rad_1 = document.getElementById('1');
var rad_2 = document.getElementById('2');
var rad_3 = document.getElementById('3');

rad_0.addEventListener("click", ()=>{
    document.getElementById("img_slider").src = img[0];
});
rad_1.addEventListener("click", ()=>{
    document.getElementById("img_slider").src = img[1];
});
rad_2.addEventListener("click", ()=>{
    document.getElementById("img_slider").src = img[2];
});
rad_3.addEventListener("click", ()=>{
    document.getElementById("img_slider").src = img[3];
});