<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
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
                        <input type="text" class="col-sm-9 form-control" id="kind_element" v-model="balance.kind_element_id">
                    </div>
                    <div class="form-group row">
                        <label for="purpose_element" class="col-sm-3 col-form-label">Purpose Element</label>
                        <input type="text" class="col-sm-9 form-control" id="purpose_element" v-model="balance.purpose_element_id">
                    </div>
                    <div class="form-group row">
                        <label for="place_element" class="col-sm-3 col-form-label">Place Element</label>
                        <input type="text" class="col-sm-9 form-control" id="purpose_element" v-model="balance.place_element_id">
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <input type="text" class="col-sm-9 form-control" id="date" v-model="balance.date">
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
                balance: {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/balances', this.balance)
                    .then((res) => {
                        this.$router.push({name: 'balance.list'});
                    });
            }
        }
    }
</script>

