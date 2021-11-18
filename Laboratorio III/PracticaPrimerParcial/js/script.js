var personas = [];
var localidades = [];
const cabeceraParams = ["Id" ,"Nombre", "Cuatrimestre", "Fecha Final", "Turno"];

function getPersonas(funcionExito, funcionError){

    personas = [];
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var response = this.response;
            console.log(this.response);
            personas = JSON.parse(response);
            funcionExito(personas);
        }
        else if(this.readyState == 4 && this.status != 200){
            funcionError(false);
        }
    }
    request.open("GET", "http://localhost:3000/personas", true);
    request.setRequestHeader('Content-type', 'application/json');
    request.send();
}

function getLocalidades(funcionExito, funcionError){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            localidades = JSON.parse(this.response);
            funcionExito(localidades);
        }
        else if(this.readyState == 4 && this.status != 200){
            funcionError(false);
        }
    }
    request.open("GET", "http://localhost:3000/localidades", true);
    request.setRequestHeader('Content-type', 'application/json');
    request.send();
}

function PostModificarPersona(funcionExito, funcionError)
{
    var personaAux = GetPersonaDataDelForm();
    //console.log(personaAux);
    if(personaAux != null && ValidarNombre(personaAux.nombre) && ValidarApellido(personaAux.apellido)) 
    {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("divSpinner").hidden = true;
                funcionExito(personaAux);
                //console.log("OK");
            }
            else if(this.readyState != 4){
                document.getElementById("divSpinner").hidden = false;
            }
            else if(this.readyState == 4 && this.status != 200){    
                funcionError(false);
                //console.log("NOT OK");
            }
        }
        request.open("POST", "http://localhost:3000/editar", true);
        request.setRequestHeader('Content-type', 'application/json');
        request.send(JSON.stringify(personaAux));
}}

function deletePersonaPost(funcionExito, funcionError){

    var personaAux = GetPersonaDataDelForm();

    if(personaAux != null){
        var request = new XMLHttpRequest();

        request.onreadystatechange = function()
        {
            console.log(this.readyState);
            //console.log(this.readyState);
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("divSpinner").hidden = true;
                funcionExito(personaAux);
                console.log("OK GetPersonaDataDelForm");
            }
            else if(this.readyState != 4){
                document.getElementById("divSpinner").hidden = false;
            }
            else if(this.readyState == 4 && this.status != 200){    
                funcionError(false);
                //console.log("NOT OK");
            }
        }
        request.open("POST", "http://localhost:3000/eliminar", true);
        request.setRequestHeader('Content-type', 'application/json');
        request.send(JSON.stringify(personaAux));
    }
}

function GetPersonaDataDelForm()
{
    var id = document.getElementById("id_id").value;
    var nombre = document.getElementById("id_nombre").value;
    var apellido  = document.getElementById("id_apellido").value;
    var localidad = document.getElementById("id_localidad").value;
    var foto = document.getElementById("id_file").value;
    var sexo;
    //sexo
    if(document.getElementById("id_Male") == "Male"){
        sexo = "Male";
    }
    else{
        sexo = "Female";
    }
    //localidad
    localidades.forEach((element) =>{
        if(localidad == element.nombre){
            localidad = element;
            console.log("this is loccalidad object");
            console.log(element);
        }
    });
    //console.log(localidad);
    return { id: id, nombre: nombre, apellido: apellido, localidad: localidad, sexo: sexo, foto:foto };
}

function ValidarNombre(nombre)
{
    var validacion = true;
    if(nombre.length<4)
    {
        document.getElementById('id_nombre').style.borderColor = "red";
        validacion = false;
    }
    return validacion;
}

function ValidarApellido(apellido)
{
    var validacion = true;
    if(apellido.length<4)
    {
        //console.log("ValidarApellido");
        document.getElementById('id_apellido').style.borderColor = "red";
        var validacion = false;
    }
    return validacion;
}

// function ReemplazarFila(persona) {
//     var filaAux = AgregarFila(persona);
//     var filaActual = document.getElementById("id_fila"+persona.id);
//     filaActual.replaceWith(filaAux);
// }

function PostPersona(funcionExito, funcionError)
{
    var personaAux = GetPersonaDataDelForm();
    //console.log(personaAux);
    if(personaAux != null && ValidarNombre(personaAux.nombre) && ValidarApellido(personaAux.apellido)) 
    {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("divSpinner").hidden = true;
                funcionExito(personaAux);
                console.log("OK");
            }
            else if(this.readyState != 4){
                document.getElementById("divSpinner").hidden = false;
                console.log("SPINNER");
            }
            else if(this.readyState == 4 && this.status != 200){    
                funcionError(false);
                console.log("NOT OK");
            }
        }
        request.open("POST", "http://localhost:3000/nueva", true);
        request.setRequestHeader('Content-type', 'application/json');
        request.send(JSON.stringify(personaAux));
}}

function FuncionExito() {
    console.log("Se ejecuta la FuncionExito() ");
}

function funcionError() {
    console.log("Se ejecuta la funcionError() ");
}

function CrearTabla(idTabla, cabeceraParams) 
{
    var tabla = document.getElementById(idTabla);

    if (tabla === null)
    {
        tabla = document.createElement("table");
        tabla.setAttribute("id", idTabla);
        tabla.setAttribute("class", "Tabla");
        let container = document.getElementById("id_div_tabla");
        container.appendChild(tabla);
        let cabecera = CrearCabeceraTabla(cabeceraParams);
        tabla.appendChild(cabecera);
        tbody = document.createElement("tbody");
        tbody.setAttribute("id", "id_tbody");
        tabla.appendChild(tbody);
    }
    return tabla;
}

function CrearCabeceraTabla(cabeceraData) 
{
    let fila = document.createElement("tr");
    for(i = 0; i<cabeceraData.length;i++)
    {
        let col = document.createElement("th");
        let lbl = document.createTextNode(cabeceraData[i]);
        col.appendChild(lbl);
        fila.appendChild(col); 
        if(i == 0)
        {
            col.setAttribute("type", "hidden");
        }
    }

    return fila;
}

function AgregarFila(persona) 
{
    var idTabla = "id_tabla"
    var tabla = document.getElementById(idTabla);
    

    if (tabla == null)
    {
        tabla = CrearTabla(idTabla, cabeceraParams);
    }

    if (persona != null)
    {
        var tbody = document.getElementById("id_tbody");
        var fila = document.createElement("tr");
        fila.setAttribute("id", "id_fila" + persona.id);
        fila.setAttribute("name", "name_fila"+ persona.id);
        cols = [persona.id, persona.nombre, persona.apellido, persona.localidad.nombre, persona.sexo, persona.foto];
        cols.forEach(element =>
        {
            var col = document.createElement("td");
            if(element == persona.foto){
                var img = document.createElement("img");
                img.setAttribute("src", persona.foto);
                img.setAttribute("class", "foto");
                img.setAttribute("id", "id_img_"+persona.id);
                col.appendChild(img);
            }
            else{
                var lbl = document.createTextNode(element);
                col.appendChild(lbl);
            }
            fila.appendChild(col);
        })

        fila.addEventListener("click", (e)=>{
            MostrarModal(persona)});

            tbody.appendChild(fila);
    }
    return fila;

}

function CargarTablaPersonas(personas)
{
    personas.forEach(element => {
        AgregarFila(element);
    })

}

function getPersonasPromise(){
    promise = new Promise(getPersonas);
    promise.then(CargarTablaPersonas).catch(funcionError);
}

function getLocalidadesPromise(){
    promise = new Promise(getLocalidades);
    promise.then(CargarSelectLocalidades).catch(funcionError);
}

function PostModificarPersonaPromise(){
    promise = new Promise(PostModificarPersona);
    promise.then(ActualizarTabla).catch(funcionError);
}

function deletePersonaPromise() {
    promise = new Promise(deletePersonaPost);
    promise.then(ActualizarTabla).catch(funcionError);
}

function CargarSelectLocalidades(opciones)
{
    var dropdown = document.getElementById("id_localidad");
    opciones.forEach(element => {
        var opt = document.createElement('option');
        opt.value = [element.nombre];
        opt.innerHTML = [element.nombre];
        dropdown.appendChild(opt);
    })
}

function ActualizarTabla() {
    var tabla = document.getElementById("id_tbody");
    var children = tabla.children; 

    while (tabla.firstChild) {
        tabla.removeChild(tabla.firstChild);
      }
    
    getPersonasPromise();
}

function PostAgregarNuevoUsuarioPromise() {
    promise = new Promise(PostPersona);
    promise.then(ActualizarTabla).catch(funcionError);
}

window.addEventListener("load", function () {
    this.getPersonasPromise();
    this.getLocalidadesPromise();

    var addBtn = document.getElementById("id_btn_abrir_form_registro");
    addBtn.addEventListener("click", (e)=>{
        MostrarModal();
    });

  });


