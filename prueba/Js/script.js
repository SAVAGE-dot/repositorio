
var IdLibro = 0

document.getElementById("identificadorboton").addEventListener("click",
function(){
    registrar_datos();
}); 
function registrar_datos(){
   
    let nombre = document.getElementById("nombre").value.trim();
    let editorial=document.querySelector('input[name="editorial"]:checked').value;
    let autor = document.getElementById("autor").value.trim();
    let año = document.getElementById("año").value.trim();


    if (nombre === '') {
    alert("El campo no puede estar vacío");
    } else if (!/^[a-zA-Z]+$/.test(nombre)) {
    alert("Solo se permiten letras en el Nombre del Libro");
        return;
    } else if (autor === '') {
    alert("El campo no puede estar vacío");
    } else if (!/^[a-zA-Z]+$/.test(autor)) {
    alert("Solo se permiten letras en el Autor");
        return;
    } else if (año === '') {
    alert("El campo no puede estar vacío");
    } else if (!/^\d+$/.test(año)) {
    alert("Solo se permiten números en este campo");
        return;
    }
    alert("estas listo para enviar los datos al servidor");
    
       // datos mandados con la solicutud POST
		var formData = new FormData();
		formData.append('nombre', nombre);
        formData.append('autor', autor);	
        formData.append('año', año);
        formData.append('editorial', editorial);

		fetch("../Rutas/bibli/create", { method: 'POST', body: formData })
		.then(function (response) {
		  return response;
		})
		.then(function (body) {
            listarlibros();

		});
}
// document.getElementById('eliminar').addEventListener('click', function() {
//     const idLibro = obtenerIdDelLibro();
//     fetch(`../Rutas/bibli/delete=${idLibro}`, {
//         method: 'POST' 
//     })
//     .then(response => {
//         if (response.ok) {
//             listarlibros();
//         } else {
//             console.error('Error al eliminar el libro');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

function eliminar_registro(update){
    var formData = new FormData();
    formData.append('idlibro', update);
    fetch(`../Rutas/bibli/delete`, {
        method: 'POST' ,
        body : formData
    })
    .then(function (response) {
        return response;
      })
    .then(function (body) {
          listarlibros();

    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function activar_registro(update){
    var formData = new FormData();
    formData.append('activacion', update);
    fetch(`../Rutas/bibli/activar`, {
        method: 'POST' ,
        body : formData
    })
    .then(function (response) {
        return response;
      })
    .then(function (body) {
          listarlibros();

    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function editar_registro(libros){
    // console.log(libros.IdEditorial)
    document.getElementById("nombre").value=libros.Nombre
    document.getElementById("autor").value=libros.Autor
    document.getElementById("año").value=libros.Año
    document.getElementById("editorial-"+libros.IdEditorial).checked = true
    IdLibro = libros.Id
    console.log(IdLibro)

}
document.getElementById("enviar_edicion").addEventListener("click",
function(){
    actualizar_libro();
}); 

function actualizar_libro(){
    let nombre = document.getElementById("nombre").value.trim();
    let editorial=document.querySelector('input[name="editorial"]:checked').value;
    let autor = document.getElementById("autor").value.trim();
    let año = document.getElementById("año").value.trim();
    
    var formData = new FormData();
        formData.append('Id', IdLibro);
		formData.append('nombre', nombre);
        formData.append('autor', autor);	
        formData.append('año', año);
        formData.append('editorial', editorial);
        

		fetch("../Rutas/bibli/editar", { method: 'POST', body: formData })
		.then(function (response) {
		  return response;
		})
		.then(function (body) {
            listarlibros();

		});

}




function listarlibros(){
    fetch("../Rutas/bibli/listar").then((response) => {
        if (response.ok) {
          return response.json();
        }
        throw new Error('Something went wrong');
      })
      .then((libros) => {   
            let cuerpohtml="";     
        for (let index = 0; index < libros.length; index++) {   
            if (libros[index].Estado === "0"){
                cuerpohtml=cuerpohtml+`
            <tr>
                <th scope="row">${libros[index].Id}</th>
                <td>${libros[index].Nombre}</td>
                <td>${libros[index].Autor}</td>
                <td>${libros[index].Año}</td>
                <td>${libros[index].Estado ? (libros[index].Estado === '1' ? 'Disponible' : 'No disponible') : 'Sin estado'}</td>
                <td>${libros[index].Editorial}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminar_registro(${libros[index].Id})"><a class="a">ELIMINAR</a></button>
                    <button type="button" class="btn btn-success" onclick="activar_registro(${libros[index].Id})"><a class="a">Activar</a></button>
                </td>
            </tr>
            `;
        }else{
            cuerpohtml=cuerpohtml+`
            <tr>
                <th scope="row">${libros[index].Id}</th>
                <td>${libros[index].Nombre}</td>
                <td>${libros[index].Autor}</td>
                <td>${libros[index].Año}</td>
                <td>${libros[index].Estado ? (libros[index].Estado === '1' ? 'Disponible' : 'No disponible') : 'Sin estado'}</td>
                <td>${libros[index].Editorial}</td>
                <td>
                    <button type="button" class="btn btn-warning" onclick=\'editar_registro(${JSON.stringify(libros[index])})\'><a class="a" >EDITAR</a></button>
                    <button type="button" class="btn btn-danger" onclick="eliminar_registro(${libros[index].Id})"><a class="a">ELIMINAR</a></button>

                </td>
            </tr>
            `;
        }
        }
        document.getElementById("cuerpo-tabla").innerHTML=cuerpohtml;
      })
      .catch((error) => {
        console.log(error)
      });  
}
listarlibros()

