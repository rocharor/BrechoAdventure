<template>
    <div class='component'>
        <h1>Componente OK</h1>
        <button class='btn btn-primary' @click.prevent="acao('OK')">AQUI !</button>
    </div>
</template>

<script>
    export default {
        name: 'testeExample',
        data() {
            return {
                msg: '123'
            }
        },
        methods: {
            acao: function(x) {
                alert(x . this.data.msg)
            }
        }
    };
</script>

<style>
    .component {
        background-color: #aaa;
    }
    .component h1 {
        color: #f00;
    }
</style>