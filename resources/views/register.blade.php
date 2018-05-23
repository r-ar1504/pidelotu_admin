@extends('master.master-template')

@section('register')
<div style="margin-top: 150px;"></div>
<div class="container">
	<h1 align="center"><i class="fa fa-users"></i> Registra tu restaurante</h1>
	<form action="/registrando" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="row">
			<div class="col-md-6">
				<h3>Datos del restaurante</h3>
				<br>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Nombre del restaurante:</label>
								<input type="text" class="form-control" name="name" placeholder="Nombre del restaurante">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="phone">Telefono: </label>
								<input type="text" class="form-control" id="phone" name="phone" placeholder="Telefono">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="state">Estado: </label>
								<select name="state" class="form-control">
									<option value="" selected="" disabled="">Estado</option>
									<option value="AGU">AGUASCALIENTES</option>
									<option value="BCN">BAJA CALIFORNIA</option>
									<option value="BCS">BAJA CALIFORNIA SUR</option>
									<option value="CAM">CAMPECHE</option>
									<option value="CHP">CHIAPAS</option>
									<option value="CHH">CHIHUAHUA</option>
									<option value="DF">CIUDAD DE MEXICO</option>
									<option value="COA">COAHUILA DE ZARAGOZA</option>
									<option value="COL">COLIMA</option>
									<option value="DUR">DURANGO</option>
									<option value="MEX">ESTADO DE MEXICO</option>
									<option value="GUA">GUANAJUATO</option>
									<option value="GRO">GUERRERO</option>
									<option value="HID">HIDALGO</option>
									<option value="JAL">JALISCO</option>
									<option value="MIC">MICHOACAN</option>
									<option value="MOR">MORELOS</option>
									<option value="NAY">NAYARIT</option>
									<option value="NLE">NUEVO LEON</option>
									<option value="OAX">OAXACA</option>
									<option value="PUE">PUEBLA</option>
									<option value="QUE">QUERETARO</option>
									<option value="ROO">QUINTANA ROO</option>
									<option value="SLP">SAN LUIS POTOSI</option>
									<option value="SIN">SINALOA</option>
									<option value="SON">SONORA</option>
									<option value="TAB">TABASCO</option>
									<option value="TAM">TAMAULIPAS</option>
									<option value="TLA">TLAXCALA</option>
									<option value="VER">VERACRUZ</option>
									<option value="YUC">YUCATAN</option>
									<option value="ZAC">ZACATECAS</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="cp">Código Postal: </label>
								<input id="cp" type="text" class="form-control" name="cp" placeholder="Código postal (Sólo Números)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="city">Ciudad: </label>
								<input type="text" class="form-control" name="city" placeholder="Ciudad">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Dirección del restaurante: </label>
								<input type="text" class="form-control" name="address" placeholder="Dirección del restaurante">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="number">Número: </label>
								<input id="number" type="text" class="form-control" name="number" placeholder="Número">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="number-r">Número del restaurante: </label>
								<input id="number-r" type="text" class="form-control" name="number-r" placeholder="Número del restaurante (solo números)">
							</div>			
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="details">Información adicional</label>
								<input type="text" class="form-control" name="details" placeholder="Información adicional">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="type">Tipo de cocina</label>
								<select name="type" class="form-control">
									<option value="null" selected="" disabled="">Tipo de cocina</option>
									<option value="Alitas y Pollo">Alitas y Pollo</option>
									<option value="Árabe">Árabe</option>
									<option value="Café y Dulces">Café y Dulces</option>
									<option value="Carnes y Argentinos">Carnes y Argentinos</option>
									<option value="China, Asiática y Oriental">China, Asiática y Oriental</option>
									<option value="Comida Rápida">Comida Rápida</option>
									<option value="Desayunos">Desayunos</option>
									<option value="Ensaladas y Comida Sana">Ensaladas y Comida Sana</option>
									<option value="Hamburguesas">Hamburguesas</option>
									<option value="Hamburguesas y Sandwiches">Hamburguesas y Sandwiches</option>
									<option value="Japonesa">Japonesa</option>
									<option value="Libanesa y Árabe">Libanesa y Árabe</option>
									<option value="Mariscos">Mariscos</option>
									<option value="Mexicana">Mexicana</option>
									<option value="Oriental">Oriental</option>
									<option value="Otros e Internacional">Otros e Internacional</option>
									<option value="Parrilla">Parrilla</option>
									<option value="Pescados y Mariscos">Pescados y Mariscos</option>
									<option value="Pizzas e Italiana">Pizzas e Italiana</option>
									<option value="Pollo">Pollo</option>
									<option value="Postres">Postres</option>
									<option value="Saludable">Saludable</option>
									<option value="Sandwiches y Tortas">Sandwiches y Tortas</option>
									<option value="Sushi">Sushi</option>
									<option value="Típica y Ejecutiva">Típica y Ejecutiva</option>

								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<h3>Datos del representante legal</h3>
				<br>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact_name">Nombre del representante legal: </label>
								<input type="text" class="form-control" name="contact_name" placeholder="Nombre del representante legal">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact_lastname">Apellidos del representante legal: </label>
								<input type="text" class="form-control" name="contact_lastname" placeholder="Apellidos del representante legal">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact_email">Correo del representante legal: </label>
								<input type="email" class="form-control" name="contact_email" placeholder="Correo electronico del representante legal">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact_phone">Telefono del representante legal: </label>
								<input id="contact_phone" type="text" class="form-control" name="contact_phone" placeholder="Telefono del representante legal">
							</div>
						</div>
					</div>
				</div>
				<h3>¿Ya entrega a domicilio?</h3>
				<br>
				<br>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="time">¿Cuánto tiempo a entregado a domicilio?</label>
								<input type="email" class="form-control" name="time" placeholder="¿Cuánto tiempo a entregado a domicilio? (Ej. 1 año)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="count_month">Cantidad de entregas a domicilio por mes</label>
								<input id="count_month" type="text" class="form-control" name="count_month" placeholder="Cantidad de entregas a domicilio por mes. (Ej. 100)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="count_rep">Cantidad de repartidores: </label>
								<input id="rep" type="text" class="form-control" name="count_rep" placeholder="Cantidad de repartidores. (Ej. 5)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="type_rep">¿En que hace el reparto?</label>
								<input type="text" class="form-control" name="type_rep" placeholder="¿En que hace el reparto? (Ej. Automovil)">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<input type="submit" name="send" value="Enviar" class="btn btn-success" style="width: 100%;">
			</div>
			<br>
			<br>
			<div class="col-md-12">
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<p>Corrige los siguientes errores:</p>
					<ul>
						@foreach ($errors->all() as $message)
						<li>{{ $message }}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</form>
</div>
@stop

@section('js')
<script type="text/javascript" src="{{elixir('libs/mask/src/jquery.mask.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#phone').mask('(000)-000-0000');
		$('#cp').mask('00000');
		$('#number').mask('000');
		$('#number-r').mask('0000000000');
		$('#contact_phone').mask('(000)-000-0000');
		$('#count_month').mask('0000');
	});
</script>
@stop