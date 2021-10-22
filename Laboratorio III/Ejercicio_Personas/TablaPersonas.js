const cabeceraParams = ["Nombre", "Apellido", "Telefono", "Fecha"];

function AgregarFilaATablaPersonas(params) 
{
    if(params != null)
    {
        AgregarFila(cabeceraParams, params);
    }
}

window.addEventListener("load", () =>{
    let btnAgregarUsuario = document.getElementById("id_button_submit");
    btnAgregarUsuario.addEventListener("click", AgregarPersonaPost);
}
)


