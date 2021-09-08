<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <input type="text" class="col-sm-9 form-control" id="amount" v-model="move.amount">
                    </div>
                    <div class="form-group row">
                        <label for="item" class="col-sm-3 col-form-label">Item</label>
                        <input type="text" class="col-sm-9 form-control" id="item" v-model="move.item">
                    </div>
                    <div class="form-group row">
                        <label for="kind_element" class="col-sm-3 col-form-label">Before Id</label>
                        <input type="text" class="col-sm-9 form-control" id="before_id" v-model="move.before_id">
                    </div>
                    <div class="form-group row">
                        <label for="purpose_element" class="col-sm-3 col-form-label">After Id</label>
                        <input type="text" class="col-sm-9 form-control" id="after_if" v-model="move.after_id">
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <input type="text" class="col-sm-9 form-control" id="date" v-model="move.date">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            attributeName: String
        },
        data: function () {
            return {
                move: {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/moves_' + this.attributeName, this.move)
                    .then((res) => {
                        this.$router.push({name: 'move.list'});
                    });
            }
        }
    }
</script>

