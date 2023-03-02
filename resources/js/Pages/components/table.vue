<template>
    <!--<div v-for="item in tableData">{{ item }}</div>-->
    <table class="border-collapse table-auto w-full text-sm">
        <thead>
            <tr>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left" v-for="value in columns">{{ value }}</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
            <tr v-for="(row) in tableData">
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400" v-for="value in row">{{ value }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        tableData: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            columns: ['Type', 'Max Price', 'Average Price', 'Total Participants']
        }
    }
}
</script>
