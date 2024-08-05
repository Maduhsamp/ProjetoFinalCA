<template>
    <div>
        <div class="background">
            <div class="blob"></div>
            <div class="container">
                <div class="token">
                    {{ token }}
                </div>

                <div class="logreg-box">
                    <div class="form-box login">
                        <form @submit.prevent="novaSenha">
                            <h2> Mudar Senha </h2>
                            <div class="input-box">
                                <span class="icon"><i class='bx bxs-envelope'></i></span>
                                <input type="email" v-model="email" required>
                                <label> Email </label>
                            </div>
                            <div class="input-box">
                                <input v-if="!showPasswordRegister1" type="password" v-model="password" required>
                                <input v-if="showPasswordRegister1" type="text" v-model="password" required>
                                <label>Senha</label>
                                <span><button class="icon-eye-register1" @click="toggleShowPasswordRegister1">
                                        <img v-if="showPasswordRegister1" src="../assets/eye-open.svg"
                                            alt="Olho aberto">
                                        <img v-else src="../assets/eye-closed.svg" alt="Olho fechado">
                                    </button></span>
                            </div>
                            <div class="input-box">
                                <input v-if="!showPasswordRegister2" type="password" v-model="password_confirmation"
                                    required>
                                <input v-if="showPasswordRegister2" type="text" v-model="password_confirmation"
                                    required>
                                <label>Confirmar Senha</label>
                                <span><button class="icon-eye-register2" @click="toggleShowPasswordRegister2">
                                        <img v-if="showPasswordRegister2" src="../assets/eye-open.svg"
                                            alt="Olho aberto">
                                        <img v-else src="../assets/eye-closed.svg" alt="Olho fechado">
                                    </button></span>
                            </div>



                            <button type="submit" class="btnSend"> Mudar Senha </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';

export default {
    name: "ResetPassword",
    data() {
        return {
            email: '',
            token: '',
            password: '',
            password_confirmation: ''
        }
    },
    mounted() {
        this.token = this.$route.params.token;
    },
    methods: {
        async novaSenha() {
            const toast = useToast();

            try {
                const response = await HttpService.post('/reset-password/', {
                    email: this.email,
                    token: this.token,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
                console.log('Senha Alterada:', response.data);
                toast.success('Senha atualizada com sucesso!');
                this.$router.push('/');
            } catch (error) {
                console.error('Registration error:', error);
                toast.error('Falha ao tentar mudar a senha!');

            }
        },
    }
}
</script>

<style scoped>
@media screen and (max-width: 1920px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 15s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(1350px, 350px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}

@media screen and (max-width: 1450px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 20s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(800px, 220px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}

@media screen and (max-width: 1368px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 20s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(800px, 80px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}


.input-box .icon-eye-register2 {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box img {
    width: 24px;
    height: 24px;
}


.token {
    opacity: 0;
}

body {
    overflow: hidden;
}



.background {
    width: 100%;
    height: 100vh;
    background: url(../assets/img/fundo.png)
}


.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 25%;
    height: 570px;
    background: #e4e4e4;
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    border-radius: 10px;
    opacity: 90%;
}




.logreg-box .form-box {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background: transparent;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    color: black;
}

.form-box h2 {

    font-size: 32px;
    text-align: center;
    margin-bottom: 40px;
}

.form-box .input-box {
    position: relative;
    width: 340px;
    height: 50px;
    border-bottom: 2px solid #3057F2;
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 500;
    padding-right: 28px;
}


.btnSend {

    width: 100%;
    height: 45px;
    background: linear-gradient(90deg, #3057F2, #9ADCFF);
    border: none;
    outline: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    box-shadow: 0 0 10px rgba(0, 0, 0, .5);
    transition: .5s;
}

.btnSend:hover {
    background: linear-gradient(90deg, #FF8AAE, #FFF89A);
    color: #000;
    transition: .5s;
}

.input-box {
    display: flex;
}



.input-box .icon-eye-register1 {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box .icon-eye-register2 {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box img {
    width: 24px;
    height: 24px;
}


.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 500;
    padding-right: 28px;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 16px;
    font-weight: 500;
    pointer-events: none;
    transition: .5s ease;
}


.input-box .icon {
    position: absolute;
    top: 13px;
    right: 0;
    font-size: 19px;
}

.remember-forgot label input {
    accent-color: #e4e4e4;
    margin-right: 3px;
}

.logreg-box .form-box {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background: transparent;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    color: black;
}

.logreg-box .form-box.login {
    transform: translateX(0);
    transition: transform .6s ease;
    transition-delay: .7s;
}

.logreg-box.active .form-box.login {
    transform: translateX(430px);
    transition-delay: 0s;
}

.logreg-box .form-box.register {
    transform: translateX(430px);
    transition: transform .6s ease;
    transition-delay: 0s;
}


.form-box h2 {

    font-size: 32px;
    text-align: center;
    margin-bottom: 40px;
}

.form-box .input-box {
    position: relative;
    width: 340px;
    height: 50px;
    border-bottom: 2px solid #3057F2;
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 500;
    padding-right: 28px;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 16px;
    font-weight: 500;
    pointer-events: none;
    transition: .5s ease;
}

.input-box input:focus~label,
.input-box input:valid~label {
    top: -5px;
}

.input-box .icon {
    position: absolute;
    top: 13px;
    right: 0;
    font-size: 19px;
}

.form-box .remember-forgot {
    font-size: 14.5px;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
}
</style>
