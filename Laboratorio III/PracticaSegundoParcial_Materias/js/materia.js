class Materia{
    // id;
    // nombre;
    // cuatrimestre;
    // fechaFinal;
    // turno;
    constructor(id, nombre, cuatri, fecha, turno) {
        this.id = id;
        this.setNombre = nombre;
        this.cuatri = cuatri;
        this.setFecha = fecha;
        this.setTurno = turno;
      }

      get getTurno() {
        return this.turno;
      }
    
      set setTurno(value) {
        if (value != 'tarde' && value != 'noche' && value != 'maniana') {
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
        this.turno = value;
      }

      set setNombre(value){
        if(value.length < 6){
          alert("turno invalid.");
          return;
        }
        this.nombre = value;
      }

      CargarTablaMaterias(materias){
        materias.forEach(element => {
        AgregarFila(element);
    })

}
}