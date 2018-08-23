<template>
  <header class="header-global">
    <base-nav class="navbar-main mt-4" transparent type="" effect="light" expand>
      <router-link to="/">
        <a slot="brand" class="navbar-brand mr-lg-5">
          <img src="img/logo/logo-1024-white.png">
        </a>
      </router-link>
      <div class="row" slot="content-header" slot-scope="{closeMenu}">
        <div class="col-6 collapse-brand">
          <router-link to="/">
            <a>
              <img src="img/logo/logo-line-black.png">
            </a>
          </router-link>
        </div>
        <div class="col-6 collapse-close">
          <close-button @click="closeMenu"></close-button>
        </div>
      </div>
      <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
        <router-link to="/">
          <li class="nav-item">
            <a href="javascript:{}" class="nav-link nav-link-icon">
              <i class="fa fa-arrow-left mr-2"></i>
              Înapoi
            </a>
          </li>
        </router-link>
      </ul>
      <ul class="navbar-nav align-items-lg-center ml-lg-auto">
      </ul>
    </base-nav>
  </header>
</template>

<style>
</style>

<script>
import BaseNav from "@/components/BaseNav";
import BaseDropdown from "@/components/BaseDropdown";
import CloseButton from "@/components/CloseButton";

export default {
  components: {
    BaseNav,
    CloseButton,
    BaseDropdown
  }
};
</script>
