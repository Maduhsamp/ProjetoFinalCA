<template>
    <div class="modal">
        <div class="modal-content">
            <span class="close" @click="hideModal">
                <!-- <p>Sair</p> -->
                &times;
            </span>
            <label>Tem certeza que deseja sair do sistema?</label>
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
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
}

.modal-content p {
    font-size: 1.2rem;
    font-weight: 600;
}

.modal-content label {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
    background: transparent;
    font-size: 1.8em;
    font-weight: 600;
}

.modal-content form {
    background: transparent;
}

.btnYes, .btnNo {
    width: 100px;
    height: 40px;
    margin: 5px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.btnYes {
    background-color: #28a745;
    color: white;
}

.btnNo {
    background-color: #dc3545;
    color: white;
}

.close {
    background: #E1E9F4;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 33px;
    height: 33px;
    border-radius: 10px;
    color: #aaa;
    float: right;
    font-size: 25px;
}

.close:hover,
.close:focus {
    text-decoration: none;
    cursor: pointer;
}
</style>
