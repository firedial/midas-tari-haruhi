<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="id" class="col-sm-3 col-form-label">Id</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id" v-model="move.id">
                    </div>
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
                        <input type="text" class="col-sm-9 form-control" id="after_id" v-model="move.after_id">
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
            attributeName: String,
            moveId: String
        },
        data: function () {
            return {
                move: {}
            }
        },
        methods: {
            getMove() {
                axios.get('/api/moves_' + this.attributeName + '/' + this.moveId)
                    .then((res) => {
                        this.move = res.data;
                    });
            },
            submit() {
                axios.put('/api/moves_' + this.attributeName + '/' + this.moveId, this.move)
                    .then((res) => {
                        this.$router.push({name: 'moves.list'})
                    });
            }
        },
        mounted() {
            this.getMove();
        }
    }
</script>

