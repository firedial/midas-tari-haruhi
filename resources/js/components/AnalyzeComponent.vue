<template>
    <div class="container">
        <div>
            search<br />
            date
            <div>
                start
                <input type="date" name="startDate" id="startDate" v-model="queries.startDate">
                end
                <input type="date" name="endDate" id="endDate" v-model="queries.endDate">
            </div>
            
            <br />
            label: 
            <div v-for="canUseLabel in canUseLabels" class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="label" v-bind:id="canUseLabel" v-bind:value="canUseLabel" v-model="queries.label">
                <label class="form-check-label" v-bind:for="canUseLabel">{{ canUseLabel }}</label>
            </div>
            <br />
            datasets: 
            <div v-for="canUseDatasets in canUseDatasets" class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataset" v-bind:id="canUseDatasets" v-bind:value="canUseDatasets" v-model="queries.dataset">
                <label class="form-check-label" v-bind:for="canUseDatasets">{{ canUseDatasets }}</label>
            </div>
            <br />
            move ignore: 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="moveIgnore" id="moveIgnore" value="true" v-model="queries.moveIgnore">
                <label class="form-check-label" for="moveIgnore">ignore</label>
            </div>
            <br />
            data form:
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataForm" id="dataFormTable" value="table" v-model="dataForm">
                <label class="form-check-label" for="dataFromTable">table</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataForm" id="dataFormGraph" value="graph" v-model="dataForm">
                <label class="form-check-label" for="dataFromGraph">graph</label>
            </div>
        </div>
        <button v-on:click="getChartData">display</button>
        {{ queries }}
        {{ queryParam }}

        <my-bar v-if="isAggregationGraph" v-bind:chartData="chartData"></my-bar>
        <balance-table v-if="isBalanceTable" :balances="balances" />
        <aggregation-table v-if="isAggregationTable" :data="chartData" />
    </div>
</template>

<script>
    import MyBar from './BarComponent'
    import BalanceTable from './commonComponents/BalanceTableComponent'
    import AggregationTable from './commonComponents/AggregationTableComponent'

    export default {
        data: function () {
            return {
                balances: [],
                kindElements: [],
                purposeElements: [],
                placeElements: [],
                chartData: {},
                canUseLabels: ['none', 'kind', 'purpose', 'place', 'day', 'all'],
                canUseDatasets: ['none', 'kind', 'purpose', 'place', 'day'],
                dataForm: 'table',
                queries: {
                    moveIgnore: true,
                    startDate: '',
                    endDate: '',
                    label: 'none',
                    dataset: 'none'
                }
            }
        },
        computed: {
            queryParam: function () {
                const queries = this.queries;
                let q = [];
                if (queries.moveIgnore) {
                    q.push('move_ignore=true');
                }
                if (queries.startDate !== '') {
                    q.push('start_date=' + queries.startDate);
                }
                if (queries.endDate !== '') {
                    q.push('end_date=' + queries.endDate);
                }
                if (queries.label !== 'none') {
                    q.push('label=' + queries.label);
                }
                if (queries.dataset !== 'none') {
                    q.push('dataset=' + queries.dataset);
                }
                return q.join('&');
            },
            isBalanceTable: function () {
                return this.queries.label === 'none';
            },
            isAggregationTable: function () {
                return this.queries.label !== 'none' && this.dataForm === 'table';
            },
            isAggregationGraph: function () {
                return this.queries.label !== 'none' && this.dataForm === 'graph';
            }
        },
        methods: {
            getBalances() {
                axios.get('/api/analyze/table')
                    .then((res) => {
                        this.balances = res.data;
                    });
            },
            getKindElements() {
                axios.get('/api/attribute_elements/kind_element')
                    .then((res) => {
                        this.kindElements = res.data;
                    });
            },
            getPurposeElements() {
                axios.get('/api/attribute_elements/purpose_element')
                    .then((res) => {
                        this.purposeElements = res.data;
                    });
            },
            getPlaceElements() {
                axios.get('/api/attribute_elements/place_element')
                    .then((res) => {
                        this.placeElements = res.data;
                    });
            },
            getChartData() {
                axios.get('/api/analyze/table?' + this.queryParam)
                    .then((res) => {
                        this.chartData = res.data;
                    });
            }
        },
        mounted() {
            this.getBalances();
            this.getKindElements();
            this.getPurposeElements();
            this.getPlaceElements();
        },
        components: {
            'my-bar': MyBar,
            'balance-table': BalanceTable,
            'aggregation-table': AggregationTable
        }
    }
</script>
