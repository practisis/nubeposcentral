<?php
/**/
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
	function insertalogactions($time,$descripcion,$datos){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$inicia =0;
			$stmt = $db1->prepare('INSERT INTO logactions (time,descripcion,datos) VALUES (?,?,? );');
			$db1->beginTransaction();
			$stmt->execute(array($time,$descripcion,$datos));
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
	function updatemesas($nombrecli,$idcli,$mitimespan,$now,$mesaactiva){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('UPDATE MESAS_DATOS SET cliente=?,id_cliente=?,id_factura=?,hora_desactivacion=?,activo=? WHERE id_mesa=? and activo=?;UPDATE MESAS SET enuso=? WHERE timespan=?;DELETE FROM MESAS_CONSUMOS WHERE id_mesa=?;');
			$db1->beginTransaction();
			$stmt->execute(array($nombrecli,$idcli,$mitimespan,$now,false,$mesaactiva,true,false,$mesaactiva,$mesaactiva));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}	       
    }
	function InsertaMesas($id,$fecha,$cant,$timespan){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');										
			$stmt = $db1->prepare('INSERT INTO MESAS_DATOS (id_mesa,hora_activacion,pax,timespan) values (?,?,?,?);UPDATE MESAS SET enuso=? WHERE timespan=?');
			$db1->beginTransaction();
			$stmt->execute(array($id,$fecha,$cant,$timespan,true,$id));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }	
	function EliminarMesas($id){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('DELETE FROM MESAS_CONSUMOS WHERE id_mesa=?');
			$db1->beginTransaction();
			$stmt->execute(array($id));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}	       
    }
	function InsertaMesasConsumos($id,$fecha,$details,$agreg,$notes,$idreal){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('INSERT INTO MESAS_CONSUMOS (id_mesa,hora,details,agregados,notas,id_real) values (?,?,?,?,?,?)');
			$db1->beginTransaction();
			$stmt->execute(array($id,$fecha,$details,$agreg,$notes,$idreal));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardaCliente($nombrep,$telefonop,$direccionp,$emailp,$cedulap,$timespanCliente){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('INSERT INTO CLIENTES(nombre,telefono,direccion,email,cedula,existe,timespan) SELECT ?,?,?,?,?,0,? WHERE NOT EXISTS(SELECT 1 FROM CLIENTES WHERE nombre = ? or cedula=? or email=?  );');
			$db1->beginTransaction();
			$stmt->execute(array($nombrep,$telefonop,$direccionp,$emailp,$cedulap,$timespanCliente,$nombrep,$cedulap,$emailp));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }	
	function ActualizarCliente($nombrep,$telefonop,$direccionp,$emailp,$cedulap,$idcliente){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');			
			$stmt = $db1->prepare('UPDATE CLIENTES SET nombre=?,telefono=?,direccion=?,email=?,cedula=? WHERE id=? AND NOT EXISTS(SELECT 1 FROM CLIENTES WHERE (cedula like ? or email like ?) and id!=?);');
			$db1->beginTransaction();
			$stmt->execute(array($nombrep,$telefonop,$direccionp,$emailp,$cedulap,$idcliente,$cedulap,$emailp,$idcliente));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }	
	function ActualizarConfiguracion($laprinter,$marca,$model,$direction,$type){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('SELECT count(*) as c from CONFIG');
			$stmt->execute();
			$result=$stmt->fetchAll();
			$dbh = array();
			$i=0;
			foreach ($result as $row) {
				$i++;
			}	
			if($i==0)						
				$stmt = $db1->prepare('INSERT INTO CONFIG (printer,printercom,marcaprint,modelprint,addressprint,typeprint) VALUES (?,?,?,?,?,?)');
			else
				$stmt = $db1->prepare('UPDATE CONFIG SET printer=?,printercom=?,marcaprint=?,modelprint=?,addressprint=?,typeprint=?  where id=1');
			$db1->beginTransaction();
			$stmt->execute(array($laprinter,$laprinter,$marca,$model,$direction,$type));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }	
	function ActualizarMedidas($encabezado,$largo){
		try {
			$stmt = $db1->prepare('UPDATE CONFIG set encabezado=?,largo=? WHERE id=1;');
			$db1->beginTransaction();
			$stmt->execute(array($encabezado,$largo));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardarNombre($tabname,$idioma,$sin_documento,$con_orden,$con_propina,$con_tarjeta,$con_shop,$con_notas,$con_comanderas,$con_mesas,$version_nub,$con_backup){
		try {
			$stmt = $db1->prepare('UPDATE CONFIG SET nombreterminal=?,sincronizar=?,id_idioma=?,sin_documento=?,con_nombre_orden=?,con_propina=?,con_tarjeta=?,con_shop=?,con_notasorden=?,con_comanderas=?,con_mesas=?,id_version_nube=?,respaldar=? where id=1;');
			$db1->beginTransaction();
			$stmt->execute(array($tabname,true,$idioma,$sin_documento,$con_orden,$con_propina,$con_tarjeta,$con_shop,$con_notas,$con_comanderas,$con_mesas,$version_nub,$con_backup));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardarProductosCategorias(){
		try {
			$stmt = $db1->prepare('INSERT OR IGNORE INTO CATEGORIAS(categoria,activo,existe,timespan,sincronizar)values(?,?,?,?,?);');
			$stmt1 = $db1->prepare('INSERT OR IGNORE INTO CATEGORIAS(categoria,activo,existe,timespan,sincronizar)values(?,?,?,?,?,?,?,?,?,?,?,?,?);');
			$db1->beginTransaction();
			$stmt->execute(array('Personalizada','1','1','-14',true));
			$stmt1->execute(array('Personalizado','1414','0','-14','0','1','0','-14','0','true','','1',true));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function EliminarLogactions($timehoy){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('DELETE FROM LOGACTIONS WHERE time <?');
			$db1->beginTransaction();
			$stmt->execute(array($timehoy));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('SELECT * FROM LOGACTIONS WHERE time>=? ORDER BY time desc');
			$stmt->execute(array($timehoy));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	    		
    }
	function GuardarConfiguracion1($nombreEsta,$razon,$ruc,$tel,$email,$dir,$serie,$establecimiento,$quehace){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');	
			if ($quehace=="update")
				$stmt = $db1->prepare('update CONFIG set nombre = ? , razon = ?, ruc = ? , telefono = ?, email = ?, direccion = ?,sincronizar=true,serie=?,establecimiento=?');
			else if($quehace=="insert")
				$stmt = $db1->prepare('INSERT INTO CONFIG(nombre , razon , ruc , telefono , email , direccion,serie,establecimiento) VALUES(?,?,?,?,?,?,?,?)');
			$db1->beginTransaction();
			$stmt->execute(array($nombreEsta,$razon,$ruc,$tel,$email,$dir,$serie,$establecimiento));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardarConfiguracion2($nombreEstable,$razonSo,$rucFac,$emailFac,$dirFac,$numcontribuyenteFac,$obligado,$activafacturacionelectronica,$telFac,$serieFac,$establecimientoFac,$msjFac){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');	
			$stmt = $db1->prepare('update CONFIG set nombre=?,razon=?,ruc2=?,email_fact=?,direccion=?,numero_contribuyente=?,obligado_contabilidad=?,tiene_factura_electronica=?,sincronizar="true",telefono=?,serie=?,establecimiento=?,mensaje_factura=? where id=1');			
			$db1->beginTransaction();
			$stmt->execute(array($nombreEstable,$razonSo,$rucFac,$emailFac,$dirFac,$numcontribuyenteFac,$obligado,$activafacturacionelectronica,$telFac,$serieFac,$establecimientoFac,$msjFac));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardarConfiguracion($produccion){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('update CONFIG set prueba_produccion=?,sincronizar="true" where id=1');
			$db1->beginTransaction();
			$stmt->execute(array($produccion));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function GuardaImpuestos($porcentaje,$activo,$timespan){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('UPDATE IMPUESTOS set porcentaje=?,activo=?,sincronizar=? where timespan=?');
			$db1->beginTransaction();
			$stmt->execute(array($porcentaje,$activo,true,$timespan));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function InsertaImpuestos($impuesto,$porcentaje,$activo,$timespan){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('INSERT INTO IMPUESTOS (nombre,porcentaje,activo,timespan,sincronizar) VALUES(?,?,?,?,?)');
			$db1->beginTransaction();
			$stmt->execute(array($impuesto,$porcentaje,$activo,$timespan,true));
			$db1->commit();
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}         
    }
	function AnularFactura($id){
		try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');				
			$stmt = $db1->prepare('UPDATE FACTURAS SET anulada=?,sincronizar=?,fetchJson=? where id=?');
			$db1->beginTransaction();
			$stmt->execute(array(1,true,"replace(fetchJson, '".'"anulada" : "false"'."','".'"anulada" : "true"'."')",$id));
			$db1->commit();
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
			$stmt = $db1->prepare('SELECT p.*,c.categoria as categ FROM PRODUCTOS p, CATEGORIAS c WHERE p.timespan=? and p.categoriaid=c.timespan;');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();
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
			$stmt = $db1->prepare('SELECT * FROM CLIENTES WHERE id=?');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();			
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
			$stmt = $db1->prepare('SELECT * FROM FACTURAS WHERE id=?');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$stmt1 = $db1->prepare('SELECT id from permisos where anular=true and activo=true and clave like ?');
			$stmt1->execute(array($clave));
			$result1=$stmt1->fetchAll();			
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
<<<<<<< HEAD
	
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
=======
	function VerDatosFactura($id,$clave){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM FACTURAS WHERE id=?');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$stmt1 = $db1->prepare('SELECT id from permisos where anular=true and activo=true and clave like ?');
			$stmt1->execute(array($clave));
			$result1=$stmt1->fetchAll();			
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			echo 'okf@@@'.json_encode($dbh).'@@@'.json_encode($dbh1);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function CambiarFormaPagoFactura($cadenapago,$efectivo,$tarjetas,$cheques,$cc,$miid){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('UPDATE FACTURAS SET paymentsUsed=?,cash=?,cards=?,cheques=?,vauleCxC=? WHERE id=?');
			$db1->beginTransaction();
			$stmt->execute(array($cadenapago,$efectivo,$tarjetas,$cheques,$cc,$miid));
			$db1->commit();			
		} 
		catch (Exception $e){
			$db1->rollBack();
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerificarClave($miclave){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');	
			$stmt = $db1->prepare('SELECT id from permisos where anular=true and activo=true and clave like ?');
			$stmt->execute(array($miclave));
			$result=$stmt->fetchAll();									
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo 'okvc@@@'.json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	                        
    }	
	function SacaImpuestos(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT * FROM IMPUESTOS WHERE activo=true group by nombre order by id');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function SacaProductos($idcategoria){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM PRODUCTOS WHERE categoriaid=? and productofinal=1 and estado=1 ORDER BY formulado asc');
			$stmt->execute(array($idcategoria));
			$result=$stmt->fetchAll();
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function SacaProductos1($idlocal,$iddiseno){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT COUNT(id_local) as cuantos FROM PRODUCTOS WHERE id_local=?');
			$stmt->execute(array($idlocal));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			if($iddiseno==1)
				$stmt1 = $db1->prepare('SELECT p.*,m.timespan as timemenu FROM PRODUCTOS p,MENU m WHERE p.timespan=m.idproducto and m.activo="true" and p.id_local=?');				
			else
				$stmt1 = $db1->prepare('SELECT * FROM PRODUCTOS WHERE id_local=?');	
			$stmt1->execute(array($idlocal));
			$result1=$stmt1->fetchAll();	
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			echo json_encode($dbh).'@@@'.json_encode($dbh1);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function formarCategorias($idcategoria){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT c.* FROM CATEGORIAS c, PRODUCTOS p where c.timespan in (p.categoriaid) and p.productofinal=1 and p.estado=1 and p.timespan != "-14" group by categoria ORDER BY categoria asc');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerConf(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT establecimiento,serie,largo,encabezado,tiene_factura_electronica from config where id=1');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerConf1(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT printer,printercom,marcaprint,modelprint,addressprint,typeprint FROM CONFIG where id=1');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerConfiguracion(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT nombreterminal as c,id_idioma,id_version_nube,sin_documento,con_nombre_orden,con_propina,con_tarjeta,con_shop,con_notasorden,con_comanderas,con_localhost,con_mesas,pais,mensajefinal,respaldar from CONFIG where id=1');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerConfiguracion1(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT * from CONFIG');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function NumFactura(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT MAX(aux)+1 as max FROM FACTURAS');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	
	function BuscarCliente($cedula){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('SELECT * FROM CLIENTES WHERE cedula=?');
			$stmt->execute(array($cedula));
			$result=$stmt->fetchAll();
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			echo json_encode($dbh);			
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function CuantosProductos(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT count(*) as cuantos from PRODUCTOS where estado=1 and id_local!=-1');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function SacarImpresora(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT printercom,printer FROM CONFIG where id=1');
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function SacarJson($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$result = $db1->query('SELECT fetchJson as j FROM FACTURAS where id=?');
			$dbh = array($id);
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function saberProducto($codigo){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT COUNT(codigo) as cuantos FROM PRODUCTOS WHERE codigo=?');
			$stmt->execute(array($codigo));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$stmt1 = $db1->prepare('SELECT * FROM PRODUCTOS WHERE codigo=?');	
			$stmt1->execute(array($codigo));
			$result1=$stmt1->fetchAll();	
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			echo json_encode($dbh).'@@@'.json_encode($dbh1);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function BuscarSugerencias2($nombre){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM PRODUCTOS WHERE formulado like ? and productofinal=1 and estado=1');
			$stmt->execute(array('%'.$nombre.'%'));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function BuscarSugerencias2new($nombre){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM PRODUCTOS WHERE (formulado like ? or codigo like ?) and productofinal=1 and estado=1');
			$stmt->execute(array('%'.$codigo.'%','%'.$codigo.'%'));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerificarNumero($valor){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT id from FACTURAS where CAST(aux as integer) = CAST(? as integer)');
			$stmt->execute(array($valor));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$stmt1 = $db1->prepare('SELECT MAX(CAST(aux as integer))+1 as max FROM FACTURAS');	
			$stmt1->execute();
			$result1=$stmt1->fetchAll();	
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			$stmt2 = $db1->prepare('SELECT serie,establecimiento from config where id=1');	
			$stmt2->execute();
			$result2=$stmt2->fetchAll();	
			$dbh2 = array();
			foreach ($result2 as $row2) {
				$dbh2[] = $row2;
			}
			echo json_encode($dbh).'@@@'.json_encode($dbh1).'@@@'.json_encode($dbh2);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function backupContent(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM FACTURAS;');
			$stmt->execute(array());
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			$stmt1 = $db1->prepare('SELECT * FROM FACTURAS_FORMULADOS;');	
			$stmt1->execute();
			$result1=$stmt1->fetchAll();	
			$dbh1 = array();
			foreach ($result1 as $row1) {
				$dbh1[] = $row1;
			}
			$stmt2 = $db1->prepare('SELECT * FROM MENU;');	
			$stmt2->execute();
			$result2=$stmt2->fetchAll();	
			$dbh2 = array();
			foreach ($result2 as $row2) {
				$dbh2[] = $row2;
			}
			$stmt3 = $db1->prepare('SELECT * FROM MENU_CATEGORIAS;');	
			$stmt3->execute();
			$result3=$stmt3->fetchAll();	
			$dbh3 = array();
			foreach ($result3 as $row3) {
				$dbh3[] = $row3;
			}
			$stmt4 = $db1->prepare('SELECT * FROM PRODUCTOS;');	
			$stmt4->execute();
			$result4=$stmt4->fetchAll();	
			$dbh4 = array();
			foreach ($result4 as $row4) {
				$dbh4[] = $row4;
			}
			echo json_encode($dbh).'@@@'.json_encode($dbh1).'@@@'.json_encode($dbh2).'@@@'.json_encode($dbh3).'@@@'.json_encode($dbh4);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function formarCategoriasMenu(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * from MENU_CATEGORIAS where activo="true" order by orden');
			$stmt->execute(array());
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function MaxMenu(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT MAX(fila) as max from menu where activo=true');
			$stmt->execute(array());
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function ProductosenCategoria($categoria,$fila){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('sELECT p.*, m.idcatmenu as idc,m.timespan as mtimespan,m.columna as col,m.fila as fila FROM PRODUCTOS p, MENU m WHERE m.idproducto=p.timespan and m.idcatmenu=? and activo="true" and fila=? ORDER BY m.columna asc');
			$stmt->execute(array($categoria,$fila));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function Modificadores($formualdo){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * from MODIFICADORES WHERE id_formulado LIKE ? and activo=? order by no_modificador asc');
			$stmt->execute(array($formualdo,true));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerPropinas(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * from PROPINAS WHERE activo=? order by es_porcentaje,valor asc');
			$stmt->execute(array(true));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerMesas(){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT m.top,m.left,m.nombre,m.timespan,t.imagen_activa as act,t.imagen_inactiva as inact,m.enuso,m.tab,t.es_mesa FROM MESAS m, TIPO_MESA t WHERE t.timespan=m.id_tipomesa and m.activo=?');
			$stmt->execute(array(true));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerPaxMesas($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT pax from mesas_datos where id_mesa=? and activo=?');
			$stmt->execute(array($id,true));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerMesasActivas($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT t.imagen_activa as act,m.* FROM TIPO_MESA t,MESAS m WHERE m.timespan=? and m.id_tipomesa=t.timespan');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function VerConsumosMesas($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM MESAS_CONSUMOS WHERE id_mesa=?');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function verFacturasFechas($fechaFiltro,$fechaFiltroh){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT * FROM FACTURAS WHERE anulada!=1 and fecha>=? and fecha<=?');
			$stmt->execute(array($fechaFiltro,$fechaFiltroh));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function verCuantasFacturasFechas($fechaFiltro,$fechaFiltroh){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');
			$stmt = $db1->prepare('SELECT count(*) as c FROM FACTURAS WHERE anulada=1 and fecha>=? and fecha<=?');
			$stmt->execute(array($fechaFiltro,$fechaFiltroh));
			$result=$stmt->fetchAll();			
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}			
			echo json_encode($dbh);
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
    }
	function BuscarClienteId($id){
        try {
			$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('SELECT * FROM CLIENTES WHERE id=?');
			$stmt->execute(array($id));
			$result=$stmt->fetchAll();
			$dbh = array();
			foreach ($result as $row) {
				$dbh[] = $row;
			}
			echo json_encode($dbh);			
		} 
		catch (Exception $e){
			echo "Failed: " . $e->getMessage();
		}	            
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
	else if ($_REQUEST['fun']=='VerDatosFactura'){
		if((int)$_REQUEST['id']>0)
			VerDatosFactura((int)$_REQUEST['id'],$_REQUEST['clave']);
	}
	else if ($_REQUEST['fun']=='CambiarFormaPagoFactura'){
		if((int)$_REQUEST['id']>0)
			CambiarFormaPagoFactura($_REQUEST['cadena'],$_REQUEST['efe'],$_REQUEST['tar'],$_REQUEST['che'],$_REQUEST['cxc'],(int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='VerificarClave'){
		if($_REQUEST['clave']!='')
			VerificarClave($_REQUEST['clave']);
	}	
	else if ($_REQUEST['fun']=='SacaImpuestos'){
		SacaImpuestos();
	}
	else if ($_REQUEST['fun']=='SacaProductos'){
		if($_REQUEST['id']!='')
			SacaProductos($_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='SacaProductos1'){
		if((int)$_REQUEST['idlocal']>0)
			SacaProductos1($_REQUEST['idlocal'],$_REQUEST['iddiseno']);
	}
	else if ($_REQUEST['fun']=='formarCategorias'){
		formarCategorias();
	}
	else if ($_REQUEST['fun']=='VerConf'){
		VerConf();
	}
	else if ($_REQUEST['fun']=='NumFactura'){
		NumFactura();
	}
	else if ($_REQUEST['fun']=='BuscarCliente'){
		if($_REQUEST['ced']!='')
			BuscarCliente($_REQUEST['ced']);
	}
	else if ($_REQUEST['fun']=='CuantosProductos'){
		CuantosProductos();
	}
	else if ($_REQUEST['fun']=='SacarImpresora'){
		SacarImpresora();
	}
	else if ($_REQUEST['fun']=='saberProducto'){
		if($_REQUEST['codigo']!='')
			saberProducto($_REQUEST['codigo']);
	}
	else if ($_REQUEST['fun']=='BuscarSugerencias2'){
		if($_REQUEST['nombre']!='')
			BuscarSugerencias2($_REQUEST['nombre']);
	}
	else if ($_REQUEST['fun']=='BuscarSugerencias2new'){
		if($_REQUEST['nombre']!='')
			BuscarSugerencias2new($_REQUEST['nombre']);
	}
	else if ($_REQUEST['fun']=='VerificarNumero'){
		if($_REQUEST['valor']!='')
			VerificarNumero($_REQUEST['valor']);
	}
	else if ($_REQUEST['fun']=='formarCategoriasMenu'){
		formarCategoriasMenu();
	}
	else if ($_REQUEST['fun']=='MaxMenu'){
		MaxMenu();
	}
	else if ($_REQUEST['fun']=='ProductosenCategoria'){
		if($_REQUEST['categoria']!='')
			ProductosenCategoria($_REQUEST['categoria'],$_REQUEST['fila']);
	}
	else if ($_REQUEST['fun']=='Modificadores'){
		if($_REQUEST['formualdo']!='')
			Modificadores($_REQUEST['formualdo']);
	}
	else if ($_REQUEST['fun']=='Mesas'){
		if((int)$_REQUEST['mitimespan']>=0)
			updatemesas($_REQUEST['nombrecli'],$_REQUEST['idcli'],(int)$_REQUEST['mitimespan'],$_REQUEST['now'],$_REQUEST['mesaactiva']);
	}
	else if ($_REQUEST['fun']=='VerPropinas'){
		VerPropinas();
	}
	else if ($_REQUEST['fun']=='VerMesas'){
		VerMesas();
	}
	else if ($_REQUEST['fun']=='VerPaxMesas'){
		if((int)$_REQUEST['id']>=0)
			VerPaxMesas((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='VerMesasActivas'){
		if((int)$_REQUEST['id']>=0)
			VerMesasActivas((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='InsertaMesas'){
		if((int)$_REQUEST['id']>=0)
			InsertaMesas((int)$_REQUEST['id'],$_REQUEST['fecha'],$_REQUEST['cant'],$_REQUEST['cant']);
	}
	else if ($_REQUEST['fun']=='VerConsumosMesas'){
		if((int)$_REQUEST['id']>=0)
			VerConsumosMesas((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='EliminarMesas'){
		if((int)$_REQUEST['id']>=0)
			EliminarMesas((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='InsertaMesasConsumos'){
		if((int)$_REQUEST['mesaactiva']>=0)
			InsertaMesasConsumos((int)$_REQUEST['mesaactiva'],$_REQUEST['fecha'],$_REQUEST['details'],$_REQUEST['agregados'],$_REQUEST['notas'],$_REQUEST['id_real']);
	}
	else if ($_REQUEST['fun']=='BuscarClienteId'){
		if((int)$_REQUEST['id']>0)
			BuscarClienteId((int)$_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='GuardaCliente'){
		GuardaCliente($_REQUEST['nombrep'],$_REQUEST['telefonop'],$_REQUEST['direccionp'],$_REQUEST['emailp'],$_REQUEST['cedulap'],$_REQUEST['timespanCliente']);
	}
	else if ($_REQUEST['fun']=='ActualizarCliente'){
		if((int)$_REQUEST['idcliente']>0)
			ActualizarCliente($_REQUEST['nombrep'],$_REQUEST['telefonop'],$_REQUEST['direccionp'],$_REQUEST['emailp'],$_REQUEST['cedulap'],(int)$_REQUEST['idcliente']);
	}
	else if ($_REQUEST['fun']=='EliminarLogactions'){
		if($_REQUEST['timehoy']!='')
			EliminarLogactions($_REQUEST['timehoy']);
	}
	else if ($_REQUEST['fun']=='GuardarConfiguracion'){
		if($_REQUEST['produccion']!='')
			GuardarConfiguracion($_REQUEST['produccion']);
	}
	else if ($_REQUEST['fun']=='VerConf1'){
		VerConf1();
	}
	else if ($_REQUEST['fun']=='ActualizarConfiguracion'){		
		ActualizarConfiguracion($_REQUEST['laprinter'],$_REQUEST['marca'],$_REQUEST['model'],$_REQUEST['direction'],$_REQUEST['type']);
	}
	else if ($_REQUEST['fun']=='ActualizarMedidas'){		
		ActualizarMedidas($_REQUEST['encabezado'],$_REQUEST['largo']);
	}
	else if ($_REQUEST['fun']=='GuardarNombre'){		
		GuardarNombre($_REQUEST['tabname'],$_REQUEST['sin_documento'],$_REQUEST['con_orden'],$_REQUEST['con_propina'],$_REQUEST['con_tarjeta'],$_REQUEST['con_shop'],$_REQUEST['con_notas'],$_REQUEST['con_comanderas'],$_REQUEST['con_mesas'],$_REQUEST['version_nub'],$_REQUEST['con_backup']);
	}
	else if ($_REQUEST['fun']=='GuardarProductosCategorias'){		
		GuardarProductosCategorias();
	}
	else if ($_REQUEST['fun']=='GuardaImpuestos'){
		if((int)$_REQUEST['timespan']>0)
			GuardaImpuestos($_REQUEST['porcentaje'],$_REQUEST['activo'],$_REQUEST['timespan']);
	}
	else if ($_REQUEST['fun']=='backupContent'){		
		backupContent();
	}
	else if ($_REQUEST['fun']=='GuardarConfiguracion1'){		
		GuardarConfiguracion1($_REQUEST['nombreEsta'],$_REQUEST['razon'],$_REQUEST['ruc'],$_REQUEST['tel'],$_REQUEST['email'],$_REQUEST['dir'],$_REQUEST['serie'],$_REQUEST['establecimiento'],$_REQUEST['quehace']);
	}
	else if ($_REQUEST['fun']=='GuardarConfiguracion2'){		
		GuardarConfiguracion1($_REQUEST['nombreEstable'],$_REQUEST['razonSo'],$_REQUEST['rucFac'],$_REQUEST['emailFac'],$_REQUEST['dirFac'],$_REQUEST['numcontribuyenteFac'],$_REQUEST['obligado'],$_REQUEST['activafacturacionelectronica'],$_REQUEST['telFac'],$_REQUEST['serieFac'],$_REQUEST['establecimientoFac'],$_REQUEST['msjFac']);
	}
	else if ($_REQUEST['fun']=='VerConfiguracion'){		
		VerConfiguracion();
	}
	else if ($_REQUEST['fun']=='VerConfiguracion1'){		
		VerConfiguracion1();
	}
	else if ($_REQUEST['fun']=='InsertaImpuestos'){
		if((int)$_REQUEST['timespan_impuesto']>0)
			InsertaImpuestos($_REQUEST['impuesto'],$_REQUEST['porcentaje'],$_REQUEST['activo'],$_REQUEST['timespan_impuesto']);
	}
	else if ($_REQUEST['fun']=='AnularFactura'){
		if((int)$_REQUEST['id']>0)
			AnularFactura($_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='SacarJson'){
		if((int)$_REQUEST['id']>0)
			SacarJson($_REQUEST['id']);
	}
	else if ($_REQUEST['fun']=='insertalogactions'){
		insertalogactions($_REQUEST['time'],$_REQUEST['descripcion'],$_REQUEST['datos']);
	}
	else if ($_REQUEST['fun']=='verFacturasFechas'){
		verFacturasFechas($_REQUEST['fechaFiltro'],$_REQUEST['fechaFiltroh']);
	}
	else if ($_REQUEST['fun']=='verCuantasFacturasFechas'){
		verCuantasFacturasFechas($_REQUEST['fechaFiltro'],$_REQUEST['fechaFiltroh']);
	}
	
	
	/*$db = new PDO('sqlite:PractisisMobile.sqlite3');
>>>>>>> release/cambios
	print "<table border=1>";

print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";

$result = $db->query('SELECT * FROM clientes');
foreach($db->query('SELECT * FROM clientes') as $row){
	echo json_encode($row);
<<<<<<< HEAD
}

=======
}*/
$cedula="9999999999999";
$db1 = new PDO('sqlite:PractisisMobile.sqlite3');							
			$stmt = $db1->prepare('SELECT * FROM CLIENTES WHERE cedula=?');
			$stmt->execute(array($cedula));
			$result=$stmt->fetchAll();
>>>>>>> release/cambios
foreach($result as $row)
{
	//echo json_encode($row);

print "<tr><td>".$row['id']."</td>";

print "<td>".$row['nombre']."</td>";

print "<td>".$row['cedula']."</td>";

print "<td>".$row['existe']."</td></tr>";

}

print "</table>";
<<<<<<< HEAD

/*try
=======
/*
try
>>>>>>> release/cambios
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