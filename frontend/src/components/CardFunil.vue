<template>
    <div class="card-container">
        <div class="card" v-for="funis in funil" :key="funis.id">
            <div class="nome">{{ funis.nome }}</div>
            <div class="acessar">
                <button class="btnAccess" @click="funilPage(funis.id)">Visualizar</button>
            </div>
        </div>
    </div>
    </template>
    <script>
    import HttpService, { getFunil } from '@/services/HttpService';

    export default{
        name: 'CardFunil',
        data() {
            return {
                funil: ''
            }
        },
        async created(){
            this.funil = await getFunil();
        },
        methods: {
            funilPage(id) {
                this.$router.push({ name: 'funil', params: { id } });
            }
        }
    }
    </script>
    <style scoped>
    * {
        background: #f8f8f8;
        height: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .card-container {
        padding-top: 80px;
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;       
    }
    
    .card {
        position: relative; 
        background: white;
        width: 240px;
        height: 130px;
        border-radius: 10px;
        padding: 10px;
        margin: auto 30px;
        border: #E1E9F4 solid 1px;
        display: inline-block;
        gap: 0px;
        margin-bottom: 10px;
    }
    
    .nome {
        background: transparent;
        max-height: 50px; 
        overflow: auto; 
        margin-bottom: 10px;
    }

    .nome::-webkit-scrollbar {
        width: 7px; 
    }

    .nome::-webkit-scrollbar-track {
        background: #ffdb79; 
        border-radius: 10px; 
    }

    .nome::-webkit-scrollbar-thumb {
        background: #FFBD00; 
        border-radius: 10px;
    }

    .nome::-webkit-scrollbar-thumb:hover {
        background: #e9ab00;
        cursor: pointer; 
    }

    .acessar {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 20%;
        background: transparent;
        width: 100%;
        margin-left: -10px;
    }
    
    .btnAccess {
        width: 70%;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #3057F2;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: #fff;
        font-weight: 500;
        font-size: 0.9em;
        transition: .5s;
    }

    .btnAccess:hover {
        background: #1339cf;
    }
    
    h2 {
        background: transparent;
        max-height: 70px;
        font-size: 24px;
    }
    </style>