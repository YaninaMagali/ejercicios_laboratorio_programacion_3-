function $(element) {
    return document.getElementById(element);
  }

  function getDatos(exito, error) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var personas = this.response;
        var personasParseado = JSON.parse(personas);
        exito(personasParseado);
      }
      if(this.readyState == 4 && this.status == 404){
          error(false);
      }
    };
    xhttp.open("GET", "http://localhost:3000/personas", true);
    xhttp.send();
  }

  function llenarTabla(persona) {
    let nombre = persona.nombre;
    let apellido = persona.apellido;
    let sexo = persona.sexo;
    let id = persona.id;
    let localidad = persona.localidad.nombre;
  
    let tabla = $("tabla_id");
  
    let fila = document.createElement("tr");
    fila.setAttribute("id", persona.id);
  
    let celdaId = document.createElement("td");
    celdaId.appendChild(document.createTextNode(id));
    fila.appendChild(celdaId);
  
    let celdaNombre = document.createElement("td");
    celdaNombre.appendChild(document.createTextNode(nombre));
    fila.appendChild(celdaNombre);
  
    let celdaApellido = document.createElement("td");
    celdaApellido.appendChild(document.createTextNode(apellido));
    fila.appendChild(celdaApellido);
  
    let celdaLocalidad = document.createElement("td");
    celdaLocalidad.appendChild(document.createTextNode(localidad));
    fila.appendChild(celdaLocalidad);
  
    let celdaSexo = document.createElement("td");
    celdaSexo.appendChild(document.createTextNode(sexo));
    fila.appendChild(celdaSexo);
  
    fila.onclick = function (event) {
      modificarOnClick(persona);
    };
  
    tabla.appendChild(fila);
  }


///Aca carga el modal
function modificarOnClick(persona) {
    var dialog = $("favDialog");
    dialog.show();
    console.log(persona);
    $("id").value = persona.id;
    $("name").value = persona.nombre;
    $("lastname").value = persona.apellido;
    if (persona.sexo == "Male") {
      $("Male").checked = true;
    } else {
      $("Female").checked = true;
    }
    console.log(persona.localidad);

    let selectDeLocalidades = $("localidad_select");
    arrayLocalidades.forEach((element) =>{
        if(persona.localidad.id == element.id){
            selectDeLocalidades.value = element.id;
            //console.log(selectDeLocalidades);
        }
    });

  }

  let arrayLocalidades = [];

  function getLocalidades(exito, error) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var localidades = this.response;
        let array = JSON.parse(localidades);
        arrayLocalidades = array;
        exito(arrayLocalidades);
      }
      if(this.readyState == 4 && this.status == 404){
            error(false);
        }
    };
    xhttp.open("GET", "http://localhost:3000/localidades", true);
    xhttp.send();
  }

  function rellenarSelect(localidad){
      let selectLocalidades = $("localidad_select");
      let nombreLocalidad = localidad.nombre;
      let idLocalidad = localidad.id;
      let opcion = document.createElement("option");
      opcion.innerHTML = nombreLocalidad;
      opcion.value = idLocalidad;
      selectLocalidades.appendChild(opcion);
  }

  ///Crea una persona para enviarla por POST luego de validar los datos
  function modificarFila() {
    let persona = { id: 0, nombre: "", apellido: "", localidad: {}, sexo: "" };
    persona.id = $("id").value;
    persona.nombre = $("name").value;
    persona.apellido = $("lastname").value;
    var localidadSeleccionada = $("localidad_select").value;
    
    arrayLocalidades.forEach((element) =>{
        if(localidadSeleccionada == element.id){
            persona.localidad = element;
        }
    });
    if (document.getElementById("Male").checked) {
      persona.sexo = "Male";
    } else {
      persona.sexo = "Female";
    }
    if (validarDatos()) {
      cleanErrors();
      post_editar("http://localhost:3000/editar", JSON.stringify(persona));
      $("divSpinner").hidden = false;
    }
  }

  function closeDialog() {
    var dialogoPregunta = document.getElementById("favDialog");
    dialogoPregunta.close();
    cleanErrors();
  }

  function validarDatos() {
    var retorno = true;
    if ($("name").value.length < 3) {
      $("name").classList.add("validate-wrong");
      retorno = false;
    }
    if ($("lastname").value.length < 3) {
      $("lastname").classList.add("validate-wrong");
      retorno = false;
    }
    return retorno;
  }

  function cleanErrors() {
    if ($("name").classList.contains("validate-wrong")) {
      $("name").classList.remove("validate-wrong");
    }
    if (
      $("lastname").classList.contains("validate-wrong")
    ) {
      $("lastname").classList.remove("validate-wrong");
    }
  }

  async function post_editar(url, formData) {
    console.log(formData + " -> dentro del post_editar");
    var xhttp = new XMLHttpRequest();

    let resultado;
    let promesa = new Promise((exito, error) => {
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              $("divSpinner").hidden = true;
              var persona = this.response;
              //console.log(this.response);
              replacePersona(JSON.parse(persona));
              exito("Funciono");
            }
            if (this.readyState == 4 && this.status == 404){
                error("Error en el POST-EDITAR");
            }
          };
    });
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(formData);
    resultado = await promesa.then(imprimirExito).catch(imprimirFracaso);
    return resultado;
  }

  function replacePersona(persona) {
    let nombre = persona.nombre;
    let apellido = persona.apellido;
    let sexo = persona.sexo;
    let id = persona.id;
    let localidad = persona.localidad;
  
    var fila = $(persona.id);
  
    let fila_nueva = document.createElement("tr");
    fila_nueva.setAttribute("id", persona.id);
  
    let data1 = document.createElement("td");
    data1.appendChild(document.createTextNode(id));
    let data2 = document.createElement("td");
    data2.appendChild(document.createTextNode(nombre));
    let data3 = document.createElement("td");
    data3.appendChild(document.createTextNode(apellido));
    let data4 = document.createElement("td");
    data4.appendChild(document.createTextNode(localidad.nombre));
    let data5 = document.createElement("td");
    data5.appendChild(document.createTextNode(sexo));
    fila_nueva.appendChild(data1);
    fila_nueva.appendChild(data2);
    fila_nueva.appendChild(data3);
    fila_nueva.appendChild(data4);
    fila_nueva.appendChild(data5);
  
    fila.replaceWith(fila_nueva);
    closeDialog();
  }


  function getPersonasPromesa(){
      promesa = new Promise(getDatos);
      promesa.then(exitoBusqueda).catch(imprimirFracaso);
  }

  function exitoBusqueda(exito){
      exito.forEach((element) =>{
          llenarTabla(element);
      });
      console.log("La peticion fue exitosa a Personas");
  }

  function imprimirFracaso(resultado){
    console.log("Resolucion fallida " + resultado);
    throw resultado;
}
function imprimirExito(resultado){
    console.log("Resolucion exitosa " + resultado);
}

function getLocalidadesPromesa(){
    promesa = new Promise(getLocalidades);
    promesa.then(exitoBusquedaLocalidad).catch(imprimirFracaso);
}

function exitoBusquedaLocalidad(exito){
    exito.forEach((element) => {
        rellenarSelect(element);
    });
    console.log("La peticion fue exitosa a Localidades");
}

window.addEventListener("load", function () {
    let tabla = $("tabla");
    tabla.setAttribute("id", "tabla_id");
    let tbody = document.createElement("tbody");
    tabla.appendChild(tbody);
    this.getPersonasPromesa();
    this.getLocalidadesPromesa();
  });