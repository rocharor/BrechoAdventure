<template>
    <div class="box-product-zoom">

        <img class="xzoom" :src="image1" :xoriginal="image2">

        <div class="xzoom-thumbs">
            <a :href="image.link" v-for="image in imageMini">
                <img class="xzoom-gallery" width="80" :src="image.linkImage"  >
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['images'],
        data() {
            return {
                image1: '',
                image2: '',
                imageMini: []
            }
        },
        methods: {
            mountFirstImage: function () {
                this.image1 = '/imagens/produtos/400x400/' + this.images[0]
                this.image2 = '/imagens/produtos/600x600/' + this.images[0]
            },
            mountImagesPreview: function () {
                var obj = {}
                for (var i in this.images) {
                    obj = {
                        'link': '/imagens/produtos/600x600/' + this.images[i],
                        'linkImage': '/imagens/produtos/400x400/' + this.images[i],
                    }
                    this.imageMini.push(obj)
                }
            }
        },
        created: function() {
            this.mountFirstImage()
            this.mountImagesPreview()
        },
        mounted: function () {
            /* Options */
            $('.xzoom, .xzoom-gallery').xzoom({ position: '#xzoom2-id', tint: '#ffa200', scroll: false });
        }
    }
</script>

<style media="screen">
    .xzoom { margin-bottom: 10px; }
</style>
