const cabeceraParams = ["Nombre", "Apellido", "Telefono", "Fecha"];

function AgregarFilaATablaPersonas() 
{
    var params = GetPersonasData();
    if(params != null)
    {
        AgregarFila(cabeceraParams, params);
    }
}


window.addEventListener("load", ()=>
{
    let btnRegistrar = document.getElementById("id_button_submit");
    btnRegistrar.addEventListener("click", AgregarFilaATablaPersonas);
}
)