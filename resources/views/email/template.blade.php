<!DOCTYPE html>
<html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <style>
            table{
                width: 600px;
            }
            a{
                text-decoration: none;
                color:#000;
            }
            .topo{
                background-color: #F3BC55;
                border: solid 2px;
            }
            .img_top{
                float:left;
                background-image: url("http://brechoadventure.com/imagens/logo.jpg");
                background-size: cover;
                width: 100px;
                height: 60px;
                display: block;
            }

            .texto_top{
                position:absolute;
                margin-left: 20%;
            }
            .rodape{
                background-color: #fedd7a;
            }
            .rodape > td > span > hr{
                border: 0;
                border-top: solid 1px #cecece;
            }
            .footer{
                text-align: center;
            }
            .footer > small{
                color: #444;
            }
            .corpoEmail{
                background-color: #fedd7a;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 13px;
                color: #414042;
                padding: 20px;
                line-height: 15px;
            }
        </style>
    </head>
    <body>
        <table align='center' cellspacing="0" callpadding="0">
            <tr class='topo'>
                <td align='center'>
                    <div class="img_top"></div>
                    <div class="texto_top"><h3><a href="brechoadventure.com">BRECH&Oacute; ADVENTURE</a><h3></div>
                </td>
            </tr>

            @yield('content')

            <tr class="rodape">
                <td>
                    <span>
                        <p><small>Att,</small><br><b>Brech&oacute; Adventure</b></p>
                        <hr>
                        <p class='footer'><small>** Este &eacute; um e-mail autom&aacute;tico. Favor n&atilde;o respond&ecirc;-lo **</small></p>
                    </span>
                </td>
            </tr>
        </table>
    </body>
</html>
