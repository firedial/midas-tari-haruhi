<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <input type="text" class="col-sm-9 form-control" id="amount" v-model="balance.amount">
                    </div>
                    <div class="form-group row">
                        <label for="item" class="col-sm-3 col-form-label">Item</label>
                        <input type="text" class="col-sm-9 form-control" id="item" v-model="balance.item">
                    </div>
                    <div class="form-group row">
                        <label for="kind_element" class="col-sm-3 col-form-label">Kind Element</label>
                        <select class="form-select form-select-sm" v-model="balance.kind_element_id">
                            <option value=""></option>
                            <option v-for="kindElement in kindElements" :value="kindElement.id" :key="kindElement.id">
                                {{ kindElement.description }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="purpose_element" class="col-sm-3 col-form-label">Purpose Element</label>
                        <select class="form-select form-select-sm" v-model="balance.purpose_element_id">
                            <option value=""></option>
                            <option v-for="purposeElement in purposeElements" :value="purposeElement.id" :key="purposeElement.id">
                                {{ purposeElement.description }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="place_element" class="col-sm-3 col-form-label">Place Element</label>
                        <select class="form-select form-select-sm" v-model="balance.place_element_id">
                            <option value=""></option>
                            <option v-for="placeElement in placeElements" :value="placeElement.id" :key="placeElement.id">
                                {{ placeElement.description }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <input type="date" class="col-sm-9 form-control" id="date" v-model="balance.date">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                balance: {},
                kindElements: [],
                purposeElements: [],
                placeElements: []
            }
        },
        methods: {
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
            submit() {
                axios.post('/api/balances', this.balance)
                    .then((res) => {
                        this.$router.push({name: 'balance.list'});
                    });
            }
        },
        mounted() {
            this.getKindElements();
            this.getPurposeElements();
            this.getPlaceElements();
        }
    }
</script>

