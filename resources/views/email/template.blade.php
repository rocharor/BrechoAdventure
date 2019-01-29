<!DOCTYPE html>
<html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.css" />

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
                background-image: url("http://brechoadventure.com/images/logo.jpg");
                background-size: cover;
                width: 100px;
                height: 60px;
                display: block;
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
            .btn{
                display: inline-block;
                margin-bottom: 0;
                font-weight: normal;
                text-align: center;
                vertical-align: middle;
                cursor: pointer;
                background-image: none;
                border: 1px solid transparent;
                white-space: nowrap;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.428571429;
                border-radius: 4px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .btn-primary{
                color: #ffffff;
                background-color: #0085b1;
                border-color: #007298;
            }
        </style>
    </head>
    <body>
        <table align='center' cellspacing="0" callpadding="0">
            <tr class='topo'>
                <td align='center'>
                    <a href="http://brechoadventure.com" target='_blank'>
                        <div class="img_top"></div>
                        <div><h3>BRECH&Oacute; ADVENTURE<h3></div>
                    </a>
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
