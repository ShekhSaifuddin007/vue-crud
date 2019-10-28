<template>
    <div id="filter">
        <form class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <strong>Search By : </strong>
                </div>
                <div class="col-md-3">
                    <select v-model="queryField" class="form-control" id="">
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="address">Address</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <input v-model="query" type="text" class="form-control" placeholder="Search here...">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "FilterForm",

        props : ['queryField', 'query'],

        data() {

            return {
                query : '',

                queryField : 'name',
            }

        },

        watch : {
            query : function (newQuery, oldQuery) {
                newQuery === '' ?  this.getStudents() : this.searchStudents();
            }
        },

        methods : {

            searchStudents() {
                this.$Progress.start();

                axios.get('/api/search/students/' + this.queryField+ '/' + this.query+ '?page=' + this.pagination.current_page)
                    .then(response => {
                        this.students = response.data.data;
                        this.pagination = response.data.meta;

                        this.$Progress.finish();
                    })
                    .catch(e => {
                        console.log(e);

                        this.$Progress.fail();
                    })
            },

        }
    }
</script>

<style scoped>

</style>
