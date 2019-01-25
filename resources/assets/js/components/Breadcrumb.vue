<template>
    <div>
        <ol class="breadcrumb">
            <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
            <li class="active" v-for="breadcrumb in dataBreadcrumb" :key="breadcrumb">{{ breadcrumb }}</li>
        </ol>
    </div>
</template>

<style>
    .breadcrumb { font-size: 11px; }
</style>

<script>
    export default {
        props: ['data-breadcrumb'],
    }
</script>
