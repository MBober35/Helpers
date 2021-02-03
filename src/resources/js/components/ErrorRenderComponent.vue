<template>
    <div class="alert alert-danger" role="alert" v-if="Object.keys(errors).length">
        <template v-for="field in errors">
            <template v-for="error in field">
                <div class="alert-message">{{ error }}</div>
                <br>
            </template>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: {}
        }
    },

    methods: {
        resetErrors() {
            this.errors = {};
        },

        // Обработать ошибки валидации.
        parseErrors(result) {
            if (result.hasOwnProperty("errors")) {
                this.errors = result.errors;
            } else {
                this.fireError(result.message);
            }
        },

        // Вызвать подтверждение.
        fireSuccess(message) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: message,
                timer: 1500
            })
        },

        // Вызвать ошибку.
        fireError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Упс...',
                text: 'Что-то пошло не так!',
                footer: message,
            })
        }
    }
}
</script>

<style scoped>

</style>
