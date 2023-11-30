
document.getElementById("identificaorboton").addEventListener("click",
function(){
    //alert('estas aqui')
    registrar_datos();
}); 
function registrar_datos(){
     let nombre=document.getElementById("nombre").value;
     let apellido=document.getElementById("apellido").value;
     let correo=document.getElementById("correo").value;
     let documento=document.getElementById("documento").value;
     let telefono=document.getElementById("telefono").value;
     let genero=document.querySelector('input[name="genero"]:checked').value
     let curso=document.getElementById("curso").value;
     
      const validarEmail= /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

      const validarnumero= /^[0-9]+$/;


    if((nombre.trim()).length<=5){
        alert("En el campo Nombre solo se permite 5 caracteres como minimo ");
        return;
    }else if((apellido.trim()).length<=5){
        alert("En el campo Apellido solo se permite 5 caracteres como minimo ");
        return;
    }else if(!validarnumero.test(documento)){
        alert("Documento invalido");
        return;
    }else if((documento.trim()).length!==12){
        alert("el campo documento solo se permite 12 caracteres ");
        return;
    }
    else if(!validarnumero.test(telefono)){
        alert("Telefono invalido");
        return;
    }
     else if((telefono.trim()).length!==9){
        alert("En el campo Telefono solo se permiten 9 caracteres ");
        return;
    }else if( !validarEmail.test(correo) ||  (correo.match(/\./g) || []).length !== 1)
    {
        alert("El correo electrónico no es válido");
        return;
        //return validarEmail.test(correo) && (correo.match(/\./g) || []).length === 1;
    }

    alert("estas listo para enviar los datos al servidor");
    

       // datos mandados con la solicutud POST
		var formData = new FormData();
		formData.append('nombre', nombre);
		formData.append('apellido', apellido);
        formData.append('correo', correo);
        formData.append('documento', documento);
        formData.append('telefono', telefono);
        formData.append('genero', genero);

		fetch("../Rutas/user/create", { method: 'POST', body: formData })
		.then(function (response) {
		  return response;
		})
		.then(function (body) {
            listarusarios();
		  //Traer();

		});




     /*console.log("nombre:"+nombre);
     console.log("apellido:"+apellido);
     console.log("correo:"+correo);
     console.log("documento:"+documento);
     console.log("telefono:"+telefono);
     console.log("genero:"+genero);
     console.log("curso:"+curso);
     */


}

function listarusarios(){
    fetch("../Rutas/user/listar").then((response) => {
        if (response.ok) {
          return response.json();
        }
        throw new Error('Something went wrong');
      })
      .then((usuarios) => {   
            let cuerpohtml="";     
        for (let index = 0; index < usuarios.length; index++) {       
            //console.log(usuarios[index].email);
            cuerpohtml=cuerpohtml+`
            <tr>
                <th scope="row">${usuarios[index].Id}</th>
                <td>${usuarios[index].nombre}</td>
                <td>${usuarios[index].apellido}</td>
                <td>${usuarios[index].email}</td>
                <td>${usuarios[index].DNI}</td>
                <td>${usuarios[index].Celular}</td>
                <td>${usuarios[index].sexo}</td>
                <td>${usuarios[index].estado}</td>
                <td>
                    <button type="button" class="btn btn-warning"><a class="a">EDITAR</a></button>
                    <button type="button" class="btn btn-danger"><a class="a">ELIMINAR</a></button>
                </td>

            </tr>
            `;

        }
        document.getElementById("cuerpo-tabla").innerHTML=cuerpohtml;
      })
      .catch((error) => {
        console.log(error)
      });  
}

listarusarios();