function eliminar(url)
{
    if(window.confirm("Realmente desea eliminar este registro?"))
    {
        window.location=url;
    }
}

function errorLogin(url){
	if (window.confirm("Los datos ingresados son incorrectos")) {
		window.location=url;
	}
}

function redirect(url){
			window.location=url;
		};