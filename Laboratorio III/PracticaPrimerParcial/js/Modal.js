function CrearModalPersonas() {
    var dialog = document.createElement("dialog");
    dialog.setAttribute("type","hidden");
    dialog.setAttribute("id","id_modal");
    dialog.setAttribute("class","modal");

    var form = document.createElement("form");
    form.setAttribute("method","dialog");
    dialog.appendChild(form);

    var id = document.createElement("input");
    id.setAttribute("type","hidden");
    id.setAttribute("id","id_id");
    form.appendChild(id);

    var nombre = document.createElement("input");
    var lblNombre = document.createElement("Label");
    lblNombre.setAttribute("for","id_form_nombre");
    nombre.setAttribute("type","text");
    nombre.setAttribute("id","id_form_nombre");
    nombre.setAttribute("value","Nombre");
    form.appendChild(nombre);

    var apellido = document.createElement("input");
    apellido.setAttribute("type","text");
    apellido.setAttribute("id","id_form_apellido");
    apellido.setAttribute("value","Apellido");
    form.appendChild(apellido);

    var localidades = document.createElement("select");
    localidades.setAttribute("type","text");
    localidades.setAttribute("id","id_select_localidades");
    localidades.setAttribute("value","Localidad");
    form.appendChild(localidades);

    var sexoM = document.createElement("input");
    sexoM.setAttribute("type","radio");
    sexoM.setAttribute("name","sexo");
    sexoM.setAttribute("id","id_radio_Male");
    sexoM.setAttribute("value","Sexo Masculino");
    form.appendChild(sexoM);

    var sexoF = document.createElement("input");
    sexoF.setAttribute("type","radio");
    sexoF.setAttribute("name","sexo");
    sexoF.setAttribute("id","id_radio_Female");
    sexoF.setAttribute("value","Sexo Femenino");
    form.appendChild(sexoF);

    divModal = document.getElementById("id_div_modal");
    divModal.appendChild(dialog);
    console.log("Crear modal");
}

function MostrarModal(persona) {
    console.log("MostrarModal");
    modal = document.getElementById("id_modal");
    var modificarBtn = document.getElementById("btn_modificarPersona");
    var agregarBt = document.getElementById("id_agregar_btn");
    var delBtn = document.getElementById("btn_deletePersona");
    form = document.getElementById("form");
    if(modal == null)
    {
        CrearModalPersonas();
    }
    else{
        if(persona != null){
            document.getElementById("id_id").value = persona.id;
            document.getElementById("id_nombre").value = persona.nombre;
            document.getElementById("id_apellido").value = persona.apellido;
            document.getElementById("id_img_"+persona.id).value = persona.foto;
            
            
            if (persona.sexo == "Male") {
                document.getElementById("id_Male").checked = true;
            }else {
                document.getElementById("id_Female").checked = true;
            }
            
            modificarBtn.setAttribute("style", "display: block");
            delBtn.setAttribute("style", "display: block");
            agregarBt.setAttribute("style", "display: none");
            modificarBtn.addEventListener("click", (e)=>{
                PostModificarPersonaPromise();
            });
            delBtn.addEventListener("click", (e)=>{
                deletePersonaPromise();
            });

            let selectDeLocalidades = document.getElementById("id_localidad");
            localidades.forEach((element) =>{
                if(persona.localidad.id == element.id){
                    selectDeLocalidades.value = element.nombre;
                }
            });
        }
        else{
            form.reset();
            agregarBt.setAttribute("style", "display: block");
            modificarBtn.setAttribute("style", "display: none");
            delBtn.setAttribute("style", "display: none");
            agregarBt.addEventListener("click", (e)=>{
                PostAgregarNuevoUsuarioPromise()});
        }
    }
        var closeBtn = document.getElementById("id_cerrar_modal");
        closeBtn.addEventListener("click", (e)=>{
            modal.close();
        });

        modal.show();
}

