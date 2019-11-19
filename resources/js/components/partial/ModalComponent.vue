<template>
    <div id="studentModal">
        <div class="modal fade" id="createStudent" tabindex="-1" role="dialog" aria-labelledby="studentModalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentModalTitle">{{ edit ? 'Update' : 'Create' }} Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="edit ? update() : store()" @keydown="form.onKeydown($event)">

                        <div class="modal-body">

                            <alert-error :form="form"/>

                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="name" name="name" placeholder="Your Name">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" name="email" id="email" placeholder="Email hare">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="font-weight-bold">Phone</label>
                                <input type="tel" v-model="form.phone" class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }" name="phone" id="phone" placeholder="Phone number">
                                <has-error :form="form" field="phone"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="address" class="font-weight-bold">Address</label>
                                <textarea class="form-control" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" name="address" id="address" placeholder="Your address"></textarea>
                                <has-error :form="form" field="address"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">{{ edit ? 'Update' : 'Create' }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalComponent",

        props : {
            edit : Boolean,
        },

        data () {
            return {
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                })
            }
        },

        methods : {
            //
        }
    }
</script>

<style scoped>

</style>
