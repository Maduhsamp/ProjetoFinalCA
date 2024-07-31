<template>
    <div class="modal">
        <div class="modal-content">
            <div class="top">
                <p>Excluir funil</p>
                <button class="close" @click="hideDeleteModal"><i class='bx bx-x'></i></button>
            </div>
            <span class="bar"></span>
            <label class="labelUm">Tem certeza que deseja excluir o funil?</label>
            <label class="labelDois">A ação não poderá ser desfeita.</label>
            <div>
                <button class="btnYes" @click="deleteFunil">Sim</button>
                <button class="btnNo" @click="hideDeleteModal">Não</button>
            </div>
        </div>
    </div>
</template>

<script>
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';
import { mapActions } from 'vuex';

export default {
    name: "ModalDeleteFunil",
    data() {
        return {
            id: this.$route.params.id
        }
    },
    methods: {
        ...mapActions(['hideDeleteModal']),
        async deleteFunil() {
            const toast = useToast();
            try {
                await HttpService.delete(`funil/delete/${this.id}`);
                toast.success('Funil deletado com sucesso!');
                this.$router.push('/dashboard');
                this.hideDeleteModal();
            } catch (error) {
                toast.error('Erro ao tentar deletar funil!');
                console.error(error);
            }
        }
    }
}
</script>
<style scoped>
.modal {
    display: flex;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border: none;
    width: 100%;
    max-width: 647px;
    height: 329px;
    border-radius: 10px;
}

.modal-content p {
    font-size: 1.2rem;
    font-weight: 600;
}

.modal-content .labelUm {
    display: flex;
    justify-content: center;
    color: #373753;
    margin-top: 8%;
    background: transparent;
    font-weight: 500;
    font-size: 22px;
}

.modal-content .labelDois {
    display: flex;
    justify-content: center;
    color: #42425C;
    margin-top: 3%;
    margin-bottom: 6%;
    background: transparent;
    font-weight: 500;
    font-size: 19px;
}

.btnYes,
.btnNo {
    width: 328px;
    height: 40px;
    margin-left: 23%;
    margin-bottom: 10px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.btnYes {
    background-color: #F23F2C;
    color: white;
    transition: .5s;
}

.btnYes:hover {
    background-color: #dd3926;
}

.btnNo {
    background-color: #FFFFFF;
    color: #778A9D;
    transition: .5s;
}

.btnNo:hover {
    background-color: #E6E6E6;
    color: #000;
}

.top {
    display: flex;
    justify-content: space-between;
}

.top p {
    color: #373753;
    font-weight: 500;
    font-size: 18px;
    margin-left: 5px;
    margin-top: -5px;
}

.top .close {
    position: absolute;
    background: transparent;
    border: none;
    color: #6F8298;
    font-size: 1.1em;
    top: 4%;
    right: 3%;
    cursor: pointer;
}

.top .close:hover {
    color: #5d6d80;
}

.bar {
    position: absolute;
    display: block;
    content: '';
    width: 100%;
    height: 1px;
    background: #E6EDF5;
    margin-left: -3.1%;
    top: 17%;
}
</style>
