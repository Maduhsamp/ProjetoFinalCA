<template>
    <div class="card-container">
        <div class="card" v-for="contatos in contato" :key="contatos.id">
            <div class="nome">{{ contatos.nome }}</div>
        </div>
    </div>
    </template>
    <script>
    import HttpService, { getContato } from '@/services/HttpService';

    export default{
        name: 'CardContato',
        data() {
            return {
                contato: ''
            }
        },
        async created(){
            this.contato = await getContato();
        },
        // methods: {
        //     updateContato(contato) {
        //         axios.put(`/api/contatos/${contato.id}`, contato)
        //             .then(response => {
        //                 this.contatos.forEach(c => {
        //                     if (c.id === contato.id) {
        //                         Object.assign(c, contato);
        //                     }
        //                 });
        //                 this.showModal = false;
        //             })
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     },

        //     deleteContato(contato) {
        //         axios.delete(`/api/contatos/${contato.id}`)
        //             .then(() => {
        //                 this.contatos = this.contatos.filter(c => c.id !== contato.id);
        //             })
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     }
        // }
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
    
    h2 {
        background: transparent;
        max-height: 70px;
        font-size: 24px;
    }
    </style>