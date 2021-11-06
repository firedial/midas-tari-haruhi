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
                <input class="form-check-input" type="radio" name="dataForm" id="dataFormTable" value="table" checked>
                <label class="form-check-label" for="dataFromTable">table</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataForm" id="dataFormGraph" value="graph">
                <label class="form-check-label" for="dataFromGraph">graph</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataForm" id="dataFormSum" value="sum">
                <label class="form-check-label" for="dataFromSum">sum</label>
            </div>
        </div>
        <button v-on:click="getChartData">display</button>
        {{ queries }}
        {{ queryParam }}

        <my-bar v-bind:chartData="chartData"></my-bar>
        <balance-table v-if="false" :balances="balances" />
    </div>
</template>

<script>
    import MyBar from './BarComponent'
    import BalanceTable from './commonComponents/BalanceTableComponent'

    export default {
        data: function () {
            return {
                balances: [],
                kindElements: [],
                purposeElements: [],
                placeElements: [],
                chartData: {},
                canUseLabels: ['none', 'kind', 'purpose', 'place', 'day', 'all'],
                canUseDatasets: ['none', 'kind', 'purpose', 'place', 'day', 'all'],
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
                    q.push('startDate=' + queries.startDate);
                }
                if (queries.endDate !== '') {
                    q.push('endDate=' + queries.endDate);
                }
                if (queries.label !== 'none') {
                    q.push('label=' + queries.label);
                }
                if (queries.dataset !== 'none') {
                    q.push('dataset=' + queries.dataset);
                }
                return q.join('&');
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
            'balance-table': BalanceTable
        }
    }
</script>
