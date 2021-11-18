var materias = [];
const cabeceraParams = ["Id" ,"Nombre", "Cuatrimestre", "Fecha Final", "Turno"];

async function getMaterias(funcionExito, funcionError){

    var response = await fetch("http://localhost:3000/materias", 
    {method: 'GET', headers:{'Content-type': 'application/json'}});

    //response.text().then(Materia.CargarTablaMaterias).catch(funcionError);
    response.json().then(Materia.CargarTablaMaterias).catch(funcionError);
    
    // request.onreadystatechange = function(){
    //     if(this.readyState == 4 && this.status == 200){
    //         var response = this.response;
    //         materias = JSON.parse(response);
    //         funcionExito(materias);
    //     }
    //     else if(this.readyState == 4 && this.status != 200){
    //         funcionError(false);
    //     }
    // }
    // request.open("GET", "http://localhost:3000/materias", true);
    // request.setRequestHeader('Content-type', 'application/json');
    // request.send();
}

function funcionError() {
    console.log("Se ejecuta la funcionError() ");
}

window.addEventListener("load", function () {
    this.getMaterias();

  });