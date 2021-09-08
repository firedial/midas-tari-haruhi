<template>
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Item</th>
                    <th scope="col">Before Id</th>
                    <th scope="col">After Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Show</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(move, index) in moves" :key="index">
                    <th scope="row">{{ move.id }}</th>
                    <td>{{ move.amount }}</td>
                    <td>{{ move.item }}</td>
                    <td>{{ move.before_id }}</td>
                    <td>{{ move.after_id }}</td>
                    <td>{{ move.date }}</td>
                    <td>
                        <router-link v-bind:to="{name: 'move.show', params: {moveId: move.id, attributeName: attributeName}}">
                            <button class="btn btn-primary">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <router-link v-bind:to="{name: 'move.edit', params: {moveId: move.id, attributeName: attributeName}}">
                            <button class="btn btn-success">Edit</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger" v-on:click="deleteMove(move.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            attributeName: String
        },
        data: function () {
            return {
                moves: []
            }
        },
        methods: {
            getMoves() {
                axios.get('/api/moves_' + this.attributeName)
                    .then((res) => {
                        this.moves = res.data;
                    });
            },
            deleteMove(id) {
                axios.delete('/api/moves_' + this.attributeName + '/' + id)
                    .then((res) => {
                        this.getMoves();
                    });
            }
        },
        mounted() {
            this.getMoves();
        }
    }
</script>
