function sendRegister()
{
    var nombre = document.registro.nombre.value;
    var apellido = document.registro.apellidos.value;
    var correo = document.registro.mail.value;
    var pass = document.registro.password.value;

    if(nombre=="" || apellido=="" || correo=="" || pass=="")
    {
        $('#mensajeRegistro').html('Faltan campos por llenar');
        setTimeout("$('#mensajeRegistro').html('');",5000);
        return false;
    }
    else
    {

        $('#formRegistro').submit(function(f){
            
            f.preventDefault();

            $.ajax({

                url : './Funciones/checkCorreo.php', 
                type : 'post',
                dataType : 'text',
                data: $('#formRegistro').serialize(),
                success : function(res){
    
                    if(res==1){
                        
                        $('#mensajeRegistro').html('El correo '+correo+' ya existe');
                        setTimeout("$('#mensajeRegistro').html('');",5000);
                        return false;
                    }
                    else{
                        
                        document.registro.submit();
    
                    }
    
                },error: function(){
    
                    alert('Error Archivo No Encontrado');
    
                }
                
    
            });
        });
        
    }

}

function sendLogin()
{
    var correo = document.login.mail.value;
    var pass = document.login.password.value;

    console.log(correo);
    console.log(pass);

    if(correo=="" || pass=="")
    {
        $('#mensajeLogin').html('Faltan campos por llenar');
        setTimeout("$('#mensajeLogin').html('');",5000);
        return false;
    }
    else
    {
        $('#loginForm').submit(function(f){
            
            f.preventDefault();

            $.ajax({

                url : './Funciones/checkLogin.php', 
                type : 'post',
                dataType : 'text',
                data: $('#loginForm').serialize(),
                success : function(res){
    
                    if(res==0){
                        
                        $('#mensajeLogin').html('El usuario no existe');
                        setTimeout("$('#mensajeLogin').html('');",5000);
                        return false;
                    }
                    else{
                        
                        window.location.href="index.php";
    
                    }
    
                },error: function(){
    
                    alert('Error Archivo No Encontrado');
    
                }
                
    
            });
        });
    }
}

function sendContacto()
{
    var nombre = document.formContacto.nombre.value;
    var apellidos = document.formContacto.last.value;
    var correo = document.formContacto.mail.value;
    var comentario = document.formContacto.comentario.value;

    if(nombre=="" || apellidos=="" || correo=="" || comentario=="")
    {
        $('#errorContact').html('Faltan campos por llenar');
        setTimeout("$('#errorContact').html('');",5000);
        return false;
    }
    else
    {
        $('#contact').submit(function(f){
            
            f.preventDefault();

            $.ajax({

                url : './Funciones/correo.php', 
                type : 'post',
                dataType : 'text',
                data: $('#loginForm').serialize(),
                success : function(res){
    
                    if(res==0){
                        
                        $('#errorContact').html('El correo no se pudo enviar');
                        setTimeout("$('#errorContact').html('');",5000);
                        return false;
                    }
                    else{
                        
                        document.formContacto.submit();
                    }
    
                },error: function(){
    
                    alert('Error Archivo No Encontrado');
    
                }
                
    
            });
        });
    }
    
}

function agregarCarrito(idP)
{

    $.ajax({

        url : './Funciones/agregaProducto.php', 
        type : 'post',
        dataType : 'text',
        data: 'id='+idP,
        success : function(res){

            if(res==1){
                
                $('#mensajeProducto').html('El producto se agregó al carrito');
                setTimeout("$('#mensajeProducto').html('');",5000);
            }
            else{
                
                $('#errorProducto').html('Hubo un error al agregar el producto o no ha iniciado sesion');
                setTimeout("$('#errorProducto').html('');",5000);
            }

        },error: function(){

            alert('Error Archivo No Encontrado');

        }
        

    });
    
}

function deleteRow(idP,idF,idPedido,cant)
{
    if(confirm("Quiere eliminar el producto?"))
    {
        $.ajax({

            url : './Funciones/eliminaProducto.php', 
            type : 'post',
            dataType : 'text',
            data: 'idPedido='+idPedido+'&idProducto='+idP+'&cant='+cant,
            success : function(res){
    
                if(res==1){
                    
                    $('#fila_'+idF).hide();
                    $('#mensajeCarrito').html('El producto se eliminó');
                    setTimeout("$('#mensajeCarrito').html('');",3000);
                }
                else{
                    
                    $('#errorCarrito').html('El producto no se pudo eliminar');
                    setTimeout("$('#mensajeCarrito').html('');",5000);
                }
    
            },error: function(){
    
                alert('Error Archivo No Encontrado');
    
            }
            
    
        });
    }

}

function confirmPedido(idPedido)
{
    $.ajax({

        url : './Funciones/confirmaPedido.php', 
        type : 'post',
        dataType : 'text',
        data: 'idPedido='+idPedido,
        success : function(res){

            if(res==1){
                
                $('#mensajeCarrito').html('El pedido se ha confirmado!');
                setTimeout("$('#mensajeCarrito').html('');",5000);
            }
            else{
                
                $('#mensajeCarrito').html('El pedido no se pudo confirmar');
                setTimeout("$('#mensajeCarrito').html('');",5000);
            }

        },error: function(){

            alert('Error Archivo No Encontrado');

        }
        

    });
}