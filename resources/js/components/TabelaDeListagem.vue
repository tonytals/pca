<template>
  <!-- Inicio -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <thead>
        <tr>
          <th v-for="item in colunas"><span v-for="(value, key) in item">{{value}}</span></th>
          <th v-if="acoes">Ações</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th v-for="item in colunas"><span v-for="(value, key) in item">{{value}}</span></th>
          <th v-if="acoes">Ações</th>
        </tr>
      </tfoot>
      <tbody>
        <tr v-for="(registro, key) in registros">
          <td v-for="(value, key) in registro" v-if="exibeColunas(key)">
            <span v-if="value != null && validaCampoData(value)" style="display:none;">{{value}}</span>
            <span v-if="value != null && validaCampoData(value)">
              <a v-if="link" href="">{{value | formataData}}</a>
              <div v-else>{{value | formataData}}</div>
            </span>
            <div v-else-if="value != null">
              <a v-if="link" href="">{{value}}</a>
              <div v-if="campoArray(value)"><a :href="montaRota('show', registro.id)">{{value}}</a></div>
              <div v-else><span v-for="(value, key) in value">{{value.nome}}</span></span></div>
            </div>
          </td>
          <th v-if="acoes">
            <form :action="montaRota('destroy', registro.id)" method="post">
              <a title="Editar" class="btn btn-primary waves-effect" :href="montaRota('edit', registro.id)">
                <i class="material-icons">mode_edit</i>
              </a>
                  <input type="hidden" name="_method" value="DELETE" />
                  <input type="hidden" name="_token" :value="csrf">

                  <button type="submit" title="Excluir" class="btn btn-danger waves-effect">
                    <i class="material-icons">delete</i>
                  </button>

                  <a v-if="acoesextras != null" :title="extraField('titulo')" :class="extraField('class')" :href="extraField('rota',registro.id)">
                    <i class="material-icons">{{extraField('icone')}}</i>
                  </a>

            </form>
          </th>
        </tr>

      </tbody>
    </table>

  </div>
  <!-- #FIM# -->
</template>
<script>
  export default {
    props: ['colunas','registros','acoes','link','acoesextras'],
    computed:{

    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods:{
      extraField:function(value,id=0){
        var acoesex = JSON.parse(this.acoesextras);
        switch (value) {
          case 'icone':
            return acoesex[0].icone;
            break;
          case 'rota':
            return route(acoesex[0].rota, {'id':id});
            break;
          case 'class':
            return acoesex[0].class;
            break;
          case 'titulo':
            return acoesex[0].titulo;
            break;
          default:

        }
      },
      campoArray:function(valor){
        if(Array.isArray(valor)){
          return false;
        }
        return true;
      },
      validaCampoData:function(valor){
        if(new Date(valor) != 'Invalid Date' && valor.length == 10){
          return true;
        }
        return false;
      },
      exibeColunas:function(key){
        var chaves = JSON.stringify(this.colunas);

        if(!chaves.includes('"'+key+'":')){
          return false;
        }
        return true;
      },
      montaRota(acao, id){

        try {
          return route(this.acoes + '.' + acao, {'id':id});
        } catch (error) {
          console.log(error);
        }

          return '#';

      }
    }
  }
</script>
