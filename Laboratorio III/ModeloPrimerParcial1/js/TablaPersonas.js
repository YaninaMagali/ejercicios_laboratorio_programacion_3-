const cabeceraParams = ["Id", "Nombre", "Apellido", "Fecha", "Sexo"];

function AgregarFilasATablaPersonas(params) 
{
    params.forEach(element => {
        params = [element.id, element.nombre, element.apellido, element.fecha, element.sexo]
        AgregarFila(cabeceraParams, params);
    })

}

function CrearModal() 
{
    tabla = document.getElementById("id_tabla_personas");
    var modal = document.createElement("div");
    modal.setAttribute("id", "id_modal_persona");
    modal.setAttribute("class", "modal");
    modal.appendChild(tabla);

}






