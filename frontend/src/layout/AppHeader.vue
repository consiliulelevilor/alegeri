<template>
  <header class="header-global">
    <base-nav class="navbar-main mt-4" transparent type="" effect="light" expand>
      <router-link to="/">
        <a href="javascript:{}" slot="brand" class="navbar-brand mr-lg-5">
          <img src="img/logo/logo-1024-white.png">
        </a>
      </router-link>
      <div class="row" slot="content-header" slot-scope="{closeMenu}">
        <div class="col-6 collapse-brand">
          <router-link to="/">
            <a href="javascript:{}">
              <img src="img/logo/logo-line-black.png">
            </a>
          </router-link>
        </div>
        <div class="col-6 collapse-close">
          <close-button @click="closeMenu"></close-button>
        </div>
      </div>
      <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
      </ul>
      <ul class="navbar-nav align-items-lg-center ml-lg-auto">
        <li class="nav-item d-none d-lg-block ml-lg-4">
          <router-link to="/login">
            <a href="javascript:{}" class="btn btn-primary btn-icon">
              <span class="btn-inner--icon">
                <i class="fa fa-sign-in mr-2"></i>
              </span>
              <span class="nav-link-inner--text">Login</span>
            </a>
          </router-link>
        </li>
      </ul>
    </base-nav>
  </header>
</template>
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
<style>
</style>
