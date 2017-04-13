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
            .rodape{
                background-color: #fedd7a;
            }
            .rodape > td > span > hr{
                border: 0;
                border-top: solid 1px #cecece;
            }
            .rodape > td > span > p:nth-child(3){
                text-align: center;
            }
            .rodape > td > span > p > span{
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
                    <h3><a href="brechoadventure.com">BRECH&Oacute; ADVENTURE</a><h3>
                </td>
            </tr>

            @yield('content')

            <tr class="rodape">
                <td>
                    <span>
                        <p><small>Att,</small><br><b>Brech&oacute; Adventure</b></p>
                        <hr>
                        <p><span>** Este &eacute; um e-mail autom&aacute;tico. Favor n&atilde;o respond&ecirc;-lo **</span></p>
                    </span>
                </td>
            </tr>
        </table>
    </body>
</html>
