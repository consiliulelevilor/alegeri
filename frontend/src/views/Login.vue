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
            <div v-if="this.isLogging" class="loader-background">
              <div class="loader"></div>
            </div>
            <template>
              <div class="text-muted text-left mb-3">
                Pentru a începe, te poți autentifica cu oricare dintre metodele de mai jos.
              </div>
              <div class="text-muted text-left mb-4">
                Dacă nu ești deja un candidat, ți se va crea un cont automat.
              </div>
              <div class="btn-wrapper text-center">
                <base-button type="facebook" @click="social('facebook')" :disabled="this.isLogging">
                  <i class="fa fa-facebook"></i>
                </base-button>
                <base-button type="google" @click="social('google')" :disabled="this.isLogging">
                  <i class="fa fa-google"></i>
                </base-button>
                <base-button type="instagram" @click="social('instagram')" :disabled="this.isLogging">
                  <i class="fa fa-instagram"></i>
                </base-button>
              </div>
            </template>
          </card>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <a href="javascript:{}" class="text-light" title="Simplu...">
                <small>De ce nu acceptăm alte metode?</small>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  methods: {
    social: function (social) {
      this.isLogging = true;
      window.location = process.env.VUE_APP_API_URL + '/social/' + social;
    }
  },
  data() {
    return {
      isLogging: false
    };
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
  position: absolute;
  left: 0;
  right: 0;
  margin-left: auto;
  margin-right: auto;
  top: 30%;
}
.loader-background {
  background: grey;
  opacity: 0.3;
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
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
