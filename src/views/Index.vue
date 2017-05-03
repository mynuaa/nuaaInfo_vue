<template>
  <div>
    <mt-switch></mt-switch>
    <card></card>
    <router-link :to="{path: '/newbottle'}"><palette-button class="new"></palette-button></router-link>
    <tab-bar></tab-bar>
  </div>
</template>

<script>
import PaletteButton from '@/components/PaletteButton'
import TabBar from '@/components/TabBar'
import Card from './Card'

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
