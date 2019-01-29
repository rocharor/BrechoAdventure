<template>
    <div class="box-product-zoom">
        <div class="row">
            <div class="col-md-4">
                <div class='img_main'>
                    <img :src="imageMain + '?w=400'" :data-zoom="imageMain + '?w=1200'">
                </div>

                <div>
                    <div class='img_mini' v-for="image in images" :key="image">
                        <img :src="path + image" @click.prevent="defineImage(image)">
                    </div>
                </div>
            </div>

            <div class="col-md-8 preview"></div>
        </div>
    </div>
</template>

<script>
    import Drift from 'drift-zoom';

    export default {
        props: ['images'],
        data() {
            return {
                path: '/images/products/',
                imageMain: '',
            }
        },
        methods: {
            mountFirstImage: function () {
                this.defineImage(this.images[0])
            },
            defineImage: function (image) {
                this.imageMain = this.path + image
            },
        },
        created: function() {
            this.mountFirstImage()
        },
        mounted: function () {
            new Drift(document.querySelector(".box-product-zoom .img_main > img"), {
                paneContainer: document.querySelector('.preview'),
                hoverBoundingBox: true,
                touchBoundingBox: true,
            });

        }
    }
</script>

<style media="screen">
    .box-product-zoom .img_main {
        width: 200px;
        height: 200px;
        margin-bottom: 10px;
        cursor: zoom-in;
    }

    .box-product-zoom .img_mini {
        width: 50px;
        height: 50px;
        display: inline-block;
        cursor: pointer;
    }

    .box-product-zoom img {
        width: 100%;
        height: 100%
    }

    .box-product-zoom .preview {
        width: 200px;
        height: 200px;
        background-image: url('https://cdn4.iconfinder.com/data/icons/software-menu-icons/256/SoftwareIcons-21-512.png');
        background-size: cover;
    }
</style>
