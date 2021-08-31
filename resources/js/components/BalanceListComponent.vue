<template>
    <div class="container">
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
                    <th scope="col">Show</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(balance, index) in balances" :key="index">
                    <th scope="row">{{ balance.id }}</th>
                    <td>{{ balance.amount }}</td>
                    <td>{{ balance.item }}</td>
                    <td>{{ balance.kind_description }}</td>
                    <td>{{ balance.purpose_description }}</td>
                    <td>{{ balance.place_description }}</td>
                    <td>{{ balance.date }}</td>
                    <td>
                        <router-link v-bind:to="{name: 'balance.show', params: {balanceId: balance.id }}">
                            <button class="btn btn-primary">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <router-link v-bind:to="{name: 'balance.edit', params: {balanceId: balance.id }}">
                            <button class="btn btn-success">Edit</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger" v-on:click="deleteBalance(balance.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                balances: []
            }
        },
        methods: {
            getBalances() {
                axios.get('/api/balances')
                    .then((res) => {
                        this.balances = res.data;
                    });
            },
            deleteTask(id) {
                axios.delete('/api/balances/' + id)
                    .then((res) => {
                        this.getBalances();
                    });
            }
        },
        mounted() {
            this.getBalances();
        }
    }
</script>
