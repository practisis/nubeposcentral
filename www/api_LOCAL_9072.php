<?php
	$campos= array();
	$campos["PRODUCTOS"]=array('id_local|integer primary key AUTOINCREMENT','id|integer','formulado|text','codigo|text','precio|real','categoriaid|text','cargaiva|integer','productofinal|integer','materiaprima|integer','timespan|text UNIQUE','ppq|real default 0','color|text','servicio|integer default 0','estado|integer default 1','sincronizar|boolean default "true"','tieneimpuestos|boolean default "true"');
	$campos["CONFIG"]=array('id|integer primary key AUTOINCREMENT','nombre|text, razon|text','ruc|integer','telefono|integer','email|text','direccion|text','printer|text','serie|text default "001"','establecimiento|text default "001"','sincronizar|boolean default "false"','encabezado|integer default 3','largo|integer default 18','nombreterminal|text default "Tablet 1"','pais|text default ""','id_idioma|integer default 1','sin_documento|boolean default "false"','con_nombre_orden|boolean default "false"','con_propina|boolean default "false"','con_tarjeta|boolean default "false"','con_shop|boolean default "false"','con_notasorden|boolean default "true"',' con_comanderas|boolean default "true"','printercom|text default ""',' con_localhost|boolean default "true"','ip_servidor|text default ""','con_mesas|boolean default "true"','logo|text default ""','id_version_nube|integer default 0','pide_telefono|boolean default "false"','telefono_inte|text default ""','mensajefinal|text default ""','paquete|integer default 1','terminos_condiciones|boolean default "true"','id_locales|integer default 0','key|text default ""','numero_contribuyente|integer default 0','obligado_contabilidad|boolean default "false"','prueba_produccion|boolean default "true"','tiene_factura_electronica|boolean default "false"','email_fact|text default ""','mensaje_factura|text default ""','respaldar|boolean default "false"','marcaprint|text default ""','modelprint|text default ""','addressprint|text default ""','typeprint|text default ""','ruc2|text default ""');
	$campos["LOGACTIONS"]=array('id|integer primary key AUTOINCREMENT','time|numeric','descripcion|text','datos|text');
	$campos["FACTURAS_FORMULADOS"]=array('id|integer primary key AUTOINCREMENT','timespan_factura|text','timespan_formulado|text','cantidad|real','precio_unitario|real');
	$campos["MENU_CATEGORIAS"]=array('id|integer primary key AUTOINCREMENT','orden|integer default 1','nombre|text default ""','timespan|text UNIQUE','activo|boolean default "true"');
	$campos["MENU"]=array('id|integer primary key AUTOINCREMENT', 'fila|integer default 0', 'columna|integer default 0','idcatmenu|text','idproducto|text','timespan|text UNIQUE','activo|boolean default true');
	$campos["PERMISOS"]=array('id|integer primary key AUTOINCREMENT',' clave|text default "" UNIQUE','historial|boolean default false','configuracion|boolean default false','anular|boolean default false', 'impcierre|boolean default false','productos|boolean default false','activo|boolean default false','vertotales|boolean default false','irnube|boolean default false');
	$campos["empresa"]=array('id|integer primary key AUTOINCREMENT','nombre|nteger','nombreempresa|text','id_barra|text','barra_arriba|text');
	$campos["CATEGORIAS"]=array('id|integer primary key AUTOINCREMENT', 'categoria|text', 'activo|integer', 'existe|integer' , 'timespan|text UNIQUE', 'sincronizar|boolean default "true"');
	$campos["CLIENTES"]=array('id|integer primary key AUTOINCREMENT','nombre|text', 'cedula|text UNIQUE', 'email|text', 'direccion|text', 'telefono|text','existe|integer','timespan|TEXT','sincronizar|boolean default "true"');
	$campos["FACTURAS"]=array('id|integer primary key AUTOINCREMENT','timespan|text','clientName|','RUC|','address|','tele|','fetchJson|','paymentsUsed|','cash|','cards|','cheques|','vauleCxC|','paymentConsumoInterno|','tablita|','aux|' ,'acc|','echo|real default 0','fecha|','anulada|integer default 0','sincronizar|boolean default "false"','total|real','subconiva|real','subsiniva|real','iva|real','servicio|real','descuento|real','nofact|text','dataimpuestos|text default ""','propina|numeric default 0','order_id|text default ""');
	$campos["PRESUPUESTO"]=array('id|integer primary key AUTOINCREMENT','timespan|text','valor|real','fecha|integer UNIQUE','transacciones|integer');
	$campos["IMPUESTOS"]=array('id|integer primary key AUTOINCREMENT','nombre|text default ""','porcentaje|numeric default 0.00','activo|boolean default "true"','timespan|text default "" UNIQUE','sincronizar|boolean default "false"');
	$campos["MODIFICADORES"]=array('id|integer primary key AUTOINCREMENT','no_modificador|integer default 0','id_formulado|text default ""','nombre|text default ""','valor|numeric default 0.00','activo|boolean default true','id_formulado_descuento|text default ""','timespan|text default "" UNIQUE','sincronizar|boolean default "false"');
	$campos["TIPO_MESA"]=array('id|integer primary key AUTOINCREMENT','imagen_activa|text default "mesapequenaanchaa.png"','imagen_inactiva|text default "mesapequenaanchai.png"','es_mesa|boolean default "true"','timespan|text default "" UNIQUE');		
	$campos["MESAS"]=array('id|integer primary key AUTOINCREMENT','left|real default 0','top|real default 0','id_tipomesa|text default ""','activo|boolean default "true"','nombre|text default ""','timespan|text default "" UNIQUE','enuso|boolean default "false"','tab|integer default 1');
	$campos["MESAS_DATOS"]=array('id|integer primary key AUTOINCREMENT','id_mesa|text default ""','cliente|text default ""','id_cliente|text default ""','activo|boolean default "true"','id_factura|text default ""','hora_activacion|integer default 0','hora_desactivacion|integer default 0','pax|integer default 0','timespan|text default "" UNIQUE','sincronizar|boolean default "false"');
	$campos["MESAS_CONSUMOS"]=array('id|integer primary key AUTOINCREMENT','id_mesa|text default ""','details|text default ""','agregados|text default ""','notas|text default ""','hora|integer default 0','id_real|integer default 0');
	$campos["LOCALES"]=array('id|integer primary key AUTOINCREMENT','local|text default ""','activo|boolean default "true"','timespan|text default "" UNIQUE');
	$campos["PROPINAS"]=array('id|integer primary key AUTOINCREMENT','valor|numeric default 0','es_porcentaje|boolean default "false"','activo|boolean default "true"','timespan|text default "" UNIQUE');
	//print_r($campos);
	function VerificarCampos($tabla){
		$db = new PDO('sqlite:PractisisMobile.sqlite3');
		$res = $db->query('SELECT sql from sqlite_master WHERE type = "table" and name like '."'".$tabla."'");
		//echo'SELECT sql from sqlite_master WHERE type = "table" and name like '."'".$tabla."'";
		foreach($res as $row){
			$sqlvec=explode('(',str_replace(")","",$row[0]));
			$camposvec=explode(',',$sqlvec[1]);
			$i=0;
			foreach($camposvec as $filas) {				
				$cols=explode(" ",trim($filas));
				$nombrecol=$cols[0];
				$camposvec[$i]=$nombrecol;
				$i++;			
			}
			$campostabla=$GLOBALS["campos"][$tabla];
			foreach($campostabla as $n) {
				$clave=-1;
				$cols=explode("|",trim($n));				
				$nombrecol=$cols[0];
				if(in_array($nombrecol, $camposvec)==false){
					$db->exec("ALTER TABLE ".$tabla." ADD COLUMN ".str_replace("|"," ",$n));			
				}
			
			}
		}
	}
	function iniciaDB(){
		$db = new PDO('sqlite:PractisisMobile.sqlite3');
		
		VerificarCampos('PRODUCTOS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS CONFIG (id integer primary key AUTOINCREMENT, nombre text, razon text , ruc integer, telefono integer , email text , direccion text, printer text,serie text default "001",establecimiento text default "001",sincronizar boolean default "false",encabezado integer default 3,largo integer default 18, nombreterminal text default "Tablet 1",pais text default "",id_idioma integer default 1,sin_documento boolean default "false",con_nombre_orden boolean default "false",con_propina boolean default "false",con_tarjeta boolean default "false",con_shop boolean default "false",con_notasorden boolean default "true", con_comanderas boolean default "true", printercom text default "", con_localhost boolean default "true",ip_servidor text default "",con_mesas boolean default "false",logo text default "",id_version_nube integer default 0,pide_telefono boolean default "false",telefono_inte text default "",mensajefinal text default "",paquete integer default 1,terminos_condiciones boolean default "true",id_locales integer default 0,key text default "",numero_contribuyente integer default 0,obligado_contabilidad boolean default "false",prueba_produccion boolean default "true",tiene_factura_electronica boolean default "false",email_fact text default "",mensaje_factura text default "",respaldar boolean default "false",marcaprint text default "",modelprint text default "",addressprint text default "",typeprint text default "", ruc2 text default "")');	
		VerificarCampos('CONFIG');
		
		$db->exec('CREATE TABLE IF NOT EXISTS LOGACTIONS (id integer primary key AUTOINCREMENT, time numeric, descripcion text, datos text)');	
		VerificarCampos('LOGACTIONS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS FACTURAS_FORMULADOS (id integer primary key AUTOINCREMENT, timespan_factura text, timespan_formulado text , cantidad real, precio_unitario real)');	
		VerificarCampos('FACTURAS_FORMULADOS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS MENU_CATEGORIAS (id integer primary key AUTOINCREMENT, orden integer default 1,nombre text default "", timespan text UNIQUE, activo boolean default "true")');	
		VerificarCampos('MENU_CATEGORIAS');
		
		/*var mitimecat=getTimeSpan();
		$db->exec('INSERT INTO MENU_CATEGORIAS (orden,nombre,timespan) values (?,?,?)',[1,'Productos',mitimecat]);*/
		
		$db->exec('CREATE TABLE IF NOT EXISTS MENU (id integer primary key AUTOINCREMENT, fila integer default 0, columna integer default 0,idcatmenu text,idproducto text, timespan text UNIQUE, activo boolean default true)');	
		VerificarCampos('MENU');
		
		$db->exec('CREATE TABLE IF NOT EXISTS PERMISOS (id integer primary key AUTOINCREMENT, clave text default "" UNIQUE, historial boolean default false,configuracion boolean default false,anular boolean default false, impcierre boolean default false,productos boolean default false,activo boolean default false,vertotales boolean default false,irnube boolean default false)');
		VerificarCampos('PERMISOS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS IMPUESTOS (id integer primary key AUTOINCREMENT, nombre text default "",porcentaje numeric default 0.00,activo boolean default true,timespan text default "" UNIQUE,sincronizar boolean default "false")');	
		VerificarCampos('IMPUESTOS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS MODIFICADORES (id integer primary key AUTOINCREMENT,no_modificador integer default 0,id_formulado text default "",nombre text default "",valor numeric default 0.00,activo boolean default true,id_formulado_descuento text default "",timespan text default "" UNIQUE,sincronizar boolean default "false")');	
		VerificarCampos('MODIFICADORES');
		
		$db->exec('CREATE TABLE IF NOT EXISTS PROPINAS (id integer primary key AUTOINCREMENT,valor numeric default 0,es_porcentaje boolean default "false",activo boolean default "true",timespan text default "" UNIQUE)');	
		VerificarCampos('PROPINAS');	
		
		$db->exec('CREATE TABLE IF NOT EXISTS empresa (id integer primary key AUTOINCREMENT, nombre integer, nombreempresa text, id_barra text, barra_arriba text )');	 
		VerificarCampos('empresa'); 
			
		//$db->exec('DROP TABLE IF EXISTS CATEGORIAS');
		$db->exec('CREATE TABLE IF NOT EXISTS CATEGORIAS (id integer primary key AUTOINCREMENT, categoria text, activo integer, existe integer , timespan text UNIQUE, sincronizar boolean default "true"  )');
		VerificarCampos('CATEGORIAS');
		
			
		//$db->exec('DROP TABLE IF EXISTS CLIENTES');
		$db->exec('CREATE TABLE IF NOT EXISTS CLIENTES (id integer primary key AUTOINCREMENT,nombre text, cedula text UNIQUE, email text, direccion text, telefono text,existe integer,timespan TEXT, sincronizar boolean default "true")');
		VerificarCampos('CLIENTES');
		$result = $db->query('SELECT COUNT(id)  as cuantos FROM CLIENTES');
		$i=0;
		foreach($result as $row){
			$i=(int)$row['cuantos'];
		}
		if((int)$i==0){
			IngresaClientes();		
		}		
		
		//$db->exec('DROP TABLE IF EXISTS FACTURAS');
		$db->exec('CREATE TABLE IF NOT EXISTS FACTURAS (id integer primary key AUTOINCREMENT,timespan text ,clientName,RUC,address,tele,fetchJson,paymentsUsed,cash,cards,cheques,vauleCxC,paymentConsumoInterno,tablita,aux ,acc,echo real default 0,fecha,anulada integer default 0,sincronizar boolean default "false",total real,subconiva real,subsiniva real,iva real,servicio real,descuento real,nofact text,dataimpuestos text default "",propina numeric default 0,order_id text default "");');		
		VerificarCampos("FACTURAS");
		
		
		$db->exec('CREATE TABLE IF NOT EXISTS CAJA (id integer primary key AUTOINCREMENT,hora_ingreso text,hora_salida text,activo integer,sobrante_faltante real,total real,establecimiento text,autorizacion text);');
		
		$db->exec('CREATE TABLE IF NOT EXISTS CAJA_APERTURA_CIERRE (id integer primary key AUTOINCREMENT,id_caja integer,valor_apertura real,movimiento integer);');
		
		$db->exec('CREATE TABLE IF NOT EXISTS PRESUPUESTO (id integer primary key AUTOINCREMENT,timespan text,valor real,fecha integer UNIQUE,transacciones integer);');		
		VerificarCampos('PRESUPUESTO');
		
		$db->exec('CREATE TABLE IF NOT EXISTS TIPO_MESA (id integer primary key AUTOINCREMENT,imagen_activa text default "mesapequenaanchaa.png",imagen_inactiva text default "mesapequenaanchai.png",es_mesa boolean default "true",timespan text default "" UNIQUE);');		
		VerificarCampos('TIPO_MESA');
		
		$db->exec('CREATE TABLE IF NOT EXISTS MESAS (id integer primary key AUTOINCREMENT,left real default 0,top real default 0, id_tipomesa text default "",activo boolean default "false",nombre text default "",timespan text default "" UNIQUE,enuso boolean default "false",tab integer default 1);');
		VerificarCampos('MESAS');
		
		$db->exec('CREATE TABLE IF NOT EXISTS MESAS_DATOS (id integer primary key AUTOINCREMENT,id_mesa text default "",cliente text default "",id_cliente text default "",activo boolean default "true",id_factura text default "",hora_activacion integer default 0,hora_desactivacion integer default 0,pax integer default 0,timespan text default "" UNIQUE,sincronizar boolean default "false");');		
		VerificarCampos('MESAS_DATOS');

		$db->exec('CREATE TABLE IF NOT EXISTS MESAS_CONSUMOS (id integer primary key AUTOINCREMENT,id_mesa text default "",details text default "",agregados text default "",notas text default "",hora integer default 0,id_real integer default 0)');		
		VerificarCampos('MESAS_CONSUMOS');

		//setea el session storage de la mesa
		//sessionStorage.setItem("mesa_activa","");
		//

		$db->exec('CREATE TABLE IF NOT EXISTS LOCALES (id integer primary key AUTOINCREMENT, local text default "",activo boolean default "true",timespan text default "" UNIQUE);');
		VerificarCampos('LOCALES');
		echo "ok";

	}
	function insertaTablas($tabla){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$inicia =0;
			$stmt = $db1->prepare('INSERT INTO logActualizar (tabla , incicial ,final) VALUES (?,?,? );');
			$db1->beginTransaction();
			$stmt->execute(array($tabla, $inicia, $inicia));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}  	
	}
	function IngresaClientes(){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$inicia =0;
			$stmt = $db1->prepare('INSERT INTO CLIENTES(id,nombre,cedula,existe)VALUES(?,?,?,?);');
			$db1->beginTransaction();
			$stmt->execute(array("1","Consumidor Final","9999999999999",1));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}  		
    }
	function InsertaProducto($itempr){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$cargaiva=0;
			$imp=explode('|',$itempr->formulado_tax_id);
			if(in_array("1", $imp)==true){
				$cargaiva=1;							
				$stmt = $db1->prepare('INSERT INTO PRODUCTOS (id,formulado,codigo,precio,categoriaid,cargaiva,productofinal,materiaprima) VALUES (?,?,?,?,?,?,?,?);');
				$db1->beginTransaction();
				$stmt->execute(array($itempr->formulado_id,$itempr->formulado_nombre,$itempr->formulado_codigo,$itempr->formulado_precio,$itempr->formulado_tipo,$cargaiva,1,$itempr->formulado_matprima));
				$db1->commit();
			}
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}  	
        
    }
	function metedatoscat($itemc){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('INSERT INTO CATEGORIAS(id,categoria,activo,existe)VALUES(?,?,?,?);');
			$db1->beginTransaction();
			$stmt->execute(array($itemc->categoria_id,$itemc->categoria_nombre,1,1));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}	       
    }
	function Ingresaconfig(){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('INSERT INTO CONFIG(nombre)VALUES(?);');
			$db1->beginTransaction();
			$stmt->execute(array("Empresa Test"));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}      		
    }
	function metedatoscliente($itemc){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('INSERT INTO CLIENTES(id,nombre,cedula,telefono,direccion,email,existe)VALUES(?,?,?,?,?,?,?)');
			$db1->beginTransaction();
			$stmt->execute(array($itemc->id,$itemc->nombre,$itemc->cedula,$itemc->telefono,$itemc->direccion,$itemc->email,1));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerDatosProducto($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT p.*,c.categoria as categ FROM PRODUCTOS p, CATEGORIAS c WHERE p.timespan='.$id.' and p.categoriaid=c.timespan;');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			echo 'okp@@@'.json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerDatosCliente($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT * FROM CLIENTES WHERE id='.$id.';');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			echo 'okc@@@'.json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerDatosFacturast($id,$clave){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT * FROM FACTURAS WHERE id='.$id.';');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$result1 = $db1->query('SELECT id from permisos where anular=true and activo=true and clave like '.$id.';');
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			echo 'okft@@@'.json_encode($dbh).'@@@'.json_encode($dbh1);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	
	function DataEmpresa(){
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');		
		$result = $db1->query("SELECT nombre,direccion,telefono from config WHERE id=1");
		$send='"empresa":{';
		foreach($result as $row){
			$send.='"nombre":"'.$row['nombre'].'","direccion":"'.$row['direccion'].'-'.$row['telefono'].'"';
		}
		$send.='},';
		return $send;
	}
	
	function APICategorias($objcategorias){
		if($objcategorias->Categorias!=null){
			$categorias=$objcategorias->Categorias;
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$db1->query('delete from categorias');
			$db1->query("delete from sqlite_sequence where name='CATEGORIAS'");
			foreach($categorias as $key=>$value){
				$catnombre=$value->categoria_nombre;
				$catimespan=$value->categoria_timespan;
				$result = $db1->query("INSERT OR IGNORE INTO CATEGORIAS(categoria,activo,existe,timespan,sincronizar)values('".$catnombre."','1','1','".$catimespan."','false'");	
			}
			return "ok";
		}
	}
	
	function APIModificadoresProductos($objmodif,$objproductos){
		if($objmodif->modificadores!=null){
			$modif=$objmodif->modificadores;
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$db1->query('delete from MODIFICADORES');
			$db1->query("delete from sqlite_sequence where name='MODIFICADORES'");
			foreach($modif as $key=>$value){
				$no_modif=$modif->no_modif;
				$id_formulado=$modif->id_formulado;
				$nombre=$modif->nombre;
				$valor=$modif->valor;
				$id_form_desc=$modif->id_form_desc;
				$activo=$modif->activo;
				$timespan=$modif->timespan;
				$result = $db1->query("INSERT OR IGNORE INTO MODIFICADORES(no_modificador,id_formulado,nombre,valor,id_formulado_descuento,activo,timespan) VALUES();");	
			}
			
			$produc=$objproductos->Productos;
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$db1->query('delete from productos');
			$db1->query("delete from sqlite_sequence where name='PRODUCTOS'");
			foreach($produc as $key=>$value){
				$nombre=$value->formulado_nombre;
				$codigo=$value->formulado_codigo;
				$precio=$value->formulado_precio;
				$timespancat=$value->categoria_timespan;
				$cargaiva=$value->cargaiva;
				$productofinal=$value->formulado_productofinal;
				$materiaprima=$value->formulado_matprima;
				$timespan=$value->formulado_timespan;
				$cargaservicio=$value->carga_servicio;
				$color=$value->color;
				$activo=$value->activo;
				$tieneimpuestos=$value->tieneimpuestos;
				
				$result=$db1->query('INSERT OR IGNORE INTO PRODUCTOS(formulado,codigo,precio,categoriaid,cargaiva,productofinal,materiaprima,timespan,servicio,sincronizar,color,estado,tieneimpuestos) VALUES("'.$nombre.'", "'.$codigo.'" ,'.$precio.','.$timespancat.','.$cargaiva.','.$productofinal.','.$materiaprima.',"'.$timespan.'",'.$cargaservicio.',"false","'.$color.'",'.$activo.',"'.$tieneimpuestos.'")');
				
			}
			echo "ok";
		}
	}
	
	function APIClientes($clientes){
			$clien=$clientes->Clientes;
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$db1->query('delete from clientes');
			$db1->query("delete from sqlite_sequence where name='CLIENTES'");
			foreach($clien as $key=>$value){
				$result=$db1->query('INSERT OR IGNORE INTO CLIENTES(nombre,cedula,email,direccion,telefono,sincronizar,existe,timespan) VALUES("'.$value->nombre.'" , "'.$value->cedula.'" , "'.$value->email.'" , "'.$value->direccion.'" ,  "'.$value->telefono.'" ,  "false" , "0" , "0" )');
			}
			echo "ok";
	}
	
	function APIPresupuesto($presupuesto){
		$presup=$presupuesto->presupuesto;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from presupuesto');
		$db1->query("delete from sqlite_sequence where name='PRESUPUESTO'");
		foreach($presup as $key=>$value){
			$result=$db1->query('INSERT OR IGNORE INTO PRESUPUESTO(timespan,valor,fecha,transacciones) VALUES("'.$value->timespan.'",'.$value->valor.','.$value->fecha.','.$value->transacciones.')');
		}
		echo "ok";
	}
	
	function APICategoriasMenu($categoriasmenu){
		$catmenu=$categoriasmenu->menucategorias;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from MENU_CATEGORIAS');
		$db1->query("delete from sqlite_sequence where name='MENU_CATEGORIAS'");
		foreach($catmenu as $key=>$value){
			$result=$db1->query('INSERT OR IGNORE INTO MENU_CATEGORIAS(orden,nombre,timespan,activo)VALUES('.$value->orden.',"'.$value->nombre.'","'.$value->timespan.'","'.$value->activo.'")');
		}
		echo "ok";
	}
	
	function APIMenuDiseno($menudiseno){
		$menu=$menudiseno->menu;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from MENU');
		$db1->query("delete from sqlite_sequence where name='MENU'");
		foreach($menu as $key=>$value){
			$result=$db1->query('INSERT INTO MENU(fila,columna,idcatmenu,idproducto,timespan,activo) SELECT '.((int)$value->fila+1).','.$value->columna.',"'.$value->idcatmenu.'","'$value->idproducto.'","'$value->timespan.'","'.$value->activo.'" WHERE NOT EXISTS(SELECT 1 FROM MENU WHERE timespan like "'.$value->timespan.'")');
		}
		echo "ok";
	}
	
	function APIProductosProfesional(){
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query("INSERT OR IGNORE INTO CATEGORIAS(categoria,activo,existe,timespan,sincronizar)values('Personalizada','1','1','-14','true');");
		$db1->query('INSERT OR IGNORE INTO PRODUCTOS(formulado,codigo,precio,categoriaid,cargaiva,productofinal,materiaprima,timespan,servicio,sincronizar,color,estado,tieneimpuestos) VALUES("Personalizado", "1414" ,0,-14,0,1,0,"-14",0,"true","",1,"true");');
		echo 'ok';
	}
	
	function APIExtra($extra){
		$extras=$extra->extras;
		$imp=$impuestos->impuestos;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from MENU');
		$db1->query("delete from sqlite_sequence where name='MENU'");
		foreach($extras as $key=>$value){
			$result=$db1->query('UPDATE CONFIG SET pais="'.$value->pais.'",id_idioma = "'.$value->idioma.'",sin_documento="'.$value->documento.'",con_nombre_orden="'.$value->orden.'",con_propina="'.$value->propina.'",con_tarjeta="'.$value->tarjeta.'",con_shop="'.$value->shop.'",ip_servidor="'.$value->ipservidor.'",con_mesas="'.$value->mesas.'",logo="'.$value->logo.'",id_version_nube="'+.$value->id_version_nube.'",pide_telefono="'.$value->pide_telefono.'",telefono_inte="'.$value->telefono_inte.'",mensajefinal="'+.$value->mensajefinal.'",terminos_condiciones="'.$value->terminos.'",id_locales="'.$value->id_locales.'",email_fact="'.$value->email_fact.'",key="'.$value->key.'",numero_contribuyente="'.$value->numero_contribuyente.'",obligado_contabilidad="'.$value->obligado_contabilidad.'",prueba_produccion="'.$value->prueba_produccion.'",tiene_factura_electronica="'.$value->tiene_factura_electronica.'",mensaje_factura="'.$value->msj_factura_electronica.'",respaldar="'.$value->respaldar.'" WHERE id=1');
		}
		echo 'ok';
	}
	
	function APIImpuestos($impuesto){
		$value=$impuesto;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$result=$db1->query("INSERT OR IGNORE INTO IMPUESTOS (nombre,porcentaje,activo,timespan) values ('".$value->nombre."','".$value->porcentaje."','".$value->activo."','".$value->id."')";
		echo 'ok';
	}
	
	function APIMesas($mtipomesas,$mmesas){
		$tipomesas=$mtipomesas->tipomesas;
		$mesas=$mmesas->mesas;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from TIPO_MESA');
		$db1->query("delete from sqlite_sequence where name='TIPO_MESA'");
		foreach($tipomesas as $key=>$value){
			$result=$db1->query('INSERT INTO TIPO_MESA(imagen_activa,imagen_inactiva,es_mesa,timespan) SELECT "'.$value->imagen_activa.'","'.$value->imagen_inactiva.'","'.$value->es_mesa.'","'.$value->id.'" WHERE NOT EXISTS(SELECT 1 FROM TIPO_MESA WHERE timespan like "'.$value->id.'")');
		}
		
		$db1->query('delete from MESAS');
		$db1->query("delete from sqlite_sequence where name='MESAS'");
		foreach($mesas as $key=>$value){
			$result=$db1->query('INSERT INTO MESAS(left,top,id_tipomesa,activo,nombre,timespan,tab) SELECT '.$value->left.','.$value->top.',"'.$value->tipo_mesa.'","'.$value->activo.'","'.$value->nombre.'","'.$value->id.'","'.$value->tab.'" WHERE NOT EXISTS(SELECT 1 FROM MESAS WHERE timespan like "'.$value->id.'")');
		}
		echo 'ok';
	}
	
	function APILocales($mlocales){
		$locales=$mlocales->locales;
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('delete from LOCALES');
		$db1->query("delete from sqlite_sequence where name='LOCALES'");
		foreach($locales as $key=>$value){
			$result=$db1->query('INSERT INTO LOCALES(local,activo,timespan) SELECT "'.$value->local.'","'.$value->activo.'","'.$value->timespan.'" WHERE NOT EXISTS(SELECT 1 FROM LOCALES WHERE timespan like "'.$value->timespan.'")');
		}
		echo 'ok';
	}
	
	function APILog($hora,$texto,$datos){
		if($datos==null)
			$datos='';
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$db1->query('insert into LOGACTIONS (time,descripcion,datos) values ("'.$hora.'","'.$texto.'","'.$datos.'")');
		echo 'ok';
	}
	
	function RECCategorias($categorias){
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$cadenaupdate='';
		$n=0;
		foreach($categorias as $key=>$value){
			$db1->query("INSERT OR IGNORE INTO CATEGORIAS (categoria,activo,existe,timespan,sincronizar)values('".$value->	formulado_tipo."','1','1','".$value->timespan."','false')");
			$db1->query("UPDATE CATEGORIAS SET categoria = '".$value->formulado_tipo."' WHERE timespan='".$value->timespan."'");
			
			$cadenaupdate.=$value->idreal.",";
		}
		echo $cadenaupdate;
	}
	
	function RECModificadoresProductos($modificadores,$productos){
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$cadenaupdate='';
		
		foreach($modificadores as $key=>$value){
			$db1->query('INSERT OR IGNORE INTO MODIFICADORES (no_modificador, id_formulado ,nombre, valor, id_formulado_descuento, activo, timespan) VALUES('.$value->no_modif.', "'.$value->id_formulado.'" ,"'.$value->nombre.'",'.$value->valor.',"'.$value->id_form_desc.'","'.$value->activo.'","'.$value->timespan.'")');
			$db1->query('UPDATE MODIFICADORES SET no_modificador="'.$value->no_modif.'",id_formulado="'.$value->id_formulado.'",nombre="'.$value->nombre.'",valor="'.$value->id_form_desc.'",id_formulado_descuento="'.$value->id_form_desc.'",activo="'.$value->activo.'",timespan="'.$value->timespan.'" WHERE nombre like "'.$value->nombre.'"');
			$cadenaupdate.=$value->id.",";
		}
		
		foreach($productos as $key=>$valuep){
			$db1->query('INSERT OR IGNORE INTO PRODUCTOS(formulado,codigo,precio,categoriaid,cargaiva,productofinal,materiaprima,timespan,servicio,sincronizar,color,estado,tieneimpuestos)VALUES("'.$valuep->formulado.'","'.$valuep->formulado_codigo.'",'.$valuep->precio.',"'.$valuep->formulado_tipo_timespan.'",'.$valuep->ivacompra.','.$valuep->esproductofinal.','.$valuep->esmateria.',"'.$valuep->timespan.'" ,'.$valuep->tieneservicio.',"false","'.$valuep->color.'",'.$valuep->activo.',"'.$valuep->tieneimpuestos.'")');
			
			$db1->query('UPDATE PRODUCTOS SET formulado="'.$valuep->formulado.'",codigo="'.$valuep->formulado_codigo.'",precio='.$valuep->precio.',categoriaid="'.$valuep->formulado_tipo_timespan.'",cargaiva='.$valuep->ivacompra.',productofinal='.$valuep->esproductofinal.',materiaprima='.$valuep->esmateria.',timespan="'.$valuep->timespan.'",servicio='.$valuep->tieneservicio.',sincronizar="false",color="'.$valuep->color.'",estado='.$valuep->activo.' ,tieneimpuestos="'.$valuep->tieneimpuestos.'" WHERE timespan="'.$valuep->timespan.'"');
			
			$cadenaupdate.=$valuep->id.",";
		}
		echo $cadenaupdate;
	}
	
	function RECClientes($clientes){
		$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		$cadenaupdate='';
		
		foreach($clientes as $key=>$value){
			$db1->query('INSERT OR IGNORE INTO CLIENTES(nombre,cedula,email,direccion,telefono,sincronizar,existe,timespan) VALUES("'$value->nombre.'" , "'$value->cedula.'" , "'$value->email.'" , "'$value->direccion.'" ,  "'$value->telefono.'" ,  "false" , "0" , "0" )');
			
			$db1->query('UPDATE CLIENTES SET nombre=  "'$value->nombre.'"  , cedula = "'$value->cedula.'" , email="'$value->email.'" , direccion = "'$value->direccion.'" , sincronizar="false"  WHERE cedula="'$value->cedula.'"');
		}
		
		echo $cadenaupdate;
	}
	
	function RECEmpresalocalhost($empresa){
		$db1->query($db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		foreach($empresa as $key=>$value){
			$db1->query('UPDATE CONFIG SET nombre="'.$value->nombreempresa.'",razon = "'.$value->razon.'" , ruc2="'.$value->ruc.'",telefono ="'.$value->telefono.'",direccion="'.$value->direccion.'",serie="'.$value->serie.'",establecimiento="'.$value->establecimiento.'",nombreterminal="'.$value->nombreterminal.'" WHERE id=1');
		}
		echo "ok";
	}
	
	function RECEmpresa($empresa){
		$db1->query($db1 = new PDO('sqlite:PractisisMobile.sqlite3');
		foreach($empresa as $key=>$value){
			$db1->query('UPDATE CONFIG SET nombre="'.$value->nombreempresa.'",razon = "'.$value->razon.'" , ruc2="'.$value->ruc.'",telefono ="'.$value->telefono.'",direccion="'.$value->direccion.'",serie="'.$value->serie.'",establecimiento="'.$value->establecimiento.'",nombreterminal="'.$value->nombreterminal.'",pais="'.$value->pais.'",id_idioma = "'.$value->idioma.'",sin_documento="'.$value->documento.'",con_nombre_orden="'.$value->orden.'",con_propina="'.$value->propina.'",con_tarjeta="'.$value->tarjeta.'",con_shop="'.$value->shop.'",con_notasorden="'.$value->notas.'",con_comanderas="'.$value->comanderas.'",con_localhost="'.$value->localhost.'",ip_servidor="'.$value->ipservidor.'",con_mesas="'.$value->mesas.'",logo="'.$value->logo.'",id_version_nube="'.$value->id_version_nube.'",pide_telefono="'.$value->pide_telefono.'",telefono_inte="'.$value->telefono_inte.'",mensajefinal="'.$value->mensajefinal.'",terminos_condiciones="'.$value->terminos.'",id_locales="'.$value->id_locales.'",email_fact="'.$value->email_fact.'",key="'.$value->key.'",numero_contribuyente="'.$value->numero_contribuyente.'",obligado_contabilidad="'.$value->obligado_contabilidad.'",prueba_produccion="'.$value->prueba_produccion.'",tiene_factura_electronica="'.$value->tiene_factura_electronica.'",mensaje_factura="'.$value->msj_factura_electronica.'",respaldar="'.$value->respaldar.'" WHERE id=1');
		}
		echo "ok";
	}

	
	
	if ($_REQUEST['fun']=='iniciaDB'){
		iniciaDB();
	}
	else if ($_REQUEST['fun']=='Ingresaproductos'){
		Ingresaproductos($_REQUEST['prod']);
	}
	else if ($_REQUEST['fun']=='VerDatosProducto'){
		if((int)$_REQUEST['id']>0)
			VerDatosProducto((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='VerDatosCliente'){
		if((int)$_REQUEST['id']>0)
			VerDatosCliente((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='VerDatosFacturast'){
		if((int)$_REQUEST['id']>0)
			VerDatosFacturast((int)$_REQUEST['id'],$_REQUEST['clave']);
	}
	//funciones Ana
	else if($_REQUEST['fun']=='DataEmpresa'){
		DataEmpresa();
	}
	else if($_REQUEST['fun']=='ApiCategorias'){
		$categorias=json_decode($_REQUEST['categorias']);
		
		if($categorias!=null)
			APICategorias($categorias);
		
	}else if($_REQUEST['fun']=='ApiModificadoresProductos'){
		$modificadores=json_decode($_REQUEST['modificadores']);
		$productos=json_decode($_REQUEST['productos']);
		
		if($modificadores!=null||$productos!=null)
			APIModificadoresProductos($modificadores,$productos);
		
	}else if($_REQUEST['fun']=='ApiClientes'){
		$clientes=json_decode($_REQUEST['clientes']);
		
		if($clientes!=null)
			APIClientes($clientes);
	}else if($_REQUEST['fun']=='APIPresupuesto'){
		$presup=json_decode($_REQUEST['presupuesto']);
		
		if($presup!=null)
			APIPresupuesto($presup);
	}else if($_REQUEST['fun']=='APICategoriasMenu'){
		$catmenu=json_decode($_REQUEST['menucategorias']);
		
		if($catmenu!=null)
			APICategoriasMenu($catmenu);
	}else if($_REQUEST['fun']=='APIMenuDiseno'){
		$menu=json_decode($_REQUEST['menudiseno']);
		
		if($menu!=null)
			APIMenuDiseno($menu);
	}else if($_REQUEST['fun']=='APIProductosProfesional'){
			APIProductosProfesional();
	}else if($_REQUEST['fun']=='APIExtra'){
			APIExtra();
	}else if($_REQUEST['fun']=='APIImpuestos'){
		if($_REQUEST['dataimpuesto']!=null){
			APIImpuestos(json_decode($_REQUEST['dataimpuesto']));
		}
	}else if($_REQUEST['fun']=='APIMesas'){
		if($_REQUEST['tipomesas']!=null||$_REQUEST['mesas']){
			APIMesas(json_decode($_REQUEST['tipomesas']),json_decode($_REQUEST['mesas']));
		}
	}else if($_REQUEST['fun']=='APILocales'){
		if($_REQUEST['locales']!=null){
			APILocales(json_decode($_REQUEST['locales']));
		}
	}else if($_REQUEST['fun']=='APILog'){
		
			APILog($_REQUEST['hora'],$_REQUEST['texto'],$_REQUEST['datos']);
	}else if($_REQUEST['fun']=='RECCategorias'){
		
		if(json_decode($_REQUEST['categorias'])){
			RECCategorias(json_decode($_REQUEST['categorias']));
		}
	}else if($_REQUEST['fun']=='RECModificadoresProductos'){
		
		if(json_decode($_REQUEST['modificadores'])||json_decode($_REQUEST['productos'])){
			RECModificadoresProductos(json_decode($_REQUEST['modificadores']),json_decode($_REQUEST['productos']));
		}
	}else if($_REQUEST['fun']=='RECClientes'){
		if(json_decode($_REQUEST['clientes'])){
			RECClientes(json_decode($_REQUEST['clientes']));
		}
	}else if($_REQUEST['fun']=='RECEmpresalocalhost'){
		if(json_decode($_REQUEST['empresa'])){
			RECEmpresalocalhost(json_decode($_REQUEST['empresa']));
		}
	}else if($_REQUEST['fun']=='RECEmpresa'){
		if(json_decode($_REQUEST['empresa'])){
			RECEmpresa(json_decode($_REQUEST['empresa']));
		}
	}
	//fin funciones Ana
	
	$db = new PDO('sqlite:PractisisMobile.sqlite3');
	print "<table border=1>";

print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";

$result = $db->query('SELECT * FROM clientes');
foreach($db->query('SELECT * FROM clientes') as $row){
	echo json_encode($row);
}

foreach($result as $row)
{
	//echo json_encode($row);

print "<tr><td>".$row['id']."</td>";

print "<td>".$row['nombre']."</td>";

print "<td>".$row['cedula']."</td>";

print "<td>".$row['existe']."</td></tr>";

}

print "</table>";

/*try
{
//open the database

$db = new PDO('sqlite:PractisisMobileDb_PDO.sqlite');
$db = new PDO('sqlite:PractisisMobile');

//create the database

$db->exec('CREATE TABLE IF NOT EXISTS PRODUCTOS (id_local integer primary key AUTOINCREMENT,id integer, formulado text, codigo text, precio real, categoriaid text,cargaiva integer,productofinal integer,materiaprima integer,timespan text UNIQUE,ppq real default 0,color text,servicio integer default 0,estado integer default 1, sincronizar boolean default "true",tieneimpuestos boolean default "true")');   

 

//insert some data...

$db->exec("INSERT INTO Dogs (Breed, Name, Age) VALUES ('Labrador', 'Tank', 2);".

"INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .

"INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");

 

//now output the data to a simple html table...

print "<table border=1>";

print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";

$result = $db->query('SELECT * FROM Dogs');

foreach($result as $row)

{

print "<tr><td>".$row['Id']."</td>";

print "<td>".$row['Breed']."</td>";

print "<td>".$row['Name']."</td>";

print "<td>".$row['Age']."</td></tr>";

}

print "</table>";

// close the database connection

$db = NULL;

}

catch(PDOException $e)

{

print 'Exception : '.$e->getMessage();

}*/
?>