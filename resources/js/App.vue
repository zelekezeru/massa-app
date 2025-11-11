<template>
  <div id="app" :class="{ 'dark-mode': isDarkMode }">
    <router-view />
  </div>
</template>

<script>
export default {
  data() {
    return {
      isDarkMode: false, // Toggle this based on user preference or system settings
    };
  },
  mounted() {
    this.checkDarkMode();
  },
  methods: {
    checkDarkMode() {
      // Check for user's system preference or saved preference
      this.isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    },
  },
};
</script>

<style>
.dark-mode {
  background-color: #121212;
  color: #ffffff;
}
</style>