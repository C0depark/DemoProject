<template>
    <div class="pb-8">{{ name }}</div>
    <table-component :tableData="tableData" />
</template>

<script>
import TableComponent from "./components/table.vue";
import ajaxService from "./services/AjaxService.js";
export default {
    methods: {
        loadData: async function () {
            this.tableData = await ajaxService.getTableData();
            console.log(this.tableData);
        }
    },
    components: {
        TableComponent
    },
    data() {
        return {
            tableData: Array,
            name: "Welcome!",
            interval: null
        }
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.interval = setInterval(function () {
            this.loadData();
        }.bind(this), 30000);
    },
    beforeUnmount() {
        clearInterval(this.interval);
    }
}
</script>
