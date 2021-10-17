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
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>+</th>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.amount"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.item"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.kind_element_id"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.purpose_element_id"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.place_element_id"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-model="newBalance.date"></td>
                    <td>
                        <button class="btn btn-success" v-on:click="addNewBalance()">Add</button>
                    </td>
                    <td>
                        <button class="btn btn-danger" v-on:click="clearNewBalance()">Clear</button>
                    </td>
                </tr>
                <tr v-for="(balance, index) in balances" :key="index">
                    <th scope="row">{{ balance.id }}</th>
                    <td><input type="text" class="col-sm-9 form-control" v-bind:readonly="isReadOnly(balance.id)" v-model="balance.amount"></td>
                    <td><input type="text" class="col-sm-9 form-control" v-bind:readonly="isReadOnly(balance.id)" v-model="balance.item"></td>
                    <td>{{ balance.kind_description }}</td>
                    <td>{{ balance.purpose_description }}</td>
                    <td>{{ balance.place_description }}</td>
                    <td>{{ balance.date }}</td>
                    <td v-if="isReadOnly(balance.id)">
                        <button class="btn btn-success" v-on:click="editBalance(balance.id)">Edit</button>
                    </td>
                    <td v-else>
                        <button class="btn btn-primary" v-on:click="saveBalance(balance)">Save</button>
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
                balances: [],
                newBalance: {},
                editable: null 
            }
        },
        methods: {
            getBalances() {
                axios.get('/api/balances')
                    .then((res) => {
                        this.balances = res.data;
                    });
            },
            editBalance(id) {
                this.editable = id;
            },
            isReadOnly(id) {
                return this.editable !== id;
            },
            saveBalance(balance) {
                axios.put('/api/balances/' + balance.id, balance)
                    .then((res) => {
                        if (res.status === 200) {
                            this.editable = null;
                        }
                    });
            },
            clearNewBalance() {
                this.newBalance = {};
            },
            addNewBalance() {
                axios.post('/api/balances', this.newBalance)
                    .then((res) => {
                        if (res.status === 201) {
                            this.newBalance = {};
                            this.balances.push(res.data);
                        }
                    });
            },
            deleteBalance(id) {
                if(confirm('本当に削除しますか？')){
                    axios.delete('/api/balances/' + id)
                        .then((res) => {
                            this.getBalances();
                        });
                }
            }
        },
        mounted() {
            this.getBalances();
        }
    }
</script>
