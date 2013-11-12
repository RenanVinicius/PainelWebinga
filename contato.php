	<div id="contato">

		<div class="contato esc">
			<h1>CONTATO</h1>
			<p>Estamos a sua disposi&ccedil;&atilde;o para esclarecimento de d&uacute;vidas, sugest&otilde;es, elogios e cr&iacute;ticas. Por favor, preencha corretamente os campos abaixo.</p>
			<form name="formContato" id="formContato" method="post" action="#">
				<div>Nome</div>
				<input type="text" name="nomeC" id="nomeC" />
				<div>E-mail</div>
				<input type="text" name="emailC" id="emailC" />
				<div>Telefone</div>
				<input onKeyPress="mascara(this, Telefone)" maxlength="14" type="text" name="telefoneC" id="telefoneC" />
				<div>Assunto</div>
				<input type="text" name="assuntoC" id="assuntoC" />
				<div>Mensagem</div>
				<textarea name="msgC" id="msgC"></textarea>
				<input type="submit" name="enviarContato" id="enviarContato" onClick="return false;" value="ENVIAR" />
				<input type="reset" value="CANCELAR" />
				<div id="resultContato"></div>
			</form>
		</div>

		<div class="contato dir">
			<h1>DEMAIS INFORMA&Ccedil;&Otilde;ES</h1>
			<p>(44) 3262-2217</p>
			<p><?php echo data_sistem("emailGeral"); ?></p>
			<br />
			<br />
			<h1>NOSSA LOCALIZA&Ccedil;&Atilde;O</h1>
			<p>R. Manoel de Macedo, 37  Maring&aacute; - PR, 87020-240</p>
			<iframe src="https://www.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+Manoel+de+Macedo,+37+Maring%C3%A1+-+Paran%C3%A1+-+Brasil&amp;aq=&amp;sll=-23.405727,-51.968329&amp;sspn=1.077543,2.113495&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Manoel+de+Macedo,+37+-+Zona+07,+Maring%C3%A1+-+Paran%C3%A1,+87020-240&amp;t=m&amp;z=14&amp;ll=-23.408785,-51.944761&amp;output=embed"></iframe>
		</div>

		<div class="clear"></div>

	</div>