// function GetPersonasData() 
// {
//     var nombre = GetFormData("id_input_nombre");
//     var apellido  = GetFormData("id_input_apellido");
//     var tel = GetFormData("id_input_telefono");
//     var fecha = GetFormData("id_input_fecha");

//     if (ValidarIngresoDatos(nombre)
//     && ValidarIngresoDatos(apellido)
//     && ValidarIngresoDatos(tel)
//     && ValidarIngresoDatos(fecha)
//     )
//     {
//         var datosPersona = [nombre, apellido, tel, fecha];
//     }
//     else
//     {
//         alert("No ingresa datos obligatorios");
//     }

//     return datosPersona;

// }


// function AgregarPersonaPost()
// {
//     var persona = GetPersonasData();
//     console.log(persona);
//     if(persona != null)
//     {
//         var http = new XMLHttpRequest();//Instancio Objeto

//         http.onreadystatechange = function()
//         {
//             if(this.readyState == 4 && this.status == 200)
//             {
//                 alert("OK");
//                 AgregarFilaATablaPersonas(persona);
//             }
//             else
//             {
//                 //alert("NOT OK");
//             }
//         }
//         http.open("POST", "http://localhost:3000/nuevaPersona", true);
//         var auxData = {'nombre': persona[0], 'apellido': persona[1], 'telefono': persona[2], 'fecha': persona[3]};
//         http.setRequestHeader('Content-type', 'application/json');
//         console.log(JSON.stringify(auxData));
//         http.send(JSON.stringify(auxData));
//     }
// }


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
        }
    }
    http.open("GET", "http://localhost:3000/personas", true);
    http.setRequestHeader('Content-type', 'application/json');
    http.send();
}


window.addEventListener("load", AgregarTablaPersonasGet);
window.addEventListener("load", () =>{
    let filaPersona = document.getElementsByName("id_fila");
    for (var i = 0 ; i < filaPersona.length; i++) {
        filaPersona[i].addEventListener('dblclick' , CrearModal , false ) ; 
     }
    //let children = filaPersona.childNodes;
    //filaPersona.addEventListener("dblclick", CrearModal);
}
)
