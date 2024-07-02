<script>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
<div>
  <header>
    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header>

  <main>
    <RouterView />
  </main>
</div>
</template>

<style scoped>
</style>
