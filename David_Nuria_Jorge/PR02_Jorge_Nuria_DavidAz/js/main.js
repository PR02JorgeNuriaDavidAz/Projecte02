
function loading(){
	imagen = '<img src="/img/loading.gif" alt="Cargando..." />'
	document.getElementById('imagencargando').innerHTML = imagen;
}

function openModal(idRecurso) {

	// document.getElementsByTagName("TR")[1].getAttributeNode("idRecurso");
    document.getElementById("demo").innerHTML = "$q='SELECT * FROM tbl_recurso WHERE idRecurso = "+idRecurso+"'";
}
