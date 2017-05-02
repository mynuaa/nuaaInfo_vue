<template>
  <div>
    <card></card>
    <palette-button class="new"></palette-button>
    <tab-bar></tab-bar>
  </div>
</template>

<script>
import PaletteButton from '@/components/PaletteButton'
import TabBar from '@/components/TabBar'
import Card from '@/components/Card'

export default {
  components: {
    PaletteButton,
    TabBar,
    Card
  }
}
</script>

<style>
.new {
  position: fixed;
  z-index: 999;
  bottom: 220px;
  right:80px;
}
</style>
