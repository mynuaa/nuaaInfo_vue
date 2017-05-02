<template>
  <div id="app">
    <router-view></router-view>

  </div>
</template>

<script>
import TabBar from '@/components/TabBar'
import PaletteButton from '@/components/PaletteButton'
export default {
  name: 'app',
  components: {
    TabBar,
    PaletteButton
  }
}
</script>

<style>
body {
  margin: 0;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
