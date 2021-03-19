<template>
  <div className="alert alert-danger" role="alert" v-if="Object.keys(errors).length">
    <template v-if="simple">
      <template v-for="field in errors">
        <template v-for="error in field">
          <div>{{ error }}</div>
        </template>
      </template>
    </template>
    <div className="alert-message" v-else>
      <template v-for="field in errors">
        <template v-for="error in field">
          <div>{{ error }}</div>
        </template>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    simple: {
      type: Boolean,
      default: false
    }
  },

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
