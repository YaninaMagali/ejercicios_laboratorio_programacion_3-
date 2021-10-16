const idTabla = "id_tabla_personas";

function CrearTabla(idTabla, cabeceraData) 
{
    var tabla = document.getElementById(idTabla);

    if (tabla === null)
    {
        tabla = document.createElement("table");
        tabla.setAttribute("id", idTabla);
        tabla.setAttribute("class", "Tabla");

        // aca quizas deberia validar que existe e div, y sino o cree
        let container = document.getElementById("id_div_tabla_personas");
        container.appendChild(tabla);
        //quizas podria crear una funcion que sea GetCabeceraData e invocarla desde aca, y asi evitar pasar a todas las funciones este param
        let cabecera = CrearCabecera(cabeceraData);
        tabla.appendChild(cabecera);
    }
    return tabla;
}

function CrearCabecera(cabeceraData) 
{
    let fila = document.createElement("tr");

    cabeceraData.forEach(element => 
    {
        let col = document.createElement("th");
        let lbl = document.createTextNode(element);
        col.appendChild(lbl);
        fila.appendChild(col); 
    })
    return fila;
}

function AgregarFila(cabeceraParams, params) 
{
    var tabla = document.getElementById(idTabla);
    console.log(params);

    if (tabla == null)
    {
        tabla = CrearTabla(idTabla, cabeceraParams);
    }

    if (params != null)
    {
        var fila = document.createElement("tr");
        fila.setAttribute("id", "id_fila");
        fila.setAttribute("name", "name_fila");

        params.forEach(element =>
        {
            var col = document.createElement("td");
            var lbl = document.createTextNode(element);
            col.appendChild(lbl);
            fila.appendChild(col);
        })
        tabla.appendChild(fila);
    }

}
