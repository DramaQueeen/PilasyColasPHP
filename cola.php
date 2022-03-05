<?php  
	session_start();
	$queue = new SplQueue();

	if(!isset($_SESSION['cola'])){
		$_SESSION['cola'] = $queue;
		$_SESSION['contador'] = 0;
		$_SESSION['contador2'] = 0;
	}

	function agregar_cola($num){
		$queue = $_SESSION['cola'];
		$queue->enqueue($num);
		$_SESSION['cola'] = $queue;
		return $num;		
	}

	function total(){
		$queue = $_SESSION['cola'];
		return $queue->count();	
	}

	function eliminar_cola(){
		$queue = $_SESSION['cola'];
		$queue->rewind();
		return $queue->dequeue();
	}

	function vagon_actual(){
		$queue = $_SESSION['cola'];
		$queue->rewind();
		if($queue->current() >= 1){
			return $queue->current();
		}else{
			return 0;
		}
		
	}

	function tiempo(){
		$hora = time();
		$_SESSION['inicio'] = $hora;
  		$_SESSION['expira'] = $hora + (60);
	}

	function dinero(){
		$dinero = $_SESSION['contador2'];
		$dinero = $dinero * 600;

		return $dinero;
	}

	if(isset($_GET["vagon"]) == "cola"){
		$_SESSION['contador'] = $_SESSION['contador']+1;
		
		agregar_cola($_SESSION['contador']);

	}

	if(vagon_actual() != 0){
		if(!isset($_SESSION['inicio'])){
			tiempo();
		
		}else{
			if(time() > $_SESSION['expira']){
				$_SESSION['contador2'] = $_SESSION['contador2']+1;
				eliminar_cola();
				tiempo();
				if(vagon_actual() == 0){
					unset($_SESSION['inicio']);
					unset($_SESSION['expira']);
				}
			}
		}
		
	}else{
		unset($_SESSION['inicio']);
		unset($_SESSION['expira']);
	}

?>