<?php
    session_start();
    include("./functions/conection.php");
    
    //var_dump($_SESSION);
    $part = "SELECT * FROM participantes WHERE ID = ".$_SESSION['ID']."";
    $participante = mysqli_query($conn, $part);
    $_SESSION['participante'] = mysqli_fetch_assoc($participante);

    $headers = 'From: simposio.naturais@redepharma.com.br'."\r\n".'Reply-To:simposio.naturais@redepharma.com.br'."\r\n".
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $mensagem = '<center>
    <h2>Olá, '.$_SESSION['participante']['NOME'].'</h2>'.

    $mensagem .= '<h3 style="margin-bottom: 0px;">Seu ingresso no 1º Simpósio Redepharma Naturais foi confirmada. O número do seu ingresso é:</h3>';
    
        $comp = "SELECT * FROM entradas WHERE id_cliente = ".$_SESSION['ID']."";
        $comprovante = mysqli_query($conn, $comp);
       
        while($_SESSION['comprovante'] = mysqli_fetch_assoc($comprovante)){
    
           $mensagem .= '<h1 style="margin-top: 0px; margin-bottom: 0px; padding: 0 7px 0 7px; border-radius: 6px; background-color: #682626; color: #fafafa; margin-left: 5px;">'.$_SESSION['comprovante']['codigo'].'</h1>';
    
        }
        
    mail($_SESSION['participante']['EMAIL'],'Participação confirmada', $mensagem, $headers);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <title>Participação Confirmada</title>
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
                * {
                    font-family: 'Lato', sans-serif;
                    font-weight: 700;

                    margin-top: 0;
                    margin-bottom: 2.5px;
                }

                .Grupo1{text-align: center; font-size: 35px;}
                .Grupo2{text-align: center; margin-top: 300px; font-size: 24px;}
                .Grupo3{text-align: right; margin-top: 300px; font-size: 24px;}
                
                @media print {
                    .noPrint{display: none;}
                }
            </style>
    <script>
   
            function getPDF(){
                $("#downloadbtn").hide();
                $("#genmsg").show();
                var HTML_Width =  690;
                var HTML_Height = 930;
                var top_left_margin = 35;
                var PDF_Width = HTML_Width+(top_left_margin*3.25);
                var PDF_Height = (top_left_margin*1)+(PDF_Width*1.35)+(top_left_margin*1);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;
                
                var totalPDFPages = 0;
                

                html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
                    canvas.getContext('2d');
                    
                    console.log(canvas.height+"  "+canvas.width);
                    
                    
                    var imgData = canvas.toDataURL("image/jpeg", 1.0);
                    var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                    
                    
                    for (var i = 1; i <= totalPDFPages; i++) { 
                        pdf.addPage(PDF_Width, PDF_Height);
                        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }
                    
                    pdf.save("Ingresso de <?php echo($_SESSION['participante']['NOME'])?>");
                    
                    setTimeout(function(){ 			
                        $("#downloadbtn").show();
                        $("#genmsg").hide();
                    }, 0);

                });
            };

            </script>
</head>
<body style="display: flex;flex-direction: column;align-items: center;">

<button onclick="getPDF()" id="downloadbtn">Download PDF</button>

<div style="width: 690px; height: 920px; display: flex; flex-direction: column; padding-left: 40px" class="canvas_div_pdf">
    <div class="Grupo1">
        <h1>1º Simpósio Naturais</h1>
    </div>
    <div class="Grupo2">
        <p>Olá, <?php echo($_SESSION['participante']['NOME']) ?>. Sua participação no primeiro simpósio naturais está confirmado(a). Seu ingresso é <?php
        $comp = "SELECT * FROM entradas WHERE id_cliente = ".$_SESSION['ID']."";
        $comprovante = mysqli_query($conn, $comp);
       
        while($_SESSION['comprovante'] = mysqli_fetch_assoc($comprovante)){
    
           echo("<br>" . $_SESSION['comprovante']['codigo']);

    
        }
        ?>.</p>
    </div>
    <div class="Grupo3">
        <p>att. Equipe Redepharma.</p>
    </div>
</div>

</body>
</html>