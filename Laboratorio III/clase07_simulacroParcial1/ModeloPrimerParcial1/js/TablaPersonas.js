const cabeceraParams = ["Id", "Nombre", "Apellido", "Fecha", "Sexo"];

function CrearModal()
{
    modal = document.getElementById('id_div_modal');
    modal.setAttribute("style", "display: block");
}

function OcultarModal() 
{
    modal = document.getElementById('id_div_modal');
    modal.setAttribute("style", "display: none");  
}

function ObtenerDataPorFila(event)
{
    t = event.currentTarget;
    let children = t.childNodes;
    //console.log("children");
    //console.log(children);
    //console.log("children");
    //console.log(children);
    //var nombre = children[1];
    //var apellido = children[2];
    //var fecha = children[3];
    //var sexo = children[4];
    //console.log("datos");
    //console.log(children[0]);
    //datos = [nombre, apellido, fecha, sexo];
    //console.log(datos);
    return t.childNodes;
}

function PrecargarDataPersonaEnForm(dataPersona) 
{
    nombre = document.getElementById("id_input_nombre");
    apellido = document.getElementById("id_input_apellido");
    fecha = document.getElementById("id_input_fecha");
    sexo = document.getElementsByClassName("radio");
    nombre.value = dataPersona[1].textContent;
    apellido.value = dataPersona[2].textContent;
    fecha.value = dataPersona[3].textContent;
    sexo.value = dataPersona[4].textContent;
}

function AgregarTablaPersonasGet()
{
    var http = new XMLHttpRequest();
    http.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            // alert("OK");
            var auxData = this.response;
            AgregarFilasATablaPersonas(JSON.parse(auxData));

            var table = document.getElementById("id_tabla_personas");
            for (var i = 0, row; row = table.rows[i]; i++)
            {
                var r = row;
                r.addEventListener("dblclick", (e)=>{
                    CrearModal();
                    var data = ObtenerDataPorFila(e);
                    PrecargarDataPersonaEnForm(data); 
                });
            }

        }
    }
    http.open("GET", "http://localhost:3000/personas", true);
    http.setRequestHeader('Content-type', 'application/json');
    http.send();
}

function AgregarFilasATablaPersonas(params)
{
    params.forEach(element => {
        params = [element.id, element.nombre, element.apellido, element.fecha, element.sexo]
        AgregarFila(cabeceraParams, params);
    })

}


window.addEventListener("load", AgregarTablaPersonasGet);






