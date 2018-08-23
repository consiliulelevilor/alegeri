<template>
  <section class="login section section-shaped section-lg my-0">
    <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
          <card type="secondary" shadow
            header-classes="bg-white pb-5"
            body-classes="px-lg-5 py-lg-5"
            class="border-0">
            <div class="loader mt-2 mb-4"></div>
            <template>
              <div class="text-muted text-center mb-2">
                Încă puțin. Ești aproape gata...
              </div>
            </template>
          </card>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  methods: {},
  data() {
    return {
      isLogging: false
    };
  },
  mounted() {
    if (this.$route.query.withToken) {
      this.isLogging = true;

      this.$store.dispatch("withToken", {
        token: this.$route.query.withToken
      }).then (() => {
        return this.$store.dispatch("syncUser");
      });
    } else {
      if  (this.$store.getters.isLoggedIn) {
        this.$router.push({ name: 'home' });
      } else {
        this.$router.push({ name: 'login' });
      }
    }
  }
};
</script>

<style>
.login.section {
  position: inherit;
}
.loader {
  border: 2px solid #f3f3f3;
  border-top: 2px solid #222;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
  position: relative;
  margin: auto;
}
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
