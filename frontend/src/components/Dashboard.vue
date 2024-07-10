<template>
    <div class="header">
            <div class="Title">
                <h2> Dashboard</h2>
            </div>
            <div class="inputs">
                    <input type="text" placeholder="Pesquisar" > 
                <button class="btnNew" @click="createFunil(funil)">
                    <i class='bx bx-plus-circle'></i>
                    <h3>Novo Funil</h3>
                </button>
            </div>
    </div>
</template>
<script>
import axios from 'axios';

export default{
    name: 'HeaderDashboard',
    methods: {
        createFunil(funil) {
                axios.post('/api/funis', funil)
                    .then(response => {
                        this.funis.push(response.data);
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
    *{
        display: flex;
        width: 100%;
        background:#f8f8f8;
    }

    .header{
        padding: 8px;
        max-height: 56px;
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