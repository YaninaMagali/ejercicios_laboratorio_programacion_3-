function CrearTabla()
{
    let auxTable = document.getElementById("tabla");
    if( auxTable == null)
    {
        //let titulo = document.createElement("label");

        auxTable = document.createElement("table");
        auxTable.setAttribute("id", "tabla_usuarios");
        auxTable.setAttribute("class", "Tabla");
        let container = document.getElementById("div_tabla_usuarios");
        if(container != null)
        {
            container.appendChild(auxTable);
            let fila = document.createElement("tr");

            let colNombre = document.createElement("th");
            let lblNombre = document.createTextNode("Nombre");
            colNombre.appendChild(lblNombre);

            let colMail = document.createElement("th");
            let lblColMail = document.createTextNode("Mail");
            colMail.appendChild(lblColMail);

            let colDocumento = document.createElement("th");
            let lblColDocumento = document.createTextNode("Clave");
            colDocumento.appendChild(lblColDocumento);

            fila.appendChild(colNombre);
            fila.appendChild(colMail);
            fila.appendChild(colDocumento);
            
            auxTable.appendChild(fila);
        }
    }

    return auxTable;
}


function AgregarFilaATabla(nombre, clave, mail)
{
    
    let auxTable = document.getElementById("tabla_usuarios");
    
    if( auxTable == null)
    {
        auxTable = CrearTabla();
    } 
    let fila = document.createElement("tr");
    let col0 = document.createElement("td");
    let col1 = document.createElement("td");
    let col2 = document.createElement("td");

    col0.appendChild(document.createTextNode(nombre));
    col1.appendChild(document.createTextNode(mail));
    col2.appendChild(document.createTextNode(clave));
    fila.appendChild(col0);
    fila.appendChild(col1);
    fila.appendChild(col2);
    auxTable.appendChild(fila);

}




window.addEventListener("load", () =>{
let btnregistrar = document.getElementById("id_registrar");
    btnregistrar.addEventListener("click", AgregarUsuario);
} 

)