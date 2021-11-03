<template>
    <div class="container">
        <div>
            search<br />
            group by attribute: 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="groupByAttribute" id="groupByKind" value="kind">
                <label class="form-check-label" for="gorupByKind">kind</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="groupByAttribute" id="groupByPurpose" value="purpose">
                <label class="form-check-label" for="gorupByPurpose">purpose</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="groupByAttribute" id="groupByPlace" value="place">
                <label class="form-check-label" for="gorupByPlace">place</label>
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
            <br />
            move ignore: 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="moveIgnore" id="moveIgnore" value="true" checked>
                <label class="form-check-label" for="moveIgnore">ignore</label>
            </div>
        </div>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Item</th>
                    <th scope="col">Kind Element</th>
                    <th scope="col">Purpose Element</th>
                    <th scope="col">Place Element</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(balance, index) in balances" :key="index">
                    <th scope="row">{{ balance.id }}</th>
                    <td>{{ balance.amount }}</td>
                    <td>{{ balance.item }}</td>
                    <td>{{ balance.kind_element_description }}</td>
                    <td>{{ balance.purpose_element_description }}</td>
                    <td>{{ balance.place_element_description }}</td>
                    <td>{{ balance.date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                balances: [],
                kindElements: [],
                purposeElements: [],
                placeElements: [],
                newBalance: {},
                editable: null 
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
            }
        },
        mounted() {
            this.getBalances();
            this.getKindElements();
            this.getPurposeElements();
            this.getPlaceElements();
        }
    }
</script>
