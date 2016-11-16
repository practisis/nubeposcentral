var msjcloud=0;
	function VerificarConexion(){
		/*if(navigator.connection.type == Connection.NONE){
			if(localStorage.getItem('idioma')==1)
				showalertred("No se puede realizar la petición, por favor revise su conexión a Internet.");
			else
				showalertred("Cannot send the data, please check your internet conection.");
			return false;
		}else{
			console.log("conectados por: "+navigator.connection.type);
			return true;
		}*/
		return true;
	}
	//console.log(campos);

	function updateOnlineStatus(condition) {
		var status = document.getElementById("status");
		//var condition = navigator.onLine ? "ONLINE" : "OFFLINE";
		var state = document.getElementById("state");
		var log = document.getElementById("log");
		$('#conexion').val(condition);
		
		var conexionInternet = $('#conexion').val();
		console.log(conexionInternet)
		if(conexionInternet == 'ONLINE' ){
			//$('#cloudIndex').css('display','block');
			//$('#cloudIndexOff').css('display','none');
			$('#signalinternet').css('color','white');
		}else if(conexionInternet == 'OFFLINE' ){
			//$('#cloudIndex').css('display','none');
			//$('#cloudIndexOff').css('display','block');
			$('#signalinternet').css('color','#606061');
		}
	}

	function envia(donde){
		//if(loopSicnronizador) clearInterval(loopSicnronizador);
		//clearInterval(intervalProcesoRepetir);
		var lugar='';
		$('#cargandoTabs').css('display','block');
		if(donde=='dashboard')
		lugar="views/dashboard/dashboard.html";
		if(donde=='puntodeventa')
		lugar="views/nubepos/nubepos.html";
		if(donde=='listaproductos')
		lugar="views/productos/listaproductos.html";
		if(donde=='nuevoproducto')
		lugar="views/productos/nuevoproducto.html";
		if(donde=='inventario')
		lugar="views/productos/inventarioproductos.html";
		if(donde=='listadeclientes'){
			lugar="views/clientes/listaclientes.html"; 
		}if(donde=='nuevocliente')
		lugar="views/clientes/nuevocliente.html";
		if(donde=='historial')
		lugar="views/facturacion/historial.html";
		if(donde=='historialst')
		lugar="views/facturacion/historialst.html";
		if(donde=='cloud')
		lugar="views/cloud/indexCloud.html";
		if(donde=='imprimeotro')
		lugar="indexprint.html";
		//alert(lugar);
		if(donde=='empresa')
		lugar="views/cloud/indexEmpresa.html";
		if(donde=='printconfig')
		lugar="views/configuracion/impresoras.html";
		if(donde=='log')
		lugar="views/configuracion/log.html";
		if(donde=='config')
		lugar="views/configuracion/configuracion.html";
		if(donde=='modif')
		lugar="views/productos/modificadores.html";
		if(!lugar) lugar="404.html";
		$('#cargandoTabs').css('display','none');
		$('#correoMal').fadeOut('slow');
		$.get(lugar,function(data){
			$('#main').html(data);
		});
		/*$('#main').load(lugar,function(){
			$("#simple-menu").click();
		});						
			//DOMOnTap();
			//loaded();
		setTimeout(function(){
			$('#cargandoTabs').css('display','none');
			$('#correoMal').fadeOut('slow');
			$('#main').load(lugar,function(){
			$("#simple-menu").click();						
			//DOMOnTap();
			//loaded();
			});
		}, 1000);*/
		
		//collapsa el menu cuando está metido
		$("#bs-example-navbar-collapse-1").attr('class', 'navbar-collapse collapse');	
	}

	function ajax(cadena){
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (E) { xmlhttp = false;}}
		@end @*/
		//console.log(cadena);
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') { try {xmlhttp = new XMLHttpRequest(); } catch (e) { xmlhttp=false;}}
		if (!xmlhttp && window.createRequest) {	try { xmlhttp = window.createRequest();} catch (e) { xmlhttp=false;}}
		xmlhttp.open("GET",cadena,true);
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4){
			if(xmlhttp.status==200){
			console.log(xmlhttp.responseText);
			var respuesta=xmlhttp.responseText.split("@@@");	
			if (respuesta[0]=='okp'){
				CargarProducto(respuesta[1]);
			}
			else if (respuesta[0]=='okc'){
				CargarCliente(respuesta[1]);
			}
			else if (respuesta[0]=='okft'){
				CargarFacturast(respuesta[1],respuesta[2]);
			}
			else if (respuesta[0]=='okf'){
				CargarFactura(respuesta[1],respuesta[2]);
			}	
			else if (respuesta[0]=='okvc'){
				VerificarClave1(respuesta[1]);
			}	
			//document.getElementById(elemento).innerHTML="";document.getElementById(elemento).innerHTML=xmlhttp.responseText; despliega(""+item);
		}}} 
		xmlhttp.send(null);
	}
	var app = {
    // Application Constructor
		initialize: function() {
			this.bindEvents();
			
		},
		// Bind Event Listeners
		//
		// Bind any events that are required on startup. Common events are:
		// 'load', 'deviceready', 'offline', and 'online'.
		bindEvents: function() {
			document.addEventListener('deviceready', this.onDeviceReady, false);
			document.addEventListener("pause", function(){ alert("pausa");}, false);
			document.addEventListener("backbutton", function(){alert("back");}, false);
		},
		// deviceready Event Handler
		//
		// The scope of 'this' is the event. In order to call the 'receivedEvent'
		// function, we must explicitly call 'app.receivedEvent(...);'
		onDeviceReady: function() {
			
		   // app.receivedEvent('deviceready');
		  // onDeviceReady();
		},
		// Update DOM on a Received Event
		/*receivedEvent: function(id) {
				var parentElement = document.getElementById(id);
				var listeningElement = parentElement.querySelector('.listening');
				var receivedElement = parentElement.querySelector('.received');

				listeningElement.setAttribute('style', 'display:none;');
				receivedElement.setAttribute('style', 'display:block;');

				console.log('Received Event: ' + id);
				
			}*/
	};

    onDeviceReady();
    function onDeviceReady(){		
		//alert("device Ready>>" + device.uuid);
		//$('#deviceid').html(device.uuid);
		//setInterval(function(){updateOnlineStatus()},60000);		
		$.ajaxSetup({
		type: 'POST',
		timeout:10000
		});
		ajax("api.php?fun=iniciaDB");
		window.addEventListener('native.keyboardshow', keyboardShowHandler);
		document.addEventListener("pause", function(){localStorage.setItem("claveuser","");}, false);
		document.addEventListener("offline",isoffline, false);
		document.addEventListener("online", isonline, false);
		//document.addEventListener("backbutton", function(){localStorage.setItem("claveuser","");}, false);		
		function isoffline(){
			$('#signalinternet').css('color','#606061');
			$('#conexion').val('offline');
		}		
		function isonline(){
			$('#signalinternet').css('color','white');
			$('#conexion').val('online');
			if(localStorage.getItem("empresa")!=null&&localStorage.getItem("idbarra")!=null&&localStorage.getItem("empresa")!=''&&localStorage.getItem("idbarra")!='')
				SincronizadorNormal();
		}		
		function keyboardShowHandler(e){
			//alert("show");
			var inp=$(":focus");
			var padding = 15;
            var targetPosition = parseInt($(inp).offset().top + padding);
            var keyboardHeight = parseInt($(window).height())-parseInt(e.keyboardHeight);//get keyboard height  
                    //if the input is hidden by the keyboard,scroll to the input 
			//alert(targetPosition+'/'+keyboardHeight);
            if (targetPosition >= keyboardHeight) {
                //padding *=5;
				if(inp.attr('id')=='search-renderitem')
					$('#mybodycontent').css("top",-(targetPosition-keyboardHeight+padding+20)+"px");
				else
					$('#mybodycontent').css("top",-(targetPosition-keyboardHeight+padding)+"px");
            }
		}
		// This event fires when the keyboard will show
		window.addEventListener('native.keyboardhide', keyboardHideHandler);

		function keyboardHideHandler(e){
			//alert("hide");
			$('#mybodycontent').css("top","0px");
		}
		
		window.StarIOAdapter = {};
		var handle_error_callback = function(error_message) {
			//alert(error_message);
			//showalert(error_message);
			console.log(error_message);
		};	
	
		/**
		 * Checks the status of the bluetooth printer and returns the string "OK" if the printer is online
		 */
		window.StarIOAdapter.check = function(port_search, success_callback, error_callback) {
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "check", [port_search]);
		};

		/**
		* Launches a raw print on the printer, it returns a string with "OK" if the sending was fine
		*/
		window.StarIOAdapter.rawprint = function(message, port_search,success_callback, error_callback) {
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "rawprint", [message, port_search]);
		};		
		/*Search the availables printers*/
		window.StarIOAdapter.searchall=function(port_search, success_callback, error_callback){
			//alert("todas buscar");
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "searchall", [port_search]);
		};		
		/*Print a logo image*/
		window.StarIOAdapter.printlogo=function(logoname,port_search, success_callback, error_callback){
			//alert("todas buscar");
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "printlogo", [logoname , port_search]);
		};		
		window.StarIOAdapter.opendrawer=function(port_search,success_callback, error_callback){
			//alert("todas buscar");
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback,"StarIOAdapter", "opendrawer", [port_search]);
		};		
		window.StarIOAdapter.searchEpson=function(port_search, success_callback, error_callback){
			//alert("todas buscar");
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "searchEpson", [port_search]);
		};		
		window.StarIOAdapter.printepson=function(message,port_search,port_dir,port_type,success_callback, error_callback){
			//alert("todas buscar");
			if(error_callback == null) {
				error_callback = handle_error_callback;
			}
			return cordova.exec(success_callback, error_callback, "StarIOAdapter", "printepson", [message,port_search,port_dir,port_type]);
		};		
        /*var db = window.openDatabase("Database", "1.0", "PractisisMobile", 200000);
        db.transaction(iniciaDB, errorCB, successCB);
        console.log(db);*/

		
        /* var element = document.getElementById('deviceProperties');
        element.innerHTML = 'Device Model: '    + device.model    + '<br />' +
                        'Device Cordova: '  + device.cordova  + '<br />' +
                        'Device Platform: ' + device.platform + '<br />' +
                        'Device UUID: '     + device.uuid     + '<br />' +
                        'Device Version: '  + device.version  + '<br />';*/
    }
    
	// Transaction error callback
    //
    function errorCB(err){
        console.log("Error processing SQL: "+err.message);
       //alert("Error processing SQL: "+err.message);
    }
    // Transaction success callback
    //
    function successCB() {
        console.log("success!");
        //alert("success!");
    }
  
    /*Funciones Ana:*/
    function Ingresaproductos(){
         var json = $('#jsonProductos').html();
            var mijson = eval(''+json+'');
            for(var j in mijson){
                for(var k in mijson[j]){
                    for(i = 0; i < mijson[j][k].length; i++){
                            var item = mijson[j][k][i];
							ajax("api.php?fun=Ingresaproductos?prod="+item);
                            //InsertaProducto(item);
                    }
                }
            }
    }  
    
    function VerDatosProducto(id){
		ajax("api.php?fun=VerDatosProducto?id="+id);		
    }
	function CargarProducto(result){
		var results=JSON.parse(result);		
        var row=results.rows.item(0);
        $('#idproducto').val(row.id_local);
        $('#titulonuevopr').html("Editar Producto");
        $('#nombreproducto').val(row.formulado);
        $('#codigoproducto').val(row.codigo);
        $('#precioproducto').val(row.precio.toFixed(2));
        $('#search-renderitem').val(row.categ);
        $('#idcategoria').val(row.categoriaid);
        $('#mprima').prop('checked',false);
        $('#pfinal').prop('checked',false);
        $('#coniva').prop('checked',false);
        $('#conservicio').prop('checked',false);
        if(row.materiaprima==1)
        $('#mprima').prop('checked',true);
        if(row.productofinal==1)
        $('#pfinal').prop('checked',true);
        if(row.tieneimpuestos=="true")
        $('#coniva').prop('checked',true);
		if(row.servicio==1)
        $('#conservicio').prop('checked',true);
    }
    
    function VerDatosCliente(id){
		ajax("api.php?fun=VerDatosCliente?id="+id);        
    }
	function CargarCliente(result){
		var results=JSON.parse(result);		
        var row=results.rows.item(0);            
		$('#idcliente').val(row.id);
		$('#titulocliente').html("Editar Cliente");
		$('#nombrecliente').val(row.nombre);
		$('#cedulacliente').val(row.cedula);
		$('#telefono').val(row.telefono);
		$('#direccion').val(row.direccion);
		$('#email').val(row.email);        
    }

    function VerDatosFacturast(id){
		ajax("api.php?fun=VerDatosFacturast?id="+id+"?clave="+localStorage.getItem("claveuser"));        
    }
	function CargarFacturast(result,result2){
        var results=JSON.parse(result);
		var results2=JSON.parse(result2);
		var inhtml='';
		for (var i=0; i < results.rows.length; i++){
			var row = results.rows.item(i);
			$('#idfactura').val(row.id);
			$('#cliente').val(row.clientName);
			$('#order_id').val(row.order_id);
			//alert(row.order_id);
			//si no tiene permisos
			if(localStorage.getItem("permisos")=="true"){					
				if(results2.rows.length>0){
					if(results2.rows.item(0).id!=null)
						$('#btnanularf').fadeIn();
					else
						$('#btnanularf').fadeOut();					
				}
				else{
					$('#btnanularf').fadeOut();
				}					
			}
			else{
				$('#btnanularf').fadeIn();
			}
			//permisos			
			if(row.anulada=='1'||row.anulada==1){
				$('#btnanularf,#reimprimir').css('display','none');
			}
			var timefecha=new Date(row.fecha);
			var mes=timefecha.getMonth()+1;
			var dia=timefecha.getDate();
			if(mes.toString().length<2)
				mes="0"+mes.toString();
			if(dia.toString().length<2)
				dia="0"+dia.toString();
			var fechaformat=dia+"-"+mes+"-"+timefecha.getFullYear()+" "+timefecha.getHours()+":"+timefecha.getMinutes()+":"+timefecha.getSeconds();
			//console.log(row);
			$('#fecha').val(fechaformat);
			var datosfact=JSON.parse(row.fetchJson);
			var totalf=parseFloat(datosfact.Pagar[0].factura.total).toFixed(2);
			var descAplicado=parseFloat(datosfact.Pagar[0].factura.descuento).toFixed(2);
			console.log('Descuento : '+descAplicado);
			var facturanumber=datosfact.Pagar[0].factura.numerofact;
			$('#numerofactura').html(facturanumber);
			$('#total').html(totalf);
			$('#invoiceTotal').html(totalf);
			var intabla='';
			var variosprods=(datosfact.Pagar[0].producto);
			var itemsfact=0;
			var subtotal=0;
			for(var n=0;n<variosprods.length;n++){
				var agregados="";
				var valoragregados=0;
				if(variosprods[n].detalle_agregados!=""){
					valoragregados=parseFloat(variosprods[n].agregados);
					var detagregados=variosprods[n].detalle_agregados;
					var vdetagregados=detagregados.split('@');
					for(var t=0;t<vdetagregados.length;t++){
						var dataagr=vdetagregados[t].split('|');
						agregados+="<div style='text-align:left; font-size:11px; margin-left:20px;'>"+dataagr[0]+": $"+parseFloat(dataagr[1]).toFixed(2)+"</div>";
					}
				}
				subtotal+=parseFloat(variosprods[n].cant_prod)*(parseFloat(variosprods[n].precio_prod)+valoragregados);
				intabla+="<tr><td style='text-align:left;'>"+variosprods[n].nombre_producto+agregados+"</td><td style='text-align:center;'>"+parseFloat(variosprods[n].cant_prod)+"</td><td style='text-align:right;display:none;'>"+(parseFloat(variosprods[n].precio_prod)+valoragregados).toFixed(2)+"</td><td style='text-align:right;display:none;'>"+parseFloat(variosprods[n].precio_total).toFixed(2)+"</td></tr>";
				itemsfact+=parseInt(parseInt(variosprods[n].cant_prod));
			}

			var subs="";
			subs+="<table class='table table-hovered'>";
			subs+="<tr><td style='text-align:right;'>SUBTOTAL</td><td style='text-align:right;'> $"+subtotal.toFixed(2)+"</td></tr>";
			
			/*descuento*/
			if(descAplicado>0){
					subs+="<tr><td style='text-align:right;' class='trans_discount'>Descuento</td><td style='text-align:right;'> $"+parseFloat(row.descuento).toFixed(2)+"</td></tr>";
			}
			
			if(row.dataimpuestos!=""){
				var detagregados=row.dataimpuestos;
				var vdetagregados=detagregados.split('@');
				for(var t=0;t<vdetagregados.length;t++){
					var dataagr=vdetagregados[t].split('|');
					subs+="<tr><td style='text-align:right;'>"+dataagr[1]+"</td><td style='text-align:right;'> $"+parseFloat(dataagr[3]).toFixed(2)+"</td></tr>";
				}
			}

			subs+="</table>";
			$('#subtotales').html(subs);
			$('#itemsfacturados').html(" "+itemsfact);
			$('#cuerpodetalle').html(intabla);
			var formaDePago = row.paymentsUsed;
			var totalpagof=0;
			console.log('Forma de pago es :'+formaDePago);
			if(formaDePago == '1'){
				$('#detaFormPago').html('Efectivo');
				$('#detaFormPagoValor').html(parseFloat(row.cash).toFixed(2));
				totalpagof+=Math.abs(parseFloat(row.cash));
				$('#detaFormPago').parent().fadeIn();
			}
			
			if(formaDePago == '2'){
				var datocard=row.cards.split('|');
				$('#detaFormPago').html('Tarjeta');
				$('#detaFormPagoValor').html(parseFloat(datocard[2].substring(0,datocard[2].length - 1)).toFixed(2));
				totalpagof+=parseFloat(parseFloat(datocard[2].substring(0,datocard[2].length - 1)));
				$('#detaFormPago').parent().fadeIn();
			}
			if(formaDePago == '3'){
			var datocheque=row.cheques.split('|');
			//alert(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').html('Cheques');
				$('#detaFormPagoValor').html(parseFloat(datocheque[2].substring(0,datocheque[2].length - 1)).toFixed(2));
				totalpagof+=parseFloat(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').parent().fadeIn();
			}

			if(formaDePago == '4'){
			var datocxc=row.vauleCxC;
			//alert(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').html('CxC');
				$('#detaFormPagoValor').html(parseFloat(datocxc).toFixed(2));
				totalpagof+=parseFloat(datocxc);
				$('#detaFormPago').parent().fadeIn();
			}

			if(formaDePago != '1' && formaDePago != '2' && formaDePago != '3' && formaDePago != '4'){
				var fpago=row.paymentsUsed.split(',');
				console.log(fpago);
				var c=0;
				for(var t=0;t<fpago.length;t++){
					console.log(t);
					if(fpago[t]==1){
						$('#detaFormPago').html('Efectivo');
						$('#detaFormPagoValor').html(parseFloat(row.cash).toFixed(2));
						$('#detaFormPago').parent().fadeIn();
					}
					if(fpago[t]==2){
						var datocard=row.cards.split('|');
						$('#detaFormPago1').html('Tarjeta');
						//console.log(datocard);
						$('#detaFormPagoValor1').html(parseFloat(datocard[2].substring(0,datocard[2].length - 1)).toFixed(2));
						$('#detaFormPago1').parent().fadeIn();
					}

					if(fpago[t]==3){
						var datocheque=row.cheques.split('|');
						$('#detaFormPago2').html('Cheques');
						//console.log(datocard);
						$('#detaFormPagoValor2').html(parseFloat(datocheque[2].substring(0,datocheque[2].length - 1)).toFixed(2));
						$('#detaFormPago2').parent().fadeIn();
					}

					if(fpago[t]==4){
						var datocheque=row.vauleCxC;
						$('#detaFormPago3').html('CxC');
						//console.log(datocard);
						$('#detaFormPagoValor3').html(parseFloat(datocheque).toFixed(2));
						$('#detaFormPago3').parent().fadeIn();
					}
				}
			}

			var tot=parseFloat($('#total').html());
			if((tot-totalpagof)<0){
				$('#tabladetformaspago').append('<tr><td><b>Vuelto</b></td><td style="text-align:right;">'+(-1*(tot-totalpagof)).toFixed(2)+'</td></tr>');
			}
			
			if(row.anulada==1){
				$('#factanulada').fadeIn();
			}
		}
    }

    function VerDatosFactura(id){
		if(localStorage.getItem("con_localhost") == 'true'){
			var apiURL='http://'+localStorage.getItem("ip_servidor")+'/connectnubepos/api2.php';
			$.post(apiURL,{
				id_emp : localStorage.getItem("empresa"),
				action : 'VerFactura',
				id_barra : localStorage.getItem("idbarra"),
				deviceid:$("#deviceid").html(),
				idfactura : id
			}).done(function(response){
				if(response!='block' && response!='Desactivado'){
					console.log(response);
					var res = response.split("||");
					$('#idfactura').val(id);
					$('#numerofactura').html(res[0]);
					$('#cliente').val(res[1]);
					$('#fecha').val(res[2]);
					$('#itemsfacturados').html(" "+res[4]);
					$('#total').html(res[3]);
					$('#invoiceTotal').html(res[3]);
					$('#cuerpodetalle').html(res[5]);
					$('#subtotales').html(res[6]);
					$('#tabladetformaspago').html(res[7]);
					$('#order_id').val(res[9]);
					if(res[8]=='1' || res[8]==1){
						$('#btnanularf,#reimprimir').css('display','none');
						$('#factanulada').fadeIn();
					}
				}
				else if(response=='Desactivado'){
					envia('config');
					setTimeout(function(){
						$('.navbar,#barraalternamovil').slideUp();
						$("#demoGratis,#fadeRow,#finalizado,#contentStepSincro,#cuentaactiva").css("display","none");
						$('#desactivo').fadeIn();
					},100);
				}
				else{
					envia('config');
					setTimeout(function(){
						$('#linklogin,#linkloginb').attr("href","https://www.practisis.net/index3.php?rvpas="+localStorage.getItem("userPasswod")+"&rvus="+localStorage.getItem("userRegister"));
						$('.navbar,#barraalternamovil').slideUp();
						$("#demoGratis,#fadeRow,#finalizado,#contentStepSincro,#cuentaactiva").css("display","none");
						$('#bloqueo').fadeIn();
					},100);

				}

			}).fail(function(){
				updateOnlineStatus("OFFLINE");
				setTimeout(function(){SincronizadorNormal()},180000);
			});
		}
		else{
			ajax("api.php?fun=VerDatosFactura?id="+id+"?clave="+localStorage.getItem("claveuser"));
		}
    }
    
	function CargarFactura(result,result2){
        var results=JSON.parse(result);
		var results2=JSON.parse(result2);	
		var inhtml='';
		for (var i=0; i < results.rows.length; i++){
			var row = results.rows.item(i);
			//console.log(row);
			$('#idfactura').val(row.id);
			$('#cliente').val(row.clientName);
			$('#order_id').val(row.order_id);
			//si no tiene permisos
			if(localStorage.getItem("permisos")=="true"){
				if(results2.rows.length>0){
					if(results2.rows.item(0).id!=null)
						$('#btnanularf').fadeIn();
					else
						$('#btnanularf').fadeOut();	
				}
				else{
					$('#btnanularf').fadeOut();
				}
			}
			else{
				$('#btnanularf').fadeIn();
			}
			//permisos
			if(row.anulada=='1'||row.anulada==1){
				$('#btnanularf,#reimprimir').css('display','none');
			}
			var timefecha=new Date(row.fecha);
			var mes=timefecha.getMonth()+1;
			var dia=timefecha.getDate();
			if(mes.toString().length<2)
				mes="0"+mes.toString();
			if(dia.toString().length<2)
				dia="0"+dia.toString();
			var fechaformat=dia+"-"+mes+"-"+timefecha.getFullYear()+" "+timefecha.getHours()+":"+timefecha.getMinutes()+":"+timefecha.getSeconds();
			//console.log(row);
			$('#fecha').val(fechaformat);
			
			var datosfact=JSON.parse(row.fetchJson);
			var totalf=parseFloat(datosfact.Pagar[0].factura.total).toFixed(2);
			var descAplicado=parseFloat(datosfact.Pagar[0].factura.descuento).toFixed(2);
			console.log('Descuento : '+descAplicado);

			var facturanumber=datosfact.Pagar[0].factura.numerofact;
			$('#numerofactura').html(facturanumber);
			
			$('#total').html(totalf);
			$('#invoiceTotal').html(totalf);
			
			var intabla='';
			var variosprods=(datosfact.Pagar[0].producto);
			var itemsfact=0;
			var subtotal=0;
			for(var n=0;n<variosprods.length;n++){
				var agregados="";
				var valoragregados=0;
				if(variosprods[n].detalle_agregados!=""){
					valoragregados=parseFloat(variosprods[n].agregados);
					var detagregados=variosprods[n].detalle_agregados;
					var vdetagregados=detagregados.split('@');
					for(var t=0;t<vdetagregados.length;t++){
						var dataagr=vdetagregados[t].split('|');
						agregados+="<div style='text-align:left; font-size:11px; margin-left:20px;'>"+dataagr[0]+": $"+parseFloat(dataagr[1]).toFixed(2)+"</div>";
					}
				}
				
				var sublinea=parseFloat(variosprods[n].cant_prod)*(parseFloat(variosprods[n].precio_prod)+valoragregados);
				subtotal+=sublinea;
				
				var lineaimp='';
				if(variosprods[n].impuesto_prod!=''&&variosprods[n].impuesto_prod!=null){
					lineaimp='(*i)';
				}
				
				intabla+="<tr><td style='text-align:left;'>"+variosprods[n].nombre_producto+lineaimp+agregados+"</td><td style='text-align:right;'>"+parseFloat(variosprods[n].cant_prod)+"</td><td style='text-align:right;'>"+(parseFloat(variosprods[n].precio_prod)+valoragregados).toFixed(2)+"</td><td style='text-align:right;'>"+parseFloat(sublinea).toFixed(2)+"</td></tr>";
				itemsfact+=parseInt(parseInt(variosprods[n].cant_prod));
			}
			
			var subs="";
			subs+="<table class='table table-hovered'>";
			
			
			
			subs+="<tr><td style='text-align:right;'>SUBTOTAL</td><td style='text-align:right;'> $"+subtotal.toFixed(2)+"</td></tr>";
			if(row.dataimpuestos!=""){
				var detagregados=row.dataimpuestos;
				var vdetagregados=detagregados.split('@');
				for(var t=0;t<vdetagregados.length;t++){
					var dataagr=vdetagregados[t].split('|');
					subs+="<tr><td style='text-align:right;'>"+dataagr[1]+" ("+(parseFloat(dataagr[2])*100).toFixed(2)+"%)</td><td style='text-align:right;'> $"+parseFloat(dataagr[3]).toFixed(2)+"</td></tr>";
				}
			}
			
			if(descAplicado>0){
				subs+="<tr><td style='text-align:right;'>DESCUENTO</td><td style='text-align:right;'> $"+parseFloat(descAplicado).toFixed(2)+"</td></tr>";
			}
			
			if(datosfact.Pagar[0].factura.propina!=null){
				if(parseFloat(datosfact.Pagar[0].factura.propina)>0){
					subs+="<tr><td style='text-align:right;' class='trans_propina'>Propina</td><td style='text-align:right;'> $"+parseFloat(datosfact.Pagar[0].factura.propina).toFixed(2)+"</td></tr>";
				}
			}
			
			subs+="</table>";
			$('#subtotales').html(subs);
			$('#itemsfacturados').html(" "+itemsfact);
			$('#cuerpodetalle').html(intabla);
			var formaDePago = row.paymentsUsed;
			var totalpagof=0;
			console.log('Forma de pago es :'+formaDePago);
			if(formaDePago == '1'){
				$('#detaFormPago').html('Efectivo');
				$('#detaFormPagoValor').html(parseFloat(row.cash).toFixed(2));
				totalpagof+=Math.abs(parseFloat(row.cash));
				$('#detaFormPago').parent().fadeIn();
			}
			if(formaDePago == '2'){
				var datocard=row.cards.split('|');
				$('#detaFormPago').html('Tarjeta');
				$('#detaFormPagoValor').html(parseFloat(datocard[2].substring(0,datocard[2].length - 1)).toFixed(2));
				totalpagof+=parseFloat(parseFloat(datocard[2].substring(0,datocard[2].length - 1)));
				$('#detaFormPago').parent().fadeIn();
			}
			if(formaDePago == '3'){
			var datocheque=row.cheques.split('|');
			//alert(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').html('Cheques');
				$('#detaFormPagoValor').html(parseFloat(datocheque[2].substring(0,datocheque[2].length - 1)).toFixed(2));
				totalpagof+=parseFloat(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').parent().fadeIn();
			}

			if(formaDePago == '4'){
			var datocxc=row.vauleCxC;
			//alert(datocheque[2].substring(0,datocheque[2].length - 1));
				$('#detaFormPago').html('CxC');
				$('#detaFormPagoValor').html(parseFloat(datocxc).toFixed(2));
				totalpagof+=parseFloat(datocxc);
				$('#detaFormPago').parent().fadeIn();
			}

			if(formaDePago != '1' && formaDePago != '2' && formaDePago != '3' && formaDePago != '4'){
				var fpago=row.paymentsUsed.split(',');
				console.log(fpago);
				var c=0;
				for(var t=0;t<fpago.length;t++){
					console.log(t);
					if(fpago[t]==1){
						$('#detaFormPago').html('Efectivo');
						$('#detaFormPagoValor').html(parseFloat(row.cash).toFixed(2));
						$('#detaFormPago').parent().fadeIn();
						totalpagof+=parseFloat(row.cash);
					}
					if(fpago[t]==2){
						var datocard=row.cards.split('|');
						$('#detaFormPago1').html('Tarjeta');
						//console.log(datocard);
						$('#detaFormPagoValor1').html(parseFloat(datocard[2].substring(0,datocard[2].length - 1)).toFixed(2));
						$('#detaFormPago1').parent().fadeIn();
						totalpagof+=parseFloat(datocard[2].substring(0,datocard[2].length - 1));
					}
					
					if(fpago[t]==3){
						var datocheque=row.cheques.split('|');
						$('#detaFormPago2').html('Cheques');
						//console.log(datocard);
						$('#detaFormPagoValor2').html(parseFloat(datocheque[2].substring(0,datocheque[2].length - 1)).toFixed(2));
						$('#detaFormPago2').parent().fadeIn();
						totalpagof+=parseFloat(datocheque[2].substring(0,datocheque[2].length - 1));
					}

					if(fpago[t]==4){
						var datocheque=row.vauleCxC;
						$('#detaFormPago3').html('CxC');
						//console.log(datocard);
						$('#detaFormPagoValor3').html(parseFloat(datocheque).toFixed(2));
						$('#detaFormPago3').parent().fadeIn();
						totalpagof+=parseFloat(datocheque);
					}
				}
			}
			
			var tot=parseFloat($('#total').html());
			//alert(tot+"/"+totalpagof);
			if((tot-totalpagof)<0){
				$('#tabladetformaspago').append('<tr><td><b>Vuelto</b></td><td style="text-align:right;">'+(-1*(tot-totalpagof)).toFixed(2)+'</td></tr>');
			}

			
			if(row.anulada==1){
				$('#factanulada').fadeIn();
			}
		}        
    }
    
    function CambiarFormaPagoFactura(){
        var inputs=$('.paymentMethods');
        var cadenapago='';
        var cont=0;
        var efectivo=0;
        var tarjetas=0;
        var cheques=0;
        var cc=0;
        var retencion=0;
        var cortesia=0;
        var otros=0;
        inputs.each(function(){
            if($(this).val()>0){
                var idforma=$(this).attr('idpaymentmethod');
                if(cont>0)
                    cadenapago+=',';
                cadenapago+=idforma;
                /*cantidades de formas de pago*/
                if(idforma==1)
                    efectivo=$(this).val();
                if(idforma==2)
                    tarjetas=$(this).val();
                if(idforma==3)
                    cheques=$(this).val();
                if(idforma==4)
                    cc=$(this).val();
                if(idforma==5)
                    retencion=$(this).val();
                if(idforma==6)
                    cortesia=$(this).val();
                if(idforma==7)
                    otros=$(this).val();
                cont++;
            }    
        });
		var miid=$('#idfactura').val();
		console.log(tarjetas);
		ajax("api.php?fun=CambiarFormaPagoFactura?id="+miid+"?cadena="+cadenapago+"?efe="+efectivo+"?tar="+tarjetas+"?che="+cheques+"?cxc="+cc);    
    }
        
	function showalert(msg){
		$('#cargandoTabs').modal('hide');
		$('#alert').html(msg);
		$('html, body').animate( { scrollTop : 0 },500,function(){
			$('#alert').slideDown('slow',function(){
				setTimeout(function(){hidealert()},3500);
			});
		});
	}
	function hidealert(){
		$('#alert').html('');
		$('#alert').slideUp('fast');
	}
	function showalertred(msg){
		$('#cargandoTabs').modal('hide');
		$('#alertred').html(msg);
		$('html, body').animate( { scrollTop : 0 },500,function(){
			$('#alertred').slideDown('slow',function(){
				setTimeout(function(){hidealertred()},3500);
			});
		});
	}
	function showalertredquiet(msg){
		$('#alertred').html(msg);
		$('#alertred').slideDown('slow',function(){
				setTimeout(function(){hidealertred()},10000);
		});
	}
	function hidealertred(){
		$('#alertred').html('');
		$('#alertred').slideUp('fast');
	}
	function getTimeSpan(){
			var rn=Math.floor((Math.random() * 10000) + 1);
			var d = new Date();
			var n = d.getTime();
			return n+''+rn;
	}

	function isalphanumeric(e){
		/*console.log(e.which);
		//alert(e.key);
		if(e.which==8||(e.which>=96&&e.which<=105)||(e.which>=65&&e.which<=90)||e.which==20||e.which==110)
		{
			console.log("correcto");
			return;
		} 
		else 
		{ 
			e.preventDefault();
		} */
	}

	function VerificarClave(){
		var ing=$('#miclave').val();
		var donde=$('#accesodonde').val();
		if(ing!=''){
			ajax("api.php?fun=VerificarClave?clave="+ing);
		}
	}
	
	function VerificarClave1(result){
        var results1=JSON.parse(result);			
		if(results1.rows.length>0){
			localStorage.setItem("claveuser",ing);
			var item=results1.rows.item(0);
			if(item.historial=="true"&&donde=='historial'){
				$('#modalpermiso').modal("hide");
				$('#miclave').val("");
				envia('historial');
			}
			else if(item.configuracion=="true"&&donde=='configuracion'){
				$('#modalpermiso').modal("hide");
				$('#miclave').val("");
				envia('config');
			}
			else if(item.productos&&donde=='productos'){
				$('#modalpermiso').modal("hide");
				$('#miclave').val("");
				envia('listaproductos');
			}
			else if(item.irnube=="true"&&donde=='nube'){
				$('#modalpermiso').modal("hide");
				$('#miclave').val("");
				IraNube(document.getElementById('linklogin'));
			}
			else{
				$('#modalpermiso').modal("hide");
				$('#miclave').val("");
				if(localStorage.getItem("idioma")==1)
				showalert("No tiene suficientes privilegios para acceder o su clave es incorrecta.");
				else if(localStorage.getItem("idioma")==2)
				showalert("You don't have enough privileges to access, or the password is incorrect.");
			
				localStorage.setItem("claveuser","");
			}
		}else{
			$('#modalpermiso').modal("hide");
			$('#miclave').val("");
			if(localStorage.getItem("idioma")==1)
				showalert("No tiene suficientes privilegios para acceder o su clave es incorrecta.");
			else if(localStorage.getItem("idioma")==2)
				showalert("You don't have enough privileges to access, or the password is incorrect.");
			localStorage.setItem("claveuser","");
		}				
	}
	function VerificarPermiso(donde){
		if(localStorage.getItem("permisos")=="true"){			
			if(localStorage.getItem("claveuser")==""||localStorage.getItem("claveuser")==null){
				if(donde!=''){
					$('#modalpermiso').modal("show");
					$('#accesodonde').val(donde);
				}
			}
			else{				
				//alert(donde+"/"+localStorage.getItem("permisos"));
				var miclave=localStorage.getItem("claveuser");				
				var apiURL='api.php';
				$.post(apiURL,{
					clave : miclave,
					fun : 'VerificarClave'
				}).done(function(response){
					var respuesta=response.split("@@@");
									
					if(results1.rows.length>0){
						var it=results1.rows.item(0);
						//alert(it.irnube+'**'+donde);
						if(donde=='historial'&&it.historial=="true"&&it.vertotales=="true"){
							envia('historial');
						}else if(donde=='historial'&&it.historial=="true"&&it.vertotales=="false"){
							envia('historialst');
						}else if(donde=='configuracion'&&it.configuracion=="true"){
							envia('config');
						}else if(donde=='productos'){
							envia('listaproductos');
						}else if(donde=='nube'&&it.irnube=="true"){
							IraNube(document.getElementById('linklogin'));
						}else if(donde=='nube'&&it.irnube=="false"){
							if(localStorage.getItem("idioma")==1)
							showalert("No tiene suficientes privilegios para acceder o su clave es incorrecta.");
							else if(localStorage.getItem("idioma")==2)
							showalert("You don't have enough privileges to access, or the password is incorrect.");
						}
					}else{
						if(localStorage.getItem("idioma")==1)
						showalert("No tiene suficientes privilegios para acceder o su clave es incorrecta.");
						else if(localStorage.getItem("idioma")==2)
						showalert("You don't have enough privileges to access, or the password is incorrect.");
						localStorage.setItem("claveuser","");
					}					
				}).fail(function(){
				});
			}
		}
		else{
			//alert(donde);
			if(donde=='historial'){
				envia('historial');
			}else if(donde=='configuracion'){
				envia('config');
			}else if(donde=='productos'){
				envia('listaproductos');
			}else if(donde=='nube'){
				IraNube(document.getElementById('linklogin'));
			}
		}        
	}
	function VerificarColombiaNit(numero){
		var primos=[71,67,59,53,47,43,41,37,29,23,19,17,13,7,3];
		var numero=numero.replace("-","");
		//console.log(numero);
		if(!numero.length==10){
			//console.log("no 10");
			return false;
		}else{
			var validar=numero.substring(0,9);
			validar="000000"+validar;
			//console.log(validar);
			var suma=0;
			for(var i=0;i<=14;i++){
				suma+=parseInt(validar[i])*primos[i];
			}
			//console.log(suma);
			var res=suma%11;
			var digitocheck=0;
			if(res==0||res==1){
				digitocheck=res;
			}else{
				digitocheck=11-res;
			}
		
			if(digitocheck==numero[9]){
				return true;
			}
			else{
				//console.log(res+"/"+numero[9]);
				return false;
			}
		}
	}
		
	function VerificarChileRut(numero){
		var rutLimpio='';
		var digitoVerificador='';
		var suma=0;
		var contador= 2;
		var valida=false;
		var retorno=false;
		 
		rutLimpio =numero.replace(/-/g,"");
		rutLimpio =rutLimpio.replace(/ /g,"");
		rutLimpio =rutLimpio.replace(/[.]/g,"");
		
		rutLimpio = rutLimpio.substring(0,rutLimpio.length-1);
		digitoVerificador = numero.substring(numero.length - 1,numero.length);
		
		console.log(rutLimpio+"/"+digitoVerificador);
		
		for(var i=rutLimpio.length-1;i>=0;i--){
			if(contador>7){
				contador=2;
			}
			
			suma+=parseInt(rutLimpio[i])*contador;
			contador++;
			valida=true;
		}
		
		if(valida){
			var dv=11-(suma%11);
			var digVer=dv.toString();
			if(dv==10)
				digVer="K";
			if(dv==11)
				digVer="0";
			
			console.log(digVer);
			if(digVer==digitoVerificador.toUpperCase())
				return true;
			else
				return false;
		}
	}

	function VerificarArgentinaCuit(numero){
		cuitLimpio =numero.replace(/-/g,"");
		cuitLimpio =cuitLimpio.replace(/ /g,"");
		cuitLimpio =cuitLimpio.replace(/[.]/g,"");
		console.log(cuitLimpio);
		
		var n=cuitLimpio[0]*6+cuitLimpio[1]*7+cuitLimpio[2]*8+cuitLimpio[3]*9+cuitLimpio[4]*4+cuitLimpio[5]*5+cuitLimpio[6]*6+cuitLimpio[7]*7+cuitLimpio[8]*8+cuitLimpio[9]*9;
		
		console.log(n);
		
		n = n%11;
		
		console.log(n);

		if(parseInt(n) == parseInt(cuitLimpio[10]))
			return true;
		else
			return false;
	}


	function VerificarPeruSunat(numero){
		
		rucLimpio =numero.replace(/-/g,"");
		rucLimpio =rucLimpio.replace(/ /g,"");
		rucLimpio =rucLimpio.replace(/[.]/g,"");
		console.log(rucLimpio);
		
		var dos=rucLimpio.substring(0,2);
		if(!(dos==10||dos==15||dos==17||dos==20)){
			return false;
		}
		
		var suma=rucLimpio[0]*5+rucLimpio[1]*4+rucLimpio[2]*3+rucLimpio[3]*2+rucLimpio[4]*7+rucLimpio[5]*6+rucLimpio[6]*5+rucLimpio[7]*4+rucLimpio[8]*3+rucLimpio[9]*2;
		
		console.log(suma);
		
		n = suma/11;
		console.log(n);
		
		n=11-(suma-(parseInt(n)*11));
		console.log(n);

		if(parseInt(n) == parseInt(rucLimpio[10]))
			return true;
		else
			return false;
		return true;
	}

	function VerificarMexicoRfc(cadena){
		var i = 0;
		var confirmacion = true;
		cadena =cadena.replace(/-/g,"");
		cadena =cadena.replace(/ /g,"");
		cadena =cadena.replace(/[.]/g,"");
		if (cadena.length > 11 && cadena.length < 14)
		{
			if (cadena.length == 12)
			{
				cadena = "-" + cadena;
				i = 1;
			}
			for (var j = i; j <= 3; j++)
			{
				if (parseInt(cadena[j])>0)
					confirmacion = false;
			}
			for (var j = 4; j <= 9; j++)
			{
				if (!(parseInt(cadena[j])>=0&&parseInt(cadena[j])<=9))
					confirmacion = false;
			}
			if (!confirmacion)
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
		if (confirmacion)
			return true;
		else
			return false;
	}

	function GenerarClaveElectronica(cedula){
		var digito1=parseInt(cedula[2])+5;
		var digito2=parseInt(cedula[3])+7;
		var digito3=parseInt(cedula[6])+parseInt(cedula[7]);
		var letras=["A", "C", "E", "G", "I", "K", "M", "O", "Q", "S", "U", "W", "Y", "B", "D", "F", "H", "J", "L"];
		return digito1.toString()+digito2.toString()+letras[digito3];
	}