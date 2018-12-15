<template>
  <a v-bind:class="corBotao" data-toggle="modal" v-bind:data-target="'#' + modal">{{titulo}}</a>
</template>

<script>
export default{
  props:['titulo','modal','css'],
  computed:{
    corBotao:function(css){
      return (this.css || "btn btn-primary waves-effect")
    }
  }
}
</script>
