<template>
    <div v-if="isLoggedIn" class="header">
        <div class="Title">
            <h2>Dashboard</h2>
        </div>
        <div class="inputs">
                <i class='bx bx-search-alt'></i>
                <input type="text" placeholder="Pesquisar"> 
            <button class="btnNew">
                <h3>Novo Funil</h3>
            </button>
        </div>
    </div>
    <div v-else>
        <p>Você precisa estar logado para ver o conteúdo do dashboard.</p>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default{
    name: 'HeaderDashboard',
    computed: {
        ...mapGetters(['Logged']),
        isLoggedIn() {
            console.log('Logged getter:', this.Logged);
            return this.Logged;
        }
    }
}
</script>
<style scoped>
    *{
        display: flex;
        width: 100%;
        background:#f8f8f8;
    }


    .header{
        padding: 8px;
        max-height: 56px;
    }

    .inputs i{
        position: absolute;
        background: transparent;
        padding-top: 12px;
        margin-right: 300px;
        width: 5PX;
        height: 5px;
    }

    .btnNew{
        width: 241px;
        height: 40px;   
        background: #3057F2;
        border: none;
        border-radius: 10px;
        outline: none;
        cursor: pointer;
        color: #fff;
        font-weight: 500;
        transition: .5s;
        margin-right: 10px;
        padding: 10px;
    }

    .btnNew:hover{
        background: #1339cf;
    }

    input{
        width: 241px;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        cursor: text;
    }

    h3{
        background: transparent;
        font-size: 16px;
        text-align: center;
        justify-content: center;
        align-content: center;
    }

    .inputs{
        justify-content: flex-end;
    }

    h2{
        margin-left: 20px;
    }
</style>