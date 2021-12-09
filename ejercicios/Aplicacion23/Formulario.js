function MostrarFormulario()
{
    let form = document.getElementById("div_registro_form");

    if(form.style.display == "none")
    {
        form.setAttribute("style", "display: block");
    } 
    else
    {
        form.setAttribute("style", "display: none");
    }
    
}

function GetDataDelForm()
{
    
    var nombre = document.getElementById("id_input_name").value;
    var clave = document.getElementById("id_input_clave").value;
    var mail = document.getElementById("id_input_mail").value;
    var data = null;

    ///VER SI HAGO MAS VALIDACIONES ACA!

    if(nombre != ""
    && clave != ""
    && mail != "")
    {
        data = [nombre, clave, mail];
    }
    else
    {
        alert("NO ingreso datos obligatorios");
    }    
    return data;
}

function AgregarUsuario()
{
    var data = GetDataDelForm();

    if(data != null)
    {
        AgregarUsuarioPost(data);
    }

}

function AgregarUsuarioPost(usuario)
{

    if(usuario != null)
    {
        var http = new XMLHttpRequest();//Instancio Objeto

        http.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                alert("OK");
                AgregarFilaATabla(usuario[0], usuario[1], usuario[2]);
            }
            else
            {
                //alert("NOT OK");
            }
        }
        http.open("POST", "http://localhost/ejercicios_laboratorio_programacion_3-/ejercicios/Aplicacion23/usuario.php", true);
        
        //var usuarioJson = {'nombre': usuario[0], 'clave': usuario[1], 'mail': usuario[2]}
        //http.setRequestHeader('Access-Control-Allow-Origin', '*');
        //http.setRequestHeader('Content-type', 'application/json');
        //http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        //console.log(JSON.stringify(usuarioJson));
        //http.send(JSON.stringify(usuarioJson));//body
        //http.send(usuarioJson);

        var formData = new FormData(); // Currently empty
        formData.append('nombre', usuario[0]);
        formData.append('clave', usuario[1]);
        formData.append('mail', usuario[2]);

        //console.log("usuarioJson: ");
        //console.log(usuarioJson);
        //console.log("usuario formdata: ");
        //console.log(formData);

        http.send(formData);//body
        
    }
}



window.addEventListener("load", () =>{
    let btnAbrirForm = document.getElementById("id_btn_abrir_form");
    btnAbrirForm.addEventListener("click", MostrarFormulario);
}
)