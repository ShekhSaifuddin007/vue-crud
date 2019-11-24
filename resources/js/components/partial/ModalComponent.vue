<template>
    <div id="studentModal">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle" v-text="edit ? 'Update Student' : 'Create Student'"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <slot></slot>

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
    }
</script>

<style scoped>

</style>
