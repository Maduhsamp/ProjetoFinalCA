<template>
    <div class="modal">
        <div class="modal-content">
            <div class="top">
                <p>Sair</p>
                <span class="close" @click="hideModal"><i class='bx bx-x'></i></span>
            </div>
            <span class="bar"></span>
            <label class="label">Tem certeza que deseja sair do sistema?</label>
            <form>
                <button class="btnYes" type="submit" @click.prevent="logout">Sim</button>
                <button class="btnNo" @click.prevent="hideModal">Não</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "ModalLogout",
    methods: {
        ...mapActions(['LogOut', 'hideModal']),
        async logout() {
            try {
                await this.LogOut();
                console.log('Logout');
                this.$router.push('/');
                this.hideModal();
            } catch (error) {
                console.error('Logout error:', error);
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

.modal-content .label {
    display: flex;
    justify-content: center;
    color: #373753;
    margin-top: 8%;
    background: transparent;
    font-size: 1.8em;
    font-weight: 500;
    font-size: 1.38em;
}

.modal-content form {
    display: flex;
    flex-direction: column;
    margin-top: 7%;
    background: transparent;
}

.btnYes,
.btnNo {
    width: 328px;
    height: 40px;
    margin-left: 23%;
    margin-bottom: 10px;
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
    font-size: 1.13em;
    margin-left: 5px;
    margin-top: -5px;
}

.top .close {
    position: absolute;
    color: #6F8298;
    font-size: 1.4em;
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
