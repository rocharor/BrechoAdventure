<template>
    <div class='box-upload'>

        <link rel="stylesheet" href="/node_modules/croppr/dist/croppr.min.css">

        <div class='img_official'>
            <img :src="imageMain" alt="brechoAdventure" class="img_perfil">
            <br>
            <button type="button" class='btn btn-primary'  @click.prevent='alterImage()'> Alterar </button>
            <br>
            <input type="file" id='select_image' class='hide' @change.prevent='selectImage()'>
        </div>

        <div class="img_preview" :class="{hide: hidePreview}">
            <input type="hidden" id="x" name="x">
            <input type="hidden" id="y" name="y">
            <input type="hidden" id="w" name="w">
            <input type="hidden" id="h" name="h">

            <p><span class="label label-warning"><b class='text-danger'>Selecione onde quer cortar a imagem.</b></span></p>

            <div id="image_alter"></div>
            <br>
            <input type='button' class='btn btn-success' value='Recortar Imagem' @click.prevent="checkImage()">
            <input type='button' class='btn btn-danger' value='Cancelar' @click.prevent='cancelImage()'>

            <!-- <span class='label label-warning instrucao' :class='{hide: hideInstruction}'><b class='text-danger'>Extenções permitidas ( jpg, png ), dimenção permitida de até (600 x 400) e tamanho permitido de até 1Mb </b></span> -->
        </div>
    </div>
</template>

<script>
    import Croppr from 'croppr';
    import { alertaPagina } from '../site/global.js';

    export default {
        props: ['name-image'],
        data() {
            return {
                path: '/imagens/cadastro/',
                imageMain: '',
                file: '',
                hidePreview: 1,
                hideInstruction: 0,
            }
        },
        methods: {
            mountImageMain: function () {
                this.imageMain = this.path + this.nameImage
            },
            alterImage: function () {
                document.getElementById("select_image").click()
            },
            selectImage: function () {
                this.hidePreview = 0
                this.file = document.getElementById("select_image")
                this.alterImageProfile();
            },
            alterImageProfile: function(){
                document.getElementsByClassName("img_official")[0].classList.add("hide")
                var reader = new FileReader;
                reader.onload = function() {
                    var html = '<img src="' + reader.result + '" id="target" alt="Foto perfil" />'
                    document.getElementById("image_alter").innerHTML = html
                    document.getElementsByClassName("img_preview")[0].classList.remove("hide")

                    var croppr = new Croppr('#target', {
                        startSize: [0, 0, '%'],
                        onCropMove: function onCropMove(value) {
                            document.getElementById("x").value = value.x;
                            document.getElementById("y").value = value.y;
                            document.getElementById("w").value = value.width;
                            document.getElementById("h").value = value.height;
                        }
                    });
                }

                reader.readAsDataURL(this.file.files[0]);
            },
            cancelImage: function(){
                document.getElementsByClassName("img_preview")[0].classList.add("hide")
                document.getElementsByClassName("img_official")[0].classList.remove("hide")
            },
            checkImage: function () {
                var value = document.getElementById("w").value
                if (parseInt(value) <= 0 || value == ''){
                    alertaPagina('Selecione a área para recorte.','danger');
                    return false;
                }

                this.sendImage()
            },
            sendImage: function () {

                var bodyFormData = new FormData();
                bodyFormData.set('x', document.getElementById("x").value);
                bodyFormData.set('y', document.getElementById("y").value);
                bodyFormData.set('w', document.getElementById("w").value);
                bodyFormData.set('h', document.getElementById("h").value);
                bodyFormData.append('imagemCrop', this.file.files[0]);

                var config = {headers: {'Content-Type': 'multipart/form-data' }}

                axios.post('/minha-conta/perfil/update-Foto', bodyFormData, config)
                .then(retorno => {
                    alertaPagina('Salvo com sucesso.','success');

                    setTimeout(function () {
                        window.location.reload()
                    }, 1500);
                })
                .catch(error => {
                    alertaPagina('Erro.','danger');
                })
            },
        },
        created: function() {
            this.mountImageMain()
        }
    };
</script>

<style>
    .img_perfil {
        max-height: 200px;
        min-height: 200px;
        max-width: 200px;
        min-width: 200px;
        border: solid 1px #ccc;
        margin-bottom: 5px;
    }
</style>
