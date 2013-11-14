--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dataExp` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`ID`, `nome`, `email`, `senha`, `dataExp`) VALUES
(1, 'Webinga', 'sites@webinga.com.br', '202cb962ac59075b964b07152d234b70', '2020-01-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cultos`
--

CREATE TABLE IF NOT EXISTS `cultos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `destaque` int(10) NOT NULL,
  `dia` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `hora` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `cultos`
--

INSERT INTO `cultos` (`ID`, `destaque`, `dia`, `nome`, `hora`) VALUES
(12, 0, 'Domingo', 'Escola Bíblica', '09:30'),
(13, 1, 'Quinta', 'Melhor Idade', '15:00'),
(14, 1, 'Quinta', 'Adolescentes', '20:00'),
(15, 0, 'Sabado', 'Jovens', '20:00'),
(16, 1, 'Domingo', 'Ceia', '09:00'),
(17, 0, 'Quarta', 'Familias', '20:00'),
(18, 1, 'Quarta', 'Familias', '20:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enquete`
--

CREATE TABLE IF NOT EXISTS `enquete` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(255) NOT NULL,
  `op1` varchar(255) NOT NULL,
  `op2` varchar(255) NOT NULL,
  `op3` varchar(255) NOT NULL,
  `op4` varchar(255) NOT NULL,
  `votOp1` int(20) NOT NULL,
  `votOp2` int(20) NOT NULL,
  `votOp3` int(20) NOT NULL,
  `votOp4` int(20) NOT NULL,
  `totalVotos` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `enquete`
--

INSERT INTO `enquete` (`ID`, `pergunta`, `op1`, `op2`, `op3`, `op4`, `votOp1`, `votOp2`, `votOp3`, `votOp4`, `totalVotos`) VALUES
(1, 'Você deixa de ler a Bíblia e orar no período de férias?', 'Claro que não', 'Leio a Bíblia e oro com pouca frequência.', 'Acabo deixando de lado', 'Reforço ainda mais a leitura da Bíblia', 2, 1, 2, 3, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(255) NOT NULL,
  `link_inscricao` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`ID`, `nome`, `data`, `hora`, `link_inscricao`, `descricao`) VALUES
(10, 'Lorem Ipsum é simple', '2013-10-22', '18:00', '', 'Lorem Ipsum é simplesmente'),
(11, 'Lorem Ipsum é simple', '2013-10-22', '18:00', '', 'Lorem Ipsum é simplesmente'),
(12, 'Lorem Ipsum é simple', '2013-10-22', '18:00', '', 'Lorem Ipsum é simplesmente'),
(13, 'Lorem Ipsum é simple', '2013-10-22', '18:00', '', 'Lorem Ipsum é simplesmente'),
(14, 'Lorem Ipsum é simple', '2013-10-22', '18:00', '', 'Lorem Ipsum é simplesmente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_galeria`
--

CREATE TABLE IF NOT EXISTS `fotos_galeria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `galeriaID` int(20) NOT NULL,
  `legenda` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `fotos_galeria`
--

INSERT INTO `fotos_galeria` (`ID`, `galeriaID`, `legenda`, `foto`) VALUES
(1, 1, '', '1.jpg'),
(7, 1, '', '2.jpg'),
(8, 1, '', '3.jpg'),
(9, 1, '', '4.jpg'),
(10, 1, '', '5.jpg'),
(11, 1, '', '6.jpg'),
(12, 1, '', '7.jpg'),
(13, 1, '', '8.jpg'),
(14, 1, '', '9.jpg'),
(15, 1, '', '10.jpg'),
(16, 1, '', '11.jpg'),
(17, 1, '', '12.jpg'),
(18, 1, '', '13.jpg'),
(19, 1, '', '14.jpg'),
(20, 1, '', '15.jpg'),
(21, 1, '', '16.jpg'),
(22, 1, '', '17.jpg'),
(23, 1, '', '18.jpg'),
(24, 1, '', '19.jpg'),
(25, 1, '', '20.jpg'),
(33, 5, '1', '36489d893ef4a12b5e0a127bd921ca90.jpg'),
(34, 5, '2', '5920c0a39b2f6966b460989ae0a65047.jpg'),
(35, 5, '3', 'c5825d1cd62d12f7f27b1ad2303283dc.jpg'),
(36, 5, '4', 'a84d76b5eca8ce49e2f7ca7fc9691992.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`ID`, `nome`) VALUES
(5, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`ID`, `data`, `foto`, `titulo`, `descricao`) VALUES
(16, '2013-10-22', '70e1f89957bb63310dd276f6a630c0f0.jpg', 'IV Simpósio da Diaconia', '<p>Tema: &quot;Saindo ao mundo para servir&quot;</p><p>&quot;O resultado real da evangeliza&ccedil;&atilde;o n&atilde;o &eacute; quantos entram no templo para adorar, mas quantos saem para servir&quot;<br />Refer&ecirc;ncia &nbsp;B&iacute;blica: Mateus 20.28</p><p>Professores:</p><p>Pr. Alv&aacute;ro Alem Sanches &ndash; Uberl&acirc;ndia MG<br />Enfoque Tem&aacute;tico: Educa&ccedil;&atilde;o Secular e Recupera&ccedil;&atilde;o Terap&ecirc;utica Educativa: Desafios para a Igreja contempor&acirc;nea</p><p>Pr. Antonio Carlos Barro &ndash; Londrina &nbsp;PR<br />Enfoque Tem&aacute;tico: Base B&iacute;blica da Miss&atilde;o Integral</p><p>Ir&ordf;. C&eacute;lia Marendaz &ndash; Londrina &nbsp;PR<br />Enfoque Tem&aacute;tico: &quot;Testemunho e Evangeliza&ccedil;&atilde;o: Elementos fundamentais do estilo de vida da mulher crist&atilde;&quot;</p><p>Ir&ordf;. Rute Brito &ndash; Maring&aacute; &nbsp;PR<br />Enfoque Tem&aacute;tico: &quot;Chamadas para servir&quot;</p>'),
(18, '2013-10-22', '017b09e67b63c7d304b18ea96fcfd553.jpg', 'Estudo Bíblico para Jovens', '<p>&quot;Se voc&ecirc; se encontra amando qualquer prazer mais do que as ora&ccedil;&otilde;es ou a B&iacute;blia, qualquer casa mais do que a de Deus, qualquer pessoa mais do que Cristo, voc&ecirc; est&aacute; correndo o perigo do mundanismo[1]&quot;</p><p>H&aacute; uma figura muito usada para explicar esta rela&ccedil;&atilde;o com o mundo: &eacute; a do barquinho na &aacute;gua. O barquinho pode estar na &aacute;gua, mas a agua n&atilde;o pode estar no barquinho.</p><p><br />&nbsp;</p><p><br />&nbsp;</p><p><br />Neste estudo, vamos examinar o que Jo&atilde;o diz sobre confian&ccedil;a irrestrita em Cristo que o crist&atilde;o desenvolve em confronto com o mundo. Inicialmente, Jo&atilde;o enfatiza duas caracter&iacute;sticas importantes de crist&atilde;os que t&ecirc;m a verdadeira f&eacute;.</p><p><br />Primeira: Os crist&atilde;os que desenvolvem uma verdadeira f&eacute; em Cristo tem uma profunda convic&ccedil;&atilde;o de que o Evangelho do Senhor n&atilde;o &eacute; meramente uma teoria e que o registro da vida de Jesus de Nazar&eacute; n&atilde;o &eacute; uma lenda, uma fic&ccedil;&atilde;o.</p><p><br />Segunda: Eles s&atilde;o obedientes aos mandamentos de Deus e eles n&atilde;o praticam deliberadamente o pecado (pecado para esses crist&atilde;os &eacute; um acidente e n&atilde;o um estilo de vida), mas procuram praticar justi&ccedil;a e pureza.</p><p>O ap&oacute;stolo Jo&atilde;o declara cinco verdades muito relevantes sobre a f&eacute; em Jesus Cristo. &Eacute; exatamente esta f&eacute; que tamb&eacute;m devemos exercer em nosso dia a dia.</p><p>1. &nbsp; &nbsp;F&eacute; &eacute; o meio pelo qual alcan&ccedil;amos vit&oacute;ria contra o mundo (mundanismo)</p><p>A palavra &quot;mundo&quot; na B&iacute;blia Sagrada tem tr&ecirc;s sentidos b&aacute;sicos:</p><p>&nbsp; &nbsp; &nbsp;O globo terrestre e todo o universo (Hb 1.2 e 11.3). A este Deus tamb&eacute;m ama, criou-o para Sua gl&oacute;ria. O pecado o amaldi&ccedil;oou, mas a salva&ccedil;&atilde;o promovida por Jesus no Calv&aacute;rio tamb&eacute;m pressup&otilde;e a sua salva&ccedil;&atilde;o, pois ele tamb&eacute;m geme aguardando a sua reden&ccedil;&atilde;o (Rm 8,22).</p><p>Abramos um par&ecirc;ntese aqui para relembrarmos que Deus ama o mundo (cria&ccedil;&atilde;o, o globo terrestre e todo o universo). A salva&ccedil;&atilde;o &eacute; um conceito mais levado que normalmente os crentes imaginam. Ecologia, por exemplo, n&atilde;o foram os homens que inventaram. Como Deus ama a Sua cria&ccedil;&atilde;o, Ele prop&ocirc;s um repouso para a terra a cada sete anos, ou seja, a lei do ano saba&acute;tico (Lv 25).</p><p><br />O profeta Ose&acute;ias retoma os ini&acute;cios da criac&cedil;a~o e renova a promessa divina de reconcilia&ccedil;&atilde;o e prop&otilde;e um di&aacute;logo entre os seres humanos e a cria&ccedil;&atilde;o (Os 2.21-25). O sonho humano percorre a Bi&acute;blia e se expressa em seu final, isto &eacute;, ver a cria&ccedil;&atilde;o de novos ce&acute;us e nova terra (Ap 21,1), onde habitara&acute; a justic&cedil;a (2Pd 3,13).</p><p>&nbsp;Os seres humanos que habitam a terra. Esta &eacute; a segunda acep&ccedil;&atilde;o da express&atilde;o &quot;mundo&quot;. Neste sentido do termo, o &quot; mundo&quot; &eacute; &nbsp;objeto do amor de Deus (Jo 3.16, 1Jo 2.2).</p><p>&nbsp;O jeito de ser e o sistema contra a vida, o amor e a santidade do Pai celestial (Leiamos: Jo15.18-23; 1Jo 3.13; 2.15-17; e 4.3-6).</p><p>Mundanismo &eacute; o estilo de vida inspirado por Satan&aacute;s que, aproveitando-se &nbsp; &nbsp; &nbsp; da natureza carnal das pessoas n&atilde;o regeneradas (ego&iacute;stas) e por meio de seus dem&ocirc;nios, instiga os seres humanos a serem ego&iacute;stas, inimigos de Deus, do povo se Deus (Jo15.18-23; 1Jo 3.13) e da Palavra de Deus. Quando ele diz para n&atilde;o amarmos o &quot;mundo&quot; (Leiamos 1Jo 2.15-17 e 4.3-6) &eacute; a esse mundo que ele se refere, isto &eacute;, n&atilde;o podemos amar o mundanismo!</p>'),
(19, '2013-10-23', '11f323cb44ce9825306f2179255ab6b9.jpg', 'Liderança Jovem Representa a Igreja em Congresso', '<p>Nossa gratid&atilde;o tamb&eacute;m aos demais edis, que apresentaram o documento no &uacute;ltimo dia: Chico Caiana (PTB), Ideval de Oliveira (PMN), M&aacute;rcia Socreppa (PSDB) e o relator Humberto Henrique (PT). Parabenizo-os pelo primoroso relat&oacute;rio final sobre a investiga&ccedil;&atilde;o. A disposi&ccedil;&atilde;o em servir a comunidade da parte do Ev. Luciano Brito foi claramente evidenciada.</p><p>Ontem a Presid&ecirc;ncia da igreja conversou com uns vinte eleitores dele que se &quot;orgulhavam&quot; de ter em votado no Vereador Luciano; n&atilde;o somente na lideran&ccedil;a desta CPI, mas pelos demais projetos de lei de sua autoria e pela suas a&ccedil;&otilde;es no parlamento municipal. O nome de Deus tem sito glorificado pelo desempenho da Miss&atilde;o de Deus na C&acirc;mara por parte do Ev. Luciano!&nbsp;</p><p>O relat&oacute;rio da CPI do Transporte Coletivo &nbsp;de Maring&aacute; foi superior a muitas cidades (at&eacute; capitais) que tiveram comiss&otilde;es similares: tinha quase 600 p&aacute;ginas - al&eacute;m de mais de 4 mil p&aacute;ginas de anexos referentes aos documentos solicitados ao Executivo Municipal e &agrave; empresa Transporte Coletivo Cidade Can&ccedil;&atilde;o (TCCC).</p><p>Ontem, em entrevista a nossa R&Aacute;DIO TODODIA FM 106,5 ao Jornalista Edson Bruno o Vereador Luciano Brito disse que o relat&oacute;rio final da CPI apresentou exig&ecirc;ncias em tr&ecirc;s &aacute;reas: pre&ccedil;o da tarifa, contrato com a Prefeitura de Maring&aacute; e qualidade do servi&ccedil;o. O documento aprovado defende a redu&ccedil;&atilde;o da tarifa em R$ 0,20. O c&aacute;lculo leva em considera&ccedil;&atilde;o a rela&ccedil;&atilde;o entre o pre&ccedil;o or&ccedil;ado p ara a composi&ccedil;&atilde;o tarif&aacute;ria e o gasto pela empresa na aquisi&ccedil;&atilde;o de pe&ccedil;as e acess&oacute;rios, pneus, recapagens e lubrificantes, por exemplo.</p><p>Os maringaenses est&atilde;o felizes porque dentre outras melhorias, o Vereador Luciano Brito liderou os membros da CPI a defenderem benfeitorias no terminal urbano, aumento no n&uacute;mero de pontos de &ocirc;nibus com cobertura e a implanta&ccedil;&atilde;o de terminais regionais, faixas preferenciais e corredores exclusivos. Parab&eacute;ns a todos os usu&aacute;rios!</p>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reunioes`
--

CREATE TABLE IF NOT EXISTS `reunioes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(255) NOT NULL,
  `link_inscricao` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `reunioes`
--

INSERT INTO `reunioes` (`ID`, `nome`, `data`, `hora`, `link_inscricao`, `descricao`) VALUES
(10, 'Lorem Ipsum é simple', '2013-10-22', '20:30', '', 'Lorem Ipsum é simplesmente'),
(11, 'Lorem Ipsum é simple', '2013-10-22', '20:30', '', 'Lorem Ipsum é simplesmente'),
(12, 'Lorem Ipsum é simple', '2013-10-22', '20:30', '', 'Lorem Ipsum é simplesmente'),
(13, 'Lorem Ipsum é simple', '2013-10-22', '20:30', '', 'Lorem Ipsum é simplesmente'),
(14, 'Lorem Ipsum é simple', '2013-10-22', '20:30', '', 'Lorem Ipsum é simplesmente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slider_home`
--

CREATE TABLE IF NOT EXISTS `slider_home` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `slider_home`
--

INSERT INTO `slider_home` (`ID`, `foto`) VALUES
(34, '7f878c9ebe1b4b4d02f59de66054e811.jpg'),
(35, '523c77a3a26ac7a55621912cc68f9784.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `textos`
--

CREATE TABLE IF NOT EXISTS `textos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `textos`
--

INSERT INTO `textos` (`ID`, `tipo`, `texto`, `foto`) VALUES
(5, 'missao', '<p>asdasd&nbsp;ut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, qu</p><p>is nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui&nbsp;asdasdin ea&nbsp;complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of hu&nbsp;man ha&nbsp;&nbsp;ppi&nbsp;ness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally&nbsp;encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occ</p><p>asionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from&quot;</p>', '05e1995eec24c28feafe99a7291d94d2.jpg'),
(6, 'visao', '<p>asdasd&nbsp;ut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, qu</p><p>is nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui&nbsp;asdasdin ea&nbsp;complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of hu&nbsp;man ha&nbsp;&nbsp;ppi&nbsp;ness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally&nbsp;encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occ</p><p>&nbsp;</p><p>asionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from&quot;</p>', '4ee2c9433d905f5d2750c9910da2dd0e.jpg'),
(7, 'valores', '<p>asdasd&nbsp;ut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, qu</p><p>is nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui&nbsp;asdasdin ea&nbsp;complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of hu&nbsp;man ha&nbsp;&nbsp;ppi&nbsp;ness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally&nbsp;encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occ</p><p><span style="line-height:1.6em">rcumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from&quot;</span></p>', 'b946f90a1c960cb21a6ff4df21fd3097.jpg'),
(8, 'historia', '<p>Passagem padr&atilde;o original de Lorem Ipsum, usada desde o s&eacute;culo XVI.&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;Se&ccedil;&atilde;o 1.10.32 de &quot;de Finibus Bonorum et Malorum&quot;, escrita por C&iacute;cero em 45 AC&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et qu<br />&nbsp;</p><p>asi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Teste de edi&ccedil;&atilde;o&quot;</p>', '2f1cef8ecab7420dd94d0757dd819779.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `update_sistema`
--

CREATE TABLE IF NOT EXISTS `update_sistema` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `lastVersion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dataUpdate` datetime NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `update_sistema`
--

INSERT INTO `update_sistema` (`ID`, `lastVersion`, `dataUpdate`, `notes`) VALUES
(1, '7.0.3', '2013-11-06 11:08:15', 'asdas'),
(17, '7.0.5', '2014-03-13 11:08:15', 'YXNkYXNhc2QNCmFzDQpkYXMNCmQNCmFzPGJyIC8+DQphc2QNCnNhDQpk');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `views` int(20) NOT NULL,
  `data` date NOT NULL,
  `nome` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`ID`, `views`, `data`, `nome`, `video`) VALUES
(27, 1, '2013-10-22', 'Banda Megafone', 'kTCSHdIAhEc'),
(28, 1, '2013-10-22', 'Igreja Batista de Sião', 'vZytaUWwtxw'),
(29, 0, '2013-08-18', 'Culto Domingo ', 'kAz1NczcYks'),
(30, 5, '2013-09-01', 'Culto Domingo ', '3HDsQLoefK4'),
(31, 0, '2013-08-11', 'Culto Domingo Parte I', 'j7dm_XkIsCk'),
(32, 0, '2013-08-11', 'Culto Domingo Parte II', 'j7dm_XkIsCk'),
(33, 0, '2013-10-22', 'Banda Ligação', 'i2hachxsn-M'),
(34, 4, '2013-10-22', 'Abateen', '5gsM3UdgLTA'),
(35, 0, '2013-10-01', 'Culto Jubs', '-J0w3c_VP0E'),
(36, 0, '2013-09-28', 'Culto Jubs', 'iFKbFB5j87Q');
