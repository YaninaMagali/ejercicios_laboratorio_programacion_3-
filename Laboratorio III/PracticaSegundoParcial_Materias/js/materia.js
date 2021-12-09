class Materia{
      id;
      nombre;
      cuatrimestre;
      fechaFinal;
      turno;

    constructor(id, nombre, cuatri, fecha, turno) {
        this.id = id;
        this.setNombre = nombre;
        this.cuatrimestre = cuatri;
        this.setFecha = fecha;
        this.setTurno = turno;
      }

      get getTurno() {
        return this.turno;
      }
    
      set setTurno(value) {
        if (value != 'Tarde' && value != 'Noche' && value != 'Mañana') {
          alert("turno invalid.");
          return;
        }
        this.turno = value;
      }

      set setFecha(value) {
        if (new Date(value) <= new Date()) {
          alert("fecha invalida.");
          return;
        }
        else{
          this.fechaFinal = value;
          //console.log(Date(value));
        }
        // var fechaAux =  value.split("-");  
        // value = fechaAux[2] + "/" + fechaAux[1] + "/" + fechaAux[0];

        
      }

      set setNombre(value){
        if(value.length < 6){
          alert("turno invalid.");
          return;
        }
        this.nombre = value;
      }

      static CargarTablaMaterias(materias){
        console.log("entro a CargarTablaMaterias");
        materias.forEach(e => {
        materiasP.push(e);
        Tabla.AgregarFila(e);
        })
      }

      static FiltrarMateriaPorTurno() {
      
        var materiasFiltradas = [];
        var turnoSeleccionado = document.getElementById("id_select_turno").value;
        materiasFiltradas = materiasP.filter(materia => materia.turno == turnoSeleccionado);
        Tabla.ActualizarTabla();
        Materia.CargarTablaMaterias(materiasFiltradas);   
      }

      static SumarDosAnios(materia){

        // console.log(materia);
        // var f = new Date(materia.fecha).setYear(2022);
        // console.log(f);
        var aux = parseInt(materia.id)+50 ;
        return  new Materia(aux , materia.nombre, materia.cuatrimestre, materia.fechaFinal, materia.turno);
      }
      //Despues llamo a la func map: materiasP.map(Materia.SumarDosAnios);
}
