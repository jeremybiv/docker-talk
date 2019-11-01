<template>
    <div class="register">
        <button class="btn btn-primary" href="#" @click="showModal = true">Sign Up</button>
        <register-modal :show="showModal" v-on:close="closeModal" v-on:open="openModal"></register-modal>
    </div>
</template>

<script>
import registerModal from "../modals/registerModal.vue";

export default {
    components: { registerModal },
    data() {
        return {
            showModal: false,
        }
    },
    methods: {
        closeModal() {
            this.showModal = false;
        },

        openModal() {
            this.showModal = true;
        }
    }
}
</script>

