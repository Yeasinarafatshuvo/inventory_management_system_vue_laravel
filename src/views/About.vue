<template>
  <div class="about">
    <h1>This is an about page</h1>
    <button @click="click_notification" class="btn btn-dark">click</button>
  </div>
</template>

<script>
export default {
  methods: {
    click_notification() {
      this.$notify({
        title: "Important message",
        text: "Hello user!",
        type: "error",
      });
    },
  },
};
</script>

<style></style>
