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
            <p><span class="label label-warning"><b class='text-danger'>Selecione onde quer cortar a imagem.</b></span></p>
            <img id="target" alt="Foto perfil" />
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
                path: '/images/profile/',
                imageMain: '',
                file: '',
                measures: {
                    x: 0,
                    y: 0,
                    w: 0,
                    h: 0,
                },
                hidePreview: 1,
                // hideInstruction: 0,
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
                this.openPreview();
            },
            openPreview: function(){
                const self = this
                document.getElementsByClassName("img_official")[0].classList.add("hide")
                var reader = new FileReader;
                reader.onload = function(event) {
                    document.getElementById("target").src = reader.result
                    document.getElementsByClassName("img_preview")[0].classList.remove("hide")

                    var croppr = new Croppr('#target', {
                        startSize: [0, 0, '%'],
                        onCropMove: function onCropMove(value) {
                            self.measures.x = value.x
                            self.measures.y = value.y
                            self.measures.w = value.width
                            self.measures.h = value.height
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
                if (parseInt(this.measures.w) <= 0 || this.measures.w == ''){
                    alertaPagina('Selecione a área para recorte.','danger');
                    return false;
                }

                this.sendImage()
            },
            sendImage: function () {
                var config = {headers: {'Content-Type': 'multipart/form-data' }}
                var bodyFormData = new FormData()
                bodyFormData.set('x', this.measures.x)
                bodyFormData.set('y', this.measures.y)
                bodyFormData.set('w', this.measures.w)
                bodyFormData.set('h', this.measures.h)
                bodyFormData.append('imagemCrop', this.file.files[0])

                axios.post(
                    '/minha-conta/perfil/update-Foto',
                    bodyFormData,
                    config
                ).then(response => {
                    if (response.data == 0) {
                        throw 'Erro ao salvar imagem.'
                    }

                    alertaPagina('Salvo com sucesso.','success');
                    setTimeout(function () {
                        window.location.reload()
                    }, 1500);
                }).catch(error => {
                    alertaPagina(error,'danger');
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
