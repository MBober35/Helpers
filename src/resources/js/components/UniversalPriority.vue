<template>
  <div class="row">
    <div class="col-12">
      <div class="alert alert-danger" role="alert" v-if="Object.keys(errors).length">
        <template v-for="field in errors">
          <template v-for="error in field">
            <div class="alert-message">{{ error }}</div>
            <br>
          </template>
        </template>
      </div>
    </div>
    <div class="col-12 position-relative">
      <draggable :list="list"
                 class="list-group"
                 @change="checkMove"
                 handle=".handle">
        <div class="list-group-item" v-for="element in list" :key="element.id">
          <i class="fa fa-align-justify handle cursor-grab me-2"></i>
          <a :href="element.url" v-if="element.url">
            {{ element.name }}
          </a>
          <span v-else>
                      {{ element.name }}
                  </span>
        </div>
      </draggable>
      <div class="button-cover" v-if="priorityChanged">
        <button class="btn btn-success mb-3"
                :disabled="loading"
                @click="changeOrder">
                            <span class="spinner-border spinner-border-sm"
                                  v-if="loading"
                                  role="status"
                                  aria-hidden="true">
                            </span>
          Сохранить порядок
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: {
    draggable,
  },

  props: {
    elements: {
      type: Array,
      required: true,
    },
    url: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      messages: [],
      errors: {},
      loading: false,
      priorityChanged: false,
      list: [],
    }
  },

  created() {
    this.list = this.elements;
  },

  computed: {
    priorityData() {
      let ids = [];
      for (let item in this.list) {
        if (this.list.hasOwnProperty(item)) {
          ids.push(this.list[item].id);
        }
      }
      return ids;
    }
  },

  methods: {
    checkMove() {
      this.priorityChanged = true;
    },
    changeOrder() {
      this.loading = true;
      this.errors = {};
      this.messages = [];
      axios
          .put(this.url, {
            items: this.priorityData,
          })
          .then(response => {
            let result = response.data;
            if (result.success) {
              this.priorityChanged = false;
              this.fireSuccess(result.message);
            } else {
              this.fireError(result.message);
            }
          })
          .catch(error => {
            this.parseErrors(error.response.data);
          })
          .finally(() => {
            this.loading = false;
          })
    },

    // Обработать ошибки валидации.
    parseErrors(result) {
      if (result.hasOwnProperty("errors")) {
        this.errors = result.errors;
      } else {
        this.fireError(result.message);
      }
    },

    // Вызвать ошибку.
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
  },
}
</script>

<style scoped>
.button-cover {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: center;
}
</style>
