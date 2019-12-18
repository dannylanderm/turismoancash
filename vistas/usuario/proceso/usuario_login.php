<?php
	include_once '../../../includes/UsuarioDAL.php';
	include_once '../../../includes/Usuario_Session.php';
	$usuarioSession = new UsuarioSession();
	$usuario        = new UsuarioDAL();
	
	if (isset($_POST['txtLogin']) && isset($_POST['txtPwd'])) {
		$userForm = $_POST['txtLogin'];
		$passForm = $_POST['txtPwd'];
		
		$usu = $usuario->login($userForm, $passForm);
		
		if ($usu) {
			$_SESSION['auth.usu_id']         = $usu['usu_id'];
			$_SESSION['auth.usu_nombres']    = $usu['pers_nombres'];
			$_SESSION['auth.usu_ap_paterno'] = $usu['pers_ap_paterno'];
			$_SESSION['auth.usu_ap_materno'] = $usu['pers_ap_materno'];
			
			$usuario->updateFechaAcceso($usu['usu_id']);
			
			$usuarioSession->setCurrentUsuario($userForm);
			echo 'Validando datos para ...'.$userForm;
			header('Refresh: 0; URL=../../intranet.php');
		} else {
			// echo 'Nombre de usuario y/o pass incorrecto';
			$errorLogin = "Nombre de usuario y/o contraseña incorrectos!!";
			header('Location: ../../../acceso.php');
		}
	} else {
		echo 'datos no validos';
	}