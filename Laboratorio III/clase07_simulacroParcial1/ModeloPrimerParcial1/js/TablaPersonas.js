const cabeceraParams = ["Id", "Nombre", "Apellido", "Fecha", "Sexo"];

function CrearModal()
{

    alert("hola martin");
    document.getElementById('id_div_modal').style.display = 'block';

}
function ObtenerDataPorFila(event)
{
    console.log("event");
    console.log(event);
    t = event.target;
    idRow = t.getAttribute("id_fila");
    row = document.getElementById(idRow);
    console.log("row");
    console.log(row);
    let children = row.childNodes;
    console.log("children");
    console.log(children);


}

function AgregarTablaPersonasGet()
{
    var http = new XMLHttpRequest();
    http.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            alert("OK");
            var auxData = this.response;
            AgregarFilasATablaPersonas(JSON.parse(auxData));

            var table = document.getElementById("id_tabla_personas");
            for (var i = 0, row; row = table.rows[i]; i++)
            {
                //console.log(row);
                row.addEventListener("dblclick", (e)=>{
                    CrearModal();
                    ObtenerDataPorFila()});
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





