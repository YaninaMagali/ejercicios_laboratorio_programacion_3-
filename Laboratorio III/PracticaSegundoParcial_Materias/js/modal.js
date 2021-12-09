class Modal{

    static CrearModal() {
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


    static MostrarModal(materia) {
        //console.log("MostrarModal");
        var modal = document.getElementById("id_modal");
        var modificarBtn = document.getElementById("btn_modificar");
        var delBtn = document.getElementById("btn_delete");
    
        if(materia != null){
            document.getElementById("id_id").value = materia.id;
            document.getElementById("id_nombre").value = materia.nombre;
            var fechaAux =  materia.fechaFinal.split("/");  
            document.getElementById("id_fecha").value = fechaAux[2] + "-" + fechaAux[1] + "-" + fechaAux[0];
            
            document.getElementById("id_cuatri").disabled = true;
            if (materia.turno == "Manana") {
                document.getElementById("id_Maniana").checked = true;
            }else {
                document.getElementById("id_Noche").checked = true;
            }
            
            modificarBtn.setAttribute("style", "display: block");
            delBtn.setAttribute("style", "display: block");
    
            modificarBtn.addEventListener("click", (e)=>{
                PostModificarMateria();
            });
    
            delBtn.addEventListener("click", (e)=>{
                deletePromise();
            });
    
            var closeBtn = document.getElementById("id_cerrar_modal");
            closeBtn.addEventListener("click", (e)=>{
                modal.close();
            });
    
            modal.show();
        }
    
    
    }



}