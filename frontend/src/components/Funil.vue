<template>
    <div class="header">
        <div class="funil">
            <label>Funil</label>
        </div>
        <div class="nome-funil">
            <label>Nome</label>
        </div>
        <div class="inputs">
            <i class='bx bx-search-alt'></i>
            <input type="text" placeholder="Pesquisar"> 
            <button class="btnNew" @click.prevent="openSidebar">
                <h3>Novo Contato</h3>
                <i class='bx bx-user-plus'></i>
            </button>
        </div>
        <div class="sidebar" :class="{ 'sidebar-active': isActive }">
            <form @submit.prevent="createContato">
                <div class="input-contato">
                    <button class="go-back" @click.prevent="closeSidebar"><i class='bx bx-arrow-back'></i></button>
                    <input type="text" v-model="nome" placeholder="Nome do Contato"><i class='bx bx-user'></i>
                </div>
                <button type="submit" class="btnSend">Adicionar Contato</button>
            </form>
        </div>
    </div>
</template>
<script>
import { useToast } from 'vue-toastification';

export default {
    name: 'FunilInfos',
    data() {
        return {
            isActive: false,
            nome: ''
        }
    },
    methods: {
        openSidebar() {
            this.isActive = !this.isActive;
        },
        closeSidebar() {
            this.isActive = false;
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

.funil {
    width: 30px;
    color: #72869A;
    margin-top: 10px;
    margin-left: 20px;
    font-weight: 600;
    font-size: 1em;
}

.nome-funil {
    margin-top: 35px;
    margin-left: -28px;
    font-size: 1.7em;
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
    position: relative; 
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
    position: relative;
    width: 100%;
    top: 30px;
    right: 10px;

    input {
        width: 241px;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        padding-left: 10px;
        padding-right: 35px;
    }

    .bx-search-alt {
        position: absolute;
        top: 17%;
        transform: translateY(-50%); 
        font-size: 1.1em;
        color: #75758B;
    }

    button i {
        position: absolute;
        bottom: 26px;
        left: 172px;
        font-size: 1.5em;
        color: #fff;
    }
}

.btnNew i {
        position: absolute;
        left: 68%;
        margin-top: 2.3%; 
        transform: translateY(-50%);
        font-size: 1.1em;
    }

.inputs i{
    position: absolute;
    background: transparent;
    padding-top: 12px;
    margin-right: 300px;
    width: 5px;
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
    z-index: 1;
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

.input-contato {
    background: transparent;
    position: relative;

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
        padding-right: 40px;
    }

    .bx-user {
        position: absolute;
        right: 12%; 
        top: 79%; 
        transform: translateY(-50%); 
        font-size: 1.1em;
        color: #75758B;
    }
}
</style>