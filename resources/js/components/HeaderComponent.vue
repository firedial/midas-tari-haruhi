<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Midas Tari</span>
                <div>
                    <router-link v-bind:to="{name: 'balance.list'}">
                        <button class="btn btn-success">Balance List</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'move.list', params: {attributeName: 'places'}}">
                        <button class="btn btn-success">Place Move List</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'move.create', params: {attributeName: 'places'}}">
                        <button class="btn btn-success">Place Move Add</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'analyze'}">
                        <button class="btn btn-success">Analyze</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {}
</script>

