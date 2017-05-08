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
  font-size: 14px;
}
html {
}
a, a:hover, a:visited, a:link, a:active{
  text-decoration: none;
  color: black;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;

}
</style>
