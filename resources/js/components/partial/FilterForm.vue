<template>
    <div id="filter">
        <form class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <strong>Search By : </strong>
                </div>
                <div class="col-md-3">
                    <select :select="field" @change="selected($event)" class="form-control" id="">
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="address">Address</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <input :value="q" @input="search($event)" type="text" class="form-control" placeholder="Search here...">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "FilterForm",

        props : ['field', 'q'],

        methods: {
            search(search) {
                this.query = search.target.value;
                this.$emit('searching', this.query)
            },

            selected(field) {
                this.queryField = field.target.value;
                this.$emit('selected', this.queryField)
            }
        },
    }
</script>

<style scoped>

</style>
