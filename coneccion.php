if(isset($_GET['usuario']) && intval($_GET['usuario'])) {
    if(isset($_GET['contra']) && intval($_GET['contra'])) {
    	$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml  default
		$correo_usuario = intval($_GET['usuario']); //no default
		$contrasena = intval($_GET['contra']); //no default

		/* se conecta a la base de datos */
		$link = mysql_connect('localhost','username','password') or die('No se puede conectar a la base de datos');
		mysql_select_db('db_name',$link) or die('No se encuentra la tabla en la base de datos');

		/* query de coneccion de usuario */
		$query = "SELECT count(*) FROM usuarios WHERE correo = $correo_usuario AND contrasena = $contrasena";
		$result = mysql_query($query,$link) or die('Query erroneo:  '.$query);

		/* create one master array of the records */
		$posts = array();
		if(mysql_num_rows($result)) {
			while($post = mysql_fetch_assoc($result)) {
				$posts[] = array('post'=>$post);
			}
		}

		/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('posts'=>$posts));
	}
	else {
		header('Content-type: text/xml');
		echo '<posts>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</posts>';
	}

	/* disconnect from the db */
	@mysql_close($link);

		
    }

 }   