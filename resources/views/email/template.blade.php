<!DOCTYPE html>
<html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <style>
            .corpoEmail{
                background-color: #fedd7a;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 13px;
                color: #414042;
                padding: 20px;
                line-height: 15px;
            }
            .rodape{
                background-color: #fedd7a;
                border: solid 2px;
            }
        </style>
    </head>
    <body>
        <table align='center' style='width: 600px;' cellspacing="0" callpadding="0">
            <tr>
                <td style='background-color: #F3BC55;' align='center'>
                    <h3>BRECHÓ ADVENTURE<h3>
                </td>
            </tr>

            @yield('content')

            <tr class="rodape" style="">
                <td>
                    <span>
                        <p><small>Att,</small><br><b>Brech&oacute; Adventure</b></p>
                        <hr style='border: 0; border-top: 1px solid #cecece;'>
                        <p style='text-align: center; color: #777;'><small>** Este &eacute; um e-mail autom&aacute;tico. Favor n&atilde;o respond&ecirc;-lo **</small></p>
                    </span>
                </td>
            </tr>
        </table>
    </body>
</html>
