<template>
    <div id="student">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark" style="font-size: 20px">
                        <h3 class="card-title text-white">Students</h3>

                        <span style="position: absolute; right: 1rem; top: .5rem;">
                            <button type="button" class="btn btn-success" @click="create()">
                                Add New <i class="fa fa-plus"></i>
                            </button>

                            <button type="button" class="btn btn-primary" @click="refresh">Refresh <i class="fa fa-retweet"></i></button>
                        </span>
                    </div>

                    <div class="card-body">

                        <!--                        <form class="mb-3">-->
                        <!--                            <div class="row">-->
                        <!--                                <div class="col-md-2">-->
                        <!--                                    <strong>Search By : </strong>-->
                        <!--                                </div>-->
                        <!--                                <div class="col-md-3">-->
                        <!--                                    <select v-model="queryField" class="form-control" id="">-->
                        <!--                                        <option value="name">Name</option>-->
                        <!--                                        <option value="email">Email</option>-->
                        <!--                                        <option value="phone">Phone</option>-->
                        <!--                                        <option value="address">Address</option>-->
                        <!--                                    </select>-->
                        <!--                                </div>-->
                        <!--                                <div class="col-md-7">-->
                        <!--                                    <input v-model="query" type="text" class="form-control" placeholder="Search here...">-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </form>-->

                        <filter-form
                            :q="query"
                            @searching="query = $event"
                            :field="queryField"
                            @selected="queryField = $event"
                        />

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center" v-show="students.length" v-for="(student, index) in students" :key="student.id">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ student.name }}</td>
                                    <td>{{ student.email }}</td>
                                    <td>{{ student.phone }}</td>
                                    <td>{{ student.address }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button @click="edit(student)" type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button @click="destroy(student)" type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr v-show="! students.length">
                                    <td colspan="6">
                                        <div class="alert alert-warning text-center">
                                            <strong>No Data Found</strong>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <pagination
                                v-if="pagination.last_page > 1"
                                :pagination="pagination"
                                :offset="10"
                                @paginate="query === '' ? getStudents() : searchStudents()"
                            />

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->

<!--        <div class="modal fade" id="createStudent" tabindex="-1" role="dialog" aria-labelledby="studentModalTitle" aria-hidden="true">-->
<!--            <div class="modal-dialog" role="document">-->

<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="studentModalTitle">{{ editMode ? 'Update' : 'Create' }} Student</h5>-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <form action="" @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">-->

<!--                        <div class="modal-body">-->

<!--                            <alert-error :form="form"/>-->

<!--                            <div class="form-group">-->
<!--                                <label for="name" class="font-weight-bold">Name</label>-->
<!--                                <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="name" name="name" placeholder="Your Name">-->
<!--                                <has-error :form="form" field="name"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <label for="email" class="font-weight-bold">Email</label>-->
<!--                                <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" name="email" id="email" placeholder="Email hare">-->
<!--                                <has-error :form="form" field="email"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <label for="phone" class="font-weight-bold">Phone</label>-->
<!--                                <input type="tel" v-model="form.phone" class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }" name="phone" id="phone" placeholder="Phone number">-->
<!--                                <has-error :form="form" field="phone"></has-error>-->
<!--                            </div>-->

<!--                            <div class="form-group">-->
<!--                                <label for="address" class="font-weight-bold">Address</label>-->
<!--                                <textarea class="form-control" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" name="address" id="address" placeholder="Your address"></textarea>-->
<!--                                <has-error :form="form" field="address"></has-error>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                            <button :disabled="form.busy" type="submit" class="btn btn-primary">{{ editMode ? 'Update' : 'Create' }}</button>-->
<!--                        </div>-->

<!--                    </form>-->
<!--                </div>-->

<!--            </div>-->
<!--        </div>-->

        <student-modal
            :edit="editMode"
        />


        <vue-progress-bar/>

        <vue-snotify/>

    </div>
</template>

<script>
    import ModalComponent from './partial/ModalComponent';

    import FilterForm from './partial/FilterForm';

    export default {

        components:{

            "student-modal" : ModalComponent,

            "filter-form" : FilterForm,
        },

        data() {
            return {
                editMode : false,

                query : '',

                queryField : 'name',

                students : [],

                pagination : {
                    current_page : 1,
                },

                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                })
            }
        },

        watch : {
            query : function (newQuery, oldQuery) {
                newQuery === '' ?  this.getStudents() : this.searchStudents();
            }
        },

        mounted() {
            this.getStudents();
        },

        methods : {
            getStudents() {

                this.$Progress.start();

                axios
                    .get('/api/students?page=' + this.pagination.current_page)
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

            clearForm() {
                this.form.reset();
                this.form.clear();
            },

            searchStudents() {
                this.$Progress.start();

                axios.get('/api/search/students/' + this.queryField+ '/' + this.query)
                    .then(response => {
                        this.students = response.data.data;

                        this.$Progress.finish();
                    })
                    .catch(e => {
                        console.log(e);

                        this.$Progress.fail();
                    })
            },

            refresh() {
                this.getStudents();
                this.query = '';
                this.queryField = 'name';

                this.$snotify.success('Refreshed Successfully', 'Success');
            },

            create() {
                this.editMode = false;
                $('#createStudent').modal('show');
                this.clearForm();
            },

            store() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.post('/api/students')
                    .then(response => {
                        this.getStudents();
                        //$('#createStudent').modal('hide');

                        if (this.form.successful) {
                            this.clearForm();
                            this.$Progress.finish();
                            this.$snotify.success('Student create successfully', 'Success')
                        } else {
                            this.$Progress.fail();
                            this.$snotify.error('Something wrong, try again.!', 'Error')
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail();
                        console.log(e)
                    })
            },

            edit(student) {
                // console.log(student)
                this.editMode = true;
                this.clearForm();
                this.form.fill(student);
                $('#createStudent').modal('show');
            },

            update() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.patch('/api/students/' + this.form.id)
                    .then(response => {
                        this.getStudents();
                        $('#createStudent').modal('hide');

                        if (this.form.successful) {
                            this.clearForm();
                            this.$Progress.finish();
                            this.$snotify.success('Student update successfully', 'Success')
                        } else {
                            this.$Progress.fail();
                            this.$snotify.error('Something wrong, try again.!', 'Error')
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail();
                        console.log(e)
                    })
            },

            destroy(student) {
                this.$snotify.clear();
                this.$snotify.confirm(
                    "You will not be able to recover this data!",
                    "Are you sure?",
                    {
                        showProgressBar: false,
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons: [
                            {
                                text: "Yes",
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                    //console.log(student);
                                    this.$Progress.start();
                                    axios
                                        .delete("/api/students/" + student.id)
                                        .then(response => {
                                            this.getStudents();
                                            this.$Progress.finish();
                                            this.$snotify.success(
                                                "Customer Successfully Deleted",
                                                "Success"
                                            );
                                        })
                                        .catch(e => {
                                            this.$Progress.fail();
                                            console.log(e);
                                        });
                                },
                                bold: true
                            },
                            {
                                text: "No",
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                },
                                bold: true
                            }
                        ]
                    }
                );
            }
        }
    }
</script>
