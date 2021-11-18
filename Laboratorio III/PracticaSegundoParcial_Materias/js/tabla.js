class Tabla{

    static CrearTabla(idTabla, cabeceraParams) {
        var tabla = document.getElementById(idTabla);
    
        if (tabla === null)
        {
            tabla = document.createElement("table");
            tabla.setAttribute("id", idTabla);
            tabla.setAttribute("class", "Tabla");
            let container = document.getElementById("id_div_tabla");
            container.appendChild(tabla);
            let cabecera = Tabla.CrearCabeceraTabla(cabeceraParams);
            tabla.appendChild(cabecera);
            let tbody = document.createElement("tbody");
            tbody.setAttribute("id", "id_tbody");
            tabla.appendChild(tbody);
        }
        return tabla;
    }
    
    static CrearCabeceraTabla(cabeceraData) {
        let fila = document.createElement("tr");
        for(let i = 0; i<cabeceraData.length;i++)
        {
            let col = document.createElement("th");
            let lbl = document.createTextNode(cabeceraData[i]);
            col.appendChild(lbl);
            fila.appendChild(col); 
        }
    
        return fila;
    }
    
    static AgregarFila(materia) {
        var idTabla = "id_tabla"
        var tabla = document.getElementById(idTabla);
        
    
        if (tabla == null)
        {
            tabla = Tabla.CrearTabla(idTabla, cabeceraParams);
        }
    
        if (materia != null)
        {
            var tbody = document.getElementById("id_tbody");
            var fila = document.createElement("tr");
            fila.setAttribute("id", "id_fila" + materia.id);
            fila.setAttribute("name", "name_fila"+ materia.id);
            var cols = [materia.id, materia.nombre, materia.cuatrimestre, materia.fechaFinal, materia.turno];
            cols.forEach(element =>
            {
                var col = document.createElement("td");
                var lbl = document.createTextNode(element);
                col.appendChild(lbl);
                fila.appendChild(col);
            })
    
            fila.addEventListener("dblclick", (e)=>{
                MostrarModal(materia)});
    
                tbody.appendChild(fila);
        }
        return fila;
    }


}   