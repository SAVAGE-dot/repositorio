
var IdProducto = 0

document.getElementById("registrar_boton").addEventListener("click",
function(){
    registrar_datos();
}); 
function registrar_datos(){
   
    let nombre = document.getElementById("Nombre").value.trim();
    let categoria=document.querySelector('input[name="categoria"]:checked').value;
    let precio = document.getElementById("Precio").value.trim();


    if (nombre === '') {
    alert("El campo no puede estar vacío");
    } else if (!/^[a-zA-Z]+(\s{1,2})?$/.test(nombre)) {
    alert("Solo se permiten letras en el Nombre del Producto");
        return;
    } else if (precio === '') {
    alert("El campo no puede estar vacío");
    } else if (!/^\d+(\.\d+)?$/.test(precio)) {
    alert("Solo se permiten números en el precio");
        return;
    }
    alert("Esta listo para enviar los datos al servidor");
    
       // datos mandados con la solicutud POST
		var formData = new FormData();
		formData.append('nombre', nombre);
        formData.append('categoria', categoria);	
        formData.append('precio', precio);

		fetch("../Rutas/Admin/create", { method: 'POST', body: formData })
		.then(function (response) {
		  return response;
		})
		.then(function (body) {
            listarProductos();

		});
}

function eliminar_registro(update){
    var formData = new FormData();
    formData.append('idProducto', update);
    fetch(`../Rutas/Admin/delete`, {
        method: 'POST' ,
        body : formData
    })
    .then(function (response) {
        return response;
      })
    .then(function (body) {
          listarProductos();

    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function activar_registro(update){
    var formData = new FormData();
    formData.append('activacion', update);
    fetch(`../Rutas/Admin/activar`, {
        method: 'POST' ,
        body : formData
    })
    .then(function (response) {
        return response;
      })
    .then(function (body) {
          listarProductos();

    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function editar_registro(Productos){
    document.getElementById("Nombre").value=Productos.Nombre
    document.getElementById("Precio").value=Productos.Precio
    document.getElementById("categoria-"+Productos.Id).checked = true
    IdProducto = Productos.Id
    console.log(Productos.Id)
}
document.getElementById("enviar_edicion").addEventListener("click",
function(){
    actualizar_producto();
}); 

function actualizar_producto(){
    let nombre = document.getElementById("Nombre").value.trim();
    let precio = document.getElementById("Precio").value.trim();
    let categoria = document.querySelector('input[name="categoria"]:checked').value;
    
    var formData = new FormData();
        formData.append('Id', IdProducto);
		formData.append('Nombre', nombre);
        formData.append('Precio', precio);	
        formData.append('categoria', categoria);
        

		fetch("../Rutas/Admin/editar", { method: 'POST', body: formData })
		.then(function (response) {
		  return response;
		})
		.then(function (body) {
            listarProductos();

		});

}

function listarProductos(){
    fetch("../Rutas/Admin/listar").then((response) => {
        if (response.ok) {
          return response.json();
        }
        throw new Error('Something went wrong');
      })
      .then((Productos) => {   
            let cuerpohtml="";     
        for (let index = 0; index < Productos.length; index++) {   
            if (Productos[index].Estado === "0"){
                cuerpohtml=cuerpohtml+`
            <tr>
                <th scope="row">${Productos[index].Id}</th>
                <td>${Productos[index].Nombre}</td>
                <td>${Productos[index].Categoria}</td>
                <td>${Productos[index].Precio}</td>
                <td>${Productos[index].Estado ? (Productos[index].Estado === '1' ? 'Disponible' : 'No disponible') : 'Sin estado'}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminar_registro(${Productos[index].Id})"><a class="a">ELIMINAR</a></button>
                    <button type="button" class="btn btn-success" onclick="activar_registro(${Productos[index].Id})"><a class="a">Activar</a></button>
                </td>
            </tr>
            `;
        }else{
            cuerpohtml=cuerpohtml+`
            <tr>
                <th scope="row">${Productos[index].Id}</th>
                <td>${Productos[index].Nombre}</td>
                <td>${Productos[index].Categoria}</td>
                <td>${Productos[index].Precio}</td>
                <td>${Productos[index].Estado ? (Productos[index].Estado === '1' ? 'Disponible' : 'No disponible') : 'Sin estado'}</td>
                <td>
                    <button type="button" class="btn btn-warning" onclick=\'editar_registro(${JSON.stringify(Productos[index])})\'><a class="a" >EDITAR</a></button>
                    <button type="button" class="btn btn-danger" onclick="eliminar_registro(${Productos[index].Id})"><a class="a">ELIMINAR</a></button>

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
listarProductos()

