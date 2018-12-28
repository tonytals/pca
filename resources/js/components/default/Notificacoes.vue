<template>
  <li class="dropdown">
      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
          <i class="material-icons">notifications</i>
          <span class="label-count">{{ notificacoesItens.length }}</span>
      </a>
      <ul class="dropdown-menu">
          <li class="header">NOTIFICAÇÕES</li>
          <li class="body">
              <ul class="menu" style="list-style:none">
                  <li v-for="item in notificacoesItens">
                      <a href="javascript:void(0);">
                          <div class="icon-circle">
                              <img :src="item.data.comentario.commentable.foto" style="max-width:100%"/>
                          </div>
                          <div class="menu-info">
                              <h4>{{ item.data.comentario.comment | striptag }}</h4>
                              <p>
                                  <i class="material-icons">access_time</i> <timeago :datetime="item.created_at" locale="pt-BR"></timeago>
                              </p>
                          </div>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- <li class="footer">
              <a href="javascript:void(0);">View All Notifications</a>
          </li> -->
      </ul>
  </li>
</template>

<script>
  export default {
      created () {
          this.carregaNotificacoes()
      },

      computed:{
          notificacoes() {
              this.notificacoesItens
          }
      },

      data(){
        return {
          notificacoesItens : []
        }
      },

      methods : {
        carregaNotificacoes() {
            axios.get('/notificacoes')
              .then(response => {
                 this.notificacoesItens = response.data.notificaoesUser
              })
        }
      }
  }
</script>
