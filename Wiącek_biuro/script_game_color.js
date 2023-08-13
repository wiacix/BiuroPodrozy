function getRandomColor(min, max){
    return Math.random()*(max-min)+min;
}

var rgb;

function setColor(){
    var r = Math.floor(getRandomColor(1,254));
    var g = Math.floor(getRandomColor(1,254));
    var b = Math.floor(getRandomColor(1,254));
    rgb = "rgb("+r+", "+g+", "+b+")";
}

var ciag_znaki = "abcdefghijklmnoprstuwxyz"; //dl: 24
var rabat_kod = "";
function rabat(){ // /^[a-z]{2}-[1-9]{2,}[A-Z]$/
    rabat_kod = ciag_znaki[Math.floor(getRandomColor(0,24))];
    rabat_kod += ciag_znaki[Math.floor(getRandomColor(0,24))]+"-";
    rabat_kod += Math.floor(getRandomColor(10,999));
    rabat_kod += (ciag_znaki[Math.floor(getRandomColor(0,24))]).toUpperCase();
    return rabat_kod;
}

function choose_color(){
    document.getElementById("result").innerHTML = "";
    setColor();
    document.getElementById("rgb_id").innerHTML = rgb;

    var which = Math.floor(getRandomColor(1,7));
    for(var i=1; i<=6; i++){
        if(i==which){
            document.getElementById("bt"+i).style.background = rgb;
        } 
        else{
            document.getElementById("bt"+i).style.background = "rgb("+Math.floor(getRandomColor(1,254))+","+Math.floor(getRandomColor(1,254))+","+Math.floor(getRandomColor(1,254))+")";
        }
    }
}

function isCorrect(nb){
    var x = document.getElementById("bt"+nb).style.background;
    if(x == rgb){
        document.getElementById("result").innerHTML = "Udało się!<br>Twój kod rabatowy: <span style='color:red;'>"+rabat()+"</span>";
    }else{
        document.getElementById("result").innerHTML = "Zła odpowiedź, spróbuj jeszcze raz!";
    }
    
}
