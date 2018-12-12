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
        <tr v-for="registro in registros">
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
            <a title="Editar" class="btn btn-primary waves-effect" :href="montaRota('edit', registro.id)">
              <i class="material-icons">mode_edit</i>
            </a>
            <a title="Excluir" class="btn btn-danger waves-effect" :href="montaRota('destroy', registro.id)">
              <i class="material-icons">delete</i>
            </a>
            <!--<div class="btn-group" role="group">
              <modal-link
                titulo="Detalhar"
                modal="detalha"
                css="btn btn-sm bg-teal waves-effect"
                ></modal-link>
              <modal-link
                titulo="Editar"
                modal="editar"
                css="btn btn-sm bg-teal waves-effect"
                ></modal-link>
                <button type="button" class="btn btn-sm bg-deep-orange waves-effect">Remover</button>
            </div>-->
          </th>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- #FIM# -->
</template>
<script>
  export default {
    props: ['colunas','registros','acoes','link'],
    computed:{

    },
    methods:{
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
        return route(this.acoes + '.' + acao, {'id':id});
      }
    }
  }
</script>
