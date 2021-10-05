function GetPersonasData() 
{
    var nombre = GetFormData("id_input_nombre");
    var apellido  = GetFormData("id_input_apellido");
    var tel = GetFormData("id_input_telefono");
    var fecha = GetFormData("id_input_fecha");

    if (ValidarIngresoDatos(nombre)
    && ValidarIngresoDatos(apellido)
    && ValidarIngresoDatos(tel)
    && ValidarIngresoDatos(fecha)
    )
    {
        var datosPersona = [nombre, apellido, tel, fecha];
    }
    else
    {
        alert("No ingresa datos obligatorios");
    }

    return datosPersona;

}