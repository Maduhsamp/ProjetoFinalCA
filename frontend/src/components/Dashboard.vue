<template>
    <div v-if="isLoggedIn" class="header">

        <div class="Title">
            <h2>Dashboard de {{ name }}</h2>
        </div>
        <div class="inputs">
            <i class='bx bx-search-alt'></i>
            <input type="text" placeholder="Pesquisar"> 
            <button class="btnNew" @click.prevent="openSidebar">
                <h3>Novo Funil</h3>
                <i class='bx bx-plus-circle'></i>
            </button>
        </div>
        <div class="sidebar" :class="{ 'sidebar-active': isActive }">
            <form @submit.prevent="createFunil">
                <div class="input-funil">
                    <button class="go-back" @click.prevent="closeSidebar"><i class='bx bx-arrow-back'></i></button>
                    <input type="text" v-model="nome" placeholder="Nome do Funil"><i class='bx bx-add-to-queue'></i>
                </div>
                <button type="submit" class="btnSend">Adicionar Funil</button>
            </form>
        </div>
    </div>
    <div v-else>
        <p>Você precisa estar logado para ver o conteúdo do dashboard.</p>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';
import { getName } from '@/services/HttpService';
import HttpService from '@/services/HttpService';


export default {
    name: 'HeaderDashboard',
    data() {
        return {
            isActive: false,
            nome: '',
            name: ''
        }
    },
    async created(){
        this.name = await getName()
    },
    computed: {
        ...mapGetters(['Logged']),
        isLoggedIn() {
            return this.Logged;
        }
    },
    methods: {
        openSidebar() {
            this.isActive = !this.isActive;
        },
        closeSidebar() {
            this.isActive = false;
        },
        async createFunil() {
                await HttpService.post('/api/funil/create', {
                    nome: this.nome
                })
                    .then(response => {
                        this.nome.push(response.data);
                        this.showModal = false;
                    })
                    .catch(error => {
                        console.error(error);
                    });
        }
    }
}
</script>

<style scoped>
* {
    width: 100%;
    background: #f8f8f8;
}

.header {
    padding: 8px;
    max-height: 56px;
    display: flex;
}

.btnNew {
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

.btnNew:hover {
    background: #1339cf;
}

h3 {
    background: transparent;
    font-size: 16px;
    text-align: center;
}

.inputs {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;

    input {
        width: 241px;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        padding-left: 10px;
    }

    .bx-search-alt {
        position: absolute;
        display: flex;
        justify-content: end;
        right: -5px;
        top: 1.3%;
        font-size: 1.1em;
        color: #75758B;
    }

    button i {
        position: absolute;
        display: flex;
        right: -15.7%;
        top: 1.3%;
        font-size: 1.1em;
        color: #fff;
    }
}

h2 {
    margin-left: 20px;
}

.btnNew i {
    position: absolute;
    width: 0;
    display: flex;
    right: 7%;
    top: 10.8%;
    font-size: 1.1em;
}

.inputs i{
    position: absolute;
    background: transparent;
    padding-top: 12px;
    margin-right: 300px;
    width: 5PX;
    height: 5px;
}

.go-back {
    background: #E1E9F4;
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    width: 35px;
    height: 30px;
    padding-left: 10px;
    margin-bottom: 20px;
}

.sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background: #fff;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.3s ease;
    transform: translateX(100%);
}

.sidebar-active {
    transform: translateX(0);
}

.sidebar form {
    background: transparent;
    .btnSend {
        display: flex;
        justify-content: center;
        white-space: nowrap;
        font-size: 0.9em;
        width: 70%;
        height: 40px;
        background: #3057F2;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: #fff;
        font-weight: 500;
        transition: .5s;
        margin-top: 10px;
        margin-left: 15%;
        padding: 10px;
    }
    .btnSend:hover {
        background: #1339cf;
    }
}

.input-funil {
    background: transparent;
    i {
        width: 0;
        display: flex;
    }
    
    input {
        width: 100%;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        cursor: text;
        padding-left: 10px;
    }

    .bx-add-to-queue {
        position: absolute;
        display: flex;
        justify-content: end;
        right: 12%;
        top: 12.8%;
        font-size: 1.1em;
        color: #75758B;
    }
}
</style>
