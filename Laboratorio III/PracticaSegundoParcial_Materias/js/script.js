const materiasP = [];
const cabeceraParams = ["Id" ,"Nombre", "Cuatrimestre", "Fecha Final", "Turno"];

async function getMaterias(funcionExito, funcionError){

    try{
        var response = await fetch("http://localhost:3000/materias", 
        {method: 'GET', headers:{'Content-type': 'application/json'}});

        response.json().then(Materia.CargarTablaMaterias).catch(funcionError);
        // var jsonAux = response.json();
        // console.log(jsonAux.type);
        // if(jsonAux.type == 'ok'){
        // response.json().then(Materia.CargarTablaMaterias).catch(funcionError);
        // }
    }
    catch(e){
        console.log("Error: ");
    }
}

function funcionError() {
    console.log("Se ejecuta la funcionError() ");
}

function GetDataDelForm(){

    var id = document.getElementById("id_id").value;
    var nombre = document.getElementById("id_nombre").value;
    var cuatri  = document.getElementById("id_cuatri").value;
    var fecha = document.getElementById("id_fecha").value;

    var fechaAux =  fecha.split("-");  
    var fechaFinal = fechaAux[2] + "/" + fechaAux[1] + "/" + fechaAux[0];
    
    var turno;
    
    if(document.getElementById("id_Maniana") == "Maniana"){
        turno = "Mañana";
    }
    else{
        turno = "Noche";
    }
    return new Materia(id, nombre, cuatri, fecha, turno);
}

async function PostModificarMateria(funcionExito, funcionError)
{
    var aux = GetDataDelForm();
    if(aux != null 
        // && ValidarNombre(aux.nombre) 
        // && ValidarTurno()
        // && ValidarFecha()
        ) 
    {
        var response = await fetch("http://localhost:3000/editar", 
        {method: 'POST', headers:{'Content-type': 'application/json'},
        body: JSON.stringify(aux)});

        response.json().then(Tabla.ReemplazarFila(aux)).catch(funcionError);
        // var request = new XMLHttpRequest();

        // request.onreadystatechange = function()
        // {
        //     if(this.readyState == 4 && this.status == 200){
        //         document.getElementById("divSpinner").hidden = true;
        //         funcionExito(aux);
        //     }
        //     else if(this.readyState != 4){
        //         document.getElementById("divSpinner").hidden = false;
        //     }
        //     else if(this.readyState == 4 && this.status != 200){    
        //         funcionError(false);
        //     }
        // }
        // request.open("POST", "http://localhost:3000/editar", true);
        // request.setRequestHeader('Content-type', 'application/json');
        // request.send(JSON.stringify(aux));
}}


window.addEventListener("load", function () {
    this.getMaterias();
    
    var turno = document.getElementById("id_select_turno");
    turno.addEventListener("change", (e)=>{
      Materia.FiltrarMateriaPorTurno();
  });

});
