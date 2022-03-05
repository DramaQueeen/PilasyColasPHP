<?php  
	session_start();
	$stack = new SplStack();

	if(!isset($_SESSION['pila'])){
		$_SESSION['pila'] = $stack;
		$_SESSION['cont'] = 0;
		$_SESSION['cont2'] = 0;
	}

	function agregar_pila($num){
		$stack = $_SESSION['pila'];
		$stack->push($num);
		$_SESSION['pila'] = $stack;
		return $num;		
	}

	function total(){
		$stack = $_SESSION['pila'];
		return $stack->count();	
	}

	function eliminar_pila(){
		$stack = $_SESSION['pila'];
		$stack->rewind();
		return $stack->pop();
	}

	function vagon_actual(){
		$stack = $_SESSION['pila'];
		$stack->rewind();
		if($stack->current() >= 1){
			return $stack->current();
		}else{
			return 0;
		}
		
	}

	function tiempo(){
		$hora = time();
		$_SESSION['inicio_pila'] = $hora;
  		$_SESSION['expira_pila'] = $hora + (60);
	}

	function dinero(){
		$dinero = $_SESSION['cont2'];
		$dinero = $dinero * 600;

		return $dinero;
	}

	if(isset($_GET["vagon"]) == "pila"){
		$_SESSION['cont'] = $_SESSION['cont']+1;
		
		agregar_pila($_SESSION['cont']);

	}

	if(vagon_actual() != 0){
		if(!isset($_SESSION['inicio_pila'])){
			tiempo();
		
		}else{
			if(time() > $_SESSION['expira_pila']){
				$_SESSION['cont2'] = $_SESSION['cont2']+1;
				eliminar_pila();
				tiempo();

				if(vagon_actual() == 0){
					unset($_SESSION['inicio_pila']);
					unset($_SESSION['expira_pila']);
				}
			}
		}
		
	}else{
		unset($_SESSION['inicio_pila']);
		unset($_SESSION['expira_pila']);
	}

?>