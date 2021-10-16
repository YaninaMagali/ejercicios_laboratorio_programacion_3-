function GetFormData(elementId) 
{
    return document.getElementById(elementId).value;
}

function ValidarIngresoDatos(dato) 
{
    let resultado = false;

    if (dato != "")
    {
        resultado = true;
    }
    return resultado;
} 

