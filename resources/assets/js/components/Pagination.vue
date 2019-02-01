<template>
    <nav align="center">
        <ul class="pagination">
            <li>
                <span aria-label="Previous" v-if="pg == 1">
                    <span aria-hidden="true">&laquo;</span>
                </span>
                <a :href="linkPrevious" aria-label="Previous" v-else>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <li :class="{active: i == pg}" v-for="i in pages" :key="i">
                <a v-if="i == pg">{{ i }}</a>
                <a :href="link + i" v-else>{{ i }}</a>
            </li>

            <li>
                <span aria-label="Previous" v-if="pg == numberPages">
                    <span aria-hidden="true">&raquo;</span>
                </span>

                <a :href="linkNext" aria-label="Next" v-else>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['pg', 'link', 'number-pages'],
    name: "Pagination",
    data() {
        return {
            linkPrevious: '',
            linkNext: '',
            pages: 0
        };
    },
    methods: {

    },
    created: function () {
        this.linkPrevious = this.link + (eval(this.pg) - 1)
        this.linkNext = this.link + (eval(this.pg) + 1)
        this.pages = eval(this.numberPages)
    }
};
</script>

<style>

</style>
