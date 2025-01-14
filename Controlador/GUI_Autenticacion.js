
async function fntGuardar() {
    let frmRegistro = document.querySelector("#frmRestro");
    let strNombre = document.querySelector("#txtNombre").value;
    let strApellidos = document.querySelector("#txtApellidos").value;
    let strCorreo = document.querySelector("#txtCorreo").value;
    let strContrasenia = document.querySelector("#txtContrasenia").value;
    
    if (strNombre == "" || strApellidos == "" || strCorreo == "" || strContrasenia == "") {
        alert("Todos los campos son obligatorios");
        return;
    }
    
    try {
        const formData = new FormData(frmRegistro);
        let resp = await fetch("../Controlador/ControladorAutentificacion.php?op=registra", {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        
        let json = await resp.json();
        console.log(json); // Aquí puedes verificar la respuesta JSON en la consola
        // Aquí puedes realizar acciones basadas en la respuesta JSON devuelta por el controlador
    } catch (err) {
        console.error("Ocurrió un error:", err);
    }

    async function fntAutenticar() {
        let strCorreo = document.querySelector("#txtCorreo").value;
        let strContrasenia = document.querySelector("#txtContrasenia").value;
        
        if (strCorreo === "" || strContrasenia === "") {
            alert("Correo y contraseña son obligatorios");
            return;
        }
        
        try {
            let formData = new FormData();
            formData.append('correo', strCorreo);
            formData.append('contrasenia', strContrasenia);
    
            let resp = await fetch("../Controlador/ControladorAutentificacion.php?op=autentica", {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: formData
            });
            
            let json = await resp.json();
            console.log(json); // Aquí puedes verificar la respuesta JSON en la consola
            
            if (json.success && json.redirect) {
                window.location.href = json.redirect; // Redirige a la página principal si la autenticación fue exitosa
            } else {
                alert("Error: " + json.message); // Muestra un mensaje de error si la autenticación falla
            }
        } catch (err) {
            console.error("Ocurrió un error:", err);
        }
    }
    
    


}
