<?php

/*
imagizer 1.0
by vitorgga
www.vitorgga.com

///////////////////////////////////////////////////////////////////////////////////////////////////////

exemplos:
imagizer("imagem.jpg",50,50,2,0,"mini_imagem.jpg",jpg); //cria a miniatura da imagem.jpg, com tamanho 50x50 fixo, saída formato jpg
imagizer("imagem.jpg",440,330,1,0,"imagem.jpg",jpg,"marca.png",1); //insere a marca.png na imagem, posição top-left
<img src="imagizer_export.php?imagem.jpg,50,50,2,0,,jpg" width="50" height="50" alt=""> //código html, exibe a miniatura 50x50 da imagem.jpg, saida jpg

///////////////////////////////////////////////////////////////////////////////////////////////////////

imagizer_export.php
envie os comandos, conforme a funcao, sem " aspas, separados por vírgulas
imagizer_export.php?varchar,int,int,int,int,*,varchar3,varchar*,int*
imagizer_export.php?0,1,2,3,4,5*,6,7*,8*
*opcionais

///////////////////////////////////////////////////////////////////////////////////////////////////////

função imagizer
imagizer($imagem,$dw,$dh,$formato=1,$curvas=false,$saida=true,$sextensao="",$mascara="",$mascara_pos=1)
             0     1  2       3            4           5            6           7             8

0) [varchar] nome do arquivo, local do arquivo local
   jpg, jpeg, pjpg, jpeg, gif, png, bmp
1) [int] largura destino
2) [int] altura destino, em pixels
3) [int] formato, 1 ou 2
   1 = largura e altura proporcional, quando atingir um dos 2 valores, ajusta.
     = a saída será proporcional
   2 = largura e altura fixos, cortando a imagem, fixando os valores
     = a saída será fixa, de acordo com $dw e $dh
4) [int] curvas, insere as curvas 8x8 na imagem, imagizer1.png a imagizer4.png
   se a imagem for transparente, a transparência nas curvas não existirá
5) [int][varchar] modo de saida
  0 = retorna a imagem no navegador
  1 = retorna o resource com a imagem
  url = cria o arquivo com a imagem, no local especificado
6) [varchar] extensão de saída
   jpg, gif, png ou bmp
   formato de como será a saída
7) [varchar] máscara
   arquivo png que será inserido na imagem, como máscara
8) [int] posição da máscara
   de 0 a 8
   sendo:
   1 5 2
   8 0 6
   4 7 3
/////////////////////////////////////////////////////////////////////////////////////////////////////////

*/

function imagizer($imagem,$dw,$dh,$formato=1,$curvas=false,$saida=true,$sextensao="",$mascara="",$mascara_pos=7)
{
 $extensao = strtolower(substr($imagem,strrpos($imagem,".")+1));
 switch($extensao)
 {
  case "jpg": $img = imagecreatefromjpeg($imagem); break;
  case "jpeg": $img = imagecreatefromjpeg($imagem); break;
  case "pjpg": $img = imagecreatefromjpeg($imagem); break;
  case "pjpeg": $img = imagecreatefromjpeg($imagem); break;
  case "gif": $img = imagecreatefromgif($imagem); break;
  case "png": $img = imagecreatefrompng($imagem); break;
  case "bmp": $img = imagecreatefromwbmp($imagem); break;
 }
 $w = @imagesx($img);
 $h = @imagesy($img);

 if($formato=="1")
 {
  //width=w
  //x=dw
  if($w>$h)
  {
   $new_width=$dw;
   $new_height=(($dw*$h)/$w);
   settype ($new_height, "integer");
  }
  else if($w<$h)
  {
   $new_width=(($dh*$w)/$h);
   $new_height=$dh;
   settype($new_width, "integer");
  }
  else
  {
   $new_width = $dw;
   $new_height = $dh;
  }
  $dw = $new_width;
  $dh = $new_height;

  $tmp_img = imagecreatetruecolor($new_width, $new_height);

  $$tmp_img = imagecreatetruecolor($dw, $dh);
  imagecolorallocate($tmp_img,255,255,255);
  $c  = imagecolorallocate($tmp_img,255,255,255);
  for ($i=0;$i<=$dh;$i++) { imageline($tmp_img,0,$i,$dw,$i,$c); }

  //imagecolorallocate($img,255,255,255);
  imagecopyresampled($tmp_img,$img,0,0,0,0,$new_width,$new_height,$w,$h);
  //imagecopyresized($tmp_img,$img,0,0,0,0,$new_width,$new_height,$w,$h);
  $img=$tmp_img;
 }
 else
 {
  $im = $img;
  $w1 = $w / $dw;
  if ($dh == 0)
  {
   $h1 = $w1;
   $hei = $h / $w1;
  }
  else
  {
   $h1 = $h / $dh;
  }
  $min = min($w1,$h1);

  $xt = $min * $dw;
  $x1 = ($w - $xt) / 2;
  $x2 = $w - $x1;

  $yt = $min * $dh;
  $y1 = ($h - $yt) / 2;
  $y2 = $h - $y1;

  $x1 = (int) $x1;
  $x2 = (int) $x2;
  $y1 = (int) $y1;
  $y2 = (int) $y2;

  $im2 = imagecreatetruecolor($dw,$dh);
  $img = NULL;

  $img = imagecreatetruecolor($dw, $dh);
  imagecolorallocate($img,255,255,255);
  $c  = imagecolorallocate($img,255,255,255);
  for ($i=0;$i<=$dh;$i++) { imageline($img,0,$i,$dw,$i,$c); }

  imagecopyresampled($img,$im,0,0,$x1,$y1,$dw,$dh,$x2-$x1,$y2-$y1);
 }

 if($curvas==true)
 {
  $path="";
  if(@file_exists("../../../imagizer1.png")) { $path="../../../"; }
  if(@file_exists("../../imagizer1.png")) { $path="../../"; }
  if(@file_exists("../imagizer1.png")) { $path="../"; }
  if(@file_exists("imagizer1.png")) { $path=""; }
  $insertfile_id = imageCreateFromPNG($path."imagizer1.png");
  imageCopy($img,$insertfile_id,0,0,0,0,8,8);
  $insertfile_id = imageCreateFromPNG($path."imagizer2.png");
  imageCopy($img,$insertfile_id,$dw-8,0,0,0,8,8);
  $insertfile_id = imageCreateFromPNG($path."imagizer3.png");
  imageCopy($img,$insertfile_id,0,$dh-8,0,0,8,8);
  $insertfile_id = imageCreateFromPNG($path."imagizer4.png");
  imageCopy($img,$insertfile_id,$dw-8,$dh-8,0,0,8,8);
 }

 if($mascara!="")
 {
  mascarar($img,$dw,$dh,$mascara,$mascara_pos);
 }

 if($sextensao!="") { $extensao=$sextensao; }
 if($saida===true)
 {
  switch($extensao)
  {
   case "jpg": header('Content-type: image/jpg'); imagejpeg($img,"",90); break;
   case "gif": header('Content-type: image/gif'); imagegif($img); break;
   case "png": header('Content-type: image/png'); imagepng($img); break;
   case "bmp": header('Content-type: image/wbmp'); imagewbmp($img); break;
  }
 }
 elseif($saida!="")
 {
  switch($extensao)
  {
   case "jpg": imagejpeg($img,$saida,90); break;
   case "gif": imagegif($img,$saida); break;
   case "png": imagepng($img,$saida); break;
   case "bmp": imagewbmp($img,$saida); break;
  }
 }
 else
 {
  switch($extensao)
  {
   case "jpg": return(imagejpeg($img,"",90)); break;
   case "gif": return(imagegif($img,"")); break;
   case "png": return(imagepng($img,"")); break;
   case "bmp": return(imagewbmp($img,"")); break;
  }
 }
}

function mascarar($sourceres,$sourceres_w,$sourceres_h,$insertfile,$pos=1)
{
 //Get the resource id?s of the pictures
 //$insertfile_id = imageCreateFromJPEG($insertfile);
 $insertfile_id = imageCreateFromPNG($insertfile);

 //Get the sizes of both pix
 $sourcefile_width=$sourceres_w;
 $sourcefile_height=$sourceres_h;
 $insertfile_width=@imageSX($insertfile_id);
 $insertfile_height=@imageSY($insertfile_id);

 //middle
 if( $pos == 0 )
 {
  $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
  $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
 }

 //top left
 if( $pos == 1 )
 {
  $dest_x = 0;
  $dest_y = 0;
 }

 //top right
 if( $pos == 2 )
 {
  $dest_x = $sourcefile_width - $insertfile_width;
  $dest_y = 0;
 }

 //bottom right
 if( $pos == 3 )
 {
  $dest_x = $sourcefile_width - $insertfile_width;
  $dest_y = $sourcefile_height - $insertfile_height;
 }

 //bottom left
 if( $pos == 4 )
 {
  $dest_x = 0;
  $dest_y = $sourcefile_height - $insertfile_height;
 }

 //top middle
 if( $pos == 5 )
 {
  $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
  $dest_y = 0;
 }

 //middle right
 if( $pos == 6 )
 {
  $dest_x = $sourcefile_width - $insertfile_width;
  $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
 }

 //bottom middle
 if( $pos == 7 )
 {
  $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
  $dest_y = $sourcefile_height - $insertfile_height;
 }

 //middle left
 if( $pos == 8 )
 {
  $dest_x = 0;
  $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
 }
 return imagecopy($sourceres,$insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height);
}


?>