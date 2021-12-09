const clientesGlobal = [];
var filtrado = [];
const cabeceraParams = ["Id" ,"Nombre", "Apellido", "Sexo", "Edad"];

async function getMaterias(funcionExito, funcionError){

    try{
        var response = await fetch("http://localhost:3001/clientes", 
        {method: 'GET', headers:{'Content-type': 'application/json'}});
        response.json().then(Cliente.CargarTablaClientes).catch(funcionError);
    }
    catch(e){
        console.log("Error: ");
    }
}

function MostrarPromedioEdadClientesPantalla(promedio){

    var p = document.getElementById("id_input_promedio");
    p.value = promedio;
}

function funcionError() {
    console.log("Se ejecuta la funcionError() ");
}

function GetDataDelForm(){

    var id = document.getElementById("id_input_id").value;
    var nombre = document.getElementById("id_nombre").value;
    var apellido  = document.getElementById("id_apellido").value;
    var sexo = document.getElementById("id_sexo").value;
    var edad = document.getElementById("id_edad").value;
    
    if( nombre !== "" && apellido !== "" && sexo !== "" && edad !== "" ){
        if(id === ""){
            id = Cliente.CalcularIdCliente();
        }
        
        return new Cliente(id, nombre, apellido, sexo, edad);
    }
    else{
        alert("Ingresar datos");
    }
    
}

function resetForm(form) {
    // clearing inputs
    var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false;   
        }
    }
}

function FiltrarSexoPromise(){
    promise = new Promise(Cliente.FiltrarPorSexo);
    promise.then(Cliente.CargarTablaClientes).catch(funcionError);
}

function PromedioPromise(){
    promise = new Promise(Cliente.CalcularPromedioEdad);
    promise.then(MostrarPromedioEdadClientesPantalla).catch(funcionError);
}

function OcultarColumna(event)
{
    var t = event.currentTarget;
    tValue = t.value;
    console.log(tValue);
    var index;
    switch(tValue){
        case 'cb_id':
            index = 0;
            break;
        case 'cb_nombre':
            index = 1;       
            break; 
        case 'cb_apellido':
            index = 2;
            break;
        case 'cb_sexo':
            index = 3;
            break;
        case 'cb_edad':
            index = 4;
            break
    }
    if(! t.checked){
        OcultarColPorFila(index, "none");
      }
    else{
      OcultarColPorFila(index, "table-cell");
    }
}

function OcultarColPorFila(indice, style){
    var tbl = document.getElementById("id_tabla");
    var th = tbl.getElementsByTagName("th");
    var rows = tbl.getElementsByTagName("tr");
    th[indice].style.display = style; 
    for ( i = 1; i < rows.length; i++) {
        var cels = rows[i].getElementsByTagName("td");
        cels[indice].style.display = style;
    }
}


window.addEventListener("load", function () {
    this.getMaterias();
    
    var sexo = document.getElementById("id_select_sexo");
    sexo.addEventListener("change", (e)=>{
        this.FiltrarSexoPromise();
  });

  var addBtn = document.getElementById("btn_add");
  addBtn.addEventListener("click", (e)=>{
      Cliente.AgregarCliente();
  });

  var delBtn = document.getElementById("btn_delete");
  delBtn.addEventListener("click", (e)=>{
      Cliente.EliminarCliente();
  });

  var delBtn = document.getElementById("btn_clean");
  delBtn.addEventListener("click", (e)=>{
      Tabla.EliminarElementosLista();
  });

  var PromedioBtn = document.getElementById("btn_promedio");
  PromedioBtn.addEventListener("click", (e)=>{
      this.PromedioPromise();
  });

  var checkId = document.getElementById("cb_id");
  checkId.addEventListener("change", OcultarColumna);

  var checkNombre = document.getElementById("cb_nombre");
  checkNombre.addEventListener("change", OcultarColumna);

  var checkApellido = document.getElementById("cb_apellido");
  checkApellido.addEventListener("change", OcultarColumna);

  var checkEdad = document.getElementById("cb_edad");
  checkEdad.addEventListener("change", OcultarColumna);

  var checkSexo = document.getElementById("cb_sexo");
  checkSexo.addEventListener("change", OcultarColumna);



});
