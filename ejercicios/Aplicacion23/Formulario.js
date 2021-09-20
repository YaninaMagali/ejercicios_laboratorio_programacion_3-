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

window.addEventListener("load", () =>{
    let btnAbrirForm = document.getElementById("id_btn_abrir_form");
    btnAbrirForm.addEventListener("click", MostrarFormulario);
}
)