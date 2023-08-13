//Kalkulator ceny
var licz = document.getElementById("licz");
var calc_result = document.getElementById("calc_result");

function check_value(gdzie, termin, ile_dni, uczestnicy, transport){
    if(gdzie=="Dokąd wyjazd?") return false;
    else if(new Date().getTime()>=new Date(termin).getTime() || !termin) return false;
    else if(!ile_dni || ile_dni<=0) return false;
    else if(!uczestnicy || uczestnicy<=0) return false;
    else if(transport == "W jaki sposób dotrzesz?") return false;
    else return true;
}

function country(gdzie){
    if(gdzie == "Tatry" || gdzie == "Beskid Żywiecki" || gdzie == "Karkonosze") return "Polska";
    else if(gdzie == "Aply Bergamskie - Pizzo Famo" || gdzie == "Aply Julijskie - Triglav" || gdzie == "Piramide Vincent" || gdzie == "Dolomity") return "Włochy";
    else if(gdzie == "Góry Gomborskie" || gdzie == "Kaukaz") return "Gruzja";
    else return "Szkocja";
}

function trans_cena(transport){
    if(transport=="Samolot") return 500;
    else if(transport=="Autobus") return 250;
    else return 0;
}

licz.addEventListener("click", ()=>{
    var gdzie = document.getElementById("gdzie").value;
    var termin = document.getElementById("kiedy").value;
    var ile_dni = document.getElementById("ile_dni").value;
    var ile_os = document.getElementById("ile_os").value;
    var transport = document.getElementById("transport").value;
    var rabat_kod = document.getElementById("rabat_kod").value;
    var rabat_reg = /^[a-z]{2}-[1-9]{2,}[A-Z]$/; //np. gh-123D

    if(!check_value(gdzie, termin, ile_dni, ile_os, transport)) calc_result.innerHTML = "Błędne dane!";
    else{
        //Przyjęte są bardzo uproszczone warunki cenowe
        var cena = 0;
        if(country(gdzie)=="Polska"){
            cena = (trans_cena(transport)*2+ile_dni*50)*ile_os;
        }else if(country(gdzie)=="Włochy"){
            cena = (trans_cena(transport)*2+ile_dni*200)*ile_os;
        }else if(country(gdzie)=="Gruzja"){
            cena = (trans_cena(transport)*2+ile_dni*100)*ile_os;
        }else if(country(gdzie)=="Szkocja"){
            cena = (trans_cena(transport)*2+ile_dni*250)*ile_os;
        }

        if(rabat_reg.test(rabat_kod)==true) cena*= 0.9;
        
        calc_result.innerHTML = "Będzie Cię to kosztowało w okolicach "+cena+" zł. Spójrz na promocje jakie aktualnie oferujemy.";
    }
});
